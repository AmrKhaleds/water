@extends('acp.layout.app')

@section('title')
    @lang('back.edit') @lang('back.product')
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.edit') @lang('back.product')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.edit') @lang('back.product')</li>
                        <li class="breadcrumb-item ">@lang('back.product')</li>
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
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                @endif
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <p></p>
                            <i class="uil uil-exclamation-octagon me-2"></i>
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                            </button>
                        </div>
                    @endforeach
                @endif
                <div class="card-body">

                    <div class="row">

                        <form method="post" action="{{route('products.update',$product->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label"> @lang('back.name')</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-Fullname-input"
                                                   value="{{old('name',$product->name)}}" required
                                                   placeholder="@lang('back.name')" name="name">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-cost"
                                               class="col-sm-4 col-form-label"> @lang('back.cost')</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-cost"
                                                   value="{{old('cost',$product->cost)}}" required
                                                   placeholder="@lang('back.cost')" name="cost">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="horizontal-alert_stock"
                                               class="col-sm-4 col-form-label"> @lang('back.brand')</label>
                                        <div class="col-sm-8">
                                            <select name="brand_id" class="form-control" required>
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($brands as $brand)
                                                    <option {{$product->brand_id == $brand->id ? 'selected' : ''}} value="{{$brand->id}}">{{$brand->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="horizontal-alert_stock"
                                               class="col-sm-4 col-form-label"> @lang('back.alert_stock')</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="horizontal-alert_stock"
                                                   value="{{old('alert_stock',$product->alert_stock)}}" required
                                                   placeholder="@lang('back.alert_stock')" name="alert_stock">
                                        </div>
                                    </div>


                                </div>
                                <div class="col-lg-6">

                                    <div class="row mb-4">
                                        <label for="horizontal-sale"
                                               class="col-sm-4 col-form-label"> @lang('back.sale')</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-sale"
                                                   value="{{old('sale',$product->sale)}}" required
                                                   placeholder="@lang('back.sale')" name="sale">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="horizontal-photos"
                                               class="col-sm-4 col-form-label"> @lang('back.photo') @lang('back.product')</label>
                                        <div class="col-sm-8">
                                            <input type="file" multiple class="form-control" id="horizontal-photos"
                                                   name="photos[]">
                                            @foreach(json_decode($product->photos) as $photos)
                                            <img src="{{getFile($photos)}}" width="10%" alt="">
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="horizontal-qty"
                                               class="col-sm-4 col-form-label"> @lang('back.unit')</label>
                                        <div class="col-sm-8">
                                            <select name="unit_id" class="form-control" required>
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($units as $unit)
                                                    <option  {{$product->unit_id == $unit->id ? 'selected' : ''}} value="{{$unit->id}}">{{$unit->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row mb-4">
                                        <label for="horizontal-notes"
                                               class="col-sm-4 col-form-label"> @lang('back.notes')</label>
                                        <div class="col-sm-8">
                                            <textarea name="notes" placeholder="@lang('back.notes')" required
                                                      class="form-control" id="horizontal-notes" cols="30"
                                                      rows="5">{{old('notes',$product->notes)}}</textarea>
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


                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
