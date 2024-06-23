@extends('acp.layout.app')

@section('title')
    @lang('back.create') @lang('back.client')
@endsection

@section('css')
    <link href="{{url('acp/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.create') @lang('back.client')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.create') @lang('back.client')</li>
                        <li class="breadcrumb-item ">@lang('back.clients')</li>
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

                    <form method="post" action="{{route('clients.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-5 mt-lg-4">

                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.name') *</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-Fullname-input"
                                                   value="{{old('name')}}" required
                                                   placeholder="@lang('back.name')" name="name">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-phone-input"
                                               class="col-sm-4 col-form-label">@lang('back.phone') *</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control phone_number" id="horizontal-phone-input"
                                                   value="{{old('phone')}}" required
                                                   placeholder="@lang('back.phone')" name="phone">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="horizontal-address-input"
                                               class="col-sm-4 col-form-label">@lang('back.from_area') *</label>
                                        <div class="col-sm-8">
                                            <select name="from_area" class="form-control select2" required>
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($areas as $FromAreas)
                                                    <optgroup label="{{$FromAreas->name}}">
                                                        @foreach($FromAreas->children as $FromChildren)
                                                            <option value="{{$FromChildren->id}}">{{$FromChildren->name}}</option>
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
                                            <select name="type_client" class="form-control select2" required>
                                                <option value="">@lang('back.select_one')</option>
                                                <option value="sentence">@lang('back.sentence')</option>
                                                <option value="sentence_sentence">@lang('back.sentence_sentence')</option>
                                                <option value="house">@lang('back.house')</option>
                                                <option value="market">@lang('back.market')</option>
                                                <option value="booth">@lang('back.booth')</option>
                                                <option value="restaurant">@lang('back.restaurant')</option>
                                                <option value="enough">@lang('back.enough')</option>
                                                <option value="private_company">@lang('back.private_company')</option>
                                                <option value="governmental_company">@lang('back.governmental_company')</option>
                                                <option value="bank">@lang('back.bank')</option>
                                                <option value="hospital">@lang('back.hospital')</option>
                                                <option value="hotel">@lang('back.hotel')</option>
                                                <option value="gym">@lang('back.gym')</option>
                                                <option value="club">@lang('back.club')</option>

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
                                                   value="{{old('email')}}"  
                                                   placeholder="@lang('back.email')" name="email">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-phone-input"
                                               class="col-sm-4 col-form-label">@lang('back.whatsapp') *</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control phone_number" id="horizontal-phone-input"
                                                   value="{{old('whatsapp')}}" required
                                                   placeholder="@lang('back.whatsapp')" name="whatsapp">
                                        </div>
                                    </div>


                                    <div class="row mb-4">
                                        <label for="horizontal-address-input"
                                               class="col-sm-4 col-form-label">@lang('back.address') *</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-address-input"
                                                   value="{{old('address')}}" required
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
  {{--  <script type='text/javascript'
            src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    <script>

        $(document).ready(function () {
            $(".phone_number").inputmask({
                "mask": "019-99-99-99-99"
            });

        });

    </script>
--}}
    <script src="{{url('acp/libs/select2/js/select2.min.js')}}"></script>

    <!-- init js -->
    <script src="{{url('acp/js/pages/form-advanced.init.js')}}"></script>

@endsection
