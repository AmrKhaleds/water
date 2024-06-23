@extends('acp.layout.app')

@section('title')
    @lang('back.report_store')
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.report_store')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.report_store')</li>
                    </ol>
                </div>

            </div>
        </div>

    </div>
    <!-- end page title -->



    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton5"
                               data-bs-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <span class="fw-semibold">@lang('back.stores') : </span> <span
                                        class="text-muted"> {{$store}} <i
                                            class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5">
                                    <a class="dropdown-item" href="{{route('report.store')}}">@lang('back.all_stores')</a>
                                @foreach($stores as $store)
                                    <a class="dropdown-item" href="{{route('report.store')}}?store={{$store->id}}">{{$store->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->

        </div>

    </div>
    <!-- end page title -->



    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-money-withdraw text-warning" style="font-size: 55px"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"> @lang('back.L.E') <span data-plugin="counterup">{{$sales->sum('total_amount')}}</span></h4>
                        <p class="text-muted mb-0">@lang('back.total_sale')</p>
                    </div>

                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-exchange-alt text-success" style="font-size: 55px"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{array_sum(array_column($orderSale,'qty'))}}</span></h4>
                        <p class="text-muted mb-0"> @lang('back.count_sale') </p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">

            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-dropbox text-pink" style="font-size: 55px"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$product_store->sum('qty')}}</span></h4>
                        <p class="text-muted mb-0">@lang('back.remaining_in_store') </p>
                    </div>

                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-money-insert text-info" style="font-size: 55px"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"> @lang('back.L.E') <span data-plugin="counterup">{{$purchases->sum('total_amount')}}</span></h4>
                        <p class="text-muted mb-0">@lang('back.total_purchase')</p>
                    </div>

                </div>
            </div>
        </div> <!-- end col-->

    </div> <!-- end row-->


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">@lang('back.sales')</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">@lang('back.purchases')</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">@lang('back.transfers_store')</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#sale" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">@lang('back.details_sale')</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#datils_remaining" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">@lang('back.datils_remaining_in_store')</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('back.date') </th>
                                    <th>@lang('back.ref') </th>
                                    <th>@lang('back.client') </th>
                                    <th>@lang('back.store') </th>
                                    <th>@lang('back.status') </th>
                                    <th>@lang('back.total') </th>
                                    <th>@lang('back.paid') </th>
                                    <th>@lang('back.due') </th>
                                    <th>@lang('back.status_paid') </th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($sales as $key => $sale)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$sale->set_date}}</td>
                                        <td><a href="{{route('sales.show',$sale->id)}}">{{$sale->ref}}</a></td>
                                        <td>{{$sale->user->name}}</td>
                                        <td>{{$sale->store->name}}</td>
                                        <td>
                                            <span class="badge bg-soft-{{$sale->status == 'ordered' ? 'success' : 'danger'}}">@lang('back.'.$sale->status)</span>
                                        </td>
                                        <td>{{$sale->total_amount}}</td>
                                        <td>{{$sale->paid}}</td>
                                        <td>{{$sale->due}}</td>
                                        <td>{!! $sale->status_paid !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="tab-pane" id="profile" role="tabpanel">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('back.date') </th>
                                    <th>@lang('back.ref') </th>
                                    <th>@lang('back.provider') </th>
                                    <th>@lang('back.store') </th>
                                    <th>@lang('back.status') </th>
                                    <th>@lang('back.total') </th>
                                    <th>@lang('back.paid') </th>
                                    <th>@lang('back.due') </th>
                                    <th>@lang('back.status_paid') </th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($purchases as $key => $purchase)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$purchase->set_date}}</td>
                                        <td><a href="{{route('purchases.show',$purchase->id)}}">{{$purchase->ref}}</a></td>
                                        <td>{{$purchase->user->name}}</td>
                                        <td>{{$purchase->store->name}}</td>
                                        <td><span class="badge bg-soft-{{$purchase->status == 'ordered' ? 'success' : 'danger'}}">@lang('back.'.$purchase->status)</span></td>
                                        <td>{{$purchase->total_amount}}</td>
                                        <td>{{$purchase->paid}}</td>
                                        <td>{{$purchase->due}}</td>
                                        <td>{!! $purchase->status_paid !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="messages" role="tabpanel">
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
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transfers as $key => $transfer)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$transfer->set_date}}</td>
                                        <td><a href="{{route('transfers.show',$transfer->id)}}">{{$transfer->ref}}</a></td>
                                        <td>{{$transfer->fromStore->name}}</td>
                                        <td>{{$transfer->toStore->name}}</td>
                                        <td>{{$transfer->orders->whereNull('deleted_at')->count()}}</td>
                                        <td><span class="badge bg-soft-{{$transfer->status == 'ordered' ? 'success' : 'danger'}}">@lang('back.'.$transfer->status)</span></td>
                                        <td>{{$transfer->total_amount}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="sale" role="tabpanel">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('back.product_name') </th>
                                    <th>@lang('back.count_sale') </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $key => $product)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->qty}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="datils_remaining" role="tabpanel">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('back.product_name') </th>
                                    <th>@lang('back.count_sale') </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allProducts as $key => $allProduct)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$allProduct->name}}</td>
                                        <td>{{$allProduct->products_store->sum('qty')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->


    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">@lang('back.value_according_cost_and_price')</h4>

                    <canvas id="pie" height="260"></canvas>

                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">@lang('back.sum_of_items_and_quantity')</h4>

                    <canvas id="doughnut" height="260"></canvas>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->



@endsection
@section('js')
    <!-- Chart JS -->
    <script src="{{url('acp/libs/chart.js/Chart.bundle.min.js')}}"></script>
    <script>
        !function (l) {
            "use strict";

            function r() {
            }

            r.prototype.respChart = function (r, o, e, a) {
                Chart.defaults.global.defaultFontColor = "#9295a4", Chart.defaults.scale.gridLines.color = "rgba(166, 176, 207, 0.1)";
                var t = r.get(0).getContext("2d"), n = l(r).parent();

                function i() {
                    r.attr("width", l(n).width());
                    switch (o) {
                        case"Doughnut":
                            new Chart(t, {type: "doughnut", data: e, options: a});
                            break;
                        case"Pie":
                            new Chart(t, {type: "pie", data: e, options: a});
                            break;
                    }
                }

                l(window).resize(i), i()
            }, r.prototype.init = function () {
                this.respChart(l("#doughnut"), "Doughnut", {
                    labels: ["Desktops", "Tablets"],
                    datasets: [{
                        data: [300, 210],
                        backgroundColor: ["#5b73e8", "#ebeff2"],
                        hoverBackgroundColor: ["#5b73e8", "#ebeff2"],
                        hoverBorderColor: "#fff"
                    }]
                });
                this.respChart(l("#pie"), "Pie", {
                    labels: ['@lang('back.stock_value_by_price')', '@lang('back.stock_value_by_cost')'],
                    datasets: [{
                        data: [300, 180],
                        backgroundColor: ["#34c38f", "#ebeff2"],
                        hoverBackgroundColor: ["#218862", "#a7a9ab"],
                        hoverBorderColor: "#fff"
                    }]
                });
            }, l.ChartJs = new r, l.ChartJs.Constructor = r
        }(window.jQuery), function () {
            "use strict";
            window.jQuery.ChartJs.init()
        }();
    </script>

@endsection