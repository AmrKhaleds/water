<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UnitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $units = Unit::whereNull('deleted_at')->get();
        return view('acp.Unit.index', compact('units'));
    }

    public function create()
    {
        return view('acp.Unit.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'qty' => 'required|string',
        ]);
        $unit = Unit::create($request->all());

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('acp.Unit.edit',compact('unit'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'qty' => 'required|string',
        ]);
        $unit = Unit::findOrFail($id);
        $unit->title = $request->title;
        $unit->qty = $request->qty;
        $unit->save();

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->deleted_at = Carbon::now();
        $unit->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }

}
