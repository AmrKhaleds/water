@extends('acp.layout.app')

@section('title')
    @lang('back.create') @lang('back.vehicle')
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.create') @lang('back.vehicle')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.create') @lang('back.vehicle')</li>
                        <li class="breadcrumb-item ">@lang('back.vehicles')</li>
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

                    <div class="row">
                        <form method="post" action="{{route('vehicles.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mt-5 mt-lg-4">

                                        <div class="row mb-4">
                                            <label for="horizontal-Fullname-input"
                                                   class="col-sm-4 col-form-label">@lang('back.type_car') *</label>
                                            <div class="col-sm-8">
                                                <select name="type_car" class="form-control" required>
                                                    <option value="">@lang('back.select_one')</option>
                                                    <option value="transportation">@lang('back.transportation')</option>
                                                    <option value="freezer">@lang('back.freezer')</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label for="horizontal-Fullname-input"
                                                   class="col-sm-4 col-form-label">@lang('back.model_car') *</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="horizontal-Fullname-input"
                                                       value="{{old('model_car')}}" required
                                                       placeholder="@lang('back.model_car')"
                                                       name="model_car">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="horizontal-Fullname-input"
                                                   class="col-sm-4 col-form-label">@lang('back.license_num') *</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="horizontal-Fullname-input"
                                                       value="{{old('license_num')}}" required
                                                       placeholder="@lang('back.license_num')"
                                                       name="license_num">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mt-5 mt-lg-4">

                                        <div class="row mb-4">
                                            <label for="horizontal-Fullname-input"
                                                   class="col-sm-4 col-form-label">@lang('back.car_name') *</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="horizontal-Fullname-input"
                                                       value="{{old('car_name')}}" required
                                                       placeholder="@lang('back.car_name')"
                                                       name="car_name">
                                            </div>
                                        </div>


                                        <div class="row mb-4">
                                            <label for="horizontal-Fullname-input"
                                                   class="col-sm-4 col-form-label">@lang('back.vehicle_number') *</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="horizontal-Fullname-input"
                                                       value="{{old('vehicle_number')}}" required
                                                       placeholder="@lang('back.vehicle_number')"
                                                       name="vehicle_number">
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label for="horizontal-Fullname-input"
                                                   class="col-sm-4 col-form-label">@lang('back.license_to') *</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="horizontal-Fullname-input"
                                                       value="{{old('license_to')}}" required
                                                       placeholder="@lang('back.license_to')"
                                                       name="license_to">
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
    </div>

@endsection
