@extends('acp.layout.app')

@section('title')
    @lang('back.edit') @lang('back.bookings')
@endsection

@section('css')
    <link href="{{url('acp/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.edit') @lang('back.bookings')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.edit') @lang('back.bookings')</li>
                        <li class="breadcrumb-item ">@lang('back.bookings')</li>
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

                            <form method="post" action="{{route('bookings.update',$booking->id)}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mt-5 mt-lg-4">
                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.invoice_num') *</label>
                                                <div class="col-sm-8">
                                                    <select name="bill_id" class="form-control select2">
                                                        <option value="">@lang('back.select_one')</option>
                                                        @foreach($bills as $bill)
                                                            <option {{$booking->bill_id == $bill->id ? 'selected' : ''}}  value="{{$bill->id}}">{{$bill->ref}}</option>
                                                        @endforeach
                                                        {{--@foreach($users as $user)
                                                        <option {{old('client_id') == $user->id ? 'selected' : ''}}  value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach--}}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="horizontal-Fullname-input"
                                                   class="col-sm-4 col-form-label">@lang('back.filling_period') *</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control"
                                                       value="{{old('filling_period',$booking->filling_period)}}" required
                                                       placeholder="@lang('back.filling_period')" name="filling_period">
                                            </div>
                                        </div>
                                        {{--<div class="mt-5 mt-lg-4">
                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.gallon_type') *</label>
                                                <div class="col-sm-8">
                                                    <select name="gallon_type" class="form-control select2">
                                                        <option value="">@lang('back.select_one')</option>
                                                        @foreach($brands as $brand)
                                                            <option {{$booking->gallon_type == $brand->id ? 'selected' : '' }} value="{{$brand->id}}">{{$brand->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>--}}
                                        <div class="row mb-4">
                                            <label for="horizontal-Fullname-input"
                                                   class="col-sm-4 col-form-label">@lang('back.first_day_packing') *</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control"
                                                       value="{{old('first_day_packing',$booking->first_day_packing)}}" required
                                                       placeholder="@lang('back.first_day_packing')" name="first_day_packing">
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
                                                                    <option {{$booking->from_area == $FromChildren->id ? 'selected' : '' }}  value="{{$FromChildren->id}}">{{$FromChildren->name}}</option>
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
                                                       class="col-sm-4 col-form-label">@lang('back.near') *</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="near" class="form-control"
                                                           value="{{old('near',$booking->near)}}" required
                                                           placeholder="@lang('back.near')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-5 mt-lg-4">
                                          {{--  <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.type') *</label>
                                                <div class="col-sm-8">
                                                    <select name="type" class="form-control">
                                                        <option value="">@lang('back.select_one')</option>
                                                        <option {{$booking->type == 'new' ? 'selected' : ''}}  value="new">@lang('back.new')</option>
                                                        <option {{$booking->type == 'custody' ? 'selected' : ''}} value="custody">@lang('back.custody')</option>
                                                    </select>
                                                </div>
                                            </div>--}}
                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.packing_number') * </label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control "
                                                           value="{{old('packing_number',$booking->packing_number)}}"
                                                           placeholder="@lang('back.packing_number')" name="packing_number">
                                                </div>
                                            </div>

                                            <div class="mt-5 mt-lg-4">
                                                <div class="row mb-4">
                                                    <label for="horizontal-Fullname-input"
                                                           class="col-sm-4 col-form-label">@lang('back.price_filling_galon') *</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" name="price" class="form-control"
                                                               value="{{old('price',$booking->price)}}" required
                                                               placeholder="@lang('back.price')">
                                                    </div>
                                                </div>
                                            </div>

                                            {{--   <div class="row mb-4">
                                                   <label for="horizontal-Fullname-input"
                                                          class="col-sm-4 col-form-label">@lang('back.gallon_count') * </label>
                                                   <div class="col-sm-8">
                                                       <input type="number" class="form-control "
                                                              value="{{old('gallon_count',$booking->gallon_count)}}"
                                                              placeholder="@lang('back.gallon_count')" name="gallon_count">
                                                   </div>
                                               </div>--}}
                                            <div class="row mb-4">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.time') *</label>
                                                <div class="col-sm-8">
                                                    <input type="time" class="form-control"
                                                           value="{{old('time',$booking->time)}}" required
                                                           placeholder="@lang('back.time')" name="time">
                                                </div>
                                            </div>


                                            <div class="mt-5 mt-lg-4">
                                                <div class="row mb-4">
                                                    <label for="horizontal-Fullname-input"
                                                           class="col-sm-4 col-form-label">@lang('back.from_address')
                                                        *</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="from_address" class="form-control"
                                                               value="{{old('from_address',$booking->from_address)}}" required
                                                               placeholder="@lang('back.from_address')">
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
                                                            <option {{$booking->status == 'sure' ? 'selected' : '' }}  value="sure">@lang('back.sure')</option>
                                                            <option {{$booking->status == 'waiting' ? 'selected' : '' }}  value="waiting">@lang('back.waiting')</option>
                                                            <option {{$booking->status == 'reservation' ? 'selected' : '' }}  value="reservation">@lang('back.reservation')</option>
                                                            <option {{$booking->status == 'canceled' ? 'selected' : '' }}  value="canceled">@lang('back.canceled')</option>
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
