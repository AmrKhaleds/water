@extends('acp.layout.app')

@section('title')
    @lang('back.price_proposal')
@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.price_proposal')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.price_proposal')</li>
                        <li class="breadcrumb-item ">@lang('back.price_proposal')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="dvContents">

                    <div class="row">
                        <div class="col-lg-4 col-sm-4">
                            <div class="invoice-title">
                                <div class="mb-4">
                                    <img src="{{ asset('acp/images/capital.png') }}" alt="logo" height="80" />
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <div class="text-muted ">
                                <div>
                                    <h5 class="font-size-16 mb-1">@lang('back.name') @lang('back.price_proposal') :</h5>
                                    <p>{{ $price_proposal->name }}</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-16 mb-1">@lang('back.price_proposal') @lang('back.date') :</h5>
                                    <p>{{ Carbon\Carbon::parse($price_proposal->date)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="py-2 col-lg-12">
                        <h5 class="font-size-15 text-left">@lang('back.price_proposal')</h5>

                        <div class="table-responsive">
                            <table class="table  table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">#</th>
                                        <th>@lang('back.product')</th>
                                        <th>@lang('back.price')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($statements as $key => $statement)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $statement['statement'] }}</td>
                                            <td>{{ number_format($statement['price']) }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot style="background: rgb(215, 215, 215)">
                                    <tr>
                                        <th style="width:20%" class="">#</th>
                                        <th style="width:20%" class="">@lang('back.sub_total') بالحروف</th>
                                        <td class="">{{ $total_price_in_arabic }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:20%" class="">#</th>
                                        <th class="">@lang('back.grand_total')</th>
                                        <td class="">{{ number_format($total_price) }} جنيهًا فقط لا غير</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="mt-4">
                            <h5 class="font-size-16 mb-1">@lang('back.description') :</h5>
                            <p>{{ $price_proposal->notes }}</p>
                        </div>
                        <div class="d-print-none mt-4">
                            <div class="float-end">
                                @php
                                    $url = route('price_proposal.print', $price_proposal->id);
                                @endphp
                                <a class="btn btn-success waves-effect waves-light me-1" href="#"
                                    onclick="printPage('{{ $url }}'); return false;"><i
                                        class="fas fa-print" style="font-size: 25px;"></i>
                                </a>
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
        function printPage(url) {
            var printWindow = window.open(url, '_blank', 'height=500,width=800');
            printWindow.onload = function() {
                printWindow.focus();
                printWindow.print();
                printWindow.onafterprint = function() {
                    printWindow.close();
                };
            };
        }
    </script>
@endsection
