<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Student;
use App\Models\StudentDonation;
use App\Models\WooOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SponsorshipController extends Controller
{
    public function getAllUnAllocatedDonations(){
        $donations = OrderItem::with(['order'])
                    ->whereIn('product_id',[11863, 11864, 11814, 11815, 11816])
                    ->get();
        return response()->json($donations);
        
    }

    public function fund_students(Request $request){
        $this->validate($request, [
            'selectedDonations' => 'required',
            'student_id' => 'required',
        ]);
        DB::beginTransaction();

        try {
            $student = Student::find($request->student_id);
            $student->sponsored = 1;
            $student->save();

            foreach($request->selectedDonations  as $donation){
                $s_d = new StudentDonation();
                $s_d->order_id      = $donation['id'];
                $s_d->student_id    = $request->student_id;
                $s_d->save();

                $order = WooOrder::find($donation['id']);
                $order->is_allocated = now();
                $order->save();
            }
            DB::commit();
        
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => 0,
                'message' => $e  
            ]);
        }

        return response()->json([
            'success' => 1,
            'message' => 'Student Has been Funded'  
        ]);
    }
}
