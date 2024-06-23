@extends('Dashboard.layouts.app')

@section('title')
    @lang('back.create_dailymove')
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


                        <form action="{{route('dailymoves.store')}}" method="post">
                            @method('POST')
                            @csrf
                            <div class="row gutters">

                                <div class="col-xl-3 col-lg col-md-3 col-sm-3 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.num_dailymove')</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="number"
                                                   name="num_dailymove" value="{{$last ? $last->registration_number + 1 : account_setting('accounting','sales','serial_dailymove')['value']}}"
                                                   id="example-text-input" required readonly
                                                   placeholder="@lang('back.num_dailymove')">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg col-md-3 col-sm-3 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.date')</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control"
                                                   placeholder="@lang('back.date')"
                                                   name="date"
                                                   value="{{old('date',date('Y-m-d'))}}>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg col-md-3 col-sm-3 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.document')</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" name="document">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg col-md-3 col-sm-3 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.paid_type')</label>
                                        <div class="col-sm-8">
                                            <select name="payments_method_id" id="" required
                                                    class="form-control form-control-lg">
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($payments as $payment)
                                                    <option value="{{$payment->id}}">{{$payment->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-12 col-lg col-md-12 col-sm-12 col-12">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-hover"
                                                   id="tab_logic">
                                                <thead>
                                                <tr>
                                                    <th class="text-center"> #</th>
                                                    <th class="text-center" width="40%"> @lang('back.account_num') /  @lang('back.account_name')</th>
                                                    <th class="text-center" width="10%"> @lang('back.debtor') </th>
                                                    <th class="text-center" width="10%">@lang('back.creditor') </th>
                                                    <th class="text-center" width="40%">@lang('back.statement') </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr id='addr0'>
                                                    <td>1</td>
                                                    <td>
                                                        {{--<select name="account_id[]" class="form-control" data-trigger name="accounts[]"
                                                                id="choices-single-default"
                                                                placeholder="@lang('back.select_one')">--}}
                                                        <select name="account_id[]" class="form-control accounts " data-live-search="true">
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($accounts as $account)
                                                                <option value="{{$account->id}}">{{$account->account_name}} , {{$account->num}}</option>
                                                            @endforeach

                                                        </select>

                                                    </td>

                                                    <td><input type="number" name='debtor[]'
                                                               placeholder='@lang('back.debtor')'
                                                               class="form-control debtor" value="0"
                                                               step="0.00" min="0"/></td>
                                                    <td><input type="number" name='creditor[]' value="0"
                                                               placeholder='@lang('back.creditor')'
                                                               class="form-control creditor"
                                                               step="0.00" min="0"/></td>
                                                    <td>
                                                        <textarea name='noteItem[]' placeholder='@lang('back.note')' class="form-control notes"></textarea>
                                                    </td>
                                                </tr>
                                                <tr id='addr1'></tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <button type="button" id="add_row"
                                                    class="btn btn-info pull-lef btn-rounded">@lang('back.add_row')</button>
                                            <button type="button" id='delete_row'
                                                    class="pull-right btn btn-danger btn-rounded">@lang('back.delete_row')</button>
                                        </div>
                                    </div>
                                    <div class="row clearfix" style="margin-top:20px">
                                        <div class="pull-right col-md-4">
                                            <h6 style="color: red ; display: none" id="err">@lang('back.total_amount_creditor_not_equal_total_amount_debtor')</h6>
                                            <h6 style="color: red ; display: none" id="errduble">@lang('back.creditors_account_may_not_same_debit_account')</h6>
                                            <table class="table table-bordered table-hover"
                                                   id="tab_logic_total">
                                                <tbody>
                                                <tr>
                                                    <th class="text-center">@lang('back.debtor')</th>
                                                    <td class="text-center"><input type="number"
                                                                                   name='debtorTotal'
                                                                                   placeholder='0.00'
                                                                                   class="form-control"
                                                                                   id="debtor"
                                                                                   readonly/>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <th class="text-center">@lang('back.creditor')</th>
                                                    <td class="text-center"><input type="text"
                                                                                   name='creditorTotal'
                                                                                   id="creditor"
                                                                                   placeholder='0.00'
                                                                                   class="form-control"
                                                                                   readonly/>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.note')</label>
                                        <div class="col-sm-8">
                                            <textarea name="notes" placeholder="@lang('back.note')" class="form-control">{{old('notes')}}</textarea>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="custom-btn-group">
                                <!-- Buttons -->
                                <button type="submit" class="btn btn-primary">@lang('back.submit')</button>
                                <button type="reset" class="btn btn-info">@lang('back.cancel')</button>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->

    </div>
    <!-- Content wrapper end -->




@endsection

@section('js')

    <script>
        $(document).ready(function(){
            var i=1;
            $("#add_row").click(function(){b=i-1;
                $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
                $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
                i++;
            });
            $("#delete_row").click(function(){
                if(i>1){
                    $("#addr"+(i-1)).html('');
                    i--;
                }
                calc();
            });

            $('#tab_logic tbody').on('keyup change',function(){
                calc();
            });

        });

        function calc()
        {
            $('#tab_logic tbody tr').each(function(i, element) {
                var html = $(this).html();
                if (html != '') {
                    var accounts = $(this).find('.accounts').val();
                    console.log(accounts);
                    // var debtor = $(this).find('.debtor').val();
                    // $(this).find('#debtor').val((debtor + debtor));

                    // var creditor = $(this).find('.creditor').val();
                    debtor = 0;
                    $('.debtor').each(function () {
                        debtor += parseInt($(this).val());
                    });
                    totaldebtor = $('#debtor').val(debtor);

                    creditor = 0;
                    $('.creditor').each(function () {
                        creditor += parseInt($(this).val());
                    });
                    $('#creditor').val(creditor);

                    totalcreditor = $('#debtor').val(debtor);
                    if (debtor !== creditor){
                        $("#debtor,#creditor").css("background-color","#f5c1c1");
                        $('#err').show();
                        $('#errbutton').hide();
                    }
                    if(debtor === creditor){
                        $("#debtor,#creditor").css("background-color","#b4f3b4");
                        $('#err').hide();
                        $('#errbutton').show();
                    }
                    if (accounts !== accounts){
                        $("#debtor,#creditor").css("background-color","#f5c1c1");
                        $('#errduble').show();
                        $('#errbutton').hide();
                    }
                    if(accounts === accounts){
                        $('#errduble').hide();
                        $('#errbutton').show();
                    }
                    // calc_total();
                }

            });
        }


        $(document).ready(function () {
            $("#tax").on('change', function () {
                var tax = $("#tax").val();
                var subtotal = parseInt($("#subtotal").text());
                var total = (subtotal * tax) / 100;
                var grandTotal = $(".grand_total").text();
                $(".grand_total").text('');
                var grandTotal = $(".grand_total").text(total + grandTotal);
                $("#total_price").text($("#grand_total").text());

            });
        });

    </script>

@endsection

