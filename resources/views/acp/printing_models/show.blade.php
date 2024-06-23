@extends('acp.layout.app')

@section('title')
    @lang('back.show') @lang('back.printing_models') 
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.show') @lang('back.printing_models') </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.show')</li>
                        <li class="breadcrumb-item ">@lang('back.printing_models')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row" >
        <div class="col-lg-12">
            <div class="card">
                <div class="d-print-none mt-4">
                    <div class="float-end">
                        <a href="javascript:void(0);" id="btnPrint"
                           class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                    </div>
                </div>
                <div class="card-body" id="dvContents">
                    <div class="row">
                        <div class="col">
                            <img src="{{ asset('uploads/printing_models/' .$model->image )}} " alt="" style="width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->



@endsection
@section('js')
    <script>
        $(function () {
            $("#btnPrint").click(function () {
                var contents = $("#dvContents").html();
                var frame1 = $('<iframe />');
                frame1[0].name = "frame1";
                //frame1.css({ "position": "absolute", "top": "-1000000px" });
                $("body").append(frame1);
                var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
                frameDoc.document.open();
                //Create a new HTML document.
                frameDoc.document.write('<!doctype html> <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="direction: rtl"><head>');

                //Append the external CSS file.
                //frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
                frameDoc.document.write('<link href="{{url('acp/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/><link href="{{url('acp/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css"/>');
                frameDoc.document.write('</head><body>');
                //Append the DIV contents.
                frameDoc.document.write(contents);
                frameDoc.document.write('</body></html>');
                frameDoc.document.close();
                setTimeout(function () {
                    window.frames["frame1"].focus();
                    window.frames["frame1"].print();
                    frame1.remove();
                }, 500);
            });
        });
    </script>
@endsection

