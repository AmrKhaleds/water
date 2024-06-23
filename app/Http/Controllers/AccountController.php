<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Tree;
use App\Models\Account;
use App\Models\DailyMove;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $accounts = Account::where('parent_id', '!=', 0)->get();
        return view('acp.Accounting.Account.index', compact('accounts'));
    }

    public function create()
    {
        $trees = Account::all();
        return view('acp.Accounting.Account.create', compact('trees'));
    }

    public function AccountAjax(Request $request)
    {
        $trees = Account::where('parent_id', $request->id)->get();
        return response()->json($trees);
    }

    public function AccountDetails(Request $request)
    {
        $dailymove = DailyMove::find($request->id);

        $returnHTML = view('acp.Accounting.DailyMove.show', compact('dailymove'))->render();

        return response()->json($returnHTML);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'account_name' => 'required|string',
//            'account_num' => 'required',
            'account_type' => 'required',
            'parent_account' => 'required',
            'description' => 'required',
        ]);
        $accou = Account::findOrFail($request->account_type);
        $checkSerial = Account::where('parent_id', $request->parent_account)->latest()->first();
        if ($checkSerial) {
            $serial = $checkSerial->num + 1;
        } else {
            $checkSerial = Account::where('id', $request->parent_account)->latest()->first();
            $serial = $checkSerial->num . 1;
        }
//        dd($serial);
        $account = new Account();
        $account->name = $accou->name;
        $account->account_name = $request->account_name;
        $account->num = $serial;
        $account->parent_id = $request->parent_account;
        $account->master = $request->account_type;
        $account->branch_id = \Auth::user()->branch_id;
        $account->balance = 0;
        $account->note = $request->description;
        $account->save();

        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function edit($id)
    {
        $account = Account::findOrFail($id);
        $trees = Account::all();
        return view('acp.Accounting.Account.edit', compact('account', 'trees'));
    }

    public function show($id)
    {
        $account = Account::findOrFail($id);
        return view('acp.Accounting.Account.show', compact('account'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'account_name' => 'required|string',
            'account_num' => 'required',
            'account_type' => 'required',
            'parent_account' => 'required',
        ]);
        $accou = Account::findOrFail($request->account_type);
        $account = Account::findOrFail($id);
        $account->name = $accou->name;
        $account->account_name = $request->account_name;
        $account->num = $request->account_num;
        $account->parent_id = $request->parent_account;
        $account->master = $request->account_type;
        $account->branch_id = \Auth::user()->branch_id;
        $account->balance = 0;
        $account->note = $request->description;
        $account->save();
        \Session::flash('msg', __('back.successfully_updated'));
        return back();
    }


    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }

    public function Tree()
    {
        $trees = Account::all();
        return view('acp.Accounting.Tree.index', compact('trees'));

    }
}
