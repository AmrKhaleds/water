@extends('acp.layout.app')

@section('title')
    @lang('back.edit') @lang('back.printing_models')
@endsection
@section('css')
    <link href="{{ url('acp/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.edit') @lang('back.printing_models')</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.edit') @lang('back.printing_models')</li>
                        <li class="breadcrumb-item ">@lang('back.printing_models')</li>
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
                    <form method="post" action="{{ route('printing_models.update', $model->id) }}" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-5 mt-lg-4">
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                            class="col-sm-4 col-form-label">@lang('back.name') *</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id=""
                                                value="{{ $model->name }}" required name="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 mt-lg-4">
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                            class="col-sm-4 col-form-label">@lang('back.photo') *</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" id=""
                                                value="{{ $model->image }}" required name="image">
                                        </div>
                                    </div>
                                </div>
                                {{-- make div to show model image from database, image that alredy exist --}}
                                <div class="mt-5 mt-lg-4">
                                    
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                            class="col-sm-4 col-form-label">@lang('back.photo')</label>
                                        <div class="col-sm-8">
                                            <img src="{{ asset('uploads/printing_models/'.$model->image) }}" width="100px">
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
    <script src="{{ url('acp/libs/select2/js/select2.min.js') }}"></script>
    <!-- init js -->
    <script src="{{ url('acp/js/pages/form-advanced.init.js') }}"></script>
@endsection
