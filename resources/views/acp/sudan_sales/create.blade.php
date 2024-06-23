@extends('acp.layout.app')

@section('title')
    @lang('back.create') @lang('back.invoice') @lang('back.sudan_sales')
@endsection
@section('css')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.create') @lang('back.invoice') @lang('back.sudan_sales')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.create') @lang('back.sales')</li>
                        <li class="breadcrumb-item ">@lang('back.invoice') @lang('back.sudan_sales')</li>
                        <li class="breadcrumb-item">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @if (Session::has('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-check me-2"></i>
                        {!! session('msg') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                        </button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class = "alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <form method="post" action="{{ route('sudan_sales.store') }}" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div id="new_client-data" class="" style="">
                            {{-- <div class="col"> --}}
                            <h5 style="font-wight: bold;">@lang('back.client_details')</h5>
                            <div class="mt-5 mt-lg-4 row ms-2">
                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.name') @lang('back.client') <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{ old('client_name') }}" required
                                            placeholder="@lang('back.name') @lang('back.client')" name="client_name">
                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.phone')
                                        <span style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control phone_number"
                                            value="{{ old('client_phone') }}" required placeholder="@lang('back.phone')"
                                            name="client_phone">
                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.whatsapp')</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control phone_number"
                                            value="{{ old('client_whatsapp') }}" placeholder="@lang('back.whatsapp')"
                                            name="client_whatsapp">
                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.number') @lang('back.passport')</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" value="{{ old('client_passport') }}"
                                            placeholder="@lang('back.number') @lang('back.passport')" name="client_passport">
                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.address')</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" placeholder="@lang('back.address')" name="address">{{ old('address') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <h5 style="font-wight: bold;">@lang('back.driver_details')</h5>
                            <div class="mt-5 mt-lg-4 row ms-2">
                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.name')
                                        @lang('back.driver')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{ old('driver_name') }}"
                                            placeholder="@lang('back.name') @lang('back.driver')" name="driver_name">
                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.driver_phone')
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control phone_number"
                                            value="{{ old('driver_phone') }}" placeholder="@lang('back.driver_phone')"
                                            name="driver_phone">
                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.number')
                                        @lang('back.passport')</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" value="{{ old('driver_passport') }}"
                                            placeholder="@lang('back.number') @lang('back.passport')" name="driver_passport">
                                    </div>
                                </div>
                            </div>

                            <h5 style="font-wight: bold;">@lang('back.sales_details')</h5>
                            <div class="mt-5 mt-lg-4 row ms-2">
                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.product') <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="product_id" class="form-control" required>
                                            <option selected disabled>اختر منتج</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                                    {{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.water_export')</label>
                                    <div class="col-sm-8">
                                        <select name="water_export" class="form-control">
                                            <option selected disabled>اختر نوع التصدير</option>
                                            <option value="sudan" {{ old('water_export') == 'sudan' ? 'selected' : '' }}>
                                                @lang('back.sudan')</option>
                                            <option value="local" {{ old('water_export') == 'local' ? 'selected' : '' }}>
                                                @lang('back.local')</option>
                                            <option value="gaza" {{ old('water_export') == 'gaza' ? 'selected' : '' }}>
                                                @lang('back.gaza')</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.qty') الكراتين <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="quantity"
                                            value="{{ old('quantity') }}" required
                                            placeholder="@lang('back.qty') الكراتين" name="quantity">
                                    </div>
                                </div>

                                <div class="col-md-4 row mb-4">
                                    <label class="col-sm-4 col-form-label">
                                        كمية الكراتين الكبيرة
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="horizontal-address-input"
                                            value="{{ old('large_packages') }}" placeholder="كمية الكراتين الكبيرة"
                                            name="large_packages">
                                    </div>
                                </div>

                                <div class="col-md-4 row mb-4">
                                    <label class="col-sm-4 col-form-label">
                                        كمية الكراتين الصغيرة
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="horizontal-address-input"
                                            value="{{ old('small_packages') }}" placeholder="كمية الكراتين الصغيرة"
                                            name="small_packages">
                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.purchase_price') <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="purchase_price"
                                            value="{{ old('purchase_price') }}" required
                                            placeholder=" @lang('back.purchase_price')" name="purchase_price">
                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.sale_price') <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="sale_price"
                                            value="{{ old('sale_price') }}" required placeholder="@lang('back.sale_price')"
                                            name="sale_price">
                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.expenses')</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="expenses"
                                            value="{{ old('expenses') }}" placeholder="@lang('back.expenses')"
                                            name="expenses">
                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.paper_loading_cost')</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="paper_loading_cost"
                                            value="{{ old('paper_loading_cost') }}" placeholder="@lang('back.paper_loading_cost')"
                                            name="paper_loading_cost">
                                    </div>
                                </div>

                                <div class="col-12" style="border-top: 2px solid #e1e1e1;margin-bottom: 20px;"></div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.sale_price') x
                                        @lang('back.qty')</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="total_1"
                                            placeholder="@lang('back.sale_price') x @lang('back.qty')" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.net_profit')</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="total_2"
                                            placeholder="@lang('back.net_profit')" disabled>
                                    </div>
                                </div>
                            </div>

                            <h5 style="font-wight: bold;">@lang('back.company_details')</h5>
                            <div class="row mt-5 mt-lg-4 row ms-2">
                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.name') @lang('back.company')
                                        @lang('back.export')<span style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{ old('company_name') }}"
                                            required placeholder="@lang('back.name') @lang('back.company') @lang('back.export')"
                                            name="company_name">
                                    </div>
                                </div>


                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.received') <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="received" class="form-control" required>
                                            <option value="pending" @selected(old('received') == 'pending')>@lang('back.pending')
                                            </option>
                                            <option value="received" @selected(old('received') == 'received')>@lang('back.is_received')
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.clearance_agent_name')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control"
                                            value="{{ old('clearance_agent_name') }}" placeholder="@lang('back.clearance_agent_name')"
                                            name="clearance_agent_name">
                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.clearance_agent_phone')</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control phone_number"
                                            value="{{ old('clearance_agent_phone') }}" placeholder="@lang('back.clearance_agent_phone')"
                                            name="clearance_agent_phone">
                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.purchase_date') <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="datetime-local" name="purchase_date" class="form-control"
                                            value="{{ old('purchase_date') }}">

                                    </div>
                                </div>

                                <div class="col-md-6 row mb-4">
                                    <label class="col-sm-4 col-form-label">@lang('back.goods_received_date') <span
                                            style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="datetime-local" name="goods_received_date" class="form-control"
                                            value="{{ old('goods_received_date') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-5 mt-lg-4">

                                    <div class="row mb-4">
                                        <label class="col-sm-4 col-form-label">@lang('back.description')
                                        </label>
                                        <div class="col-sm-8">
                                            <textarea name="notes" class="form-control" placeholder="@lang('back.description')" cols="30" rows="5">{{ old('description', 'Thank You For Shopping With Us . Please Come Again') }}</textarea>
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
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#sale_price, #quantity').keyup(function() {
            var price = parseFloat($('#sale_price').val()) || 0;
            var qty = parseFloat($('#quantity').val()) || 0;
            var total = price * qty;
            $('#total_1').val(total.toLocaleString());
        });

        $('#sale_price, #purchase_price, #quantity, #expenses, #paper_loading_cost').keyup(function() {
            var sale_price = parseFloat($('#sale_price').val()) || 0;
            var quantity = parseFloat($('#quantity').val()) || 0;
            var purchase_price = parseFloat($('#purchase_price').val()) || 0;
            var expenses = parseFloat($('#expenses').val()) || 0;
            var paper_loading_cost = parseFloat($('#paper_loading_cost').val()) || 0;

            var total = ((sale_price * quantity) + paper_loading_cost) - (purchase_price * quantity) - expenses;
            $('#total_2').val(total.toLocaleString());
        });
    </script>
@endsection
