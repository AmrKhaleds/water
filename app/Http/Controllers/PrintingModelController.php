<?php

namespace App\Http\Controllers;

use App\Models\PrintModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrintingModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = PrintModel::latest()->get();
        return view('acp.printing_models.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acp.printing_models.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // make validation
        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
        ]);
        // sotre name and image file name into database and store image in in public/uploads/printing_models directory
        $model = new PrintModel();
        $model->name = $request->name;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/printing_models/'), $filename);
            $model->image = $filename;
        };
        $model->save();

        Session::flash('msg', __('back.successfully_applied'));
        return redirect()->route('printing_models.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = PrintModel::find($id);
        return view('acp.printing_models.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = PrintModel::find($id);
        return view('acp.printing_models.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
        ]);

        $model = PrintModel::find($id);
        $model->name = $request->name;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/printing_models/'), $filename);
            $model->image = $filename;
        }else{
            $model->image = $model->image;
        };
        $model->save();

        Session::flash('msg', __('back.successfully_updated'));
        return redirect()->route('printing_models.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = PrintModel::find($id);
        $model->delete();

        Session::flash('msg', __('back.successfully_deleted'));
        return redirect()->route('printing_models.index');
    }
}
