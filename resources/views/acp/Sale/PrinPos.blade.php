<div id="invoice-POS">
    <div style="max-width: 400px; margin: 0px auto;">
        <div class="info"><img src="{{getSetting('logo')->value}}" alt="logo" height="70"/>
            <p>
                <span>@lang('back.date') : {{$bill->created_at->format('d-m-Y')}} <br></span>
                <span>@lang('back.invoice') : {{$bill->ref}} <br></span>
                <span>@lang('back.address') : {{$bill->user->profile->address}} , {{$bill->user->profile->area->name}} <br></span>
                <span>@lang('back.email')  : {{$bill->user->email}} <br></span>
                <span>@lang('back.phone') : {{$bill->user->profile->phone}} <br></span>
                <span>@lang('back.client') : {{$bill->user->name}} <br></span>
            </p>
        </div>
        <table>
            <tbody>
            @foreach($bill->orders->whereNull('deleted_at') as $key => $orders)
            <tr>
                <td colspan="3"><span>{{$orders->product->name}} <br> {{$orders->qty}} x {{number_format($orders->price,2)}}</span></td>
                <td style="text-align: right; vertical-align: bottom;">{{number_format($orders->price * $orders->qty,2)}}</td>
            </tr>
            @endforeach
            <tr style="margin-top: 10px;">
                <td colspan="3" class="total">@lang('back.sub_total')</td>
                <td class="total" style="text-align: right;">@lang('back.le') {{number_format($bill->sub_total,2)}}</td>
            </tr>

            <tr style="margin-top: 10px;">
                <td colspan="3" class="total">@lang('back.tax')</td>
                <td class="total" style="text-align: right;">@lang('back.le') ({{$bill->tax}}%) {{number_format($bill->tax_amount,2)}}</td>
            </tr>
            <tr style="margin-top: 10px;">
                <td colspan="3" class="total">@lang('back.grand_total')</td>
                <td class="total" style="text-align: right;">@lang('back.le')  {{number_format($bill->total_amount,2)}}</td>
            </tr>
            <tr style="display: none;">
                <td colspan="3" class="total">@lang('back.paid')</td>
                <td class="total" style="text-align: right;">@lang('back.le') {{number_format($bill->paid,2)}}</td>
            </tr>
            <tr style="display: none;">
                <td colspan="3" class="total">@lang('back.due')</td>
                <td class="total" style="text-align: right;">@lang('back.le') {{number_format($bill->due,2)}}</td>
            </tr>
            </tbody>
        </table>
        <table class="change mt-3" style="font-size: 10px;">
            <thead>
            <tr style="background: rgb(238, 238, 238);">
                <th colspan="2" style="text-align: center;">@lang('back.paid'):</th>
                <th colspan="1" style="text-align: right;">@lang('back.due'):</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2" style="text-align: center;">@lang('back.le') {{number_format($bill->paid,2)}}</td>
                <td colspan="1" style="text-align: right;">@lang('back.le') {{number_format($bill->due,2)}}</td>
            </tr>
            </tbody>
        </table>
        <div id="legalcopy" class="ml-2"><p class="legal"><strong>{{$bill->description}}</strong></p>
        </div>
    </div>
</div>

<script>
    var divContents = document.getElementById("invoice-POS").innerHTML;
    var a = window.open("", "", "height=500, width=300");

    var frame1 = $('<iframe />');
    frame1[0].name = "frame1";
    frame1.css({ "position": "absolute", "top": "-1000000px" });
    $("body").append(frame1);

    var printOne = $('#invoice-POS').html();
    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
    a.document.open();
    a.document.write('<html><head><title>Copy Printed</title></head><body style="direction: rtl;">' + printOne + '</body></html>');
    a.document.close();
    setTimeout(function () {
        window.frames["frame1"].focus();
        frame1.remove();
    }, 500);

    a.print();

</script>
