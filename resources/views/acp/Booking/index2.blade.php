@extends('acp.layout.app')

@section('title')
    @lang('back.bookings')
@endsection

@section('title')
    <style type="text/css">
        .ajax-load{
            background: #e1e1e1;
            padding: 10px 0px;
            width: 100%;
        }
    </style>
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.bookings')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.bookings')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row mb-2">
        <div class="col-md-6">
            <div class="mb-3">
                <a href="{{route('bookings.create')}}" class="btn btn-primary waves-effect waves-light">
                    @lang('back.create') @lang('back.bookings') <i class="uil uil-plus-square ms-2"></i>
                </a>

            </div>
        </div>

        <div class="col-md-6">
            <form action="?" method="get">
                <div class="form-inline float-md-end mb-3">
                    <div class="search-box ms-2">
                        <div class="position-relative">
                            <input type="text" class="form-control rounded border-0 search" name="search" value="{{$request->search}}" placeholder="Search...">
                            <i class="mdi mdi-magnify search-icon"></i>
                        </div>
                    </div>

                </div>
            </form>
        </div>


    </div>
    <!-- end row -->

    <div class="row" id="post-data">
        @if(Session::has('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="uil uil-check me-2"></i>
                {!! session('msg') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>

        @endif

        @include('acp.Booking.scroll')

    </div> <!-- end row -->



    <div class="row">
        <div class="col-12">
            <div class="ajax-load text-center" style="display:none">
                <div class="spinner-grow text-primary m-1" role="status">
                    <span class="sr-only">Loading...</span>
                </div>

            </div>
        </div>
    </div>



@endsection
@section('js')

    <script type="text/javascript">
        var page = 1;
        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                loadMoreData(page);
            }
        });


        function loadMoreData(page){
            $.ajax(
                {
                    url: '?page=' + page,
                    type: "get",
                    beforeSend: function()
                    {
                        $('.ajax-load').show();
                    }
                })
                .done(function(data)
                {
                    if(data.html == " "){
                        $('.ajax-load').html("No more records found");
                        return;
                    }
                    $('.ajax-load').hide();
                    $("#post-data").append(data.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('server not responding...');
                });
        }


    </script>
@endsection

