<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use App\Models\ProductStore;
use App\Models\Area;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StoreController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stores = Store::whereNull('deleted_at')->get();
        return view('acp.Store.index', compact('stores'));
    }

    public function create()
    {
        $areas = Area::where('parint', 0)->get();
        $vehicles = Vehicle::whereNull('deleted_at')->get();
        return view('acp.Store.create', compact('areas', 'vehicles'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string',
            'area_id' => 'required|string',
            'type_store' => 'required|string',
            'address' => 'required|string',
        ]);

        $store = Store::create($request->all());

        $products = Product::where('deleted_at', '=', null)
            ->pluck('id')
            ->toArray();

        if ($products) {
            foreach ($products as $product) {

                    $product_warehouse = [
                        'product_id' => $product,
                        'store_id' => $store->id,
                        'qty' => 0,
                    ];


                ProductStore::insert($product_warehouse);
            }
        }

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function edit($id)
    {
        $areas = Area::where('parint', 0)->get();
        $store = Store::findOrFail($id);
        $vehicles = Vehicle::whereNull('deleted_at')->get();

        return view('acp.Store.edit', compact('store', 'areas', 'vehicles'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'area_id' => 'required|string',
            'type_store' => 'required|string',
            'address' => 'required|string',
        ]);

        $store = Store::findOrFail($id);
        $store->update($request->all());

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        $store->deleted_at = Carbon::now();
        $store->save();

        ProductStore::where('store_id', $id)->update([
            'deleted_at' => Carbon::now(),
        ]);
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }


}
