<?php

namespace App\Http\Controllers;

use Alkoumi\LaravelArabicNumbers\Numbers;
use App\Models\PriceProposal;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Knp\Snappy\Pdf;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;

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

        return view('acp.price_proposal.show', compact('statements', 'price_proposal', 'total_price', 'total_price_in_arabic'));
    }

    public function create()
    {
        return view('acp.price_proposal.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'statement' => 'required|array',
            'statement.*' => 'required|string|distinct',
            'price' => 'required|array',
            'price.*' => 'required|string|distinct',
            'notes' => 'nullable|string',
        ]);

        // Combine statements and prices into a single JSON object
        $data = collect($validatedData['statement'])->map(function ($statement, $index) use ($validatedData) {
            return [
                'statement' => $statement,
                'price' => $validatedData['price'][$index],
            ];
        })->toArray();

        // Create and save a new PriceProposal
        $priceProposal = PriceProposal::create([
            'name' => $validatedData['name'],
            'date' => $validatedData['date'],
            'statements' => json_encode($data),
            'notes' => $validatedData['notes'] ?? null,
        ]);

        // Calculate total price and convert it to Arabic
        $totalPrice = collect($data)->sum('price');
        $totalPriceInArabic = Numbers::tafqeetMoney($totalPrice, 'EGP');

        // Prepare data for PDF generation
        $pdfData = [
            'statements' => $data,
            'price_proposal' => $priceProposal,
            'total_price' => $totalPrice,
            'total_price_in_arabic' => $totalPriceInArabic,
        ];

        // Generate and save the PDF
        $pdf = LaravelMpdf::loadView('acp.price_proposal.print', $pdfData);
        $pdf->save('uploads/price-proposal/' . $priceProposal->id . '.pdf');

        // Redirect or return a response
        Session::flash('msg', __('back.successfully_applied'));
        return redirect()->route('price_proposal.index');
    }

    public function edit($id)
    {
        $price_proposal = PriceProposal::findOrFail($id);
        $statements = json_decode($price_proposal->statements, true);
        return view('acp.price_proposal.edit', compact('price_proposal', 'statements'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'statement' => 'required|array',
            'statement.*' => 'required|string|distinct',
            'price' => 'required|array',
            'price.*' => 'required|string|distinct',
            'notes' => 'nullable|string',
        ]);

        // Combine statements and prices into a single JSON object
        $data = collect($request->statement)->map(function ($statement, $index) use ($request) {
            return [
                'statement' => $statement,
                'price' => $request->price[$index],
            ];
        })->toArray();

        // Find the existing PriceProposal
        $priceProposal = PriceProposal::findOrFail($id);

        // Remove the old PDF
        $pdfPath = 'uploads/price-proposal/' . $priceProposal->id . '.pdf';
        if (file_exists($pdfPath)) {
            unlink($pdfPath);
        }

        // Update the PriceProposal
        $priceProposal->name = $request->name;
        $priceProposal->date = $request->date;
        $priceProposal->statements = json_encode($data);
        $priceProposal->notes = $request->notes ?? null;
        $priceProposal->save();

        // Calculate total price and convert it to Arabic
        $totalPrice = collect($data)->sum('price');
        $totalPriceInArabic = Numbers::tafqeetMoney($totalPrice, 'EGP');

        // Prepare data for PDF generation
        $pdfData = [
            'statements' => $data,
            'price_proposal' => $priceProposal,
            'total_price' => $totalPrice,
            'total_price_in_arabic' => $totalPriceInArabic,
        ];

        // Generate and save the new PDF
        $pdf = LaravelMpdf::loadView('acp.price_proposal.print', $pdfData);
        $pdf->save($pdfPath);

        // Redirect or return a response
        Session::flash('msg', __('back.successfully_updated'));
        return redirect()->route('price_proposal.index');
    }

    public function destroy($id)
    {
        $price_proposal = PriceProposal::findOrFail($id);
        $price_proposal->delete();

        Session::flash('msg', __('back.successfully_deleted'));
        return redirect()->back();
    }

    public function whatsapp(Request $request)
    {
        $request->validate([
            'whatsapp' => 'required|numeric',
            'proposal_id' => 'required',
        ]);
        $message = "السلام عليكم\nعرض سعر مقدم من شركة فرعون\n------------------- \nلينك عرض السعر:\n";
        $fileUrl = asset('uploads/price-proposal/' . $request->proposal_id . '.pdf'); // Replace with your actual file URL
        $message .= $fileUrl . "\n\nكامل الإحترام\nشركة فرعون";
        $encodedMessage = urlencode($message);

        $whatsappUrl = 'https://wa.me/+2' . $request->whatsapp . '?text=' . $encodedMessage;
        return view('acp.price_proposal.whatsapp', ['url' => $whatsappUrl]);
    }

    public function print($id)
    {
        $price_proposal = PriceProposal::findOrFail($id);
        $statements = json_decode($price_proposal->statements, true);

        $statements_collection = collect($statements);
        $total_price = $statements_collection->sum('price');
        $total_price_in_arabic = Numbers::tafqeetMoney($total_price, 'EGP');

        return view('acp.price_proposal.print', compact('statements', 'price_proposal', 'total_price', 'total_price_in_arabic'));
    }
}
