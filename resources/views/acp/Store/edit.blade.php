@extends('acp.layout.app')

@section('title')
    @lang('back.edit') @lang('back.store')
@endsection

@section('css')
    <link href="{{url('acp/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.edit') @lang('back.store')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.edit') @lang('back.store')</li>
                        <li class="breadcrumb-item ">@lang('back.stores')</li>
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

                    <form method="post" action="{{route('stores.update',$store->id)}}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-5 mt-lg-4">

                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.name') @lang('back.store')
                                            *</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-Fullname-input"
                                                   value="{{old('name',$store->name)}}" required
                                                   placeholder="@lang('back.name') @lang('back.store')" name="name">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="horizontal-address-input"
                                               class="col-sm-4 col-form-label">@lang('back.area') *</label>
                                        <div class="col-sm-8">
                                            <select name="area_id" class="form-control select2" required>
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($areas as $FromAreas)
                                                    <optgroup label="{{$FromAreas->name}}">
                                                        @foreach($FromAreas->children as $FromChildren)
                                                            <option {{$store->area_id == $FromChildren->id ? 'selected' : ''}}  value="{{$FromChildren->id}}">{{$FromChildren->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-4 crane" >
                                        <label for="horizontal-address-input"
                                               class="col-sm-4 col-form-label">@lang('back.crane') *</label>
                                        <div class="col-sm-8">
                                            <select name="vehicle_id" class="form-control select2">
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($vehicles as $vehicle)
                                                    <option {{$store->vehicle_id == $vehicle->id ? 'selected' : ''}}  value="{{$vehicle->id}}">{{$vehicle->car_name}}</option>
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
                                               class="col-sm-4 col-form-label">@lang('back.type_store') *</label>
                                        <div class="col-sm-8">
                                            <select name="type_store" class="form-control select2" required>
                                                <option value="">@lang('back.select_one')</option>
                                                <option {{$store->type_store == 'crane' ? 'selected' : ''}}  value="crane">@lang('back.crane')</option>
                                                <option {{$store->type_store == 'fixed_store' ? 'selected' : ''}}  value="fixed_store">@lang('back.fixed_store')</option>

                                            </select>

                                        </div>
                                    </div>


                                    <div class="row mb-4">
                                        <label for="horizontal-address-input"
                                               class="col-sm-4 col-form-label">@lang('back.address') *</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-address-input"
                                                   value="{{old('address',$store->address)}}" required
                                                   placeholder="@lang('back.address')" name="address">
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

            @if($store->type_store != 'crane')
                $(".crane").hide();
            @endif
            $("select[name='type_store']").change(function() {
                if(this.value == 'crane'){
                    $("select[name='vehicle_id']").prop('required',true);
                    $(".crane").show();
                }else if(this.value == 'fixed_store'){
                    $("select[name='vehicle_id']").prop('required',false);
                    $(".crane").hide();
                }
            });

        });

    </script>
@endsection
