<?php

namespace App\Http\Controllers;

use App\Models\AssignCar;
use App\Models\Bill;
use App\Models\Booking;
use App\Models\BookingFreeze;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Setting;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ReCaptcha\RequestMethod\Curl;
use Str;

class TrakingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($type)
    {
        if ($type == 'custody') {
            $title = __('back.custody_traking');
            $setting = Setting::whereIn('id', [4, 5])->get(['name', 'value'])->toArray();
            $vehicles = Vehicle::where('type_car', 'transportation')->whereNull('deleted_at')->get();
            $vehicles_garage = Vehicle::where('type_car', 'transportation')->where('status', 'garage')->whereNull('deleted_at')->count();
            $vehicles_available = Vehicle::where('type_car', 'transportation')->where('status', 'available')->whereNull('deleted_at')->count();
            $vehicleData = Vehicle::where('type_car', 'transportation')->whereNull('deleted_at')->get();
            $category = Category::where('title', 'LIKE', "%سواق%")->OrWhere('title', 'LIKE', "%سائق%")->whereNull('deleted_at')->first(['id']);
            $categoryDelegate = Category::where('title', 'LIKE', "%مندوب مبيعات%")->OrWhere('title', 'LIKE', "%مندوب مبيعات شركات فقط%")->whereNull('deleted_at')->first(['id']);
            $users = Employee::where('category_id', $category->id)->whereNull('deleted_at')->get(['user_id']);
            $accDelegates = Employee::where('category_id', $categoryDelegate->id)->whereNull('deleted_at')->get(['user_id']);
            $drivers = User::whereIn('id', $users)->whereNull('deleted_at')->get();
            $delegates = User::whereIn('id', $accDelegates)->whereNull('deleted_at')->get();

            $target = 0;
            $sum_garage = 0;
            $sum_available = 0;
            foreach ($vehicles as $vehicle) {
                if ($vehicle->status == 'garage') {
                    $sum_garage += $setting[0]['value'] * $vehicles_garage;
                    $target += $setting[0]['value'] * $vehicles_garage;
                } elseif ($vehicle->status == 'available') {
                    $sum_available += $setting[1]['value'] * $vehicles_available;
                    $target += $setting[1]['value'] * $vehicles_available;
                }

            }
            $arrayToDay = [
                ['from' => 0, 'to' => $target, 'color' => 'rgba(200, 50, 50, .75)'],
                ['from' => $target, 'to' => ($target * 1 + $target), 'color' => 'rgba(220, 200, 0, .75)'],
                ['from' => ($target * 1 + $target), 'to' => ($target * 2 + $target), 'color' => 'rgba(100, 255, 100, .2)']
            ];
            $bookings = Booking::whereDate('created_at', date('Y-m-d'))->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
//        $bookings = Bill::where('type', 'Sale')->whereDate('created_at', date('Y-m-d'))->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
            foreach ($bookings as $booking) {
                $brand = [];
                foreach ($booking->bill->orders as $order) {
//            foreach ($booking->orders as $order) {
                    $brand [] = $order->product->brand->title;
                }
                $booking->setAttribute('brand', implode("-", $brand));
            }

            $cars = Booking::whereDate('created_at', date('Y-m-d'))->whereNull('deleted_at')->whereNotNull('vehicle_id')->get();

            $titles = [];
            $data = [];
            $priceAssigned = 0;
            foreach (array_count_values($cars->pluck('assign_car_id')->toArray()) as $id => $car) {
                $assign = AssignCar::find($id);
                $data [] = Booking::whereDate('created_at', date('Y-m-d'))->whereNull('deleted_at')->where('assign_car_id', $id)->get();
                foreach ($data as $value) {
                    foreach ($value as $val) {
                        $priceAssigned += $val->price;
                        $color = '';
                        if ($val->status == 'inprocess') {
                            $color = 'primary';
                        } elseif ($val->status == 'inuploaded') {
                            $color = 'info';
                        } elseif ($val->status == 'finished') {
                            $color = 'success';
                        }
                        $val->setAttribute('color_status', $color);
                        $message = 'طلب جديد';
                        $message .= ' - ' . __('back.client_name') . ' : ' . $val->client_phone;
                        $message .= ' - ' . __('back.gallon_type') . ' : ' . __('back.' . $val->gallon_type);
                        $message .= ' - ' . __('back.price') . ' : ' . $val->price;
                        $message .= ' - ' . __('back.type') . ' : ' . __('back.' . $val->type);
                        $message .= ' - ' . __('back.from_area') . ' : ' . $val->area->name;
                        $message .= ' - ' . __('back.address') . ' : ' . $val->address;

                        $val->setAttribute('whatsappMessage', $message);

                        $brandCar = [];
                        foreach ($val->bill->orders as $orderCar) {
                            $brandCar [] = $orderCar->product->brand->title;
                        }
                        $val->setAttribute('brand', implode("-", $brandCar));
                    }
                }
                $titles [] = $assign->user->name . ' - ' . $assign->vehicle->car_name;

            }

            $target = $sum_garage + $sum_available;
//        $priceAssigned;
//dd($target , $priceAssigned);
//dd(($target * 100) / $priceAssigned);
            $titles = array_values(array_unique($titles));
//        dd(0, $target / 2, $target, (int) ($target * .5) + $target, $target * 2 + $target);
            return view('acp.Traking.custody', compact('bookings', 'vehicles', 'cars', 'data', 'titles', 'arrayToDay', 'target', 'priceAssigned', 'vehicleData', 'drivers', 'delegates', 'title'));

        }
        else if ($type == 'freezers') {
            $title = __('back.freezers');
            $setting = Setting::whereIn('id', [4, 5])->get(['name', 'value'])->toArray();
            $vehicles = Vehicle::where('type_car', 'freezer')->whereNull('deleted_at')->get();
            $vehicles_garage = Vehicle::where('type_car', 'freezer')->where('status', 'garage')->whereNull('deleted_at')->count();
            $vehicles_available = Vehicle::where('type_car', 'freezer')->where('status', 'available')->whereNull('deleted_at')->count();
            $vehicleData = Vehicle::where('type_car', 'freezer')->whereNull('deleted_at')->get();
            $category = Category::where('title', 'LIKE', "%سواق%")->OrWhere('title', 'LIKE', "%سائق%")->whereNull('deleted_at')->first(['id']);
            $categoryDelegate = Category::where('title', 'LIKE', "%مندوب مبيعات%")->OrWhere('title', 'LIKE', "%مندوب مبيعات شركات فقط%")->whereNull('deleted_at')->first(['id']);
            $users = Employee::where('category_id', $category->id)->whereNull('deleted_at')->get(['user_id']);
            $accDelegates = Employee::where('category_id', $categoryDelegate->id)->whereNull('deleted_at')->get(['user_id']);
            $drivers = User::whereIn('id', $users)->whereNull('deleted_at')->get();
            $delegates = User::whereIn('id', $accDelegates)->whereNull('deleted_at')->get();

            $target = 0;
            $sum_garage = 0;
            $sum_available = 0;
            foreach ($vehicles as $vehicle) {
                if ($vehicle->status == 'garage') {
                    $sum_garage += $setting[0]['value'] * $vehicles_garage;
                    $target += $setting[0]['value'] * $vehicles_garage;
                } elseif ($vehicle->status == 'available') {
                    $sum_available += $setting[1]['value'] * $vehicles_available;
                    $target += $setting[1]['value'] * $vehicles_available;
                }

            }
            $arrayToDay = [
                ['from' => 0, 'to' => $target, 'color' => 'rgba(200, 50, 50, .75)'],
                ['from' => $target, 'to' => ($target * 1 + $target), 'color' => 'rgba(220, 200, 0, .75)'],
                ['from' => ($target * 1 + $target), 'to' => ($target * 2 + $target), 'color' => 'rgba(100, 255, 100, .2)']
            ];
            $bookings = BookingFreeze::whereDate('created_at', date('Y-m-d'))->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
//        $bookings = Bill::where('type', 'Sale')->whereDate('created_at', date('Y-m-d'))->whereNull('deleted_at')->orderBy('id', 'DESC')->get();

            $cars = BookingFreeze::whereDate('created_at', date('Y-m-d'))->whereNull('deleted_at')->whereNotNull('vehicle_id')->get();

            $titles = [];
            $data = [];
            $priceAssigned = 0;
            foreach (array_count_values($cars->pluck('assign_car_id')->toArray()) as $id => $car) {
                $assign = AssignCar::find($id);
                $data [] = BookingFreeze::whereDate('created_at', date('Y-m-d'))->whereNull('deleted_at')->where('assign_car_id', $id)->get();
                foreach ($data as $value) {
                    foreach ($value as $val) {
                        $priceAssigned += $val->price;
                        $color = '';
                        if ($val->status == 'inprocess') {
                            $color = 'primary';
                        } elseif ($val->status == 'inuploaded') {
                            $color = 'info';
                        } elseif ($val->status == 'finished') {
                            $color = 'success';
                        }
                        $val->setAttribute('color_status', $color);
                        $message = 'طلب جديد';
                        $message .= ' - ' . __('back.client_name') . ' : ' . $val->client_phone;
                        $message .= ' - ' . __('back.gallon_type') . ' : ' . __('back.' . $val->gallon_type);
                        $message .= ' - ' . __('back.price') . ' : ' . $val->price;
                        $message .= ' - ' . __('back.type') . ' : ' . __('back.' . $val->type);
                        $message .= ' - ' . __('back.from_area') . ' : ' . $val->FromArea ? $val->FromArea->name : '';
                        $message .= ' - ' . __('back.to_area') . ' : ' . $val->ToArea ? $val->ToArea->name : '';
                        $message .= ' - ' . __('back.address') . ' : ' . $val->address;

                        $val->setAttribute('whatsappMessage', $message);
                    }
                }
                $titles [] = $assign->user->name . ' - ' . $assign->vehicle->car_name;

            }

            $target = $sum_garage + $sum_available;
//        $priceAssigned;
//dd($target , $priceAssigned);
//dd(($target * 100) / $priceAssigned);
            $titles = array_values(array_unique($titles));
//        dd(0, $target / 2, $target, (int) ($target * .5) + $target, $target * 2 + $target);
            return view('acp.Traking.freez', compact('bookings', 'vehicles', 'cars', 'data', 'titles', 'arrayToDay', 'target', 'priceAssigned', 'vehicleData', 'drivers', 'delegates', 'title'));

        }
        elseif ($type == 'sales') {

            $title = __('back.sales');
            $setting = Setting::whereIn('id', [4, 5])->get(['name', 'value'])->toArray();
            $vehicles = Vehicle::where('type_car', 'transportation')->whereNull('deleted_at')->get();
            $vehicles_garage = Vehicle::where('type_car', 'transportation')->where('status', 'garage')->whereNull('deleted_at')->count();
            $vehicles_available = Vehicle::where('type_car', 'transportation')->where('status', 'available')->whereNull('deleted_at')->count();
            $vehicleData = Vehicle::where('type_car', 'transportation')->whereNull('deleted_at')->get();
            $category = Category::where('title', 'LIKE', "%سواق%")->OrWhere('title', 'LIKE', "%سائق%")->whereNull('deleted_at')->first(['id']);
            $categoryDelegate = Category::where('title', 'LIKE', "%مندوب مبيعات%")->OrWhere('title', 'LIKE', "%مندوب مبيعات شركات فقط%")->whereNull('deleted_at')->first(['id']);
            $users = Employee::where('category_id', $category->id)->whereNull('deleted_at')->get(['user_id']);
            $accDelegates = Employee::where('category_id', $categoryDelegate->id)->whereNull('deleted_at')->get(['user_id']);
            $drivers = User::whereIn('id', $users)->whereNull('deleted_at')->get();
            $delegates = User::whereIn('id', $accDelegates)->whereNull('deleted_at')->get();

            $target = 0;
            $sum_garage = 0;
            $sum_available = 0;
            foreach ($vehicles as $vehicle) {
                if ($vehicle->status == 'garage') {
                    $sum_garage += $setting[0]['value'] * $vehicles_garage;
                    $target += $setting[0]['value'] * $vehicles_garage;
                } elseif ($vehicle->status == 'available') {
                    $sum_available += $setting[1]['value'] * $vehicles_available;
                    $target += $setting[1]['value'] * $vehicles_available;
                }

            }
            $arrayToDay = [
                ['from' => 0, 'to' => $target, 'color' => 'rgba(200, 50, 50, .75)'],
                ['from' => $target, 'to' => ($target * 1 + $target), 'color' => 'rgba(220, 200, 0, .75)'],
                ['from' => ($target * 1 + $target), 'to' => ($target * 2 + $target), 'color' => 'rgba(100, 255, 100, .2)']
            ];


            $bookings = Bill::where('type', 'Sale')->whereDate('set_date', date('Y-m-d'))->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
            foreach ($bookings as $booking) {
                $brand = [];
//                foreach ($booking->bill->orders as $order) {
                foreach ($booking->orders as $order) {
                    $brand [] = $order->product->brand->title;
                }

                $booking->setAttribute('count_orders', $booking->orders->count());
                $booking->setAttribute('brand', implode("-", $brand));
            }

//            $cars = Booking::whereDate('created_at', date('Y-m-d'))->whereNull('deleted_at')->whereNotNull('vehicle_id')->get();
            $cars = Bill::where('type', 'Sale')->whereDate('set_date', date('Y-m-d'))->whereNull('deleted_at')->whereNotNull('vehicle_id')->get();

            $titles = [];
            $data = [];
            $priceAssigned = 0;
            foreach (array_count_values($cars->pluck('assign_car_id')->toArray()) as $id => $car) {
                $assign = AssignCar::find($id);
//                $data [] = Booking::whereDate('created_at', date('Y-m-d'))->whereNull('deleted_at')->where('assign_car_id', $id)->get();
                $data [] = Bill::where('type', 'Sale')->whereDate('set_date', date('Y-m-d'))->whereNull('deleted_at')->where('assign_car_id', $id)->get();
                foreach ($data as $value) {
                    foreach ($value as $val) {
                        $priceAssigned += $val->total_amount;
                        $color = '';
                        if ($val->status_ship == 'inprocess') {
                            $color = 'primary';
                        } elseif ($val->status_ship == 'inuploaded') {
                            $color = 'info';
                        } elseif ($val->status_ship == 'finished') {
                            $color = 'success';
                        }
                        $val->setAttribute('color_status', $color);
                        $message = 'طلب جديد';
                        $message .= ' - ' . __('back.client_name') . ' : ' . $val->client_phone;
                        $message .= ' - ' . __('back.price') . ' : ' . $val->total_amount;
                        $message .= ' - ' . __('back.from_area') . ' : ' . $booking->user->profile->area->name;
                        $message .= ' - ' . __('back.address') . ' : ' . $booking->user->profile->address;

                        $val->setAttribute('whatsappMessage', $message);

                        $brandCar = [];
                        foreach ($val->orders as $orderCar) {
                            $brandCar [] = $orderCar->product->brand->title;
                        }
                        $val->setAttribute('brand', implode("-", $brandCar));
                        $val->setAttribute('count_orders', $val->orders->count());
                    }
                }
                $titles [] = $assign->user->name . ' - ' . $assign->vehicle->car_name;

            }

            $target = $sum_garage + $sum_available;
//        $priceAssigned;
//dd($target , $priceAssigned);
//dd(($target * 100) / $priceAssigned);
            $titles = array_values(array_unique($titles));
//        dd(0, $target / 2, $target, (int) ($target * .5) + $target, $target * 2 + $target);
            return view('acp.Traking.sales', compact('bookings', 'vehicles', 'cars', 'data', 'titles', 'arrayToDay', 'target', 'priceAssigned', 'vehicleData', 'drivers', 'delegates', 'title'));

        }
    }

    public function assign($id, $assign_to)
    {
        $vehicle = Vehicle::where('id', $assign_to)->latest()->first();
        if ($vehicle->assign->user_id) {
            $booking = Booking::find($id);
            $booking->vehicle_id = $assign_to;
            $booking->driver_id = $vehicle->assign->user_id;
            $booking->assign_car_id = $vehicle->assign->id;
            $booking->assign_at = date('Y-m-d H:i:s');
            $booking->status = 'inprocess';
            $booking->save();
            \Session::flash('msg', __('back.successfully_assign'));
            return redirect()->route('trakings.index');
        }
    }


    public function destroy(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->vehicle_id = null;
        $booking->status = 'canceled';
        $booking->note_canceled = $request->note_canceled;
        $booking->save();
        \Session::flash('msg', __('back.successfully_canceled'));
        return back();
    }

    public function undestroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->vehicle_id = null;
        $booking->driver_id = null;
        $booking->assign_car_id = null;
        $booking->status = 'waiting';
        $booking->save();
        \Session::flash('msg', __('back.successfully_recovery'));
        return back();
    }

    public function Status($id, $status)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = $status;
        $booking->save();
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }
}
