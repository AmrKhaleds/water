<?php

namespace App\Http\Controllers;

use Alkoumi\LaravelArabicNumbers\Numbers;
use App\Models\PriceProposal;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PriceProposalController extends Controller
{
    public function index()
    {
        $statements = PriceProposal::paginate(15);
        return view('acp.price_proposal.index', compact('statements'));
    }

    public function show($id)
    {
        $price_proposal = PriceProposal::findOrFail($id);
        $statements = json_decode($price_proposal->statements, true);

        $statements_collection = collect($statements);
        $total_price = $statements_collection->sum('price');
        $total_price_in_arabic = Numbers::tafqeetMoney($total_price, 'EGP');

        return view('acp.price_proposal.show', compact('statements', 'price_proposal', 'total_price_in_arabic'));
    }

    public function create()
    {
        return view('acp.price_proposal.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            "statement"    => "required|array",
            "statement.*"  => "required|string|distinct",
            'price' => 'required|array',
            "price.*"  => "required|string|distinct",
            'notes' => 'nullable|string',
        ]);

        // Combine statements and prices into a single JSON object
        $data = [];
        foreach ($request->input('statement') as $index => $statement) {
            $data[] = [
                'statement' => $statement,
                'price' => $request->input('price')[$index]
            ];
        }

        $price_proposal = new PriceProposal;
        $price_proposal->name = $request->input('name');
        $price_proposal->date = $request->input('date');
        $price_proposal->statements = json_encode($data);
        $price_proposal->notes = $request->input('notes');
        $price_proposal->save();
    
        // Redirect or return a response
        Session::flash('msg', __('back.successfully_applied'));
        return redirect()->back();
    }


    public function arabic_price(Request $request)
    {
        // Validate the request
        $request->validate([
            'total' => 'required|numeric',
        ]);

        // Convert the total to Arabic words
        $total = $request->input('total');
        $convertedTotal = Numbers::tafqeetMoney($total, 'EGP');

        // Return the converted total
        return response()->json(['convertedTotal' => $convertedTotal]);
    }

    public function destroy($id)
    {
        $price_proposal = PriceProposal::findOrFail($id);
        $price_proposal->delete();

        Session::flash('msg', __('back.successfully_deleted'));
        return redirect()->back();

    }
}
