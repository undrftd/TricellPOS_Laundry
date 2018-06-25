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
        
        $queue = Sale::where(DB::raw("(DATE_FORMAT(transaction_date,'%Y-%m-%d'))"), '=', $now)->orderBy('transaction_date', 'asc')->paginate(7);
        return view('admin.queue')->with(['queue' => $queue]);
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

        return view('admin.queuedetails')->with(['washers' => $washers, 'dryers' => $dryers]);
    }

    public function switch(Request $request)
    {
        // $details = Product::find($request->product_id);
        // if($details->switch == 0)
        // {
        //    $details->switch = 1; 
        //     // $product->sales->finish_date = Carbon::now()->addMinutes(10);
        // }
        // else if($details->switch == 1)
        // {
        //     $details->switch = 0;  
        // }

        // $details->save();

        $details = Sales_details::where('sales_id', $request->sales_id)->where('product_id', $request->product_id)->first();
        // dd($product->salesdetails->finish_date);
        if($details->product->switch == 0)
        {
           $details->product->switch = 1; 
           $details->finish_date = Carbon::now()->addMinutes(10);
        }
        else if($details->product->switch == 1)
        {
            $details->product->switch = 0;  
        }
        $details->save();
        $details->product->save();
    }
}
