@extends('acp.layout.app')

@section('title')
    تحديث رصيد المصنع
@endsection
@section('css')
    <link href="{{ url('acp/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">تحديث رصيد المصنع</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">تحديث رصيد المصنع</li>
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
                    <form method="post" action="{{ route('sudan_sales.factory_quantity.store') }}" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div id="new_client-data" class="" style="">
                            {{-- <div class="col"> --}}
                            <h5 style="font-wight: bold;">رصيد المصنع</h5>
                            <div class="mt-5 mt-lg-4 row ms-2">
                                <div class="col-md-6 row mb-4">
                                    <label for="horizontal-Fullname-input"
                                        class="col-sm-4 col-form-label">تحديث رصيد المصنع<span style="color: red;">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="horizontal-Fullname-input"
                                            value="{{ getSetting('sudan_sales_factory_quantity')->value }}" required
                                            placeholder="@lang('back.name') @lang('back.client')" name="sudan_sales_factory_quantity">
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
    <script src="{{ url('acp/libs/select2/js/select2.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ url('acp/js/pages/form-advanced.init.js') }}"></script>
    <script>
        $(document).ready(function() {
            var i = 1;
            $("#add_row").click(function() {
                b = i - 1;
                $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                i++;
            });
            $("#delete_row").click(function() {
                if (i > 1) {
                    $("#addr" + (i - 1)).html('');
                    i--;
                }
                calc();
            });

            $('#tab_logic tbody').on('keyup change', function() {
                calc();
            });
            $('#tax').on('keyup change', function() {
                calc_total();
            });


        });



        function calc() {
            $('#tab_logic tbody tr').each(function(i, element) {
                var html = $(this).html();
                if (html != '') {
                    var qty = $(this).find('.qty').val();
                    var price = $(this).find('.price').val();
                    $(this).find('.total').val(qty * price);

                    calc_total();
                }
            });
        }

        function calc_total() {
            total = 0;
            $('.total').each(function() {
                total += parseInt($(this).val());
            });
            $('#sub_total').val(total.toFixed(2));
            tax_sum = total / 100 * $('#tax').val();
            $('#tax_amount').val(tax_sum.toFixed(2));
            $('#total_amount').val((tax_sum + total).toFixed(2));
        }


        $("#client_type").change(function() {
            if (this.value == "new_client") {
                $("#new_client-data").show();
                $("#old_client-data").hide();
                $("#new_client-data input ,#new_client-data select").attr("required", true);
                $(".select2-container").css('width', '100%');
            } else {
                $("#new_client-data").hide();
                $("#old_client-data").show();
                $("#new_client-data input ,#new_client-data select").attr("required", false);
            }
        });
    </script>
@endsection
