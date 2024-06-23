@extends('acp.layout.app')

@section('title')
    @lang('back.edit') @lang('back.account')
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.edit') @lang('back.account')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.edit') @lang('back.account')</li>
                        <li class="breadcrumb-item ">@lang('back.accounts')</li>
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

                    <form method="post" action="{{route('accounts.update',$account->id)}}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-5 mt-lg-4">

                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.account_name') *</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-Fullname-input"
                                                   value="{{old('account_name',$account->account_name)}}" required
                                                   placeholder="@lang('back.account_name')" name="account_name">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-phone-input"
                                               class="col-sm-4 col-form-label">@lang('back.account_type') *</label>
                                        <div class="col-sm-8">
                                            <select name="account_type" id="parent"
                                                    class="form-control">
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($trees->where('parent_id',0) as $type)
                                                    <option value="{{$type->id}}" {{$account->master == $type->id ? 'selected' :''}} >{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-5 mt-lg-4">

                                    <div class="row mb-4">
                                        <label for="horizontal-email-input"
                                               class="col-sm-4 col-form-label">@lang('back.parent_account') </label>
                                        <div class="col-sm-8">
                                            <select name="parent_account" id="emptyDropdown"
                                                    class="form-control">
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($trees->where('parent_id','!=',0) as $parent)
                                                    <option {{$account->parent_id == $parent->parent_id ? 'selected' : ''}}  value="{{$parent->id}}">{{$parent->account_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-phone-input"
                                               class="col-sm-4 col-form-label">@lang('back.description') *</label>
                                        <div class="col-sm-8">
                                            <textarea name="description" class="form-control" placeholder="@lang('back.description')" cols="30" rows="5">{{old('description',$account->description)}}</textarea>
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
    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],
                height: 170,
            });
        });

        $(document).ready(function () {
            $("#parent").change(function () {
                $('#emptyDropdown').empty()
                var dropDown = document.getElementById("parent");
                var parent = dropDown.options[dropDown.selectedIndex].value;
                $.ajax({
                    type: "GET",
                    url: '{{route('account.ajax')}}/?id='+parent,
                    success: function (data) {
                        // Parse the returned json data
                        // Use jQuery's each to iterate over the opts value
                        $('#emptyDropdown').append('<option value="">@lang('back.select_one')</option>');
                        $('#emptyDropdown').append('<option value="'+parent+'">@lang('back.parent')</option>');
                        $.each(data, function (i, d) {
                            // You will need to alter the below to get the right values from your json object.  Guessing that d.id / d.modelName are columns in your carModels data
                            $('#emptyDropdown').append('<option value="' + d.id + '">' + d.account_name + '</option>');
                        });
                    }
                });
            });
        });

    </script>

@endsection
