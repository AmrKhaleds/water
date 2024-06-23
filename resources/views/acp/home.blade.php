@extends('acp.layout.app')

@section('title')
    @lang('back.dashborad')
@endsection

@section('css')
@endsection
@section('content')
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">انظمة الإدارة</h4>
            </div>
        </div>
        <div style="display: flex; flex-flow: row;overflow: scroll;" class="mb-2 pb-3">
            <a href="https://2.khater100100.xyz/acp/trakings" target="_blank" class="btn btn-primary dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                سيستم فرسان
            </a>&ensp;
            <a href="https://6.khater100100.xyz/acp/home" target="_blank" class="btn btn-primary dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                سيستم مبرد
            </a>&ensp;
            <a href="https://44.khater100100.xyz/acp/trakings" target="_blank" class="btn btn-primary dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                سيستم فرعون الجديد
            </a>&ensp;
            <a href="https://3.khater100100.xyz/" target="_blank" class="btn btn-primary dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                سيستم فرعون القديم
            </a>&ensp;
            <a href="https://4.khater100100.xyz/acp/login" target="_blank" class="btn btn-primary dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                سيستم مياه معدنيه
            </a>&ensp;
            <a href="https://22.khater100100.xyz/" target="_blank" class="btn btn-primary dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                سيستم حسابات الجديد
            </a>&ensp;
            <a href="https://1.khater100100.xyz/" target="_blank" class="btn btn-primary dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                حسابات القديم
            </a>&ensp;
            {{-- <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                سيستم حجز خيول
            </button> --}}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.billing_movements')</h4>
            </div>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('sales.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-shopping-cart-alt  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.sales')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('purchases.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-calendar-alt  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.purchases')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('sales.external_debt') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-money-withdrawal  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.external_debt')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('transfers.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-exchange-alt  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.transfers_store')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('sudan_sales.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-money-withdrawal  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.sudan_sales')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('printing_models.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-print  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.printing_models')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.menu')</h4>
            </div>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('report.store') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-calendar-alt  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.report_store')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('trakings.index', 'custody') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-route  custom-color" style="line-height: 1.5;font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.trakings') @lang('back.custody_traking')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('trakings.index', 'sales') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-route  custom-color" style="line-height: 1.5;font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.trakings') @lang('back.sales')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('trakings.index', 'freezers') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-route  custom-color" style="line-height: 1.5;font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.trakings') @lang('back.freezer_transfare')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.HR')</h4>
            </div>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('categories.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-sitemap  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.categories')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('employees.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-users-alt  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.employees')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('jobs.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-bag-alt  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.jobs')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('attendants.index', 'driver') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-clock-seven  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.attendants') @lang('back.drivers')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('attendants.index', 'mangers') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-clock-seven  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.attendants') @lang('back.mangers')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.STORE')</h4>
            </div>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('stores.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-store-alt  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.stores')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('products.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-water-glass  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.products')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('units.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-sitemap  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.units')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('brands.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-copyright  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.brands')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('providers.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-users-alt  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.providers')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('clients.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-user  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.clients')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>


    </div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.CARS')</h4>
            </div>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('vehicles.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-car-wash  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.vehicles')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('maintenances.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-cog  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.periodic_maintenance')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.FollowUp')</h4>
            </div>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('bookings.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-calendar-alt  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.bookings')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('booking.freezers.index') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-snowflake-alt  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.bookings_freezers')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.REPORTS')</h4>
            </div>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('report.store') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-calendar-alt  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.report_store')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.settings')</h4>
            </div>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('setting_km.create') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-sign-alt  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.settings') @lang('back.pricing')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-6 col-md-4 col-xl-2">
            <a href="{{ route('setting.create') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="uil-cog  custom-color" style="font-size: 55px"></i>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h4 class="mb-1 mt-1">
                                <span>@lang('back.settings') @lang('back.general')</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
@section('js')
    <!-- apexcharts -->
    <script src="{{ url('acp/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script>
        options = {
            chart: {
                height: 350,
                type: "bar",
                toolbar: {
                    show: !1
                }
            },
            plotOptions: {
                bar: {
                    horizontal: !1,
                    columnWidth: "45%",
                    endingShape: "rounded"
                }
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                show: !0,
                width: 2,
                colors: ["transparent"]
            },
            series: @json($valuesSeries),
            colors: ["#a90707", "#34c38f", "#bf990c"],
            xaxis: @json($label),
            grid: {
                borderColor: "#f1f1f1"
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(e) {
                        return "$ " + e + " thousands"
                    }
                }
            }
        };
        (chart = new ApexCharts(document.querySelector("#column_chart"), options)).render();

        options = {
            chart: {
                height: 350,
                type: "bar",
                toolbar: {
                    show: !1
                }
            },
            plotOptions: {
                bar: {
                    horizontal: !0
                }
            },
            dataLabels: {
                enabled: !1
            },
            series: [{
                data: @json($booking_drivers)
            }],
            colors: ["#34c38f"],
            grid: {
                borderColor: "#f1f1f1"
            },
            xaxis: {
                categories: @json($drivers)
            }
        };
        (chart = new ApexCharts(document.querySelector("#bar_chart"), options)).render();


        options = {
            chart: {
                height: 320,
                type: "pie"
            },
            series: [{{ $vehicleData->where('status', 'damage')->count() }},
                {{ $vehicleData->where('status', 'available')->count() }},
                {{ $vehicleData->where('status', 'garage')->count() }}
            ],
            labels: ["@lang('back.maintenance')", "@lang('back.avalble')", "@lang('back.garage')"],
            colors: ["#f46a6a", "#34c38f", "#f1b44c"],
            legend: {
                show: !0,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: !1,
                fontSize: "14px",
                offsetX: 0
            },
            responsive: [{
                breakpoint: 600,
                options: {
                    chart: {
                        height: 240
                    },
                    legend: {
                        show: !1
                    }
                }
            }]
        };
        (chart = new ApexCharts(document.querySelector("#pie_chart"), options)).render();
    </script>
    {{-- <script src="{{url('acp/js/pages/dashboard.init.js')}}"></script>
--}}
@endsection
