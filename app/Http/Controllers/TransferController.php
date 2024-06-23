<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Bill;
use App\Models\Order;
use App\Models\ProductStore;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $purchases = Bill::where('type', 'Transfer')->whereNull('deleted_at')->get();
        return view('acp.Transfer.index', compact('purchases'));
    }

    public function create()
    {
        $stores = Store::whereNull('deleted_at')->get();
        $providers = User::where('type', 'PROVIDER')->whereNull('deleted_at')->get();
        $products = Product::whereNull('deleted_at')->get();
        $productSearch = Product::whereNull('deleted_at')->get(['name'])->toArray();
        return view('acp.Transfer.create', compact('stores', 'providers', 'products','productSearch'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'set_date' => 'required|string',
            'user_id' => 'required|string',
            'store_id' => 'required|string',
            'status' => 'required|string',
            'sub_total' => 'required|string',

            'tax_amount' => 'required|string',
            'total_amount' => 'required|string',
            'product_id' => 'required|array',
            'qty' => 'required|array',
            'price' => 'required|array',
            'total' => 'required|array',
        ]);
        $lastBill = Bill::latest('id')->first();
        $finalrequest = $request->all();
        $finalrequest ['ref'] = 'TR_' . date('Ymdhi') . $lastBill->id + 1;
        $finalrequest ['created_by'] = Auth::user()->id;
        $finalrequest ['type'] = 'Transfer';
        $finalrequest ['due'] = $request->total_amount;
        $bill = Bill::create($finalrequest);

        foreach ($request->product_id as $key => $value) {
            $order = new Order();
            $order->product_id = $request->product_id[$key];
            $order->qty = $request->qty[$key];
            $order->price = $request->price[$key];
            $order->total = $request->total[$key];
            $order->bill_id = $bill->id;
            $order->save();
            if ($request->status == 'ordered') {
                $product_storeFrom = ProductStore::where('store_id', $request->user_id)->where('product_id', $request->product_id[$key])->first();
                $product_storeFrom->qty -= $request->qty[$key];
                $product_storeFrom->save();
                $product_storeTo = ProductStore::where('store_id', $request->store_id)->where('product_id', $request->product_id[$key])->first();
                $product_storeTo->qty += $request->qty[$key];
                $product_storeTo->save();
            }
        }

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function show($id)
    {
        $bill = Bill::where('type', 'Transfer')->where('id',$id)->firstOrFail();

        if ($bill->paid == $bill->total_amount) {
            $status = '<div class="badge bg-soft-success font-size-12">' . __('back.paid') . '</div>';
        } elseif ($bill->paid != 0 && $bill->paid < $bill->total_amount) {
            $status = '<div class="badge bg-soft-info font-size-12">' . __('back.paid') . ' ' . __('back.partial') . '</div>';
        } else {
            $status = '<div class="badge bg-soft-warning font-size-12">' . __('back.not') . ' ' . __('back.paid') . '</div>';
        }
        $bill->setAttribute('status_paid', $status);
        return view('acp.Transfer.show', compact('bill'));
    }
    public function edit($id)
    {
        $bill = Bill::where('type', 'Transfer')->where('id',$id)->firstOrFail();
        $stores = Store::whereNull('deleted_at')->get();
        $providers = User::where('type', 'PROVIDER')->whereNull('deleted_at')->get();
        $products = Product::whereNull('deleted_at')->get();
        return view('acp.Transfer.edit', compact('stores', 'providers', 'products', 'bill'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'set_date' => 'required|string',
            'user_id' => 'required|string',
            'store_id' => 'required|string',
            'status' => 'required|string',
            'sub_total' => 'required|string',
            'tax' => 'required|string',
            'tax_amount' => 'required|string',
            'total_amount' => 'required|string',
            'product_id' => 'required|array',
            'qty' => 'required|array',
            'price' => 'required|array',
            'total' => 'required|array',
        ]);
        $finalrequest = $request->all();
        $finalrequest ['created_by'] = Auth::user()->id;
        $bill = Bill::where('type', 'Transfer')->where('id',$id)->firstOrFail();
        $bill->update($finalrequest);

        foreach ($bill->orders as $key => $order) {
            if ($request->status == 'ordered') {
                $product_store = ProductStore::where('store_id', $request->store_id)->where('product_id', $request->product_id[$key])->first();
                $product_store->qty -= $order->qty;
                $product_store->save();

            }
            $order->deleted_at = Carbon::now();
            $order->save();
        }

        foreach ($request->product_id as $key => $value) {
            $new_order = new Order();
            $new_order->product_id = $request->product_id[$key];
            $new_order->qty = $request->qty[$key];
            $new_order->price = $request->price[$key];
            $new_order->total = $request->total[$key];
            $new_order->bill_id = $bill->id;
            $new_order->save();

            if ($request->status == 'ordered') {
                $product_storeFrom = ProductStore::where('store_id', $request->user_id)->where('product_id', $request->product_id[$key])->first();
                $product_storeFrom->qty -= $request->qty[$key];
                $product_storeFrom->save();
                $product_storeTo = ProductStore::where('store_id', $request->store_id)->where('product_id', $request->product_id[$key])->first();
                $product_storeTo->qty += $request->qty[$key];
                $product_storeTo->save();
            }
        }


        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function destroy($id)
    {
        $bill = Bill::where('type', 'Transfer')->where('id',$id)->firstOrFail();
        $bill->deleted_at = Carbon::now();
        $bill->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }

}
