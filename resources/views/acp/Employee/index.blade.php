@extends('acp.layout.app')

@section('title')
    @lang('back.employees')
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.employees')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.employees')</li>
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
        <div class="col-xl-3 col-sm-6">
            <a href="{{route('employees.create')}}" class="btn btn-primary waves-effect waves-light">
                @lang('back.create') @lang('back.employee') <i class="uil uil-plus-square ms-2"></i>
            </a>
        </div>

    </div>
    <div class="row">

        @foreach($employees as $employee)
            @if($employee->employee)
                <div class="col-xl-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a class="text-body dropdown-toggle font-size-16" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true">
                                    <i class="uil uil-ellipsis-h"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item"
                                       href="{{route('employees.edit',$employee->id)}}">@lang('back.edit')</a>
                                    <a class="dropdown-item"
                                       href="{{route('employees.destroy',$employee->id)}}">@lang('back.delete')</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="mb-4">
                                <img src="{{getFile($employee->employee->photo)}}" alt=""
                                     class="avatar-lg rounded-circle img-thumbnail">
                            </div>
                            <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">{{$employee->name}}</a></h5>
                            <p class="text-muted mb-2">{{$employee->employee->department->name}}</p>

                        </div>

                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-light text-truncate"><i
                                        class="uil uil-user me-1"></i> Profile
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <!-- end row -->


@endsection

