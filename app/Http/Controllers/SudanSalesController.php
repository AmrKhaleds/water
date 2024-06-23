<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use App\Models\SudanSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SudanSalesController extends Controller
{
    public function index()
    {
        $sales = SudanSale::latest()->get();
        $total_quantity = SudanSale::all()->sum('quantity');
        $total_net_profit = SudanSale::all()->sum('net_profit');

        return view('acp.sudan_sales.list', compact('sales', 'total_net_profit', 'total_quantity'));
    }

    public function create()
    {
        $products = Product::all();
        return view('acp.sudan_sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "client_name" => 'required|string',
            "client_phone" => 'required',
            "company_name" => 'required|string',
            "quantity" => 'required|integer',
            "purchase_price" => 'required|integer',
            "sale_price" => 'required|integer',
            "purchase_date" => 'required|date',
            "goods_received_date" => 'required|date',
            "received" => 'required',
            "product_id" => 'required|integer',
        ]);
        $getFactoryQuantity = Setting::where('name', 'sudan_sales_factory_quantity')->first();
        if ($request->purchase_price && $request->sale_price) {
            $net_profit_without_expenses = (($request->quantity * $request->sale_price) + $request->paper_loading_cost ?? 0) - $request->quantity * $request->purchase_price;
            $lastBill = SudanSale::latest('id')->first();

            $sale = new SudanSale();
            // Client Details
            $sale->client_name = $request->client_name;
            $sale->client_phone = $request->client_phone;
            $sale->client_whatsapp = $request->client_whatsapp;
            $sale->client_passport = $request->client_passport ?? null;
            $sale->address = $request->address ?? null;
            // Driver Details
            $sale->driver_name = $request->driver_name ?? null;
            $sale->driver_phone = $request->driver_phone ?? null;
            $sale->driver_passport = $request->driver_passport ?? null;
            // Sales Details
            $sale->product_id = $request->product_id ?? null;
            $sale->water_export = $request->water_export ?? null;
            $sale->quantity = $request->quantity;
            $sale->small_packages = $request->small_packages ?? null;
            $sale->large_packages = $request->large_packages ?? null;
            $sale->purchase_price = $request->purchase_price;
            $sale->sale_price = $request->sale_price;
            $sale->expenses = $request->expenses ?? 0;
            $sale->paper_loading_cost = $request->paper_loading_cost ?? 0;
            // Company Details
            $sale->company_name = $request->company_name;
            $sale->clearance_agent_name = $request->clearance_agent_name ?? null;
            $sale->clearance_agent_phone = $request->clearance_agent_phone ?? null;
            $sale->purchase_date = $request->purchase_date;
            $sale->goods_received_date = $request->goods_received_date;
            $sale->received = $request->received;
            if($sale->received == 'received'){
                $getFactoryQuantity->value -= $sale->quantity;
                $getFactoryQuantity->save();
            }

            $sale->notes = $request->notes;

            $sale->ref = is_null($lastBill) ? 'SS_' . date('Ymd') . '_' . str_pad(1, 4, "0", STR_PAD_LEFT) : 'SS_' . date('Ymd') . '_' . str_pad($lastBill->id + 1, 4, "0", STR_PAD_LEFT);
            $sale->net_profit = $net_profit_without_expenses - $request->expenses ?? 0;
            $sale->assign_from = Auth::user()->id;
            $sale->save();

            Session::flash('msg', __('back.successfully_applied'));
            return redirect()->route('sudan_sales.index');
        }
    }

    public function show($id)
    {
        $sale = SudanSale::find($id);
        return view('acp.sudan_sales.show', compact('sale'));
    }

    public function edit($id)
    {
        $sale = SudanSale::find($id);
        $products = Product::all();
        return view('acp.sudan_sales.edit', compact('sale', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "client_name" => 'required|string',
            "client_phone" => 'required',
            "company_name" => 'required|string',
            "quantity" => 'required|integer',
            "purchase_price" => 'required|integer',
            "sale_price" => 'required|integer',
            "purchase_date" => 'required|date',
            "goods_received_date" => 'required|date',
            "received" => 'required',
            "product_id" => 'required|integer',
        ]);
        $getFactoryQuantity = Setting::where('name', 'sudan_sales_factory_quantity')->first();
        $net_profit_without_expenses = (($request->quantity * $request->sale_price) + $request->paper_loading_cost ?? 0) - $request->quantity * $request->purchase_price;

        $sale = SudanSale::where('id', $id)->first();
        // Client Details
        $sale->client_name = $request->client_name;
        $sale->client_phone = $request->client_phone;
        $sale->client_whatsapp = $request->client_whatsapp;
        $sale->client_passport = $request->client_passport ?? null;
        $sale->address = $request->address ?? null;
        // Driver Details
        $sale->driver_name = $request->driver_name ?? null;
        $sale->driver_phone = $request->driver_phone ?? null;
        $sale->driver_passport = $request->driver_passport ?? null;
        // Sales Details
        $sale->product_id = $request->product_id ?? null;
        $sale->water_export = $request->water_export ?? null;
        $sale->quantity = $request->quantity;
        $sale->small_packages = $request->small_packages ?? null;
        $sale->large_packages = $request->large_packages ?? null;
        $sale->purchase_price = $request->purchase_price;
        $sale->sale_price = $request->sale_price;
        $sale->expenses = $request->expenses ?? 0;
        $sale->paper_loading_cost = $request->paper_loading_cost ?? 0;
        // Company Details
        $sale->company_name = $request->company_name;
        $sale->clearance_agent_name = $request->clearance_agent_name ?? null;
        $sale->clearance_agent_phone = $request->clearance_agent_phone ?? null;
        $sale->purchase_date = $request->purchase_date;
        $sale->goods_received_date = $request->goods_received_date;

        if($request->received != "pending"){
            $getFactoryQuantity->value -= $sale->quantity;
            $getFactoryQuantity->save();
            $sale->received = $request->received;
        }


        $sale->notes = $request->notes;

        // $sale->ref = is_null($lastBill) ? 'SS_' . date('Ymd') . '_' . str_pad(1, 4, "0", STR_PAD_LEFT) : 'SS_' . date('Ymd') . '_' . str_pad($lastBill->id + 1, 4, "0", STR_PAD_LEFT);
        $sale->net_profit = $net_profit_without_expenses - $request->expenses ?? 0;
        $sale->assign_from = Auth::user()->id;
        $sale->save();

        Session::flash('msg', __('back.successfully_applied'));
        return redirect()->route('sudan_sales.index');
    }

    public function destroy($id)
    {
        $sale = SudanSale::find($id);
        $sale->delete();
        Session::flash('msg', __('back.successfully_deleted'));
        return redirect()->route('sudan_sales.index');
    }

    public function invoice($id)
    {
        $sale = SudanSale::find($id);
        return view('acp.sudan_sales.invoice', compact('sale'));
    }

    public function factory_quantity()
    {
        return view('acp.sudan_sales.factory_quantity');
    }

    public function factory_quantity_store(Request $request)
    {
        $request->validate([
            'sudan_sales_factory_quantity' => 'required|integer',
        ]);

        $getQuantity = Setting::where('name', 'sudan_sales_factory_quantity')->first();
        $getQuantity->value = $request->sudan_sales_factory_quantity;
        $getQuantity->save();

        Session::flash('msg', __('back.successfully_applied'));
        return redirect()->route('sudan_sales.index');
    }
}
