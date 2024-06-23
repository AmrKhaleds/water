@extends('acp.layout.app')

@section('title')
    @lang('back.invoice') {{$sale->ref}}
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.invoice') {{$sale->ref}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.invoice') {{$sale->ref}}</li>
                        <li class="breadcrumb-item ">@lang('back.sudan_sales')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row" >
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="dvContents">

                    <div class="row">
                        <div class="col-lg-4 col-sm-4">
                            <div class="invoice-title">
                                <div class="mb-4">
                                    <img src="{{getSetting('logo')->value}}" alt="logo" height="80"/>
                                </div>
                                <div class="text-muted">
                                    <p class="mb-1">{{getSetting('address')->value}}</p>
                                    <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> {{getSetting('email')->value}}</p>
                                    <p><i class="uil uil-phone me-1"></i> {{getSetting('phone')->value}}</p>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">@lang('back.provider_datiles'):</h5>
                                <h5 class="font-size-15 mb-2">{{$sale->client_name}}</h5>
                                <p class="mb-1">{{$sale->address}}</p>
                                {{-- <p class="mb-1">{{$sale->email}}</p> --}}
                                <p>{{$sale->client_phone}} - {{$sale->client_whatsapp}}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <div class="text-muted ">
                                <div>
                                    <h5 class="font-size-16 mb-1">@lang('back.invoice') :</h5>
                                    <p>{{$sale->ref}}</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-16 mb-1">@lang('back.invoice') @lang('back.date') :</h5>
                                    <p>{{$sale->purchase_date}}</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-16 mb-1">@lang('back.status_paid'):</h5>
                                    @if($sale->received == 'received') @lang('back.is_received') @else @lang('back.pending') @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="py-2 col-lg-12">
                        <h5 class="font-size-15 text-left">@lang('back.order_summary')</h5>

                        <div class="table-responsive">
                            <table class="table  table-centered mb-0">
                                <thead>
                                <tr>
                                    <th style="width: 70px;">#.</th>
                                    <th>@lang('back.product')</th>
                                    <th>@lang('back.price')</th>
                                    <th>@lang('back.qty')</th>
                                    <th class="text-end" style="width: 120px;">@lang('back.total')</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $sale->product->name }}</td>
                                        <td>{{ $sale->sale_price }}</td>
                                        <td>{{ $sale->quantity}}</td>
                                        <td class="text-end">{{$sale->sale_price * $sale->quantity}}</td>
                                    </tr>
                                {{-- @foreach($sale->orders->whereNull('deleted_at') as $key => $orders)
                                @endforeach --}}

                                <tr>
                                    <th scope="row" colspan="4" class="text-end">@lang('back.sub_total')</th>
                                    <td class="text-end">{{$sale->sale_price * $sale->quantity}}</td>
                                </tr>
                                {{-- <tr>
                                    <th scope="row" colspan="4" class="text-end">@lang('back.tax')</th>
                                    <td class="text-end">({{$sale->tax}}%) {{$sale->tax_amount}} </td>
                                </tr> --}}
                                <tr>
                                    <th scope="row" colspan="4" class=" text-end">@lang('back.grand_total')</th>
                                    <td class="text-end">{{$sale->sale_price * $sale->quantity}}</td>
                                </tr>
                                </tbody>
                            </table>

                            <p>{{$sale->description}}</p>
                        </div>
                        <div class="d-print-none mt-4">
                            <div class="float-end">
                                <a href="javascript:void(0);" id="btnPrint"
                                   class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->



@endsection
@section('js')
    <script>
        $(function () {
            $("#btnPrint").click(function () {
                var contents = $("#dvContents").html();
                var frame1 = $('<iframe />');
                frame1[0].name = "frame1";
                //frame1.css({ "position": "absolute", "top": "-1000000px" });
                $("body").append(frame1);
                var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
                frameDoc.document.open();
                //Create a new HTML document.
                frameDoc.document.write('<!doctype html> <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="direction: rtl"><head>');

                //Append the external CSS file.
                //frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
                frameDoc.document.write('<link href="{{url('acp/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/><link href="{{url('acp/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css"/>');
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
    </script>
@endsection

