<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Account;
use App\Models\SettingKM;
use Illuminate\Http\Request;


class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $settingKms = SettingKM::all();
        return view('acp.Setting.pricing', compact('settingKms'));
    }

    public function New(Request $request)
    {
        $settingKms = SettingKM::latest()->first();
        $newSettingKms = $settingKms->replicate();
        $newSettingKms->start = 0;
        $newSettingKms->to = 0;
        $newSettingKms->average_start = 0;
        $newSettingKms->average_to = 0;
        $newSettingKms->save();
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function createGeneral()
    {
        $settings = Setting::all();
        return view('acp.Setting.General', compact('settings'));
    }

    public function check(Request $request)
    {
        $settingKms = SettingKM::where('start', '<=', $request->search_keyword)->where('to', '>=', $request->search_keyword)->first();
        $start = $settingKms->average_start * $request->search_keyword;
        $check = $start < 250 ? 250 : $start;
        $to = $settingKms->average_to * $request->search_keyword;
        if ($to < $check) {
            $data = $check;
        } else {
            $data = $to . ' ~ ' . $check;
        }
        return response()->json($data);
    }

    public function checkDuration(Request $request)
    {
        $data = $request->search_keyword * 300;

        return response()->json($data);
    }

    public function store(Request $request)
    {
        foreach ($request->id as $key => $id) {
            $settingKms = SettingKM::find($id);
            $settingKms->start = $request->start[$key];
            $settingKms->to = $request->to[$key];
            $settingKms->average_start = $request->average_start[$key];
            $settingKms->average_to = $request->average_to[$key];
            $settingKms->save();
        }
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }
    public function storeGeneral(Request $request)
    {
//        dd($request->all());
        foreach ($request->id as $key => $id) {
            $setting = Setting::find($id);
            $setting->value = $request->name[$key];
            $setting->save();
        }
        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }


    public function createAccounting($type)
    {
        $groups = Setting::select('groupe')->get()->toArray();
//        $array_groups = array_unique(array_column($groups,'groupe'));
        $array_groups = ['sales','purchases'];
        $settings = Setting::where('groupe', 'sales')->OrWhere('groupe', 'purchases')->get();
        $accounts = Account::where('parent_id','!=',0)->get();
        if (count($settings) > 0) {
            return view('acp.Accounting.setting', compact('settings','array_groups','settings','accounts'));
        } else {
            abort(404);
        }
    }
}
