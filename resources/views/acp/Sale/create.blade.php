@extends('acp.layout.app')

@section('title')
    @lang('back.create') @lang('back.invoice') @lang('back.sales')
@endsection
@section('css')
    <link href="{{url('acp/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.create') @lang('back.invoice') @lang('back.sales')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.create') @lang('back.invoice') @lang('back.sales')</li>
                        <li class="breadcrumb-item ">@lang('back.invoice') @lang('back.sales')</li>
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
                @if(Session::has('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-check me-2"></i>
                        {!! session('msg') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                        </button>
                    </div>

                @endif
                @if($errors->any())
                    <div class = "alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">

                    <form method="post" action="{{route('sales.store')}}" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mt-5 mt-lg-4">

                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.date') *</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" id="horizontal-Fullname-input"
                                                   value="{{old('set_date',date('Y-m-d'))}}" required name="set_date">
                                        </div>
                                    </div>

                                    <div class="row mb-4" >
                                        <label for="horizontal-address-input"
                                               class="col-sm-4 col-form-label">@lang('back.client_type') *</label>
                                        <div class="col-sm-8">
                                            <select name="client_type" id="client_type" class="form-control select2">
                                                <option value="old_client"  @if(old('client_type') == 'old_client') selected @endif >@lang('back.old_client')</option>
                                                <option value="new_client" @if(old('client_type') == 'new_client') selected @endif  >@lang('back.new_client')</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-4"  id="old_client-data">
                                        <label for="horizontal-address-input"
                                               class="col-sm-4 col-form-label">@lang('back.client') *</label>
                                        <div class="col-sm-8">
                                            <select name="user_id" class="form-control select2">
                                                <option value="" disabled selected>@lang('back.select_one')</option>
                                                @foreach($clients as $client)
                                                    <option {{$client->id == old('user_id') ? 'selected' : ''}}  value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-5 mt-lg-4">
                                    <div class="row mb-4">
                                        <label for="horizontal-address-input"
                                               class="col-sm-4 col-form-label">@lang('back.store') *</label>
                                        <div class="col-sm-8">
                                            <select name="store_id" class="form-control select2" required>
                                                <option value="" disabled selected>@lang('back.select_one')</option>
                                                @foreach($stores as $store)
                                                <option {{$store->id == old('store_id') ? 'selected' : ''}} value="{{$store->id}}">{{$store->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>


                                    <div class="row mb-4">
                                        <label for="horizontal-address-input"
                                               class="col-sm-4 col-form-label">@lang('back.status') *</label>
                                        <div class="col-sm-8">
                                            <select name="status" class="form-control select2" required>
                                                <option value="" disabled selected>@lang('back.select_one')</option>
                                                <option {{old('status') == 'pending' ? 'selected' : ''}} value="pending">@lang('back.pending')</option>
                                                <option {{old('status') == 'ordered' ? 'selected' : ''}} value="ordered">@lang('back.ordered')</option>
                                            </select>
                                        </div>
                                    </div>



                                </div>
                            </div>

                        </div>

                        <div id="new_client-data" class="row" style="display: none; border: 1px solid #000000;">
                            <div class="col-lg-6">
                                <div class="mt-5 mt-lg-4">

                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.name') *</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-Fullname-input"
                                                   value="{{old('client_name')}}" required
                                                   placeholder="@lang('back.name')" name="client_name">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-phone-input"
                                               class="col-sm-4 col-form-label">@lang('back.phone') *</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control phone_number" id="horizontal-phone-input"
                                                   value="{{old('client_phone')}}" required
                                                   placeholder="@lang('back.phone')" name="client_phone">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="horizontal-address-input"
                                               class="col-sm-4 col-form-label">@lang('back.from_area') *</label>
                                        <div class="col-sm-8">
                                            <select name="client_from_area" class="form-control select2" required>
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($areas as $FromAreas)
                                                    <optgroup label="{{$FromAreas->name}}">
                                                        @foreach($FromAreas->children as $FromChildren)
                                                            <option @selected(old('client_from_area') == $FromChildren->id)  value="{{$FromChildren->id}}">{{$FromChildren->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="horizontal-address-input"
                                               class="col-sm-4 col-form-label">@lang('back.type_client') *</label>
                                        <div class="col-sm-8">
                                            <select name="client_type_client" class="form-control select2" required>
                                                <option value="">@lang('back.select_one')</option>
                                                <option @selected(old('client_type_client') == 'sentence')  value="sentence">@lang('back.sentence')</option>
                                                <option @selected(old('client_type_client') == 'sentence_sentence')  value="sentence_sentence">@lang('back.sentence_sentence')</option>
                                                <option @selected(old('client_type_client') == 'house') value="house">@lang('back.house')</option>
                                                <option @selected(old('client_type_client') == 'market') value="market">@lang('back.market')</option>
                                                <option @selected(old('client_type_client') == 'booth') value="booth">@lang('back.booth')</option>
                                                <option @selected(old('client_type_client') == 'restaurant') value="restaurant">@lang('back.restaurant')</option>
                                                <option @selected(old('client_type_client') == 'enough') value="enough">@lang('back.enough')</option>
                                                <option @selected(old('client_type_client') == 'private_company') value="private_company">@lang('back.private_company')</option>
                                                <option @selected(old('client_type_client') == 'governmental_company') value="governmental_company">@lang('back.governmental_company')</option>
                                                <option @selected(old('client_type_client') == 'bank') value="bank">@lang('back.bank')</option>
                                                <option @selected(old('client_type_client') == 'hospital') value="hospital">@lang('back.hospital')</option>
                                                <option @selected(old('client_type_client') == 'hotel') value="hotel">@lang('back.hotel')</option>
                                                <option @selected(old('client_type_client') == 'gym') value="gym">@lang('back.gym')</option>
                                                <option @selected(old('client_type_client') == 'club') value="club">@lang('back.club')</option>

                                            </select>

                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-5 mt-lg-4">

                                    <div class="row mb-4">
                                        <label for="horizontal-email-input"
                                               class="col-sm-4 col-form-label">@lang('back.email') </label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" id="horizontal-email-input"
                                                   value="{{old('client_email')}}"
                                                   placeholder="@lang('back.email')" name="client_email">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-phone-input"
                                               class="col-sm-4 col-form-label">@lang('back.whatsapp') *</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control phone_number" id="horizontal-phone-input"
                                                   value="{{old('client_whatsapp')}}" required
                                                   placeholder="@lang('back.whatsapp')" name="client_whatsapp">
                                        </div>
                                    </div>


                                    <div class="row mb-4">
                                        <label for="horizontal-address-input"
                                               class="col-sm-4 col-form-label">@lang('back.address') *</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-address-input"
                                                   value="{{old('client_address')}}" required
                                                   placeholder="@lang('back.address')" name="client_address">
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>


                        <div class="row clearfix">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                    <tr>
                                        <th class="text-center"> # </th>
                                        <th class="text-center"> @lang('back.product') </th>
                                        <th class="text-center"> @lang('back.qty') </th>
                                        <th class="text-center"> @lang('back.price') </th>
                                        <th class="text-center"> @lang('back.total') </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr id='addr0'>
                                        <td>1</td>
                                        <td>
                                            <select name="product_id[]" class="form-control" required>
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($products as $key => $product)
                                                <option {{ collect(old('product_id'))->contains($product->id) ? 'selected' : '' }} value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" required name='qty[]' placeholder='@lang('back.qty')' class="form-control qty" step="0" min="0"/></td>
                                        <td><input type="text" required name='price[]' placeholder='@lang('back.price')' class="form-control price" step="0.00" min="0"/></td>
                                        <td><input type="number"  name='total[]' placeholder='0.00' class="form-control total" readonly/></td>
                                    </tr>
                                    <tr id='addr1'></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <button type="button" id="add_row" class="btn btn-default pull-left">@lang('back.add_row')</button>
                                <button type="button" id='delete_row' class="pull-right btn btn-default">@lang('back.delete_row')</button>
                            </div>
                        </div>
                        <div class="row clearfix" style="margin-top:20px">
                            <div class="pull-right col-md-4">
                                <table class="table table-bordered table-hover" id="tab_logic_total">
                                    <tbody>
                                    <tr>
                                        <th class="text-center">@lang('back.sub_total')</th>
                                        <td class="text-center"><input type="number" name='sub_total' value="{{old('sub_total')}}" placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">@lang('back.tax')</th>
                                        <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                                                <input type="number" name="tax" value="{{old('tax',0)}}" class="form-control" id="tax" placeholder="0">
                                                <div class="input-group-addon">%</div>
                                            </div></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">@lang('back.tax_amount')</th>
                                        <td class="text-center"><input type="number" name='tax_amount' value="{{old('tax_amount')}}" id="tax_amount" placeholder='0.00' class="form-control" readonly/></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">@lang('back.grand_total')</th>
                                        <td class="text-center"><input type="number" name='total_amount' value="{{old('total_amount')}}" id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-5 mt-lg-4">

                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.description') </label>
                                        <div class="col-sm-8">
                                            <textarea name="description" class="form-control" placeholder="@lang('back.description')" cols="30" rows="5">{{old('description','Thank You For Shopping With Us . Please Come Again')}}</textarea>
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


    <script src="{{url('acp/libs/select2/js/select2.min.js')}}"></script>

    <!-- init js -->
    <script src="{{url('acp/js/pages/form-advanced.init.js')}}"></script>
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
            $('#tax').on('keyup change',function(){
                calc_total();
            });


        });



            function calc()
            {
                $('#tab_logic tbody tr').each(function(i, element) {
                    var html = $(this).html();
                    if(html!='')
                    {
                        var qty = $(this).find('.qty').val();
                        var price = $(this).find('.price').val();
                        $(this).find('.total').val(qty*price);

                        calc_total();
                    }
                });
            }

            function calc_total()
            {
                total=0;
                $('.total').each(function() {
                    total += parseInt($(this).val());
                });
                $('#sub_total').val(total.toFixed(2));
                tax_sum=total/100*$('#tax').val();
                $('#tax_amount').val(tax_sum.toFixed(2));
                $('#total_amount').val((tax_sum+total).toFixed(2));
            }


            $("#client_type").change(function (){
                if(this.value == "new_client"){
                    $("#new_client-data").show();
                    $("#old_client-data").hide();
                    $("#new_client-data input ,#new_client-data select").attr("required",true);
                    $(".select2-container").css('width','100%');
                }else{
                    $("#new_client-data").hide();
                    $("#old_client-data").show();
                    $("#new_client-data input ,#new_client-data select").attr("required",false);
                }
            });

    </script>
@endsection
