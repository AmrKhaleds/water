@extends('acp.layout.app')

@section('title')
    {{$type == 'today' ? __('back.candidate_today') : __('back.all_candidate')}}
@endsection

@section('css')
    <link href="{{url('acp/libs/jquery-bar-rating/themes/css-stars.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('acp/libs/jquery-bar-rating/themes/fontawesome-stars-o.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('acp/libs/jquery-bar-rating/themes/fontawesome-stars.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .fas {
            font-size: x-large;
        }
    </style>
@endsection

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">{{$type == 'today' ? __('back.candidate_today') : __('back.all_candidate')}} <span
                            class="badge rounded-pill bg-primary">@lang('back.count_candidate') {{count($job->where('status', 'NEW'))}}</span><span
                            class="badge rounded-pill bg-info">@lang('back.interviewed') {{count($job->where('status', 'interviewed'))}}</span><span
                            class="badge rounded-pill bg-warning">@lang('back.waiting') {{count($job->where('status', 'waiting'))}}</span><span
                            class="badge rounded-pill bg-success">@lang('back.approved') {{count($job->where('status', 'approved'))}}</span><span
                            class="badge rounded-pill bg-danger">@lang('back.rejected') {{count($job->where('status', 'rejected'))}}</span>
                </h4>

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

        @if(Session::has('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="uil uil-check me-2"></i>
                {!! session('msg') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>
        @endif
        <br>
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('back.name')</th>
                            <th>@lang('back.date_of_berth')</th>
                            <th>@lang('back.job_title')</th>
                            <th>@lang('back.date_apply_job')</th>
                            <th>Application</th>

                        </tr>
                        </thead>
                        <tbody>
                        {{--                        @dd(ksort($job->where('status', 'NEW')))--}}
                        {{--@dd(collect(array_values($job->where('status', 'NEW')->toArray()))->values())--}}
                        @foreach($job->where('status', 'NEW') as $key => $candidate2)
                            @if(!is_null($candidate2->job) && is_null($candidate2->job->deleted_at))

                                <tr>

                                        {{--                                <td>{{count($job->where('status', 'NEW')) - 1 - $key}}</td>--}}
                                        <td>{{1 + $key}}</td>
                                        <td><a href="#{{$candidate2->id}}">{{$candidate2->name}}</a></td>
                                        <td>{{json_decode($candidate2->app)->date_of_berth}}</td>
                                        <td>{{$candidate2->job->job_title}}</td>
                                        <td>{{$candidate2->created_at}}</td>
                                        <td>
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                               data-bs-target=".app{{$candidate2->id}}"
                                               class="btn btn-outline-light text-truncate"><i
                                                        class="uil-file-alt me-1"></i>
                                                Application</a>
                                        </td>
                                </tr>
                            @endif

                        @endforeach
                        </tbody>
                    </table>

                </div>


            </div>
        </div> <!-- end col -->
        @foreach($job->where('status', 'NEW') as $key => $candidate)

            @if(!is_null($candidate->job) && is_null($candidate->job->deleted_at))
                <div class="col-xl-4 col-sm-6" id="{{$candidate->id}}">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a class="text-body dropdown-toggle font-size-16" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="uil uil-ellipsis-h"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item text-info"
                                       href="{{route('jobs.status',[$candidate->id,'interviewed'])}}"> <i
                                                class="uil-users-alt"></i> @lang('back.interviewed')</a>
                                    <a class="dropdown-item text-warning"
                                       href="{{route('jobs.status',[$candidate->id,'waiting'])}}"> <i
                                                class="uil-users-alt"></i> @lang('back.waiting')</a>
                                    <a class="dropdown-item text-success"
                                       href="{{route('jobs.status',[$candidate->id,'approved'])}}"> <i
                                                class="uil-check"></i> @lang('back.approved')</a>
                                    <a class="dropdown-item text-danger"
                                       href="{{route('jobs.status',[$candidate->id,'rejected'])}}"> <i
                                                class="uil-times"></i> @lang('back.rejected')</a>
                                </div>
                            </div>


                            <div class="clearfix"></div>
                            <div class="mb-4">
                                <img src="https://cdn-icons-png.flaticon.com/512/544/544548.png"
                                     alt="{{$candidate->name}}"
                                     class="avatar-lg rounded-circle img-thumbnail">
                            </div>
                            <div class="pb-2">
                                <form action="{{route('jobs.candidate.rate',$candidate->id)}}">
                                    <select class="rating-css" name="rate" autocomplete="off"
                                            onchange="this.form.submit()">
                                        <option {{$candidate->rate == 1 ? 'selected' : ''}}  value="1">1
                                        </option>
                                        <option {{$candidate->rate == 2 ? 'selected' : ''}}  value="2">2
                                        </option>
                                        <option {{$candidate->rate == 3 ? 'selected' : ''}}  value="3">3
                                        </option>
                                        <option {{$candidate->rate == 4 ? 'selected' : ''}}  value="4">4
                                        </option>
                                        <option {{$candidate->rate == 5 ? 'selected' : ''}}  value="5">5
                                        </option>
                                    </select>
                                </form>
                            </div>

                            <h5 class="font-size-16 mb-1"><a href="#" data-bs-toggle="modal"
                                                             data-bs-target=".app{{$candidate->id}}"
                                                             class="text-dark">{{$candidate->name}}
                                    <br>({{$candidate->job->job_title}})</a></h5>
                            <p class="text-muted mb-2">{{$candidate->email}}</p>
                            <span class="badge rounded-pill bg-{{$candidate->color}}">@lang('back.'.$candidate->status)</span>
                            <br>
                            <span class="badge rounded-pill bg-dark">@lang('back.date_apply_job') {{$candidate->created_at}}</span>
                        </div>
                        @include('acp.Job.app',$candidate)
                        <div class="btn-group" role="group">
                            <a href="javascript:void(0);" data-bs-toggle="modal"
                               data-bs-target=".app{{$candidate->id}}"
                               class="btn btn-outline-light text-truncate"><i class="uil-file-alt me-1"></i>
                                Application</a>


                            @if($candidate->cv)
                                <a target="_blank" href="{{getFile($candidate->cv)}}"
                                   class="btn btn-outline-light text-truncate"><i
                                            class="uil-file-copy-alt me-1"></i>CV</a>
                            @else
                                <a href="javascript:void(0);" class="btn btn-outline-light text-truncate"><i
                                            class="uil-file-copy-alt me-1"></i>CV</a>
                            @endif
                            <a href="https://wa.me/+2{{str_replace('-','',json_decode($candidate->app)->whatsapp)}}?text={{route('candidate',[$candidate->id,\Str::replace(' ', '-', $candidate->name)])}}"
                               target="_blank" class="btn btn-outline-light">
                                <span class=" text-success  rounded-circle">
                                <i class="fab fa-whatsapp" style="font-size: 33px;"></i>
                                </span>
                            </a>

                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    </div>
    <!-- end row -->


@endsection


@section('js')
    <!-- jquery-bar-rating js -->
    <script src="{{url('acp/libs/jquery-bar-rating/jquery.barrating.min.js')}}"></script>

    <script src="{{url('acp/js/pages/rating-init.js')}}"></script>

    <script>
        jQuery(document).ready(function () {
            $(".btnPrint").click(function () {
                var contents = $("#dvContents" + $(this).attr('data-id')).html();
                var frame1 = $('<iframe />');
                frame1[0].name = "frame1";
                //frame1.css({ "position": "absolute", "top": "-1000000px" });
                $("body").append(frame1);
                var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
                frameDoc.document.title = $(".modal-title" + $(this).attr('data-id')).html();

                //Create a new HTML document.
                frameDoc.document.write('<!doctype html> <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="direction: rtl"><head><title>' + $(".modal-title" + $(this).attr('data-id')).html() + '</title>');

                //Append the external CSS file.
                //frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
                frameDoc.document.write('<link href="{{url('acp/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/>');
                frameDoc.document.write('</head><body>');
                //Append the DIV contents.
                frameDoc.document.write(contents);
                frameDoc.document.write('</body></html>');
                frameDoc.document.close();
                setTimeout(function () {
                    window.frames["frame1"].focus();
                    window.frames["frame1"].print();
                    frame1.remove();
                }, 500);
            });
        });

        jQuery(document).ready(function () {
            $(".btnSendTo").click(function () {

                $("#sendto" + $(this).attr('data-id')).show();
// alert($(this).attr('data-id'));
            });
        });
    </script>
@endsection
