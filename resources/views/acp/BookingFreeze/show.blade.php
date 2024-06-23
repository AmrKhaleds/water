@extends('acp.layout.app')

@section('title')
    @lang('back.show') @lang('back.bookings_freezers')
@endsection

@section('css')
    <link href="{{url('acp/libs/jquery-bar-rating/themes/css-stars.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('acp/libs/jquery-bar-rating/themes/fontawesome-stars-o.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('acp/libs/jquery-bar-rating/themes/fontawesome-stars.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .fas{
            font-size: x-large;
        }
    </style>
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
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
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.show') @lang('back.bookings_freezers')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.show') @lang('back.bookings_freezers')</li>
                        <li class="breadcrumb-item ">@lang('back.bookings_freezers')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    @php

        $color = '';
        if ($booking->status == 'sure'){
            $color = 'success';
        }elseif ($booking->status == 'waiting'){
            $color = 'warning';
        }elseif ($booking->status == 'reservation'){
            $color = 'info';
        }elseif ($booking->status == 'canceled'){
            $color = 'dark';
        }
    @endphp
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-16">@lang('back.invoice')
                            #VF{{$booking->created_at->format('Ymdhi'.$booking->id)}}
                            <span class="badge bg-{{$color}} font-size-12 ms-2">@lang('back.'.$booking->status)</span>
                        </h4>
                        <div class="mb-4">
                            <img src="{{getSetting('logo')->value}}" alt="logo" height="20"/>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">@lang('back.client_datils') :</h5>
                                <h5 class="font-size-15 mb-2">{{$booking->client->name}} : @lang('back.client_name')</h5>
                                <p class="mb-1">{{$booking->client->profile->phone}} : @lang('back.client_phone')</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted text-sm-end">
                                <div>
                                    <h5 class="font-size-16 mb-1">@lang('back.invoice') :</h5>
                                    <p>#VF{{$booking->created_at->format('Ymdhi').$booking->id}}</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-16 mb-1">@lang('back.booking_at'):</h5>
                                    <p>{{$booking->created_at}}</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="py-2">
                        <h5 class="font-size-15">@lang('back.order_summary')</h5>
                        <div class="row">
                            <div class="col-sm-5">

                                <div class="text-muted">
                                    <div class="table-responsive mt-4">
                                        <div class="mt-4">
                                            <p class="mb-1">@lang('back.from_area')</p>
                                            <h5 class="font-size-16">{{$booking->fromArea->name}}</h5>
                                        </div>

                                        <div class="mt-4">
                                            <p class="mb-1">@lang('back.created_by')</p>
                                            <h5 class="font-size-16">{{$booking->user->name}}</h5>
                                        </div>
                                        <div class="mt-4">
                                            <p class="mb-1">@lang('back.date')</p>
                                            <h5 class="font-size-16">{{$booking->time}}</h5>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-2">

                                <div class="text-muted">
                                    <div class="table-responsive mt-4">
                                        <div class="mt-4">
                                            <h2 class="font-size-60"><i class="uil-arrow-left"></i></h2>
                                        </div>
                                        <br>
                                        <div class="mt-4">
                                            <h2 class="font-size-60"><i class="uil-arrow-left"></i></h2>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-5">

                                <div class="text-muted">
                                    <div class="table-responsive mt-4">
                                        <div class="mt-4">
                                            <p class="mb-1">@lang('back.to_area')</p>
                                            <h5 class="font-size-16">{{$booking->toArea->name}}</h5>
                                        </div>
                                        <div class="mt-4">
                                            <p class="mb-1">@lang('back.price')</p>
                                            <h5 class="font-size-16">{{$booking->price}} @lang('back.L.E')</h5>
                                        </div>

                                        <div class="mt-4">
                                            <p class="mb-1">@lang('back.status')</p>
                                            <span
                                                    class="badge rounded-pill font-size-16 bg-{{$color}}">@lang('back.'.$booking->status)</span>
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>
                     {{--   @if($booking->rate)
                            <div class="row">
                                <div class="col-xl-6 col-sm-6">
                                    <div class="pt-5">
                                        <h5 class="font-size-15">@lang('back.rate_callcenter')</h5>
                                        @for($c=0;$c<(5-$booking->rate->callcenter);$c++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @for($c=0;$c<$booking->rate->callcenter;$c++)
                                            <i class="fas fa-star" style="color:#f1b44c;"></i>
                                        @endfor
                                    </div>
                                    <div class="mt-4">
                                        <p class="mb-1">@lang('back.note_callcenter')</p>
                                        <h5 class="font-size-16">{{$booking->rate->callcenter_description}}</h5>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-sm-6">
                                    <div class="pt-5">
                                        <h5 class="font-size-15">@lang('back.rate_driver')</h5>
                                        @for($d=0;$d<(5-$booking->rate->driver);$d++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @for($d=0;$d<$booking->rate->driver;$d++)
                                            <i class="fas fa-star" style="color:#f1b44c;"></i>
                                        @endfor

                                    </div>
                                    <div class="mt-4">
                                        <p class="mb-1">@lang('back.note_driver')</p>
                                        <h5 class="font-size-16">{{$booking->rate->driver_description}}</h5>
                                    </div>
                                </div>

                            </div>

                        @else
                            <form action="{{route('bookings.rate')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$booking->id}}" name="id">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="pt-5">
                                            <h5 class="font-size-15">@lang('back.rate_callcenter')</h5>
                                            <select class="rating-css " name="rate_callcenter_star" autocomplete="off">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div class="mt-4">
                                            <p class="mb-1">@lang('back.note_callcenter') *</p>
                                            <textarea name="rate_callcenter_note" placeholder="@lang('back.note_callcenter')" class="form-control" cols="30" required
                                                      rows="5"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-sm-6">
                                        <div class="pt-5">
                                            <h5 class="font-size-15">@lang('back.rate_driver')</h5>
                                            <select class="rating-css" name="rate_driver_star" autocomplete="off">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div class="mt-4">
                                            <p class="mb-1">@lang('back.note_driver') *</p>
                                            <textarea name="rate_driver_note" placeholder="@lang('back.note_driver')" class="form-control" cols="30" required
                                                      rows="5"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="d-flex flex-wrap gap-3">
                                            <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light w-md">@lang('back.submit')</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif--}}
                        <div class="d-print-none mt-4">
                            <div class="float-end">
                                <a href="javascript:window.print()"
                                   class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->


@endsection
@section('js')

    <!-- jquery-bar-rating js -->
    <script src="{{url('acp/libs/jquery-bar-rating/jquery.barrating.min.js')}}"></script>

    <script src="{{url('acp/js/pages/rating-init.js')}}"></script>
@endsection

