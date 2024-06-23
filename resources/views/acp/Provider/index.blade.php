@extends('acp.layout.app')

@section('title')
    @lang('back.providers')
@endsection

@section('css')
    <link href="{{url('acp/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('acp/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('acp/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.providers')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.providers')</li>
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
                    <a href="{{route('providers.create')}}" class="btn btn-primary waves-effect waves-light">
                        @lang('back.create') @lang('back.provider') <i class="uil uil-plus-square ms-2"></i>
                    </a>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('back.name')</th>
                            <th>@lang('back.email')</th>
                            <th>@lang('back.phone')</th>
                            <th>@lang('back.whatsapp')</th>
                            <th>@lang('back.address')</th>
                            <th>@lang('back.action')</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($providers as $key => $provider)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$provider->name}}</td>
                                <td>{{$provider->email}}</td>
                                <td>{{$provider->profile ? $provider->profile->phone : ''}}</td>
                                <td>{{$provider->profile ? $provider->profile->whatsapp : ''}}</td>
                                <td>{{$provider->profile ? $provider->profile->address : ''}}</td>
                                <td style="width: 100px">
                                    <a href="{{route('providers.edit',$provider->id)}}" class="btn btn-outline-warning btn-sm" title="@lang('back.edit')">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="{{route('providers.destroy',$provider->id)}}" class="btn btn-outline-danger btn-sm" title="@lang('back.delete')">
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


@section('js')

    <!-- Responsive Table js -->
    <script src="{{url('acp/libs/admin-resources/rwd-table/rwd-table.min.js')}}"></script>

    <!-- Init js -->
    <script src="{{url('acp/js/pages/table-responsive.init.js')}}"></script>

@endsection