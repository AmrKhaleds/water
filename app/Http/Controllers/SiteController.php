<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Candidate;
use Illuminate\Support\Facades\Session;
use Str;
use function GuzzleHttp\json_encode;

class SiteController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function job($id)
    {
        /*$title = Str::of($title)->explode('-')->toArray();
        $id = last($title);
        array_pop($title);
        $job = Job::where('job_title', collect($title)->implode(' '))->where('id', $id)->firstOrFail();*/
        $job = Job::findOrFail($id);
        return view('job', compact('job'));
    }

    public function jobStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);
        $candidate = new Candidate();
        if ($request->cv) {
            $this->validate($request, [
                'cv' => 'required|mimes:jpeg,png,jpg,pdf,doc.docx|max:2048',
            ]);
            $candidate->cv = uploadFile($request->cv, null, 'new');
        }
        $req = $request->except(['_token', 'name', 'email', 'job_id', 'cv']);
        $req ['date_of_berth'] = $request->day .'-'.$request->month.'-'.$request->year;
        $candidate->name = $request->name;
        $candidate->email = $request->email;
        $candidate->job_id = $request->job_id;
        $candidate->app = json_encode($req);
        $candidate->save();

        Session::flash('msg', __('back.successfully_applied'));
        return back();
    }
}
