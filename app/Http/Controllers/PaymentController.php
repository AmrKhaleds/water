<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $id)
    {

        $this->validate($request, [
            'date' => 'required|string',
            'payment_type' => 'required|string',
            'total_amount' => 'required|string',
            'amount' => 'required|string',
        ]);
        $bill = Bill::find($id);
        $bill->paid = $request->amount;
        $bill->due = $bill->total_amount - $request->amount;
        $bill->save();

        $finalrequest = $request->all();
        $finalrequest ['bill_id'] = $bill->id;
        $finalrequest ['created_by'] = Auth::user()->id;
        $finalrequest ['type'] = $bill->type == 'Purchase' ? 'Purchase' : 'Sale';
        $finalrequest ['remaining'] = $request->total_amount - $request->amount;
        $payment = Payment::create($finalrequest);


        \Session::flash('msg', __('back.successfully_saved'));
        return back();
    }

    public function show($id)
    {

        $bill = Bill::find($id);
        $payments = Payment::where('bill_id',$bill->id)->whereNull('deleted_at')->get();

        return view('acp.Purchase.payments', compact('bill','payments'));
    }



    public function destroy($id)
    {
        $payment = Payment::find($id);

        $bill = Bill::find($payment->bill_id);
        $bill->due = $bill->due + $payment->amount;
        $bill->paid = $bill->paid - $payment->amount;
        $bill->save();

        $payment->deleted_at = Carbon::now();
        $payment->save();
        \Session::flash('msg', __('back.successfully_deleted'));
        return back();
    }


}
