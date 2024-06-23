@extends('acp.layout.app')

@section('title')
    @lang('back.edit') @lang('back.bookings_freezers')
@endsection

@section('css')
    <link href="{{url('acp/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.edit') @lang('back.bookings_freezers')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.edit') @lang('back.bookings_freezers')</li>
                        <li class="breadcrumb-item ">@lang('back.bookings_freezers')</li>
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

                            <form method="post" action="{{route('booking.freezers.update',$booking->id)}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-5 mt-lg-4">
                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.client_name') *</label>
                                                <div class="col-sm-8">
                                                    <select name="client_id" class="form-control select2">
                                                        <option value="">@lang('back.select_one')</option>
                                                        @foreach($users as $user)
                                                            <option {{$booking->client_id == $user->id ? 'selected' : ''}}  value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-5 mt-lg-4">
                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.from_area') *</label>
                                                <div class="col-sm-8">
                                                    <select name="from_area" class="form-control select2" required>
                                                        <option value="">@lang('back.select_one')</option>
                                                        @foreach($areas as $FromAreas)
                                                            <optgroup label="{{$FromAreas->name}}">
                                                                @foreach($FromAreas->children as $FromChildren)
                                                                    <option {{$booking->from_area == $FromChildren->id ? 'selected' : ''}}  value="{{$FromChildren->id}}">{{$FromChildren->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="mt-5 mt-lg-4">
                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.price')
                                                    *</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="price" class="form-control"
                                                           value="{{old('price',$booking->price)}}" required
                                                           placeholder="@lang('back.price')">
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-5 mt-lg-4">

                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.time') *</label>
                                                <div class="col-sm-8">
                                                    <input type="datetime-local" class="form-control"
                                                           value="{{old('time',$booking->time)}}" required
                                                           placeholder="@lang('back.time')" name="time">
                                                </div>
                                            </div>
                                            <div class="mt-5 mt-lg-4">
                                                <div class="row mb-4">
                                                    <label for="horizontal-Fullname-input"
                                                           class="col-sm-4 col-form-label">@lang('back.to_area') *</label>
                                                    <div class="col-sm-8">
                                                        <select name="to_area" class="form-control select2" required>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($areas as $ToAreas)
                                                                <optgroup label="{{$ToAreas->name}}">
                                                                    @foreach($ToAreas->children as $ToChildren)
                                                                        <option {{$booking->to_area == $ToChildren->id ? 'selected' : ''}} value="{{$ToChildren->id}}">{{$ToChildren->name}}</option>
                                                                    @endforeach
                                                                </optgroup>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-5 mt-lg-4">
                                                <div class="row mb-4">

                                                    <label for="horizontal-Fullname-input"
                                                           class="col-sm-4 col-form-label">@lang('back.status') *</label>
                                                    <div class="col-sm-8">
                                                        <select name="status" class="form-control" required>
                                                            <option value="">@lang('back.select_one')</option>
                                                            <option {{$booking->status == 'sure' ? 'selected' : ''}} value="sure">@lang('back.sure')</option>
                                                            <option {{$booking->status == 'waiting' ? 'selected' : ''}} value="waiting">@lang('back.waiting')</option>
                                                            <option {{$booking->status == 'reservation' ? 'selected' : ''}} value="reservation">@lang('back.reservation')</option>
                                                            <option {{$booking->status == 'canceled' ? 'selected' : ''}} value="canceled">@lang('back.canceled')</option>
                                                        </select>
                                                    </div>
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
    </div>

@endsection
@section('js')
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    <script>

        $(document).ready(function(){
            $(".phone_number").inputmask({
                "mask": "019-99-99-99-99"
            });

        });

    </script>

    <script src="{{url('acp/libs/select2/js/select2.min.js')}}"></script>

    <!-- init js -->
    <script src="{{url('acp/js/pages/form-advanced.init.js')}}"></script>

@endsection
