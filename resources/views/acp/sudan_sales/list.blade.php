@extends('acp.layout.app')

@section('title')
    @lang('back.sudan_sales')
@endsection

@section('css')
    <link href="{{ url('acp/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('acp/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('acp/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.sudan_sales')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.sudan_sales')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
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
                        <h4 class="mb-1 mt-1"> <span data-plugin="counterup">{{ number_format(count($sales)) }}</span> عميل
                        </h4>
                        <p class="text-muted mb-0">اجمالي العملاء</p>
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
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ number_format($total_quantity) }}</span></h4>
                        <p class="text-muted mb-0"> اجمالى عدد الكرتين </p>
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
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ number_format($total_net_profit) }}</span>
                        </h4>
                        <p class="text-muted mb-0">Net Profit</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-money-withdrawal text-success" style="font-size: 55px"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span
                                data-plugin="counterup">{{ number_format(getSetting('sudan_sales_factory_quantity')->value) }}</span>
                        </h4>
                        <p class="text-muted mb-0">رصيد المصنع</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if (Session::has('msg'))
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
                    <a href="{{ route('sudan_sales.create') }}" class="btn btn-primary waves-effect waves-light">
                        @lang('back.create') @lang('back.sudan_sales') <i class="uil uil-plus-square ms-2"></i>
                    </a>
                    <a href="{{ route('sudan_sales.factory_quantity') }}" class="btn btn-success waves-effect waves-light">
                        تحديث رصيد المصنع <i class="uil uil-pin ms-2"></i>
                    </a>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('back.print')</th>
                                <th>@lang('back.client') </th>
                                <th>@lang('back.invoice_num') </th>
                                {{-- <th>@lang('back.purchase_date') </th> --}}
                                <th>@lang('back.name') @lang('back.company') @lang('back.export')</th>
                                <th>@lang('back.phone') </th>
                                <th>@lang('back.whatsapp') </th>
                                <th>@lang('back.sale_price') </th>
                                <th>@lang('back.received') </th>
                                <th>@lang('back.net_profit') </th>
                                <th>@lang('back.action')</th>
                            </tr>
                        </thead>


                        <tbody>
                            @isset($sales)
                                @foreach ($sales as $key => $sale)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <a class="dropdown-item" href="{{ route('sudan_sales.invoice', $sale->id) }}">
                                                <i class="text-warning fas fa-print"></i>
                                            </a>
                                        </td>
                                        <td @if ($sale->received == 'received') style="color: red;" @endif>
                                            {{ $sale->client_name }}
                                        </td>
                                        <td>
                                            <a href="{{ route('sudan_sales.show', $sale->id) }}">
                                                {{ $sale->ref }}
                                            </a>
                                        </td>
                                        {{-- <td>{{ $sale->purchase_date }}</td> --}}
                                        <td>{{ $sale->company_name }}</td>
                                        <td>
                                            <a href="tel:{{ $sale->client_phone }}">
                                                <img src="https://icons.veryicon.com/png/o/miscellaneous/fs-icon/call-13.png"
                                                    width="30" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            @if ($sale->client_whatsapp)
                                                <a href="https://wa.me/+2{{ $sale->client_whatsapp ? Str::replace('-', '', $sale->client_whatsapp) : '' }}"
                                                    target="_blanck">
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/WhatsApp_icon.png/479px-WhatsApp_icon.png"
                                                        width="30" alt="">
                                                </a>
                                            @else
                                                لا يوجد رقم للتواصل واتس
                                            @endif
                                        </td>
                                        <td>{{ number_format($sale->sale_price) }}</td>
                                        <td>
                                            @if ($sale->received == 'received')
                                                <div class="p-1 bg-dark text-white text-center" style="border-radius: 20px">
                                                    @lang('back.is_received')
                                                </div>
                                            @else
                                                <div class="p-1 bg-success text-white text-center" style="border-radius: 20px">
                                                    @lang('back.' . $sale->received)
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ number_format($sale->net_profit) }}</td>

                                        <td style="width: 100px">
                                            <div class="dropdown float-end">
                                                <a class="text-body dropdown-toggle font-size-16" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="uil uil-ellipsis-h"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    {{-- <a class="dropdown-item"
                                                    href="{{ route('sudan_sales.show', $sale->id) }}"><i
                                                        class="text-warning fas fa-eye"></i> @lang('back.show')
                                                    </a> --}}
                                                    {{-- <a class="dropdown-item"
                                                        href="{{ route('sudan_sales.invoice', $sale->id) }}"><i
                                                            class="text-warning fas fa-print"></i> @lang('back.print')
                                                    </a> --}}
                                                    <a class="dropdown-item"
                                                        href="{{ route('sudan_sales.edit', $sale->id) }}"><i
                                                            class="text-warning fas fa-pencil-alt"></i> @lang('back.edit')
                                                    </a>
                                                    <!-- Delete Button -->
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal" data-id="{{ $sale->id }}"
                                                        class="dropdown-item">
                                                        <i class="text-danger fas fa-times"></i> @lang('back.delete')
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!--  Create Payment -->
                                    <div class="modal fade bs-example-modal-lg{{ $sale->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">@lang('back.create')
                                                        @lang('back.payment') {{ $sale->ref }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ route('payments.store', $sale->id) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">

                                                            <div class="col-lg-6">
                                                                <div class="mt-5 mt-lg-4">

                                                                    <div class="row mb-4">
                                                                        <label for="horizontal-Fullname-input"
                                                                            class="col-sm-4 col-form-label">@lang('back.date')
                                                                            *</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="date" class="form-control"
                                                                                id="horizontal-Fullname-input"
                                                                                value="{{ old('date', date('Y-m-d')) }}"
                                                                                required name="date">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-4">
                                                                        <label for="horizontal-Fullname-input"
                                                                            class="col-sm-4 col-form-label">@lang('back.to_be_paid')
                                                                        </label>
                                                                        <div class="col-sm-8">
                                                                            <input type="number" class="form-control"
                                                                                id="horizontal-Fullname-input"
                                                                                value="{{ $sale->total_amount }}" readonly
                                                                                required name="total_amount">
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="mt-5 mt-lg-4">
                                                                    <div class="row mb-4">
                                                                        <label for="horizontal-address-input"
                                                                            class="col-sm-4 col-form-label">@lang('back.payment_type')
                                                                            *</label>
                                                                        <div class="col-sm-8">
                                                                            <select name="payment_type" class="form-control">
                                                                                <option value="" disabled selected>
                                                                                    @lang('back.select_one')</option>
                                                                                <option value="cash">@lang('back.cash')
                                                                                </option>
                                                                                <option value="bank_transfer">
                                                                                    @lang('back.bank_transfer')</option>
                                                                                <option value="bank_check">@lang('back.bank_check')
                                                                                </option>

                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-4">
                                                                        <label for="horizontal-Fullname-input"
                                                                            class="col-sm-4 col-form-label">@lang('back.paid_up')
                                                                            *</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="number" class="form-control"
                                                                                id="horizontal-Fullname-input"
                                                                                value="{{ old('amount	') }}" required
                                                                                name="amount"
                                                                                placeholder="@lang('back.paid_up')">
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                        </div>


                                                        <div class="row">

                                                            <div class="col-lg-12">
                                                                <div class="mt-5 mt-lg-4">

                                                                    <div class="row mb-4">
                                                                        <label for="horizontal-Fullname-input"
                                                                            class="col-sm-4 col-form-label">@lang('back.description')
                                                                            *</label>
                                                                        <div class="col-sm-8">
                                                                            <textarea name="note" class="form-control" cols="30" rows="5" placeholder="@lang('back.description')">{{ old('note') }}</textarea>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div class="row justify-content-end">
                                                            <div class="col-sm-9">
                                                                <div class="d-flex flex-wrap gap-3">
                                                                    <button type="submit"
                                                                        class="btn btn-primary waves-effect waves-light w-md">@lang('back.submit')</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <!-- Print POS -->
                                    <div class="modal fade print{{ $sale->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="mySmallModalLabel">@lang('back.invoice')
                                                        @lang('back.pos') {{ $sale->ref }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body invoice-POS">
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد أنك تريد حذف هذه الفاتورة؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء الإجراء</button>
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script src="{{ url('acp/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('acp/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var saleId = button.getAttribute('data-id');
                var action = "{{ route('sudan_sales.destroy', '') }}/" + saleId;
                var form = document.getElementById('deleteForm');
                form.action = action;
            });
        });
    </script>

    <!-- Buttons examples -->
    <script src="{{ url('acp/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('acp/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('acp/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('acp/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('acp/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ url('acp/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ url('acp/js/pages/datatables.init.js') }}"></script>
@endsection
