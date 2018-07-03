<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Product;
use Response;
use Validator;
use DB;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ServicesController extends Controller
{
    
    public function index()
    {
    	$products = Product::where('product_name', 'LIKE', 'Washer%')->orderBy('product_name', 'asc')->get();
    	return view('admin.washers')->with('products', $products);
    }

    public function dryer()
    {
        $products = Product::where('product_name', 'LIKE', 'Dryer%')->orderBy('product_name', 'asc')->get();
        return view('admin.dryers')->with('products', $products);
    }

    public function edit(Request $request)
    {
    	$product = Product::find($request->product_id);

        $rules = array(
        'price' => 'required|numeric',
        'member_price' => 'required|numeric'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        else
        {
            $product = Product::find($request->product_id);
            $product->price = $request->price;
            $product->member_price = $request->member_price;
            $product->save();
        }	
    }

    public function search(Request $request)
    {
    	$search = $request->search;

        if($search == "")
        {
            return Redirect::to('inventory');
        }
        else
        {
            $products = Product::where(function($query) use ($request, $search)
                {
                    $query->where('product_name', 'LIKE', '%' . $search . '%')->orWhere('product_desc', 'LIKE', '%' . $search . '%');
                })->paginate(7);

            $products->appends($request->only('search'));
            $count = $products->count();
            $totalcount = Product::where(function($query) use ($request, $search)
                {
                    $query->where('product_name', 'LIKE', '%' . $search . '%')->orWhere('product_desc', 'LIKE', '%' . $search . '%');
                })->count();
            return view('admin.inventory')->with(['products' => $products, 'search' => $search, 'count' => $count, 'totalcount' => $totalcount]);  	
        }
    }

    

    public function search_low(Request $request)
    {
        $search = $request->search;
        $lowstock = DB::table('profile')->select('low_stock')->where('id', 1)->first();

        if($search == "")
        {
            return Redirect::to('inventory/low_stocks');
        }
        else
        {
            $products = Product::where(function($query) use ($request, $search, $lowstock)
                {
                    $query->where('product_name', 'LIKE', '%' . $search . '%')->orWhere('product_desc', 'LIKE', '%' . $search . '%');})->where(function($query) use ($request, $search, $lowstock)
                {
                    $query->where('product_qty', '<=', $lowstock->low_stock);
                })->paginate(7);

            $products->appends($request->only('search'));
            $count = $products->count();
            $totalcount = Product::where(function($query) use ($request, $search, $lowstock)
                {
                    $query->where('product_name', 'LIKE', '%' . $search . '%')->orWhere('product_desc', 'LIKE', '%' . $search . '%');})->where(function($query) use ($request, $search, $lowstock)
                {
                    $query->where('product_qty', '<=', $lowstock->low_stock);
                })->count();
            return view('admin.inventorylow')->with(['products' => $products, 'search' => $search, 'count' => $count, 'totalcount' => $totalcount]);   
        }
    }
}
