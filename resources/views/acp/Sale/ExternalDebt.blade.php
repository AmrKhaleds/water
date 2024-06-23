@extends('acp.layout.app')

@section('title')
    @lang('back.external_debt')
@endsection

@section('css')
    <link href="{{url('acp/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('acp/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('acp/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.external_debt')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.external_debt')</li>
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
                <div class="contentToPrint">
                    <!-- content to be printed here -->
                </div>

                <div class="card-body">

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('back.client') </th>
                                                        <th>@lang('back.due') </th>
                                                        <th>@lang('back.count_bills') </th>
                        </tr>
                        </thead>


                        <tbody>
                        @php($total=0)
                        @php($bills=0)
                        @foreach($clients as $key => $client)
                            @php($total+=$client['due'])
                            @php($bills+=$client['count_bills'])

                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$client['name']}}</td>
                                <td>{{$client['due']}} @lang('back.L.E')</td>
                                <td>
                                    <a href="{{route('sales.external_debt.bills')}}?data={{$client['bills']}}" class="btn btn-primary waves-effect waves-light">
                                        @lang('back.show') @lang('back.billing_movements') {{$client['count_bills']}} <i class="uil uil-files-landscapes-alt ms-2"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><p style="display:none">{{$key+1}}</p></td>
                            <th><h3>@lang('back.total')</h3></th>
                            <th><h3>{{$total}} @lang('back.L.E')</h3></th>
                            <th><h3>{{$bills}} @lang('back.invoice')</h3></th>
                        </tr>
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