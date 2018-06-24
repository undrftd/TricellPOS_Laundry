<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Reload_sale;
use App\Sale;
use App\Sales_details;
use App\Product;
use Carbon\Carbon;
use Response;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index()	
    {	
        //panels
        $newmembers = User::where('role', 'member')->where('created_at', '>', Carbon::now()->subDays(7))->count();
        $reloadsales = Reload_sale::selectRaw('ROUND(SUM(amount_due),2)')->where('transaction_date', '>', Carbon::now()->subDays(30))->pluck('ROUND(SUM(amount_due),2)')->toArray();
        $reloadsales = implode($reloadsales);
        $sales = Sale::selectRaw('ROUND(SUM(amount_due),2)')->where('transaction_date', '>', Carbon::now()->subDays(30))->pluck('ROUND(SUM(amount_due),2)')->toArray();
        $sales = implode($sales);
        $stock_ind = DB::table('profile')->select('low_stock')->where('id', 1)->first();
        $lowstock = Product::where('product_qty', '<=', $stock_ind->low_stock)->count();

        //sales for the year
        $yearnow = Carbon::now()->format('Y');

        $jan = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->whereRaw("(DATE_FORMAT(transaction_date, '%M') = 'January')")->whereRaw("(DATE_FORMAT(transaction_date, '%Y') = '$yearnow')")->get()->toArray();
        $jan = array_column($jan, 'ROUND(SUM(amount_due),2)');
        $feb = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->whereRaw("(DATE_FORMAT(transaction_date, '%M') = 'February')")->whereRaw("(DATE_FORMAT(transaction_date, '%Y') = '$yearnow')")->get()->toArray();
        $feb = array_column($feb, 'ROUND(SUM(amount_due),2)');
        $mar = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->whereRaw("(DATE_FORMAT(transaction_date, '%M') = 'March')")->whereRaw("(DATE_FORMAT(transaction_date, '%Y') = '$yearnow')")->get()->toArray();
        $mar = array_column($mar, 'ROUND(SUM(amount_due),2)');
        $apr = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->whereRaw("(DATE_FORMAT(transaction_date, '%M') = 'April')")->whereRaw("(DATE_FORMAT(transaction_date, '%Y') = '$yearnow')")->get()->toArray();
        $apr = array_column($apr, 'ROUND(SUM(amount_due),2)');
        $may = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->whereRaw("(DATE_FORMAT(transaction_date, '%M') = 'May')")->whereRaw("(DATE_FORMAT(transaction_date, '%Y') = '$yearnow')")->get()->toArray();
        $may = array_column($may, 'ROUND(SUM(amount_due),2)');
        $jun = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->whereRaw("(DATE_FORMAT(transaction_date, '%M') = 'June')")->whereRaw("(DATE_FORMAT(transaction_date, '%Y') = '$yearnow')")->get()->toArray();
        $jun = array_column($jun, 'ROUND(SUM(amount_due),2)');
        $jul = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->whereRaw("(DATE_FORMAT(transaction_date, '%M') = 'July')")->whereRaw("(DATE_FORMAT(transaction_date, '%Y') = '$yearnow')")->get()->toArray();
        $jul = array_column($jul, 'ROUND(SUM(amount_due),2)');
        $aug = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->whereRaw("(DATE_FORMAT(transaction_date, '%M') = 'August')")->whereRaw("(DATE_FORMAT(transaction_date, '%Y') = '$yearnow')")->get()->toArray();
        $aug = array_column($aug, 'ROUND(SUM(amount_due),2)');
        $sep = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->whereRaw("(DATE_FORMAT(transaction_date, '%M') = 'September')")->whereRaw("(DATE_FORMAT(transaction_date, '%Y') = '$yearnow')")->get()->toArray();
        $sep = array_column($sep, 'ROUND(SUM(amount_due),2)');
        $oct = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->whereRaw("(DATE_FORMAT(transaction_date, '%M') = 'October')")->whereRaw("(DATE_FORMAT(transaction_date, '%Y') = '$yearnow')")->get()->toArray();
        $oct = array_column($oct, 'ROUND(SUM(amount_due),2)');
        $nov = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->whereRaw("(DATE_FORMAT(transaction_date, '%M') = 'November')")->whereRaw("(DATE_FORMAT(transaction_date, '%Y') = '$yearnow')")->get()->toArray();
        $nov = array_column($nov, 'ROUND(SUM(amount_due),2)');
        $dec = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->whereRaw("(DATE_FORMAT(transaction_date, '%M') = 'December')")->whereRaw("(DATE_FORMAT(transaction_date, '%Y') = '$yearnow')")->get()->toArray();
        $dec = array_column($dec, 'ROUND(SUM(amount_due),2)');
       
        $yearsales = array($jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec);

        //donut sales by payment mode
        $cashpay = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->where('payment_mode', 'cash')->get()->toArray();
        $cashpay = array_column($cashpay, 'ROUND(SUM(amount_due),2)');
        $loadpay = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->where('payment_mode', 'card load')->get()->toArray();
        $loadpay = array_column($loadpay, 'ROUND(SUM(amount_due),2)');
        
        //bar member vs walk-in 
        $membersales = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->where('guest_id', '0')->get()->toArray();
        $membersales = array_column($membersales, 'ROUND(SUM(amount_due),2)');
        $guestsales = DB::table('sales')->selectRaw('ROUND(SUM(amount_due),2)')->where('guest_id', '!=', '0')->get()->toArray();
        $guestsales = array_column($guestsales, 'ROUND(SUM(amount_due),2)');

        $topitems = DB::table('sales_details')->selectRaw('DISTINCT sales_details.product_id, products.product_name, SUM(subtotal) as subtotal')->groupBy('product_id')->join('products', 'sales_details.product_id', '=', 'products.product_id')->limit(10)->orderBy('subtotal', 'desc')->get()->toArray();

        $topmembers = DB::table('sales')->selectRaw('DISTINCT (sales.member_id), CONCAT(users.firstname, " ", users.lastname) as name, SUM(amount_due) as amount_due')->groupBy('member_id')->join('users', 'sales.member_id', '=', 'users.id')->limit(10)->orderBy('amount_due', 'desc')->get()->toArray();

        return view('admin.dashboard')->with(['newmembers' => $newmembers, 'lowstock' => $lowstock, 'reloadsales' => $reloadsales, 'sales' => $sales, 'cashpay' => json_encode($cashpay,JSON_NUMERIC_CHECK), 'loadpay' => json_encode($loadpay,JSON_NUMERIC_CHECK),'yearsales' => $yearsales, 'membersales' => json_encode($membersales,JSON_NUMERIC_CHECK), 'guestsales' => json_encode($guestsales,JSON_NUMERIC_CHECK), 'topitems' => $topitems, 'topmembers' => $topmembers]);
    }

}
