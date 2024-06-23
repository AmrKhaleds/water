<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $brands = Brand::whereNull('deleted_at')->get();
        return view('acp.Brand.index', compact('brands'));
    }

    public function create()
    {
        return view('acp.Brand.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'logo' => 'required',
        ]);

        $final = $request->all();
        $final ['logo'] = uploadFile($request->logo);
        $brand = Brand::create($final);


        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('acp.Brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
        ]);
        $brand = Brand::findOrFail($id);
        if ($request->logo) {
            $brand->logo = uploadFile($request->logo);
        }
        $brand->title = $request->title;
        $brand->save();

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->deleted_at = Carbon::now();
        $brand->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }


}
