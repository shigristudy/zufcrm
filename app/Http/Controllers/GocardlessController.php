<?php

namespace App\Http\Controllers;

use App\Models\GocardlessInfo;
use App\Models\GocardlessWebhook;
use App\Models\WooOrder;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PDF;

class GocardlessController extends Controller
{
    private $access_token;

    public function __construct(){
        $this->access_token = 'sandbox_wk6v2tr38xid1BDnm4nBSsCBatzAnCOCp9ppOdpA'; 
    }
   
    public function updateWebhook(Request $request){
        Log::info($request->all());
        $event = $request->events[0];
        if( $event['resource_type'] == 'payments' ){
            if($event['links']['payment']){

                if(in_array($event['action'],['paid_out','failed'])){

                    $customer = $this->getCustomerInformationFromPaymentID($event['links']['payment']);
    
                    if( $customer && isset( $customer['metadata'] ) && isset( $customer['metadata']['order_id'] ) ){
    
                        $webhook = new GocardlessWebhook();
                        $webhook->order_id          = $customer['metadata']['order_id']; 
                        $webhook->resource_type     = $event['resource_type']; 
                        $webhook->action            = $event['action'];
                        $webhook->payload           = json_encode($event);
                        $webhook->save();
                        
                        WooOrder::where('order_id',$customer['metadata']['order_id'])
                                ->update([
                                    'submitted' => null,
                                    'claimed'   => null,
                                ]);
                    }
                }
            }
        }
        return response()->json($event);
    }

    public function gocardless_create_customer(Request $request){
        // Log::info($request->header('Webhook-Signature'));
        Log::info($request->all());

        $gocardless_info  = new GocardlessInfo();
        $gocardless_info->order_id              = $request->order_id;
        $gocardless_info->gcl_customer_id       = $request->gcl_customer_id;
        $gocardless_info->gcl_customer_bank_id  = $request->gcl_customer_bank_id;
        $gocardless_info->gcl_mandate_id        = $request->gcl_mandate_id;
        $gocardless_info->gcl_subscription_id   = $request->gcl_subscription_id;
        $gocardless_info->save();
        return 'Done';
    }


    public function getCustomerInformationFromPaymentID($payment_id){
        
        $client = new Client();
        $payment = $client->request('GET', "https://api-sandbox.gocardless.com/payments/{$payment_id}",[
                        'headers' => [
                            'GoCardless-Version'=>'2015-07-06',
                            'Accept'=>'application/json',
                            'Content-Type'=>'application/json',
                            'Authorization' => "Bearer {$this->access_token}"
                        ]
                    ]);

        $payment = json_decode($payment->getBody(),true);   
        $mandate_id = $payment['payments']['links']['mandate'];

        $mandate = $client->request('GET', "https://api-sandbox.gocardless.com/mandates/{$mandate_id}",[
                        'headers' => [
                            'GoCardless-Version'=>'2015-07-06',
                            'Accept'=>'application/json',
                            'Content-Type'=>'application/json',
                            'Authorization' => "Bearer {$this->access_token}"
                        ]
                    ]);

        $mandate = json_decode($mandate->getBody(),true);   
        
        $customer_id = $mandate['mandates']['links']['customer'];

        $customer = $client->request('GET', "https://api-sandbox.gocardless.com/customers/{$customer_id}",[
            'headers' => [
                'GoCardless-Version'=>'2015-07-06',
                'Accept'=>'application/json',
                'Content-Type'=>'application/json',
                'Authorization' => "Bearer {$this->access_token}"
            ]
        ]);

        $customer = json_decode($customer->getBody(),true); 
        return $customer;
                    
    }

    public function getWebhooks( Request $request ){
        
        $columns = ['action', 'order_id', 'payload'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        
        $query = GocardlessWebhook::with(['order'])->select('id', 'action', 'order_id', 'payload')->orderBy($columns[$column], $dir);
        
        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('action', 'like', '%' . $searchValue . '%')
                ->orWhere('order_id', 'like', '%' . $searchValue . '%');
            });
        }
        if($request->webhook_type == 'successfull'){
            $query->where('action','paid_out');
        }else{
            $query->where('action','failed');
        }
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function gocardlessCustomer( Request $request ){
        
    }

    public function gocardless_testing(){
        
            $client = new Client();
            $payment = $client->request('GET', 'https://api-sandbox.gocardless.com/payments/PM0028NZGTFWZE',[
                            'headers' => [
                                'GoCardless-Version'=>'2015-07-06',
                                'Accept'=>'application/json',
                                'Content-Type'=>'application/json',
                                'Authorization' => "Bearer {$this->access_token}"
                            ]
                        ]);

            $payment = json_decode($payment->getBody(),true);   
            // return $payment;
            $mandate_id = $payment['payments']['links']['mandate'];


            $mandate = $client->request('GET', "https://api-sandbox.gocardless.com/mandates/{$mandate_id}",[
                            'headers' => [
                                'GoCardless-Version'=>'2015-07-06',
                                'Accept'=>'application/json',
                                'Content-Type'=>'application/json',
                                'Authorization' => "Bearer {$this->access_token}"
                            ]
                        ]);

            $mandate = json_decode($mandate->getBody(),true);   
            
            $customer_id = $mandate['mandates']['links']['customer'];

            $customer = $client->request('GET', "https://api-sandbox.gocardless.com/customers/{$customer_id}",[
                'headers' => [
                    'GoCardless-Version'=>'2015-07-06',
                    'Accept'=>'application/json',
                    'Content-Type'=>'application/json',
                    'Authorization' => "Bearer {$this->access_token}"
                ]
            ]);

            $customer = json_decode($customer->getBody(),true); 
            return $customer;
                        
        
    }



    public function pdf_generator(){
        // return view('student');     
        $data = [
			'foo' => 'bar'
		];
        $pdf = PDF::loadView('student', $data);
        
        Storage::put('public/pdf/invoice.pdf', $pdf->output());
        return $pdf->stream('document.pdf');
        
    }
}
