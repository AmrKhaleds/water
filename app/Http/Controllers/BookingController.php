<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Bill;
use App\Models\Booking;
use App\Models\Brand;
use App\Models\Rate;
use App\Models\User;
use App\Models\SettingKM;
use Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->search) {
            $bookings = Booking::where('client_phone', 'LIKE', "%$request->search%")->OrWhere('client_phone2', 'LIKE', "%$request->search%")->OrWhere('client_name', 'LIKE', "%$request->search%")->whereNull('deleted_at')->orderBy('id', 'DESC')->paginate(9);
        } else {
            $bookings = Booking::whereNull('deleted_at')->orderBy('id', 'DESC')->paginate(9);
        }
        foreach ($bookings as $booking) {
            $brand = [];
            foreach ($booking->bill->orders as $order) {
                $brand [] = $order->product->brand->title;
            }
            $booking->setAttribute('brand', implode("-",$brand));
        }
        if ($request->ajax()) {
            $view = view('acp.Booking.scroll', compact('bookings'))->render();
            return response()->json(['html' => $view]);
        }
        return view('acp.Booking.index', compact('bookings', 'request'));
    }

    public function create()
    {
        $areas = Area::where('parint', 0)->get();
        $brands = Brand::whereNull('deleted_at')->get();
        $users = User::where('type', 'CLIENT')->get();
        $bills = Bill::where('type', 'Sale')->whereNull('deleted_at')->get();
        return view('acp.Booking.create', compact('areas', 'users', 'brands', 'bills'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request, [
            "bill_id" => "required",
            "filling_period" => "required",
            "first_day_packing" => "required",
            "from_area" => "required",
            "near" => "required",
            "packing_number" => "required",
            "price" => "required",
            "time" => "required",
            "from_address" => "required",
            "status" => "required",
//            "type" => "required",
//            "gallon_count" => "required",
        ]);
        $Request = $request->all();
        $Request['created_by'] = Auth::user()->id;
        $booking = Booking::create($Request);

        \Session::flash('msg', __('back.successfully_saved'));
        return redirect()->route('bookings.index');
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
            $brand = [];
            foreach ($booking->bill->orders as $order) {
                $brand [] = $order->product->brand->title;
            }
            $booking->setAttribute('brand', implode("-",$brand));

        return view('acp.Booking.show', compact('booking'));
    }

    public function SearchPhone(Request $request)
    {
        $bookings = Booking::query()
            ->where('client_phone', 'LIKE', "%{$request->phone}%")
            ->orWhere('client_phone2', 'LIKE', "%{$request->phone}%")
            ->get();
        foreach ($bookings as $booking) {
            $status = '';
            if ($booking->status == 'inprocess') {
                $status = 'warning';
            } elseif ($booking->status == 'finished') {
                $status = 'success';
            } elseif ($booking->status == 'canceled') {
                $status = 'danger';
            }
            $booking->setAttribute('status_lable', '<span class="badge rounded-pill bg-' . $status . ' float-end">' . __('back.' . $booking->status) . '</span>');
            $booking->setAttribute('created', $booking->created_at->format('d-m-Y'));
            $booking->setAttribute('vehicle_status', __('back.' . $booking->vehicle_status));
            $booking->setAttribute('vehicle_type', __('back.' . $booking->vehicle_type));
        }
        return response()->json($bookings);
    }

    public function edit($id)
    {
        $areas = Area::where('parint', 0)->get();
        $booking = Booking::findOrFail($id);
        $brands = Brand::whereNull('deleted_at')->get();
        $users = User::where('type', 'CLIENT')->get();
        $bills = Bill::where('type', 'Sale')->whereNull('deleted_at')->get();
        return view('acp.Booking.edit', compact('booking', 'areas', 'users', 'brands','bills'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "bill_id" => "required",
            "filling_period" => "required",
            "first_day_packing" => "required",
            "from_area" => "required",
            "near" => "required",
            "packing_number" => "required",
            "price" => "required",
            "time" => "required",
            "from_address" => "required",
            "status" => "required",
            /*
            "client_id" => "required",
            "filling_period" => "required",
            "gallon_type" => "required",
            "first_day_packing" => "required",
            "from_area" => "required",
            "price" => "required",
            "type" => "required",
            "packing_number" => "required",
            "gallon_count" => "required",
            "time" => "required",
            "from_address" => "required",
            "status" => "required",*/
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($request->all());

        \Session::flash('msg', __('back.successfully_saved'));
        return redirect()->route('bookings.index');
    }


    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->deleted_at = Carbon::now();
        $booking->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }

    public function rate(Request $request)
    {
        $booking = new Rate();
        $booking->callcenter = $request->rate_callcenter_star;
        $booking->callcenter_description = $request->rate_callcenter_note;
        $booking->driver = $request->rate_driver_star;
        $booking->driver_description = $request->rate_driver_note;
        $booking->booking_id = $request->id;
        $booking->created_by = Auth::user()->id;
        $booking->save();
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }
}
