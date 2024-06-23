@extends('acp.layout.app')

@section('title')
    @lang('back.settings') @lang('back.pricing')
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.settings') @lang('back.pricing')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.settings') @lang('back.pricing')</li>
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

                        <form method="post" action="{{route('setting.store')}}">
                            @csrf
                            <div class="row ">
                                @foreach($settings as $setting)
                                    <input type="hidden" required
                                           value="{{$setting->id}}" name="id[]">
                                    <div class="col-lg-12">
                                        <div class="mt-5 mt-lg-4">
                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.'.$setting->name)</label>
                                                <div class="col-sm-8">
                                                        <input type="text" class="form-control"
                                                               id="horizontal-Fullname-input" required
                                                               value="{{old('value',$setting->value)}}"
                                                               placeholder="@lang('back.'.$setting->name)"
                                                               name="name[]">
                                                    @if($setting->name == 'logo')
                                                    <img src="{{$setting->value}}" width="30px">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
    </div>

@endsection
