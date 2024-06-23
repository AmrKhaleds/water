<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Store;
use App\Models\Unit;
use App\Models\ProductStore;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->brand) {
            $products = Product::where('brand_id', $request->brand)->whereNull('deleted_at')->orderBy('id', 'DESC')->paginate(18);
        } else {
            $products = Product::whereNull('deleted_at')->orderBy('id', 'DESC')->paginate(18);
        }
        $brands = Brand::all();
        return view('acp.Product.index', compact('products', 'brands'));
    }

    public function create()
    {
        $brands = Brand::whereNull('deleted_at')->get();
        $units = Unit::whereNull('deleted_at')->get();
        return view('acp.Product.create', compact('units', 'brands'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'cost' => 'required|string',
            'unit_id' => 'required|string',
            'brand_id' => 'required|string',
            'alert_stock' => 'required|string',
            'sale' => 'required|string',
            'notes' => 'required|string',
            'photos' => 'required|array',
        ]);
        $ids = [];
        foreach ($request->photos as $id) {
            $ids [] = uploadFile($id);
        }
        $final = $request->all();
        $final ['photos'] = json_encode($ids);
        $product = Product::create($final);

        $stores = Store::whereNull('deleted_at')->get();

        foreach ($stores as $store) {
            $prod = [];
            $prod ['product_id'] = $product->id;
            $prod ['store_id'] = $store->id;
            $prod ['qty'] = 0;
            ProductStore::create($prod);
        }

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function getAjax($product_id,$store_id)
    {
        $productStore = ProductStore::where('product_id',$product_id)->where('store_id',$store_id)->first();
        $product = Product::findOrFail($product_id);
        $product->setAttribute('qty',$productStore->qty);
        return response()->json($product);
    }
    public function Details($product_name)
    {
        $product = Product::where('name',$product_name)->whereNull('deleted_at')->first();
        return response()->json($product);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::whereNull('deleted_at')->get();
        $units = Unit::whereNull('deleted_at')->get();
        return view('acp.Product.edit', compact('units', 'brands', 'product'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'cost' => 'required|string',
            'unit_id' => 'required|string',
            'brand_id' => 'required|string',
            'alert_stock' => 'required|string',
            'sale' => 'required|string',
            'notes' => 'required|string',
        ]);
        $product = Product::findOrFail($id);
        $final = $request->all();
        if (!is_null($request->photos) && !empty(array_filter($request->photos))) {
            $ids = [];
            foreach ($request->photos as $id) {
                $ids [] = uploadFile($id);
            }

            $final ['photos'] = json_encode($ids);
        }

        $product->update($final);

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->deleted_at = Carbon::now();
        $product->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }

}
