<?php

namespace App\Http\Controllers;

use App\Models\GocardlessWebhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GocardlessController extends Controller
{
   
    public function updateWebhook(Request $request){
        Log::info($request->all());
        $event = $request->events[0];
        $allowed = ['payouts','payments'];
        if( in_array( $event['resource_type'], $allowed ) ){

            $webhook = new GocardlessWebhook();
            $webhook->resource_type = $event['resource_type']; 
            $webhook->action = $event['action'];
            $webhook->payload = json_encode($event);
            $webhook->save();

        }
        return response()->json($event);
    }

    public function gocardless_create_customer(Request $request){
        Log::info($request->header('Webhook-Signature'));
        Log::info($request->all());
    }
}
