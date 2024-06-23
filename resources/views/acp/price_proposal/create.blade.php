@extends('acp.layout.app')

@section('title')
    @lang('back.create') @lang('back.price_proposal')
@endsection
@section('css')
    <link href="{{ url('acp/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.create') @lang('back.price_proposal')</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.create') @lang('back.price_proposal')</li>
                        <li class="breadcrumb-item ">@lang('back.price_proposal')</li>
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
                    <form method="post" action="{{ route('price_proposal.store') }}" enctype="multipart/form-data"
                        novalidate>
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">@lang('back.name')</label>
                                <input type="text" class="form-control" id="name" name="name" required placeholder="Enter Price Proposal Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date">@lang('back.date') </label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                        </div>
                        <div id="statements" class="mt-2">
                            <div class="row">
                                <div class="form-group col-5">
                                    <label for="statement">@lang('back.statement')</label>
                                    <input type="text" class="form-control" name="statement[]" required placeholder="@lang('back.statement')">
                                </div>
                                <div class="form-group col-5">
                                    <label for="price">@lang('back.price')</label>
                                    <input type="number" class="form-control" name="price[]" required placeholder="@lang('back.price')">
                                </div>
                                <div class="form-group col-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-success add-row">@lang('back.create')</button>
                                </div>
                            </div>
                        </div>
                        <div id="notes" class="mt-2">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="statement">ملاحظات</label>
                                    <textarea placeholder="إضافة ملاحظة" name="notes" id=""  rows="6" class="form-control">

                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row  mt-5">
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
            $('.add-row').click(function() {
                var newRow = '<div class="row mt-3 form-row">' +
                    '<div class="form-group col-5">' +
                    '<input type="text" class="form-control" name="statement[]" required placeholder="@lang('back.statement')">' +
                    '</div>' +
                    '<div class="form-group col-5">' +
                    '<input type="number" class="form-control" name="price[]" required placeholder="@lang('back.price')">' +
                    '</div>' +
                    '<div class="form-group col-2">' +
                    '<button type="button" class="btn btn-danger remove-row">@lang('back.delete')</button>' +
                    '</div>' +
                    '</div>';
                $('#statements').append(newRow);
            });

            $(document).on('click', '.remove-row', function() {
                $(this).closest('.form-row').remove();
            });
        });
    </script>
@endsection
