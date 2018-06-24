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

class InventoryController extends Controller
{
    
    public function index()
    {
    	$products = Product::orderBy('product_name', 'asc')->paginate(7);
    	return view('admin.inventory')->with('products', $products);
    }

    public function create(Request $request)
    {
        $rules = array(
        'product_name' => 'bail|required|min:2|unique:products,product_name',
        'product_desc' => 'required|min:5',
        'price' => 'required|numeric',
        'member_price' => 'required|numeric',
        'product_qty' => 'required|integer'	
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        else
        {
            $product = new Product;
            $product->product_name = $request->product_name;
            $product->product_desc = $request->product_desc;
            $product->price = $request->price;
            $product->member_price = $request->member_price;
            $product->product_qty = $request->product_qty;
            $product->save();
        }	
    }

    public function edit(Request $request)
    {
    	$product = Product::find($request->product_id);

        $rules = array(
        'product_name' => "bail|required|min:2|unique:products,product_name," . $product->product_id .",product_id",
        'product_desc' => 'required|min:5',
        'price' => 'required|numeric',
        'member_price' => 'required|numeric',
        'product_qty' => 'required|integer'	
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        else
        {
            $product = Product::find($request->product_id);
            $product->product_name = $request->product_name;
            $product->product_desc = $request->product_desc;
            $product->price = $request->price;
            $product->member_price = $request->member_price;
            $product->product_qty = $request->product_qty;
            $product->save();
        }	
    }

    public function destroy(Request $request)
    {
        $product = Product::find($request->product_id)->delete();
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

    public function lowstocks()
    {
        $lowstock = DB::table('profile')->select('low_stock')->where('id', 1)->first();
        $products = Product::where('product_qty', '<=', $lowstock->low_stock)->orderBy('product_name', 'asc')->paginate(7);
        return view('admin.inventorylow')->with('products', $products);
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

    public function healthystocks()
    {
        $products = Product::where('product_qty', '>', 20)->orderBy('product_name', 'asc')->paginate(7);
        return view('admin.inventoryhealthy')->with('products', $products);
    }

    public function search_healthy(Request $request)
    {
        $search = $request->search;

        if($search == "")
        {
            return Redirect::to('inventory/healthy_stocks');
        }
        else
        {
            $products = Product::where(function($query) use ($request, $search)
                {
                    $query->where('product_name', 'LIKE', '%' . $search . '%')->orWhere('product_desc', 'LIKE', '%' . $search . '%');})->where(function($query) use ($request, $search)
                {
                    $query->where('product_qty', '>', 20);
                })->paginate(7);

            $products->appends($request->only('search'));
            $count = $products->count();
            $totalcount = Product::where(function($query) use ($request, $search)
                {
                    $query->where('product_name', 'LIKE', '%' . $search . '%')->orWhere('product_desc', 'LIKE', '%' . $search . '%');})->where(function($query) use ($request, $search)
                {
                    $query->where('product_qty', '>', 20);
                })->count();
            return view('admin.inventoryhealthy')->with(['products' => $products, 'search' => $search, 'count' => $count, 'totalcount' => $totalcount]);   
        }
    }
}
