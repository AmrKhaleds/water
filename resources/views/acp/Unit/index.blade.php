@extends('acp.layout.app')

@section('title')
    @lang('back.units')
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.units')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.units')</li>
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
                    <a href="{{route('units.create')}}" class="btn btn-primary waves-effect waves-light">
                        @lang('back.create') @lang('back.unit') <i class="uil uil-plus-square ms-2"></i>
                    </a>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('back.unit') @lang('back.name')</th>
                            <th>@lang('back.qty')</th>
                            <th>@lang('back.action')</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($units as $key => $unit)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$unit->title}}</td>
                                <td>{{$unit->qty}}</td>
                                <td style="width: 100px">
                                    <a href="{{route('units.edit',$unit->id)}}" class="btn btn-outline-warning btn-sm" title="@lang('back.edit')">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="{{route('units.destroy',$unit->id)}}" class="btn btn-outline-danger btn-sm" title="@lang('back.delete')">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

