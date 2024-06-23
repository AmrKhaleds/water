@extends('acp.layout.app')

@section('title')
    @lang('back.trakings') {{$title}}
@endsection

@section('css')

    <!-- Sweet Alert-->
    <link href="{{url('acp/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('acp/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>

    <style>
        .digital-clock {
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 200px;
            height: 55px;
            color: #ffffff;
            border: 0px solid #999;
            border-radius: 4px;
            text-align: center;
            font: 50px/60px 'DIGITAL', Helvetica;
            background: linear-gradient(90deg, #000, #555);
        }

        .date {
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 300px;
            height: 55px;
            color: #ffffff;
            border: 0px solid #999;
            border-radius: 4px;
            text-align: center;
            font: 50px/60px 'DIGITAL', Helvetica;
            background: linear-gradient(90deg, #000, #555);
        }
    </style>
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.trakings') {{$title}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.trakings') {{$title}}</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <h6 class="card-text text-dark">@lang('back.trakings') @lang('back.shift') </h6>
                            <h6 class="card-text text-info"> @lang('back.total') @lang('back.bookings')
                                = {{$bookings->where('status', 'inprocess')->count()}}
                                : @lang('back.total') @lang('back.price')
                                = {{$bookings->where('status', 'inprocess')->sum(['price'])}} @lang('back.L.E')</h6>
                            <h6 class="card-text text-danger"> @lang('back.total') @lang('back.bookings') @lang('back.canceled')
                                = {{$bookings->where('status','canceled')->count()}}
                                : @lang('back.total') @lang('back.price')
                                = {{$bookings->where('status','canceled')->sum(['price'])}} @lang('back.L.E') </h6>
                        </div>
                        <div class="col-4">
                            <h6 class="card-text text-success"><i
                                        class="fas fa-car"></i> @lang('back.vehicles') @lang('back.avalble')
                                = {{$vehicles->where('status','available')->count()}}</h6>
                            <h6 class="card-text text-warning"><i
                                        class="fas fa-car-crash"></i> @lang('back.vehicles') @lang('back.damage')
                                = {{$vehicles->where('status','damage')->count()}}</h6>
                            <h6 class="card-text text-primary"><i
                                        class="fas fa-parking"></i> @lang('back.vehicles') @lang('back.garage')
                                = {{$vehicles->where('status','garage')->count()}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="dateTime">
                                <h6 class="card-text text-center">@lang('back.date_time')</h6>
                                <div class="date">{{date('d-m-Y')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-6">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">@lang('back.target')</h5>
                    <div class="row">

                        <div class="col-3">

                            <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample"
                               role="button"
                               aria-controls="offcanvasExample">
                                @lang('back.cranes')
                            </a>

                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
                                 aria-labelledby="offcanvasExampleLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">@lang('back.cranes')</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseTwo"
                                                        aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    @lang('back.cranes_available')
                                                    ({{$vehicleData->where('status','available')->count()}})
                                                </button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse show"
                                                 aria-labelledby="flush-headingTwo"
                                                 data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    @foreach($vehicleData->where('status','available') as $available)
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <h6>{{$available->car_name}}</h6>
                                                            </div>
                                                            <div class="col-6">
                                                                <a href="{{route('vehicles.status',[$available->id,'garage'])}}"
                                                                   class="btn btn-success btn-rounded waves-effect waves-light">
                                                                    @lang('back.garage')
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingThree">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseThree"
                                                        aria-expanded="false" aria-controls="flush-collapseThree">
                                                    @lang('back.garage')
                                                    ({{$vehicleData->where('status','garage')->count()}})
                                                </button>
                                            </h2>
                                            <div id="flush-collapseThree" class="accordion-collapse collapse show"
                                                 aria-labelledby="flush-headingThree"
                                                 data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    @foreach($vehicleData->where('status','garage') as $garage)
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <h6>{{$garage->car_name}}</h6>
                                                            </div>
                                                            <div class="col-6">
                                                                <a href="{{route('vehicles.status',[$garage->id,'damage'])}}"
                                                                   class="btn btn-success btn-rounded waves-effect waves-light">
                                                                    @lang('back.damaged')
                                                                </a>
                                                            </div>
                                                        </div>
                                                        {{--<form action="{{route('')}}" method="post">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                               for="formrow-email-input">Email</label>
                                                                        <input type="email" class="form-control"
                                                                               id="formrow-email-input"
                                                                               placeholder="Enter your email address">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                               for="formrow-password-input">Password</label>
                                                                        <input type="password" class="form-control"
                                                                               id="formrow-password-input"
                                                                               placeholder="Enter your password">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="mb-3">
                                                                        <button type="submit" class="btn btn-success btn-rounded waves-effect waves-light">
                                                                            @lang('back.submit') </button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>--}}
                                                        <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseOne" aria-expanded="true"
                                                        aria-controls="flush-collapseOne">
                                                    @lang('back.maintenance')
                                                    ({{$vehicleData->where('status','damage')->count()}})
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                                 aria-labelledby="flush-headingOne"
                                                 data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    @foreach($vehicleData->where('status','damage') as $damage)
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <h6>{{$damage->car_name}}</h6>
                                                            </div>
                                                            <div class="col-6">
                                                                <a href="{{route('vehicles.status',[$damage->id,'available'])}}"
                                                                   class="btn btn-success btn-rounded waves-effect waves-light">
                                                                    @lang('back.avalble')
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">

                            <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#assign_cars"
                               role="button"
                               aria-controls="offcanvasExample">
                                @lang('back.assign_cars')
                            </a>

                            <div class="offcanvas offcanvas-end" tabindex="-1" id="assign_cars"
                                 aria-labelledby="offcanvasExampleLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title"
                                        id="offcanvasExampleLabel">@lang('back.assign_cars')</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <form action="{{route('assign_cars.storeAssign')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                           for="formrow-email-input">@lang('back.drivrer_name')</label>
                                                    <select name="user_id" class="form-control select2">
                                                        <option value="">@lang('back.select_one')</option>
                                                        @foreach($drivers as $driver)
                                                            <option {{old('user_id') == $driver->id ? 'selected' : ''}} value="{{$driver->id}}">{{$driver->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                           for="formrow-password-input">@lang('back.crane')</label>
                                                    <select name="car_id" class="form-control select2">
                                                        <option value="">@lang('back.select_one')</option>
                                                        @foreach($vehicleData->where('status','available') as $CarAvailable)
                                                            <option {{old('car_id') == $CarAvailable->id ? 'selected' : ''}} value="{{$CarAvailable->id}}">{{$CarAvailable->car_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                           for="formrow-counter_number">@lang('back.counter_number')</label>
                                                    <input type="number" name="counter_number"
                                                           placeholder="@lang('back.counter_number')"
                                                           class="form-control" value="{{old('counter_number')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                           for="formrow-counter_number">@lang('back.delegate')</label>
                                                    <select name="delegate_id" class="form-control select2">
                                                        <option value="">@lang('back.select_one')</option>
                                                        @foreach($delegates as $delegate)
                                                        <option value="{{$delegate->id}}">{{$delegate->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow"></label>

                                                    <button type="submit"
                                                            class="btn btn-success btn-rounded waves-effect waves-light">@lang('back.submit')</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                    <br>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>@lang('back.cranes_with_drivers')</h5>
                                            <hr>
                                            @foreach($vehicleData->whereNotNull('assign_car_id') as $with_drivers)
                                                <dl class="row mb-0">
                                                    <dt class="col-sm-3">@lang('back.car_name')</dt>
                                                    <dd class="col-sm-9">{{$with_drivers->car_name}}</dd>
                                                    <dt class="col-sm-3">@lang('back.drivrer_name')</dt>
                                                    <dd class="col-sm-9">{{$with_drivers->assign->user->name}}</dd>
                                                    <dt class="col-sm-3">@lang('back.delegate')</dt>
                                                    <dd class="col-sm-9">{{$with_drivers->assign->delegate->name}}</dd>
                                                    <dd class="col-sm-12"><a
                                                                href="{{route('assign_cars.leave',$with_drivers->id)}}"
                                                                class="btn btn-warning btn-rounded waves-effect waves-light">@lang('back.leave_drive')</a>
                                                    </dd>
                                                </dl>
                                                <hr>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <canvas data-type="radial-gauge" id="gauge-a"
                                    data-width="250"
                                    data-height="170"
                                    data-units="@lang('back.today')"
                                    data-value="{{$priceAssigned}}"
                                    data-min-value="0"
                                    data-start-angle="90"
                                    data-ticks-angle="180"
                                    data-value-box="false"
                                    data-max-value="{{$target*2 + $target}}"
                                    data-major-ticks="0,{{$target}},{{($target*.5) + $target}},{{($target*2) + $target}}"
                                    data-minor-ticks="2"
                                    data-stroke-ticks="true"
                                    data-highlights='@json($arrayToDay)'
                                    data-color-plate="#fff"
                                    data-border-shadow-width="0"
                                    data-borders="false"
                                    data-needle-type="arrow"
                                    data-needle-width="2"
                                    data-needle-circle-size="7"
                                    data-needle-circle-outer="true"
                                    data-needle-circle-inner="false"
                                    data-animation-duration="800"
                                    data-animation-rule="linear"
                            ></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    @if(Session::has('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="uil uil-check me-2"></i>
            {!! session('msg') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

            </button>
        </div>

    @endif

    <div class="row">
        <div class="col-12">
            <div class="card bg-soft-warning border-warning">

                <div class="card-body">
                    <h6 class="card-text">@lang('back.bookings') @lang('back.notAssign')  @lang('back.today')</h6>
                    <div class="table-responsive">
                        <table class="table table-nowrap table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('back.employee')</th>
                                <th>@lang('back.client_name')</th>
                                <th>@lang('back.client_phone')</th>
                                <th>@lang('back.from_area')</th>
                                <th>@lang('back.gallon_type')</th>
{{--                                <th>@lang('back.type')</th>--}}
                                <th>@lang('back.price')</th>
                                <th>@lang('back.assign')</th>
                                <th>@lang('back.action')</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($bookings->where('status','!=','canceled')->whereNull('vehicle_id') as $key => $booking)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$booking->user->name}}</td>
                                    <td>{{$booking->bill->user->name}}</td>
                                    <td>
{{--                                        <a href="https://wa.me/+2{{Str::replace('-','',$booking->client->profile->phone)}}?text=اهلا بك"--}}
                                        <a href="https://wa.me/+2{{str_replace('-','',$booking->bill->user->profile->whatsapp)}}?text=اهلا بك" target="_blank">
                                            <div class="avatar-sm">
                                                    <span
                                                            class="avatar-title bg-soft-success text-success font-size-25 rounded-circle">
                                                        <i class="fab fa-whatsapp" style="font-size:35px;"></i>
                                                    </span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>{{$booking->area->name}}</td>
                                    <td>{{$booking->brand}}</td>
{{--                                    <td>@lang('back.'.$booking->gallon_type)</td>--}}
{{--                                    <td>@lang('back.'.$booking->type)</td>--}}
                                    <td>{{$booking->bill->orders->sum(['qty']) * $booking->price}}@lang('back.L.E')</td>
                                    <td>
                                        <select name="" class="form-control" onchange="location = this.value;">
                                            <option value="" selected>@lang('back.select_one')</option>
                                            @foreach($vehicles->whereNotNull('assign_car_id')->where('status','available') as $keyCount => $vehicle)
                                                <option
                                                        value="{{route('trakings.assign',[$booking->id,$vehicle->id])}}" {{$booking->vehicle_id==$vehicle->id ? 'selected' : ''}}>{{$vehicle->car_name}}
                                                    ({{$vehicle->assign ? $vehicle->assign->user->name : ''}})
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="width: 100px">
                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#myModal{{$booking->id}}"
                                                title="@lang('back.canceled')"><i class="fas fa-times"></i></button>
                                        <a href="{{route('bookings.edit',$booking->id)}}"
                                           class="btn btn-outline-warning btn-sm"
                                           title="@lang('back.edit')"><i class="fas fa-pencil-alt"></i></a>
                                    </td>
                                </tr>
                                <!-- sample modal content -->
                                <div id="myModal{{$booking->id}}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="myModalLabel">@lang('back.note_canceled')</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                </button>
                                            </div>
                                            <form action="{{route('trakings.destroy',$booking->id)}}" method="post">
                                                <div class="modal-body">
                                                    @csrf
                                                    <textarea name="note_canceled" class="form-control" cols="30"
                                                              rows="5"
                                                              placeholder="@lang('back.write') @lang('back.note_canceled')"
                                                              required></textarea>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light">@lang('back.submit')</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->





    <div class="row">
        <div class="col-12">
            <div class="card bg-soft-success border-success">
                <div class="card-body">

                    <h6 class="card-text">@lang('back.traking') @lang('back.cranes') @lang('back.today')</h6>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                 aria-orientation="vertical">
                                @foreach($titles as $key1 => $title)
                                    <a class="nav-link mb-2 {{$key1 == 0 ? 'active' : ''}}" id="v-pills-{{$key1}}-tab"
                                       data-bs-toggle="pill"
                                       href="#v-pills-{{$key1}}" role="tab" aria-controls="v-pills-{{$key1}}"
                                       aria-selected="{{$key1 == 0 ? 'true' : 'false'}}">  {{$title}} </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                @foreach($data as $key2 => $car)
                                    <div class="tab-pane fade {{$key2 == 0 ? 'show active' : ''}}"
                                         id="v-pills-{{$key2}}" role="tabpanel"
                                         aria-labelledby="v-pills-{{$key2}}-tab">
                                        <div class="table-responsive">
                                            <table class="table table-nowrap table-centered mb-0">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>@lang('back.client_name')</th>
                                                    <th>@lang('back.whatsapp') @lang('back.driver')</th>
                                                    <th>@lang('back.from_area')</th>
                                                    <th>@lang('back.gallon_type')</th>
{{--                                                    <th>@lang('back.type')</th>--}}
                                                    <th>@lang('back.price')</th>
                                                    <th>@lang('back.action')</th>
                                                </tr>
                                                </thead>


                                                <tbody>
                                                @foreach($car as $k => $value)
                                                    <tr>
                                                        <td>{{$k+1}}</td>
                                                        <td>{{$value->user->name}}</td>
                                                        <td>
                                                            <a href="https://wa.me/+2{{$value->assign->user->employee->whatsapp}}?text={!! $value->whatsappMessage !!}"
                                                               target="_blank">
                                                                <div class="avatar-sm">

                                                    <span
                                                            class="avatar-title bg-soft-success text-success font-size-25 rounded-circle">
                                                        <i class="fab fa-whatsapp" style="font-size:35px;"></i>
                                                    </span>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>{{$value->area->name}}</td>
                                                        <td>{{$value->brand}}</td>
{{--                                                        <td>@lang('back.'.$value->gallon_type)</td>--}}
{{--                                                        <td>@lang('back.'.$value->type)</td>--}}
                                                        <td>{{$value->bill->orders->sum(['qty']) * $value->price}}@lang('back.L.E')</td>
                                                        <td style="width: 100px">
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                        class="btn btn-{{$value->color_status}} dropdown-toggle waves-effect waves-light"
                                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">@lang('back.'.$value->status)
                                                                    <i class="mdi mdi-chevron-down"></i></button>
                                                                <div class="dropdown-menu dropdown-menu-end"
                                                                     data-placement="top">
                                                                    <a class="dropdown-item text-primary"
                                                                       href="{{route('trakings.status',[$value->id,'inprocess'])}}">
                                                                        <i class="fas fa-recycle"></i> @lang('back.inprocess')
                                                                    </a>
                                                                    <a class="dropdown-item text-info"
                                                                       href="{{route('trakings.status',[$value->id,'inuploaded'])}}">
                                                                        <i class="fas fa-road"></i> @lang('back.inuploaded')
                                                                    </a>
                                                                    <a class="dropdown-item text-success"
                                                                       href="{{route('trakings.status',[$value->id,'finished'])}}">
                                                                        <i class="fas fa-check-double"></i> @lang('back.finished')
                                                                    </a>
                                                                    <a class="dropdown-item text-warning"
                                                                       href="{{route('trakings.undestroy',$value->id)}}">
                                                                        <i class="fas fa-sync-alt"></i> @lang('back.cancel_assign')
                                                                    </a>
                                                                </div>
                                                            </div><!-- /btn-group -->
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div><!-- end row -->
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->



    <div class="row">
        <div class="col-12">
            <div class="card bg-soft-danger border-danger">
                <div class="card-body">
                    <h6 class="card-text text-danger">@lang('back.bookings') @lang('back.canceling') @lang('back.today')</h6>
                    <div class="table-responsive">
                        <table class="table table-nowrap table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('back.employee')</th>
                                <th>@lang('back.client_name')</th>
                                <th>@lang('back.client_phone')</th>
                                <th>@lang('back.from_area')</th>
                                <th>@lang('back.gallon_type')</th>
{{--                                <th>@lang('back.type')</th>--}}
                                <th>@lang('back.price')</th>
                                <th>@lang('back.note_canceled')</th>
                                <th>@lang('back.action')</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($bookings->where('status','canceled') as $key => $booking2)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$booking2->user->name}}</td>
                                    <td>{{$booking2->bill->user->name}}</td>
{{--                                    <td>{{$booking2->client->name}}</td>--}}
                                    <td>
                                        <a href="https://wa.me/+2{{str_replace('-','',$booking2->bill->user->profile->whatsapp)}}?text=اهلا بك" target="_blank">

{{--                                        <a href="https://wa.me/+2{{Str::replace('-','',$booking2->client->profile->phone)}}?text=اهلا بك" target="_blank">--}}
                                            <div class="avatar-sm">
                                                    <span
                                                            class="avatar-title bg-soft-success text-success font-size-25 rounded-circle">
                                                        <i class="fab fa-whatsapp" style="font-size:35px;"></i>
                                                    </span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>{{$booking2->area->name}}</td>
                                    <td>{{$booking2->brand}}</td>
{{--                                    <td>@lang('back.'.$booking2->gallon_type)</td>--}}
{{--                                    <td>@lang('back.'.$booking2->type)</td>--}}
                                    <td>{{$booking2->bill->orders->sum(['qty']) *  $booking2->price}} @lang('back.L.E')</td>
                                    <td>{{$booking2->note_canceled}}</td>
                                    <td style="width: 100px">
                                        <a href="{{route('trakings.undestroy',$booking2->id)}}"
                                           class="btn btn-outline-warning btn-sm" title="@lang('back.recovery')">
                                            <i class="fas fa-sync-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->



@endsection
@section('js')

    <!-- Sweet Alerts js -->
    <script src="{{url('acp/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Sweet alert init js-->
    <script src="{{url('acp/js/pages/sweet-alerts.init.js')}}"></script>
    <script src="{{url('acp/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{url('acp/js/pages/form-advanced.init.js')}}"></script>


    <script src="https://cdn.rawgit.com/Mikhus/canvas-gauges/gh-pages/download/2.1.4/radial/gauge.min.js"></script>
    <script>

        var gauge = new RadialGauge({renderTo: 'gauge-a'});
        gauge.draw();
        var gauge2 = new RadialGauge({renderTo: 'gauge-b'});
        gauge2.draw();


        $(document).ready(function () {
            clockUpdate();
            setInterval(clockUpdate, 1000);
        })

        function clockUpdate() {
            var date = new Date();

            function addZero(x) {
                if (x < 10) {
                    return x = '0' + x;
                } else {
                    return x;
                }
            }

            function twelveHour(x) {
                if (x > 12) {
                    return x = x - 12;
                } else if (x == 0) {
                    return x = 12;
                } else {
                    return x;
                }
            }

        }
    </script>
@endsection


