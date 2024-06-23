@extends('acp.layout.app')

@section('title')
    @lang('back.transfers_store')
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
                <h4 class="mb-0">@lang('back.transfers_store')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.transfers_store')</li>
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
                    <a href="{{route('transfers.create')}}" class="btn btn-primary waves-effect waves-light">
                        @lang('back.create') @lang('back.transfer_store') <i class="uil uil-plus-square ms-2"></i>
                    </a>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('back.date') </th>
                            <th>@lang('back.ref') </th>
                            <th>@lang('back.from') @lang('back.store') </th>
                            <th>@lang('back.to') @lang('back.store') </th>
                            <th>@lang('back.count_transfer') </th>
                            <th>@lang('back.status') </th>
                            <th>@lang('back.total') </th>
                            <th>@lang('back.action')</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($purchases as $key => $purchase)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$purchase->set_date}}</td>
                                <td><a href="{{route('purchases.show',$purchase->id)}}">{{$purchase->ref}}</a></td>
                                <td>{{$purchase->fromStore->name}}</td>
                                <td>{{$purchase->toStore->name}}</td>
                                <td>{{$purchase->orders->whereNull('deleted_at')->count()}}</td>
                                <td><span class="badge bg-soft-{{$purchase->status == 'ordered' ? 'success' : 'danger'}}">@lang('back.'.$purchase->status)</span></td>
                                <td>{{$purchase->total_amount}}</td>
                                <td style="width: 100px">
                                    <div class="dropdown float-end">
                                        <a class="text-body dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                            <i class="uil uil-ellipsis-h"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{route('transfers.edit',$purchase->id)}}"><i class="text-warning fas fa-pencil-alt"></i> @lang('back.edit')</a>
                                            <a class="dropdown-item" href="{{route('transfers.destroy',$purchase->id)}}"><i class="text-danger fas fa-times"></i> @lang('back.delete')</a>
                                            <a class="dropdown-item" href="{{route('transfers.show',$purchase->id)}}"><i class="text-dark fas fa-dollar-sign"></i> @lang('back.payments')</a>

                                        </div>
                                    </div>
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
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{url('acp/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{url('acp/js/pages/datatables.init.js')}}"></script>


@endsection