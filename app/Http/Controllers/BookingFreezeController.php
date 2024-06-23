<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Bill;
use App\Models\BookingFreeze;
use App\Models\Vehicle;
use App\Models\Rate;
use App\Models\User;
use App\Models\SettingKM;
use Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingFreezeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->search) {
            $bookings = BookingFreeze::where('client_phone', 'LIKE', "%$request->search%")->OrWhere('client_phone2', 'LIKE', "%$request->search%")->OrWhere('client_name', 'LIKE', "%$request->search%")->whereNull('deleted_at')->orderBy('id', 'DESC')->paginate(9);
        } else {
            $bookings = BookingFreeze::whereNull('deleted_at')->orderBy('id', 'DESC')->paginate(9);
        }

        if ($request->ajax()) {
            $view = view('acp.Booking.scroll', compact('bookings'))->render();
            return response()->json(['html' => $view]);
        }
        return view('acp.BookingFreeze.index', compact('bookings', 'request'));
    }

    public function create()
    {
        $areas = Area::where('parint', 0)->get();
        $users = User::where('type', 'CLIENT')->get();
        return view('acp.BookingFreeze.create', compact('areas', 'users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "client_id" => "required",
            "from_area" => "required",
            "price" => "required",
            "time" => "required",
            "to_area" => "required",
            "status" => "required",
        ]);
        $Request = $request->all();
        $Request['created_by'] = Auth::user()->id;
        $booking = BookingFreeze::create($Request);

        \Session::flash('msg', __('back.successfully_saved'));
        return redirect()->route('booking.freezers.index');
    }

    public function show($id)
    {
        $booking = BookingFreeze::findOrFail($id);
        return view('acp.BookingFreeze.show', compact('booking'));
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
        $booking = BookingFreeze::findOrFail($id);
        $users = User::where('type', 'CLIENT')->get();
        return view('acp.BookingFreeze.edit', compact('booking', 'areas', 'users'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "client_id" => "required",
            "from_area" => "required",
            "price" => "required",
            "time" => "required",
            "to_area" => "required",
            "status" => "required",
        ]);
        $Request = $request->all();
        $Request['created_by'] = Auth::user()->id;

        $booking = BookingFreeze::findOrFail($id);
        $booking->update($Request);

        \Session::flash('msg', __('back.successfully_saved'));
        return redirect()->route('booking.freezers.index');
    }


    public function destroy($id)
    {
        $booking = BookingFreeze::findOrFail($id);
        $booking->deleted_at = Carbon::now();
        $booking->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }

    public function undestroy($id)
    {
        $booking = BookingFreeze::findOrFail($id);
        $booking->vehicle_id = null;
        $booking->driver_id = null;
        $booking->assign_car_id = null;
        $booking->status = 'waiting';
        $booking->save();
        \Session::flash('msg', __('back.successfully_recovery'));
        return back();
    }

    public function trakingsDestroy(Request $request,$id)
    {
        $booking = BookingFreeze::findOrFail($id);
        $booking->vehicle_id = null;
        $booking->status = 'canceled';
        $booking->note_canceled = $request->note_canceled;
        $booking->save();
        \Session::flash('msg', __('back.successfully_canceled'));
        return back();
    }
    public function Status($id, $status)
    {
        $bill = BookingFreeze::findOrFail($id);
        $bill->status = $status;
        $bill->save();
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function assign($id, $assign_to)
    {
        $vehicle = Vehicle::where('id', $assign_to)->latest()->first();
        if ($vehicle->assign->user_id) {
            $booking = BookingFreeze::find($id);
            $booking->vehicle_id = $assign_to;
            $booking->driver_id = $vehicle->assign->user_id;
            $booking->assign_car_id = $vehicle->assign->id;
            $booking->assign_at = date('Y-m-d H:i:s');
            $booking->status = 'inprocess';
            $booking->save();
            \Session::flash('msg', __('back.successfully_assign'));
            return back();
        }
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
