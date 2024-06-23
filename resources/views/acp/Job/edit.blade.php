@extends('acp.layout.app')

@section('title')
    @lang('back.edit') @lang('back.job')
@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">

@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.edit') @lang('back.job')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.edit') @lang('back.job')</li>
                        <li class="breadcrumb-item ">@lang('back.jobs')</li>
                        <li class="breadcrumb-item">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @if(Session::has('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-check me-2"></i>
                        {!! session('msg') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                        </button>
                    </div>

                @endif
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <p></p>
                            <i class="uil uil-exclamation-octagon me-2"></i>
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                            </button>
                        </div>
                    @endforeach
                @endif
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">

                            <form action="{{route('jobs.update',$job->id)}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-5 mt-lg-4">
                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.job_title') *</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"
                                                           name="job_title" required placeholder="@lang('back.job_title')" value="{{old('job_title',$job->job_title)}}">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.start_day') *</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control"
                                                           name="start_day" placeholder="@lang('back.start_day')" value="{{old('start_day',$job->start_in)}}" required>
                                                </div>
                                            </div>


                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.working_hours') *</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control"
                                                           name="working_hours" placeholder="@lang('back.working_hours')" required value="{{old('working_hours',$job->working_hours)}}">
                                                </div>
                                            </div>


                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.public_holidays') *</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="public_holidays" class="form-control" value="{{old('public_holidays',$job->public_holidays)}}" placeholder="@lang('back.public_holidays')">
                                                </div>
                                            </div>


                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.work_from') *</label>
                                                <div class="col-sm-8">
                                                    <select name="work_from" class="form-control">
                                                        <option value="" selected disabled>@lang('back.select_one')</option>
                                                        <option {{$job->work_from == 'at_home'? 'selected' : ''}}  value="at_home">@lang('back.at_home')</option>
                                                        <option {{$job->work_from == 'at_work'? 'selected' : ''}}  value="at_work">@lang('back.at_work')</option>

                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.skills') *</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="skills" class="form-control" value="{{old('skills',$job->skills)}}"  placeholder="افصل بين كل مهاره بعلامه , مثال (كتابه ,قرائه ,كمبيوتر)">
                                                </div>
                                            </div>




                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-5 mt-lg-4">
                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.total_positions') *</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control"
                                                           name="total_positions" placeholder="@lang('back.total_positions')" value="{{old('total_positions',$job->total_positions)}}">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.end_day') *</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control"
                                                           name="end_day" placeholder="@lang('back.end_day')" required value="{{old('end_day',$job->end_in)}}">
                                                </div>
                                            </div>



                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.workdays') *</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="workdays" class="form-control" value="{{old('workdays',$job->workdays)}}" placeholder="افصل بين ايام العمل بعلامه , مثال (السبت ,الاحد ,الاثنين)">

                                                </div>
                                            </div>




                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.department') *</label>
                                                <div class="col-sm-8">
                                                    <select name="job_category" class="form-control" >
                                                        <option value="" selected disabled>@lang('back.select_one')</option>
                                                        @foreach($departments as $department)
                                                            <option {{$job->job_category == $department->id ? 'selected' : ''}}  value="{{$department->id}}">{{$department->title}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.type_employment') *</label>
                                                <div class="col-sm-8">
                                                    <select name="type_employment" class="form-control">
                                                        <option value="" selected disabled>@lang('back.select_one')</option>
                                                        <option {{$job->type_employment == 'part_time' ? 'selected' : ''}} value="part_time">@lang('back.part_time')</option>
                                                        <option {{$job->type_employment == 'full_time' ? 'selected' : ''}} value="full_time">@lang('back.full_time')</option>
                                                        <option {{$job->type_employment == 'freelance' ? 'selected' : ''}} value="freelance">@lang('back.freelance')</option>
                                                        <option {{$job->type_employment == 'entry_level' ? 'selected' : ''}} value="entry_level">@lang('back.entry_level')</option>
                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mt-5 mt-lg-4">

                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.job_requirement') *</label>
                                                <div class="col-sm-8">
                                                    <textarea placeholder="@lang('back.job_requirement')" name="job_requirement" class="summernote">{!! old('job_requirement',$job->job_requirement) !!}</textarea>
                                                </div>
                                            </div>


                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.job_description') *</label>
                                                <div class="col-sm-8">
                                                    <textarea placeholder="@lang('back.job_description')" name="job_description" class="summernote">{!! old('job_description',$job->job_description) !!}</textarea>
                                                </div>
                                            </div>



                                            <div class="row justify-content-end">
                                                <div class="col-sm-9">
                                                    <div class="d-flex flex-wrap gap-3">
                                                        <button type="submit"
                                                                class="btn btn-primary waves-effect waves-light w-md">@lang('back.submit')</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>



@endsection


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
    <script>

        $(document).ready(function () {
            $('.summernote').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],
                height: 170,
            });
        });
    </script>

@endsection
