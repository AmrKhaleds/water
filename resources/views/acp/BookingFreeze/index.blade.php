@extends('acp.layout.app')

@section('title')
    @lang('back.bookings_freezers')
@endsection

@section('css')
    <link href="{{url('acp/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('acp/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('acp/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection


@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.bookings_freezers')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.bookings_freezers')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        @if(Session::has('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="uil uil-check me-2"></i>
                {!! session('msg') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>

        @endif
            <div class="card">

        <div class="card-body">
            <div class="mb-3">
                <a href="{{route('booking.freezers.create')}}" class="btn btn-primary waves-effect waves-light">
                    @lang('back.create') @lang('back.bookings_freezers') <i class="uil uil-plus-square ms-2"></i>
                </a>

            </div>

            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr>
                    <th>#</th>
                    <th> @lang('back.name') @lang('back.client')</th>
                    <th>@lang('back.from_area')</th>
                    <th>@lang('back.to_area')</th>
                    <th>@lang('back.date') </th>
                    <th>@lang('back.price')</th>
                    <th>@lang('back.created_by')</th>
                    <th>@lang('back.whatsapp')</th>
                    <th>@lang('back.action')</th>
                </tr>
                </thead>

                <tbody>
                @foreach($bookings as $key => $booking)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$booking->client->name}}</td>
                        <td>{{$booking->FromArea ? $booking->FromArea->name : ''}}</td>
                        <td>{{$booking->ToArea ? $booking->ToArea->name : ''}}</td>
                        <td>{{$booking->time}}</td>
                        <td>{{$booking->price}}</td>
                        <td>{{$booking->user->name}}</td>
                        <td>
                            <a href="https://wa.me/+2{{str_replace('-','',$booking->client->profile->whatsapp)}}?text=اهلا بك">
{{--                            <a href="https://wa.me/+2{{str_replace('-','',$booking->bill->user->profile->whatsapp)}}?text=اهلا بك">--}}
                                <div class="avatar-sm" style="height: 2rem;width: 2rem;">
                                                    <span
                                                            class="avatar-title bg-soft-success text-success font-size-25 rounded-circle">
                                                        <i class="fab fa-whatsapp" style="font-size:30px;"></i>
                                                    </span>
                                </div>
                            </a>
                        </td>
                        <td style="width: 100px">
                            <a href="{{route('booking.freezers.edit',$booking->id)}}" class="btn btn-outline-warning btn-sm"
                               title="@lang('back.edit')">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="{{route('booking.freezers.destroy',$booking->id)}}" class="btn btn-outline-danger btn-sm"
                               title="@lang('back.delete')">
                                <i class="fas fa-times"></i>
                            </a>
                            <a href="{{route('booking.freezers.show',$booking->id)}}" class="btn btn-outline-info btn-sm"
                               title="@lang('back.show')">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    </div> <!-- end row -->






@endsection

@section('js')
    <!-- Required datatable js -->
    <script src="{{url('acp/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{url('acp/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{url('acp/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{url('acp/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{url('acp/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{url('acp/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>



    <!-- Datatable init js -->
    <script src="{{url('acp/js/pages/datatables.init.js')}}"></script>

@endsection

