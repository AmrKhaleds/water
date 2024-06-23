<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Product;
use App\Models\Bill;
use App\Models\Profile;
use App\Models\Vehicle;
use App\Models\Order;
use App\Models\ProductStore;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class SaleController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$sales = Bill::where('type', 'Sale')->orderBy('set_date','desc')->whereNull('deleted_at')->get();
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
		return view('acp.Sale.index', compact('sales'));
	}

	public function ExternalDebt()
	{
		$salesUsers = Bill::where('type', 'Sale')->where('due', '!=', 0)->whereNull('deleted_at')->get(['id', 'user_id', 'due'])->toArray();


		$filtered = [];
		$ids = [];

		foreach ($salesUsers as $v) {
			$ids [] = $v['id'];
			$filtered[$v['user_id']][$v['id']] = $v['due'];
		}


		$filtered = array_filter($filtered, function ($v) {
			return count($v) > 0;
		});
		$clients = [];
		foreach ($filtered as $key => $filter){
			$clients []= ['name'=>User::where('type', 'CLIENT')->where('id',$key)->first()->name,'due'=>array_sum($filter),'count_bills'=>count($filter),'bills'=>json_encode(array_keys($filter))];
		}


//        $sales = Bill::whereIn('id', $salesUsers)->get();

		return view('acp.Sale.ExternalDebt', compact('clients'));
	}

	public function ExternalDebtBills(Request $request)
	{

		$sales = Bill::where('type', 'Sale')->where('due', '!=', 0)->whereIn('id',json_decode($request->data))->whereNull('deleted_at')->get();

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
		return view('acp.Sale.index', compact('sales'));

	}

	public function create()
	{
		$stores = Store::whereNull('deleted_at')->get();
		$clients = User::where('type', 'CLIENT')->whereNull('deleted_at')->get();
		$products = Product::whereNull('deleted_at')->get();
        $areas = Area::where('parint', 0)->get();
		return view('acp.Sale.create', compact('stores', 'clients', 'products' , 'areas'));
	}

	public function createTest()
	{
		$stores = Store::whereNull('deleted_at')->get();
		$clients = User::where('type', 'CLIENT')->whereNull('deleted_at')->get();
		$products = Product::whereNull('deleted_at')->get();
		return view('acp.Sale.createTest', compact('stores', 'clients', 'products'));
	}

	public function GetProductStore($id)
	{
		$stores = ProductStore::where('store_id', $id)->whereNull('deleted_at')->get();
//        $li = '';
		$li = [];
		foreach ($stores as $store) {
//            $li .= '<li><a href="#" data-fa="'.$store->product->name.'" title="">'.$store->product->name.'</a></li>';
			$li [] = $store->product->name;
		}
//        return '<ul>'.$li.'</ul>';
		return $li;
	}

	public function store(Request $request)
	{
//        dd($request->all());
        $validationArray = [
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
        ];
        if($request->client_type == 'new_client') {
            $validationArray = array_merge($validationArray, [
                'client_name' => 'required',
                'client_phone' => 'required',
                'client_whatsapp' => 'required',
            ]);
            unset($validationArray['user_id']);
        }

        $validator = Validator::make($request->all(), $validationArray);
        if ($validator->fails()){
            return Redirect::back()->withErrors($validator->errors());
        }
        /*
        if ($request->status == 'ordered') {
            foreach ($request->product_id as $key => $value) {
                $product_store = ProductStore::where('store_id', $request->store_id)->where('product_id', $request->product_id[$key])->first();
                if ($product_store->qty < $request->qty[$key]) {
                    return back()->withErrors(__('back.the_product_is_out_of_stock') . ' ' . $product_store->product->name);
                }
            }
        }*/

		$lastBill = Bill::where('type', 'Sale')->latest('id')->first();



		$finalrequest = $request->all();
        $finalrequest ['ref'] =  is_null($lastBill) ? 'SL_' . date('Ymdhi') . 1 : 'SL_' . date('Ymdhi') . ($lastBill->id + 1);
        $finalrequest ['created_by'] = Auth::user()->id;
		$finalrequest ['type'] = 'Sale';
		$finalrequest ['due'] = $request->total_amount;

        // adding new client
        if($request->client_type == 'new_client'){

            $user = new User();
            $user->name = $request->client_name;
            $user->type = 'CLIENT';
            $user->save();
            $profile = new Profile();
            $profile->phone = $request->client_phone;
            $profile->whatsapp = $request->client_whatsapp;
            $profile->address = $request->client_address;
            $profile->from_area = $request->client_from_area;
            $profile->type_client = $request->client_type_client;
            $profile->user_id = $user->id;
            $profile->save();
            $finalrequest ['user_id'] = $user->id;
        }
        //end adding client

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
				$product_store = ProductStore::where('store_id', $request->store_id)->where('product_id', $request->product_id[$key])->first();
				$product_store->qty -= $request->qty[$key];
				$product_store->save();

			}
		}

		\Session::flash('msg', __('back.successfully_saved'));
		return Redirect::back();
	}

	public function show($id)
	{
		$bill = Bill::findOrFail($id);

		if ($bill->paid == $bill->total_amount) {
			$status = '<div class="badge bg-soft-success font-size-12">' . __('back.paid') . '</div>';
		} elseif ($bill->paid != 0 && $bill->paid < $bill->total_amount) {
			$status = '<div class="badge bg-soft-info font-size-12">' . __('back.paid') . ' ' . __('back.partial') . '</div>';
		} else {
			$status = '<div class="badge bg-soft-warning font-size-12">' . __('back.not') . ' ' . __('back.paid') . '</div>';
		}
		$bill->setAttribute('status_paid', $status);
		return view('acp.Sale.show', compact('bill'));
	}

	public function PrintPos($id)
	{
		$bill = Bill::findOrFail($id);

		if ($bill->paid == $bill->total_amount) {
			$status = '<div class="badge bg-soft-success font-size-12">' . __('back.paid') . '</div>';
		} elseif ($bill->paid != 0 && $bill->paid < $bill->total_amount) {
			$status = '<div class="badge bg-soft-info font-size-12">' . __('back.paid') . ' ' . __('back.partial') . '</div>';
		} else {
			$status = '<div class="badge bg-soft-warning font-size-12">' . __('back.not') . ' ' . __('back.paid') . '</div>';
		}
		$bill->setAttribute('status_paid', $status);

//        return view('acp.Sale.PrinPos', compact('bill'))->render();
		return response()->json(view('acp.Sale.PrinPos', compact('bill'))->render());
	}

	public function assign($id, $assign_to)
	{
		$vehicle = Vehicle::where('id', $assign_to)->latest()->first();
		if ($vehicle->assign->user_id) {
			$booking = Bill::find($id);
			$booking->vehicle_id = $assign_to;
			$booking->driver_id = $vehicle->assign->user_id;
			$booking->assign_car_id = $vehicle->assign->id;
			$booking->assign_at = date('Y-m-d H:i:s');
			$booking->status_ship = 'inprocess';
			$booking->save();
			\Session::flash('msg', __('back.successfully_assign'));
			return back();
		}
	}

	public function edit($id)
	{
		$bill = Bill::where('type', 'Sale')->where('id', $id)->firstOrFail();
		$stores = Store::whereNull('deleted_at')->get();
		$clients = User::where('type', 'CLIENT')->whereNull('deleted_at')->get();
		$products = Product::whereNull('deleted_at')->get();
		return view('acp.Sale.edit', compact('stores', 'clients', 'products', 'bill'));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'set_date' => 'required|string',
			'user_id' => 'required|string',
			'store_id' => 'required|string',
			'status' => 'required|string',
			'sub_total' => 'required|string',
			'total_amount' => 'required|string',
			'product_id' => 'required|array',
			'qty' => 'required|array',
			'price' => 'required|array',
			'total' => 'required|array',
		]);
		if ($request->status == 'ordered') {
			foreach ($request->product_id as $key => $value) {
				$product_store = ProductStore::where('store_id', $request->store_id)->where('product_id', $request->product_id[$key])->first();
				if ($product_store->qty < $request->qty[$key]) {
					return back()->withErrors(__('back.the_product_is_out_of_stock') . ' ' . $product_store->product->name);
				}
			}
		}

		$finalrequest = $request->all();
		$finalrequest ['created_by'] = Auth::user()->id;
		$bill = Bill::where('type', 'Sale')->where('id', $id)->firstOrFail();
		$bill->update($finalrequest);

		foreach ($bill->orders as $keyO => $order) {
			if ($request->status == 'ordered') {
				$product_store = ProductStore::where('store_id', $request->store_id)->where('product_id', $request->product_id[$keyO])->first();
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
				$product_store = ProductStore::where('store_id', $request->store_id)->where('product_id', $request->product_id[$key])->first();
				$product_store->qty -= $request->qty[$key];
				$product_store->save();
			}
		}


		\Session::flash('msg', __('back.successfully_saved'));
		return back();
	}

	public function undestroy($id)
	{
		$bill = Bill::findOrFail($id);
		$bill->vehicle_id = null;
		$bill->driver_id = null;
		$bill->assign_car_id = null;
		$bill->status_ship = 'waiting';
		$bill->save();
		\Session::flash('msg', __('back.successfully_recovery'));
		return back();
	}

	public function Status($id, $status)
	{
		$bill = Bill::findOrFail($id);
		$bill->status_ship = $status;
		$bill->save();
		\Session::flash('msg', __('back.successfully_saved'));
		return back();
	}

	public function trakingsDestroy(Request $request, $id)
	{
		$bill = Bill::findOrFail($id);
		$bill->vehicle_id = null;
		$bill->status_ship = 'canceled';
		$bill->note_canceled = $request->note_canceled;
		$bill->save();
		\Session::flash('msg', __('back.successfully_canceled'));
		return back();
	}

	public function destroy($id)
	{
		$bill = Bill::where('type', 'Sale')->where('id', $id)->firstOrFail();
		$bill->deleted_at = Carbon::now();
		$bill->save();
		\Session::flash('msg', __('back.successfully_deleted'));
		return back();
	}

}
