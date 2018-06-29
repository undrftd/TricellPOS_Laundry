<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Guest;
use App\Product;
use App\Discount;
use App\Sale;
use App\Sales_details;
use Response;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class QueueController extends Controller
{
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');
        
        $queues = Sale::where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '=', $now)->orderBy('transaction_date', 'asc')->paginate(7);
        return view('admin.queue')->with(['queues' => $queues]);
    }

    public function viewstatus()
    {
        $washers = Product::where('product_name', 'LIKE', 'Washer%')->get();
        $dryers = Product::where('product_name', 'LIKE', 'Dryer%')->get();
        return view('admin.queuestatus')->with(['washers' => $washers, 'dryers' => $dryers]);
    }

    public function showdetails(Request $request)
    {
        $sales_id = $request->sales_id;
        $washers = Sales_details::with('product')->where('sales_id', $sales_id)->where('product_id', '<=', 8)->orderBy('product_id', 'asc')->get();
        $dryers = Sales_details::with('product')->where('sales_id', $sales_id)->where('product_id', '>', 8)->orderBy('product_id', 'asc')->get();
        $expire = Carbon::now()->addMinutes(10)->toDateTimeString();
        
       return view('admin.queuedetails')->with(['washers' => $washers, 'dryers' => $dryers, 'expire'=> $expire ]);
    }

    public function switch(Request $request)
    {
        $details = Sales_details::where('id', $request->id)->where('sales_id', $request->sales_id)->first();
        $profile = DB::table('profile')->select('*')->where('id', 1)->first();

        if($details->product->switch == 0)
        {
            $details->product->switch = 1;
            $details->product->used_by = $request->sales_id;
            $details->switch = 1;  
            $details->used = $details->used +1;
            
            if($details->product_id <= 8)
            {
                $details->product->finish_date = Carbon::now()->addMinutes($profile->washer_timer);
            }
            else
            {
                $details->product->finish_date = Carbon::now()->addMinutes($profile->dryer_timer);
            }
        }
        else if($details->product->switch == 1)
        {
            $details->product->switch = 0; 
            $details->product->used_by = 0; 
            $details->switch = 0; 
        }
        $details->save();
        $details->product->save();

        return Response::json(array('used' => $details->used, 'quantity' => $details->quantity));
    }
}
