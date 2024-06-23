<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\Candidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JobController extends Controller
{

	public function __construct()
	{

		$this->middleware('auth',['except' => ['showCandidate']]);
	}

	public function index()
	{
		$jobs = Job::whereNull('deleted_at')->orderBy('id', 'DESC')->get();
		return view('acp.Job.index', compact('jobs'));
	}

	public function create()
	{
		$departments = Category::all();
		return view('acp.Job.create', compact('departments'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'job_category' => 'required|integer',
			'job_title' => 'required|string',
			'total_positions' => 'required|integer',
			'work_from' => 'required|string',
			'type_employment' => 'required|string',
			'skills' => 'required|string',
			'job_description' => 'required|string',
			'job_requirement' => 'required|string',
		]);
		$addons = array_merge($request->all(), ['user_id' => Auth::user()->id, 'start_in' => $request->start_day, 'end_in' => $request->end_day]);
		$job = Job::create($addons);

		\Session::flash('msg', __('back.successfully_saved'));
		return back();
	}

	public function show($id)
	{
		$job = Job::findOrFail($id);
		foreach ($job->candidates as $candidates) {
			$color = '';
			if ($candidates->status == 'NEW') {
				$color = 'primary';
			} elseif ($candidates->status == 'interviewed') {
				$color = 'info';
			} elseif ($candidates->status == 'waiting') {
				$color = 'warning';
			} elseif ($candidates->status == 'approved') {
				$color = 'success';
			} elseif ($candidates->status == 'rejected') {
				$color = 'danger';
			}
			$candidates->setAttribute('color', $color);
		}
		return view('acp.Job.show', compact('job'));
	}

	public function candidate($type)
	{
		if ($type == 'today') {
//            $job = Candidate::where('status', 'NEW')->whereDate('created_at', Carbon::today())->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
//            $job = Candidate::where('status', 'NEW')->whereDate('created_at', Carbon::today())->whereNull('deleted_at')->get();
			$job = Candidate::whereDate('created_at', Carbon::today())->whereNull('deleted_at')->get();
		} elseif ($type == 'rejected' || $type == 'approved' || $type == 'interviewed') {
			$job = Candidate::where('status', $type)->whereNull('deleted_at')->orderBy('id', 'DESC')->get();
		} elseif ($type == 'all') {
			$job = Candidate::whereNull('deleted_at')->orderBy('id', 'DESC')->get();
		}
//        $job = Candidate::findOrFail($id);
//        foreach ($job->candidates as $candidates) {
		foreach ($job as $candidates) {
			$color = '';
			if ($candidates->status == 'NEW') {
				$color = 'primary';
			} elseif ($candidates->status == 'interviewed') {
				$color = 'info';
			} elseif ($candidates->status == 'waiting') {
				$color = 'warning';
			} elseif ($candidates->status == 'approved') {
				$color = 'success';
			} elseif ($candidates->status == 'rejected') {
				$color = 'danger';
			}
			$candidates->setAttribute('color', $color);
		}
		return view('acp.Job.candidate', compact('job', 'type'));
	}

	public function showCandidate($id,$name)
	{
		$canName = \Str::replace('-', ' ', $name);
		$candidate = Candidate::where('id',$id)->where('name',$canName)->firstOrFail();
		return view('acp.Job.candidateShow', compact('candidate'));
	}

	public function SendTo(Request $request,$id)
	{
		$candidate = Candidate::findOrFail($id);
		if (is_numeric($request->send_to)){
			$url = 'https://wa.me/+2'.$request->send_to.'?text='.route('candidate',[$candidate->id,\Str::replace(' ', '-', $candidate->name)]);
			echo "<script>window.open('".$url."', '_blank')</script>";
			\Session::flash('msg', __('back.successfully_send'));

			return  back();
//			return Redirect::away() redirect('https://wa.me/+2'.$request->send_to.'?text='.route('candidate',[$candidate->id,\Str::replace(' ', '-', $candidate->name)]));
			return \Redirect::away('https://wa.me/+2'.$request->send_to.'?text='.route('candidate',[$candidate->id,\Str::replace(' ', '-', $candidate->name)]));
		}else{

			$to = $request->send_to;
			$subject = 'ابليكيشن محول اليك من مستر محمد';
			$data = [
				'job_title' => $candidate->job->job_title,
				'link' => route('candidate',[$candidate->id,\Str::replace(' ', '-', $candidate->name)]),
			];
			\Mail::send('acp.applecation', $data, function ($message) use ($to, $subject) {
				$message->to($to)->subject($subject);
				$message->from('system@khater.xyz', 'سيستم التوظيف');
			});

			\Session::flash('msg', __('back.successfully_send'));
			return back();
		}

	}

	public function edit($id)
	{
		$job = Job::findOrFail($id);
		$departments = Category::all();
		return view('acp.Job.edit', compact('departments', 'job'));
	}

	public function Status($id, $status)
	{
		$candidate = Candidate::findOrFail($id);
		$candidate->status = $status;
		$candidate->save();
		\Session::flash('msg', __('back.successfully_updated'));
		return back();
	}

	public function rate(Request $request, $id)
	{
		$candidate = Candidate::findOrFail($id);
		$candidate->rate = $request->rate;
		$candidate->save();
		\Session::flash('msg', __('back.successfully_saved'));
		return back();
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'job_category' => 'required|integer',
			'job_title' => 'required|string',
			'total_positions' => 'required|integer',
			'work_from' => 'required|string',
			'type_employment' => 'required|string',
			'skills' => 'required|string',
			'job_description' => 'required|string',
			'job_requirement' => 'required|string',
		]);
		$addons = array_merge($request->all(), ['user_id' => Auth::user()->id, 'start_in' => $request->start_day, 'end_in' => $request->end_day]);
		$job = Job::findOrFail($id);

		$job->update($addons);

		\Session::flash('msg', __('back.successfully_updated'));
		return back();
	}


	public function destroy($id)
	{
		$job = Job::findOrFail($id);
		$job->deleted_at = Carbon::now();
		$job->save();
		\Session::flash('msg', __('back.successfully_deleted'));
		return back();
	}


}
