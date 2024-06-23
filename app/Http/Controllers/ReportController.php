<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Store;
use App\Models\ProductStore;
use App\Models\Order;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ReportStore(Request $request)
    {
        $store = $request->store ? Store::find($request->store)->name : __('back.all_stores');
        $stores = Store::whereNull('deleted_at')->get();

        if ($request->store) {
            $sales = Bill::where('store_id', $request->store)->where('type', 'Sale')->whereNull('deleted_at')->get();
            $purchases = Bill::where('store_id', $request->store)->where('type', 'Purchase')->whereNull('deleted_at')->get();
            $transfers = Bill::where('store_id', $request->store)->where('type', 'Transfer')->whereNull('deleted_at')->get();
            $saleBill = Bill::where('store_id', $request->store)->where('type', 'Sale')->whereNull('deleted_at')->select('id')->get()->toArray();
            $saleBill = array_column($saleBill, 'id');
            $orderSale = Order::whereIn('bill_id', $saleBill)->whereNull('deleted_at')->select('product_id', 'qty')->get()->toArray();
            $product_store = ProductStore::where('store_id', $request->store)->whereNull('deleted_at')->get();
        } else {
            $sales = Bill::where('type', 'Sale')->whereNull('deleted_at')->get();
            $purchases = Bill::where('type', 'Purchase')->whereNull('deleted_at')->get();
            $transfers = Bill::where('type', 'Transfer')->whereNull('deleted_at')->get();
            $saleBill = Bill::where('type', 'Sale')->whereNull('deleted_at')->select('id')->get()->toArray();
            $saleBill = array_column($saleBill, 'id');
            $orderSale = Order::whereIn('bill_id', $saleBill)->whereNull('deleted_at')->select('product_id', 'qty')->get()->toArray();
            $product_store = ProductStore::whereNull('deleted_at')->get();
        }
        $sums = [];
        foreach ($orderSale as $item) {
            $key = $item['product_id'];
            if (!array_key_exists($key, $sums)) {
                $sums[$key] = 0;
            }
            $sums[$key] = $sums[$key] + $item['qty'];
        }
        $products = Product::whereIn('id',array_keys($sums))->whereNull('deleted_at')->get();
        $allProducts = Product::whereNull('deleted_at')->get();
        foreach ($products as $product) {
            $product->setAttribute('qty', $sums[$product->id]);
        }
        foreach ($sales as $sale) {

            if ($sale->paid == $sale->total_amount) {
                $status = '<div class="badge bg-soft-success font-size-12">' . __('back.paid') . '</div>';
            } elseif ($sale->paid != 0 && $sale->paid < $sale->total_amount) {
                $status = '<div class="badge bg-soft-info font-size-12">' . __('back.paid') . ' ' . __('back.partial') . '</div>';
            } else {
                $status = '<div class="badge bg-soft-warning font-size-12">' . __('back.not') . ' ' . __('back.paid') . '</div>';
            }
            $sale->setAttribute('status_paid', $status);
        }

        foreach ($purchases as $purchase) {

            if ($purchase->paid == $purchase->total_amount) {
                $status = '<div class="badge bg-soft-success font-size-12">' . __('back.paid') . '</div>';
            } elseif ($purchase->paid != 0 && $purchase->paid < $purchase->total_amount) {
                $status = '<div class="badge bg-soft-info font-size-12">' . __('back.paid') . ' ' . __('back.partial') . '</div>';
            } else {
                $status = '<div class="badge bg-soft-warning font-size-12">' . __('back.not') . ' ' . __('back.paid') . '</div>';
            }
            $purchase->setAttribute('status_paid', $status);
        }


        return view('acp.Report.Stores', compact('stores', 'sales', 'purchases', 'transfers', 'store', 'orderSale', 'products', 'product_store','allProducts'));
    }

}
