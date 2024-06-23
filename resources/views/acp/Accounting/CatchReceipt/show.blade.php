<style id="smart-base-colors">    :root {        --base-color: #009688;        --base-color-hover: #068479;        --base-color-focus: #09776d;        --base-color-dark: #087268;    }</style><style id="style_content1">    .title {        margin: 0 auto;        display: inline-block;        width: 100%;        text-align: center;        border: 2px solid #000;        border-radius: 12px;        padding: 6px 23px;        font-size: 140%;        font-weight: 700;        min-width: 285px;    }    .float_left {        float: left !important;    }    .float_right {        float: right !important;    }    .margin_bottom_10 {        margin-bottom: 10px;    }    .margin_top_10 {        margin-top: 15px;    }    .company_info {        float: right;        width: 25%;        font-size: 90%;        font-weight: 700;        margin: 0 auto;    }    .company_info .company-name {        width: 100%;        display: inline-block;        text-align: center;    }    .company_info .logo {        text-align: center;        max-width: 300px;        width: 96%;        display: inline-block;        clear: left;        float: none;    }    .company_info img {        width: 100%;        height: auto;        max-height: 50px;    }    .id_receipt {        width: 25%;        float: left;        display: table;        margin: 3px 0 auto;        text-align: center;        padding: 0 7px;    }    .id_receipt .date {        float: left;        direction: initial;        border: 1px solid #e1e1e1;        padding: 3px 9px;        width: 100%;        font-weight: 700;        font-size: 110%;        display: inline-block;        text-align: center;        margin: -1px 0;    }    .id_receipt .amount {        direction: ltr;        border: 1px solid #dadada;        padding: 3px;        font-weight: 700;        display: inline;        width: 100%;        float: left;    }    .id_receipt .amount .num {        display: inline-block;        margin-top: 1px;        font-family: sans-serif;    }    .id_receipt span {        direction: ltr;        border: 1px solid #dadada;        padding: 3px;        font-weight: 700;        display: inline;        width: 100%;        float: left;        font-family: sans-serif;    }    b,    strong {        font-weight: 700;    }    .col-sm-1,    .col-sm-2,    .col-sm-3,    .col-sm-4,    .col-sm-5,    .col-sm-6,    .col-sm-7,    .col-sm-8,    .col-sm-9,    .col-sm-10,    .col-sm-11,    .col-sm-12 {        float: right;        position: relative;        min-height: 1px;        padding-left: 0;        padding-right: 1px;    }    .center {        text-align: center;    }    .print_content {        padding: 0 !important;        width: 100% !important;        margin: 0;        display: table;        direction: rtl;        overflow: visible;    }    .signature {        margin-top: 38px;        display: inline-block;        width: 100%;        border-bottom-width: 1px;        border-bottom-style: dotted;        border-bottom-color: #818181;    }    .receipt_info {        padding: 0 2px;        margin: 0 2px;        display: inline-block;        font-weight: 700;        float:right;    }    .col-sm-4 {        width: 31%;        margin: 4px;        padding: 0 13px;    }    .col-auto {        width: 30%;        margin: 52px 7px 0px 7px;        padding: 0 5px;        float: right;        font-weight: 700;        font-size: 90%;    }    .margin_right_10 {        margin-right: 10% !important;    }    .col-sm-6 {        width: 50%;    }    .col-sm-12 {        width: 100%;    }</style>    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"         aria-hidden="true">        <div class="modal-dialog modal-lg">        <div class="modal-content">            <div class="modal-header">                <h5 class="modal-title" id="myLargeModalLabel">@lang('back.catch_receipt_datilse')</h5>            </div>            <div class="modal-body" id="content_to_print">                <div class="print_content padding10">                    <div class="clearfix"></div>                    <div class="col-sm-12 ">                        <div class="col-sm-12 margin_bottom_10" style=" margin-top: 10px; ">                            <div class="col-auto   "> </div>                            <div class="col-sm-4  ">                                <div class="title">                                    @lang('back.catch_receipt')</br>                                    @lang('fixed.cash_receipt')                                </div>                            </div>                            <div class="col-sm-4  "> </div>                        </div>                        <div class="col-sm-12 margin_bottom_10" style=" margin-top: 10px; ">                            <div class="company_info  ">                                <div class="logo">                                    <img src="{{branch()->logo}}"                                         alt="{{branch()->name}}">                                    </br>                                </div>                            </div>                            <div class="id_receipt">                                <div class="float_left center">                                <span>                                    <div class="float_left" style=" font-size: 80%; margin-top: 3px; ">No </div>                                    {{$cach->registration_number}}                                </span>                                    <div class="amount">                                        <div class="float_left">@lang('fixed.amount') </div>                                        <div class="num"> {{$cach->creditor}} @lang('back.SAR') </div>                                        <div class="float_right">@lang('back.amount')</div>                                    </div>                                </div>                            </div>                        </div>                        <div class="col-sm-12 margin_bottom_10" style=" margin-top: 32px; ">                            <div class="float_left" style="direction: ltr;">@lang('fixed.date') : </div>                            <div class="float_right">@lang('back.date') : </div>                            <div class="receipt_info"> {{$cach->created_at}} </div>                        </div>                        <div class="col-sm-12 margin_bottom_10">                            <div class="float_left" style="direction: ltr;">                                @lang('fixed.recipient_from') @lang('fixed.Mr/Mrs'): </div>                            <div class="float_right">                                @lang('back.recipient_from') @lang('back.Mr/Mrs') :                            </div>                            <div class="receipt_info">                                {{$cach->account_name}} </div>                        </div>                        <div class="col-sm-12 margin_bottom_10">                            <div class="float_left" style="direction: ltr;">@lang('fixed.amount'):</div>                            <div class="float_right">@lang('back.amount'): </div>                            <div class="receipt_info"> {{$cach->amount_arabic}} </div>                        </div>                        <div class="col-sm-12 margin_bottom_10">                            <div class="float_left" style="direction: ltr;">@lang('fixed.payments_method'): </div>                            <div class="float_right">@lang('back.payments_method') : </div>                            <div class="receipt_info"> {{$cach->paymentMethod->name}}  </div>                        </div>                        <div class="col-sm-12 margin_bottom_10">                            <div class="float_left" style="direction: ltr;">@lang('fixed.for'):</div>                            <div class="float_right">@lang('back.for'): </div>                            <div class="receipt_info">                            </div>                        </div>                        <div class="col-auto">                            <div class="float_left" style="direction: ltr;"> @lang('fixed.receiver_signature') </div>                            <div class="float_right">@lang('back.receiver_signature')</div>                            <div class="signature "></div>                        </div>                        <div class="col-auto margin_right_101">                            <div class="float_left" style="direction: ltr;">@lang('fixed.accountant_signature')</div>                            <div class="float_right">@lang('back.accountant_signature') </div>                            <div class="signature  "></div>                        </div>                        <div class="col-auto float_left">                            <div class="float_left" style="direction: ltr;">@lang('fixed.manager')</div>                            <div class="float_right"> @lang('back.manager') </div>                            <div class="signature"> </div>                        </div>                    </div>                </div>            </div>            <div class="modal-footer">                <button type="button" class="btn btn-success no-print pull-right" style="margin-right:15px;"                        onclick="printBond('content_to_print');">                    <i class="fa fa-print"></i>  @lang('back.print')  </button>            </div>            </div>        </div>    </div><script language="javascript">    function printBond(el) {        var printContent = document.getElementById(el);        var style_content = document.getElementById('style_content1');        var windowName = 'سند قبض 000000136';        var printWindow = window.open('#', windowName);        var page_size = "   210mm 148mm  ";        var font_size = 13;        var style = '  <style> @media print {  ' +    document.getElementById('smart-base-colors').innerHTML+style_content.innerHTML +            '  .no-print{ visibility: hidden; } #section-to-print, #section-to-print * { visibility: visible; } #content_to_print { position: absolute; left: 0; top: 0; }  .print_content {  font-size:13px; }      .print_content {    margin: 0 !important; padding: 0px !important;} body,html {    margin: 0 !important; padding: 4px !important;} @page { size:  ' + page_size + ' ;margin:0.2mm 1mm 1mm 1mm;}       } </style>';        printWindow.document.write(style + printContent.innerHTML);        printWindow.document.title = windowName;        printWindow.document.close();        printWindow.focus();        printWindow.print();        printWindow.close();    }</script>