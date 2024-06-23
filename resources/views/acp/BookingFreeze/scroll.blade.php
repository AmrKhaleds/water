@foreach($bookings as $booking)
    <div class="col-xl-6 col-sm-6">
        <div class="card">
            <div class="card-body">
                @if($booking->status !== 'finished')
                    <div class="dropdown float-end">
                        <a class="text-body dropdown-toggle font-size-16" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true">
                            <i class="uil uil-ellipsis-h"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item"
                               href="{{route('bookings.edit',$booking->id)}}">@lang('back.edit')</a>
                            <a class="dropdown-item"
                               href="{{route('bookings.destroy',$booking->id)}}">@lang('back.delete')</a>
                        </div>
                    </div>
                @endif
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-4">
                        <a href="https://wa.me/+2{{str_replace('-','',$booking->client->profile->whatsapp)}}?text=اهلا بك">
                            <div class="avatar-sm">
                                                    <span
                                                            class="avatar-title bg-soft-success text-success font-size-25 rounded-circle">
                                                        <i class="fab fa-whatsapp" style="font-size:35px;"></i>
                                                    </span>
                            </div>
                        </a>
                    </div>

                    <div class="flex-grow-1 align-self-center">

                        <div class="row">
                            <div class="col-5">
                                <div class="mt-3">
                                    <h5 class="text-truncate font-size-16 mb-1">
                                        <a
                                                href="{{route('bookings.show',$booking->id)}}"
                                                class="text-dark">{{$booking->client->name}}</a></h5>

                                    <p class="text-muted">
                                        <i class="mdi mdi-account me-1"></i> {{$booking->user->name}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-3">
                                    <h5 class="font-size-16 mb-0"><i class="uil-arrow-left"></i></h5>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="mt-3">
                                    <div class="float-end">
                                        @lang('back.filling') {{$booking->first_day_packing}} {{$booking->time}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <div class="mt-3">
                                    <h6 class="font-size-14 mb-0">@lang('back.from_area')</h6>
                                    <p class="text-muted mb-2">{{$booking->area ? $booking->area->name : ''}}</p>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-3">
                                    <h5 class="font-size-16 mb-0"><i class="uil-arrow-left"></i></h5>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="mt-3">
                                    <h6 class="font-size-14 mb-0">@lang('back.type')</h6>
                                    <p class="text-muted mb-2">@lang('back.'.$booking->type)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
@endforeach
