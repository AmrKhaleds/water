@extends('Dashboard.layouts.app')

@section('title')
    @lang('back.dailymoves')
@endsection

@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="{{url('back/vendor/datatables/dataTables.bs4.css')}}" />
    <link rel="stylesheet" href="{{url('back/vendor/datatables/dataTables.bs4-custom.css')}}" />
    <link href="{{url('back/vendor/datatables/buttons.bs.css')}}" rel="stylesheet" />

@endsection

@section('content')
   

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row starts -->
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">@lang('back.create_dailymove')</div>
                    </div>
                    @if(Session::has('msg'))
                        <div class="alert alert-success">
                            <strong>{!! session('msg') !!}</strong>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-container">
                            <div class="table-responsive">
                                <div class="avatar-group flex-row-reverse">
                                    <a href="{{route('dailymoves.create')}}" class="btn btn-info btn-rounded btn-lg">
                                        <span class="icon-plus-circle"></span> @lang('back.create_dailymove') </a>
                                </div>
                                <br>
                                <table id="copy-print-csv" class="table custom-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('back.account_num')</th>
                                        <th>@lang('back.type')</th>
                                        <th>@lang('back.account_name')</th>
                                        <th>@lang('back.debtor')</th>
                                        <th>@lang('back.creditor')</th>
                                        <th>@lang('back.note')</th>
                                        <th>@lang('back.created_at')</th>
{{--                                        <th>@lang('back.action')</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $debtor =0;
                                        $creditor =0;
                                    @endphp
                                    @foreach($dailymoves as $key => $dailymove)
                                        @php
                                            $debtor +=$dailymove->debtor;
                                            $creditor +=$dailymove->creditor;
                                        @endphp
                                        <tr account="{{$dailymove->id}}" class="account">
                                            <td>{{$key+1}}</td>
                                            <td>{{$dailymove->registration_number}}</td>
                                            <th>{{$dailymove->type}}</th>
                                            <td>
                                                @foreach($dailymove->dailyMoveItem as $dailyMoveItem)
                                                    {{$dailyMoveItem->account->name}}
                                                    <hr>
                                                @endforeach
                                            </td>
                                            <td>{{$dailymove->debtor}}</td>
                                            <td>{{$dailymove->creditor}}</td>
                                            <td>{{$dailymove->notes}}</td>
                                            <td>{{$dailymove->created_at}}</td>
{{--
                                            <td>
                                                <div class="td-actions">
                                                    <form  action="{{ route('dailymoves.destroy' , $dailymove->id) }}"
                                                           method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-danger btn-rounded waves-effect waves-light">@lang('back.delete')</button>
                                                    </form>
                                                    <a href="{{ route('dailymoves.edit' , $dailymove->id) }}" class="btn btn-success  btn-rounded waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('back.edit')">
                                                        @lang('back.edit')
                                                    </a>
                                                </div>
                                            </td>
--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <table class="total_all table table-bordered table-striped" rowspan="4" colspan="10" style=" margin-top: 1px; ">
                                    <tbody>
                                    <tr class="total_header">
                                        <td class="text-center w_max" rowspan="3" colspan="4" style=" background-color: #fffad2; ">
                                            <h5> @lang('back.grand_total') </h5>
                                        </td>

                                        <td class="text-center total_debit"><h5>  @lang('back.sub_total')  @lang('back.debtor') </h5></td>
                                        <td class="text-center total_credite"><h5>  @lang('back.sub_total') @lang('back.creditor')  </h5></td>
                                    </tr>
                                    <tr class="total_tr" style="text-align: center">
                                        <td id="total_debit"><h5> {{$debtor}}</h5></td>
                                        <td id="total_credite"><h5> {{$creditor}}</h5></td>

                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->

    </div>
    <!-- Content wrapper end -->

    <div id="model"></div>

@endsection

@section('js')

    <!-- Data Tables -->
    <script src="{{url('back/vendor/datatables/dataTables.min.js')}}"></script>
    <script src="{{url('back/vendor/datatables/dataTables.bootstrap.min.js')}}"></script>

    <!-- Custom Data tables -->
    <script src="{{url('back/vendor/datatables/custom/custom-datatables.js')}}"></script>
    <script src="{{url('back/vendor/datatables/custom/fixedHeader.js')}}"></script>

    <!-- Download / CSV / Copy / Print -->
    <script src="{{url('back/vendor/datatables/buttons.min.js')}}"></script>
    <script src="{{url('back/vendor/datatables/jszip.min.js')}}"></script>
    <script src="{{url('back/vendor/datatables/pdfmake.min.js')}}"></script>
    <script src="{{url('back/vendor/datatables/vfs_fonts.js')}}"></script>
    <script src="{{url('back/vendor/datatables/html5.min.js')}}"></script>
    <script src="{{url('back/vendor/datatables/buttons.print.min.js')}}"></script>
    <script>

        $(document).ready(function () {
            $(".account").click(function () {
                var dailymove = $(this).attr('account') ;
                $.ajax({
                    type: "GET",
                    url: '{{route('account.details')}}/?id=' + dailymove,
                    success: function (data) {
                        $('#model').empty()
                        $('#model').append(data);
                        $('.bd-example-modal-lg').modal('show');

                    }
                });
            });
        });
    </script>

@endsection
