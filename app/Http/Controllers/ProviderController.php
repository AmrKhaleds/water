<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Area;
use App\Models\Employee;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function GuzzleHttp\json_encode;

class ProviderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $providers = User::where('type','PROVIDER')->whereNull('deleted_at')->get();
        return view('acp.Provider.index', compact('providers'));
    }

    public function create()
    {
        $areas = Area::where('parint', 0)->get();
        return view('acp.Provider.create',compact('areas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
//            'email' => 'required|string|unique:users',
            'whatsapp' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
//        $user->email = $request->email;
        $user->type = 'PROVIDER';
//        $user->password = Hash::make(rand(000000000, 999999999));
        $user->save();
        $profile = new Profile();
        $profile->phone = $request->phone;
        $profile->whatsapp = $request->whatsapp;
        $profile->address = $request->address;
        $profile->from_area = $request->from_area;
        $profile->user_id = $user->id;
        $profile->save();
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function edit($id)
    {
        $areas = Area::where('parint', 0)->get();
        $provider = User::where('id', $id)->whereNull('deleted_at')->first();
        return view('acp.Provider.edit', compact('provider','areas'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
//            'email' => 'required|string|unique:users,email,'.$id,
            'whatsapp' => 'required',
            'address' => 'required',
        ]);
        $user = User::where('id',$id)->whereNull('deleted_at')->first();
        $user->name = $request->name;
//        $user->email = $request->email;
        $user->save();
        $profile = Profile::where('user_id',$id)->first();
        $profile->phone = $request->phone;
        $profile->whatsapp = $request->whatsapp;
        $profile->address = $request->address;
        $profile->from_area = $request->from_area;
        $profile->save();
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }



    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->deleted_at = Carbon::now();
        $user->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }


}
