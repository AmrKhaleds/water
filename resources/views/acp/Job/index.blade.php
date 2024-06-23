@extends('acp.layout.app')

@section('title')
    @lang('back.jobs')
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.jobs')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.jobs')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                @if(Session::has('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-check me-2"></i>
                        {!! session('msg') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                        </button>
                    </div>

                @endif
                <div class="card-body">
                    <a href="{{route('jobs.create')}}" class="btn btn-primary waves-effect waves-light">
                        @lang('back.create') @lang('back.job') <i class="uil uil-plus-square ms-2"></i>
                    </a>
                    <a href="{{route('jobs.candidate','today')}}" class="btn btn-info waves-effect waves-light">
                        @lang('back.candidate_today') <i class="uil-copy-landscape ms-2"></i>
                    </a>
                    <a href="{{route('jobs.candidate','all')}}" class="btn btn-dark waves-effect waves-light">
                        @lang('back.all_candidate') <i class="uil-copy-landscape ms-2"></i>
                    </a>
                    <a href="{{route('jobs.candidate','rejected')}}" class="btn btn-danger waves-effect waves-light">
                        @lang('back.rejected') <i class="uil-copy-landscape ms-2"></i>
                    </a>
                    <a href="{{route('jobs.candidate','interviewed')}}" class="btn btn-warning waves-effect waves-light">
                        @lang('back.interviewed') <i class="uil-copy-landscape ms-2"></i>
                    </a>
                    <a href="{{route('jobs.candidate','approved')}}" class="btn btn-success waves-effect waves-light">
                        @lang('back.approved') <i class="uil-copy-landscape ms-2"></i>
                    </a>
                    <div class="table-responsive">
                        <table class="table table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th >@lang('back.job_title')</th>
                              {{--  <th>@lang('back.work_from')</th>
                                <th>@lang('back.end_day')</th>
                                <th>@lang('back.count_candidate')</th>
                                <th>@lang('back.count_candidate_approved')</th>
                                <th>@lang('back.count_candidate_rejected')</th>
                                <th>@lang('back.count_candidate_new')</th> --}}
                                <th >@lang('back.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $key => $job)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$job->job_title}}</td>
                                  {{--  <td>@lang('back.'.$job->work_from)</td>
                                    <td>{{$job->end_in}}</td>
                                    <td>{{$job->candidates->count()}}</td>
                                    <td>{{$job->candidates->where('status','approved')->count()}}</td>
                                    <td>{{$job->candidates->where('status','rejected')->count()}}</td>
                                    <td>{{$job->candidates->where('status','NEW')->count()}}</td>--}}
                                    <td style="width: 100px">
                                        <a href="{{route('jobs.edit',$job->id)}}"
                                           class="btn btn-outline-warning btn-sm" title="@lang('back.edit')">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{route('jobs.destroy',$job->id)}}"
                                           class="btn btn-outline-danger btn-sm" title="@lang('back.delete')">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <a href="{{route('job',$job->id)}}" target="_blank" class="btn btn-outline-info btn-sm"  data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('back.open') @lang('back.job')">
                                            <i class="uil-link-alt"></i>
                                        </a>
                                        <a href="{{route('jobs.show',$job->id)}}" target="_blank" class="btn btn-outline-primary btn-sm" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="top" title="@lang('back.cvs')">
                                            <i class="uil-copy-landscape"></i>
                                        </a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection