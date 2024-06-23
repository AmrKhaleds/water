@extends('acp.layout.app')

@section('title')
    @lang('back.clients')
@endsection

@section('css')
    <link href="{{url('acp/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('acp/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('acp/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.clients')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.clients')</li>
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
                    <a href="{{route('clients.create')}}" class="btn btn-primary waves-effect waves-light">
                        @lang('back.create') @lang('back.client') <i class="uil uil-plus-square ms-2"></i>
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
                        @foreach($clients as $key => $client)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$client->name}}</td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->profile ? Str::replace('-','',$client->profile->phone) : ''}}</td>
                                <td>
                                    <a href="https://wa.me/+2{{$client->profile ? Str::replace('-','',$client->profile->whatsapp) : ''}}?text=اهلا بك">
                                        <div class="avatar-sm">
                                                    <span
                                                            class="avatar-title bg-soft-success text-success font-size-25 rounded-circle">
                                                        <i class="fab fa-whatsapp" style="font-size:35px;"></i>
                                                    </span>
                                        </div>
                                    </a>
                                </td>
                                <td>{{$client->profile ? $client->profile->address : ''}}</td>
                                <td style="width: 100px">
                                    <a href="{{route('clients.edit',$client->id)}}" class="btn btn-outline-warning btn-sm" title="@lang('back.edit')">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="{{route('clients.destroy',$client->id)}}" class="btn btn-outline-danger btn-sm" title="@lang('back.delete')">
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
    <!-- Required datatable js -->
    <script src="{{url('acp/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{url('acp/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{url('acp/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{url('acp/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{url('acp/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{url('acp/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>



    <!-- Datatable init js -->
    <script src="{{url('acp/js/pages/datatables.init.js')}}"></script>

@endsection