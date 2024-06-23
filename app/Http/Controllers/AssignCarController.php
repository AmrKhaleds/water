<?php

namespace App\Http\Controllers;

use App\Models\AssignCar;
use App\Models\Category;
use App\Models\Employee;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignCarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {

        $category = Category::where('title', 'LIKE', "%سواق%")->OrWhere('title', 'LIKE', "%سائق%") ->whereNull('deleted_at')->first(['id']);
        $users = Employee::where('category_id', $category->id) ->whereNull('deleted_at')->get(['user_id']);
        $drivers = User::whereIn('id', $users) ->whereNull('deleted_at')->get();
        $assigns = AssignCar::where('vehicle_id',$id)->whereNull('deleted_at')->get();
        return view('acp.AssignCar.index', compact('drivers','assigns','id'));
    }

    public function store(Request $request,$id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'counter_number' => 'required|numeric',
        ]);
        $Request = $request->all();
        $Request ['created_by'] = Auth::user()->name;
        $Request ['vehicle_id'] = $id;

        $assign = AssignCar::create($Request);

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }
    public function storeAssign(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'delegate_id' => 'required',
            'counter_number' => 'required|numeric',
        ]);
        $Request = $request->all();
        $Request ['created_by'] = Auth::user()->name;
        $Request ['vehicle_id'] = $request->car_id;

        $assign = AssignCar::create($Request);

        $vehicle = Vehicle::find($request->car_id);
        $vehicle->assign_car_id =$assign->id;
        $vehicle->save();

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function leave($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->assign_car_id =null;
        $vehicle->save();

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'counter_number' => 'required|numeric',
        ]);
        $Request = $request->all();
        $Request ['updated_by'] = Auth::user()->name;
        $assign  = AssignCar::findOrFail($id);
        $assign->update($Request);

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function destroy($id)
    {
        $assign  = AssignCar::findOrFail($id);
        $assign->deleted_at = Carbon::now();
        $assign->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }

}
