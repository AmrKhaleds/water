<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background: rgb(204, 204, 204);
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        page[size="A4"] {
            width: 19cm;
            height: 27.7cm;
        }

        page[size="A4"][layout="landscape"] {
            width: 29.7cm;
            height: 21cm;
        }

        page[size="A3"] {
            width: 29.7cm;
            height: 42cm;
        }

        page[size="A3"][layout="landscape"] {
            width: 42cm;
            height: 29.7cm;
        }

        page[size="A5"] {
            width: 14.8cm;
            height: 21cm;
        }

        page[size="A5"][layout="landscape"] {
            width: 21cm;
            height: 14.8cm;
        }

        @media print {

            body,
            page {
                background: white;
                margin: 0;
                box-shadow: 0;
            }
        }

        .btn {
            color: #ffffff;
            background-color: #2ca67a;
            border-color: #2a9c72;
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            text-align: center;
            width: 150px;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.47rem 0.75rem;
            font-size: 0.9rem;
            border-radius: 0.25rem;
            -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        }

        .title {
            font-size: 1.2rem;
            font-weight: bold;
            margin: 10px 10px;
        }

        .data {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 1.2rem;
            background: #c1c1c1;
        }

        @media print {
            tr.vendorListHeading {
                background-color: #1a4567 !important;
                print-color-adjust: exact;
            }
        }

        @media print {
            .vendorListHeading th {
                color: white !important;
            }
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container" style="display: flex; justify-content: end;width: 100%;">
        {{-- make button to print page --}}
        <button onclick="window.print()" class="no-print btn">طباعة</button>
    </div>

    <page size="A4" style="position: relative;" id="invoice" class="    width: 100%;">
        <div class="row header">
            <img src="{{ asset('acp/images/sudan_invoices/header.png') }}" alt="" width="100%">
        </div>
        <div class="content w-100" style="    border: 2px solid gray;
        border-radius: 20px;margin: 0 5px;">
            <div class="" style="text-align: center;">
                <h2>ايصال استلام مياة معدنية من المخازن او المصنع</h2>
            </div>
            <div class="row">
                <div class="col title">
                    <span>
                        اسم المصنع او المخزن :
                    </span>
                    <span @if ($sale->product->name) class="data" @endif>
                        {{ $sale->product->name }}
                    </span>
                </div>
                <div class="col title">
                    <span>
                        العنوان :
                    </span>
                    <span @if ($sale->address) class="data" @endif>
                        {{ $sale->address }}
                    </span>
                </div>
                <div class="col title">
                    <span>
                        اسم المستلم :
                    </span>
                    <span @if ($sale->client_name) class="data" @endif>
                        {{ $sale->client_name }}
                    </span>
                </div>
                <div class="col title">
                    <span>
                        رقم الجواز :
                    </span>
                    <span @if ($sale->client_passport) class="data" @endif>
                        {{ $sale->client_passport }}
                    </span>
                </div>
                <div class="col title">
                    <span>
                        رقم الهاتف :
                    </span>
                    <span @if ($sale->client_phone) class="data" @endif>
                        {{ $sale->client_phone }}
                    </span>
                </div>
                <div class="col title">
                    <span>
                        اسم صاحب البضاعة :
                    </span>
                    <span @if ($sale->client_name) class="data" @endif>
                        {{ $sale->client_name }}
                    </span>
                </div>
                <div class="col title">
                    <span>
                        ثمن الكرتونة :
                    </span>
                    <span @if ($sale->sale_price) class="data" @endif>
                        {{ $sale->sale_price }} جنية فقط لا غير
                    </span>
                </div>

                <div class="col title">
                    <span>
                        ثمن التحميل والورق :
                    </span>
                    <span @if ($sale->paper_loading_cost) class="data" @endif>
                        {{ $sale->paper_loading_cost }} جنية فقط لا غير
                    </span>
                </div>
                <div class="col title">
                    <span>
                        اجمالي ثمن البضاعة :
                    </span>
                    <span @if ($sale->sale_price) class="data" @endif>
                        {{ $sale->quantity * $sale->sale_price }} جنية فقط لا غير
                    </span>
                </div>
                <div class="col title">
                    <span>
                        المدفوع :
                    </span>
                    <span>

                    </span>
                </div>
                <div class="col title">
                    <span>
                        المتبقي :
                    </span>
                    <span>

                    </span>
                </div>
                <div class="col title">
                    <span>
                        المياة تصدير :
                    </span>
                    <span @if ($sale->water_export) class="data" @endif>
                        {{ $sale->water_export }}
                    </span>
                </div>
                <div class="col title">
                    <span>
                        المنتج :
                    </span>
                    <span @if ($sale->product->name) class="data" @endif>
                        {{ $sale->product->name }}
                    </span>
                </div>
                <div class="col title">
                    <span>
                        عدد الكراتين :
                    </span>
                    <span @if ($sale->quantity) class="data" @endif>
                        {{ $sale->quantity }}
                    </span>
                </div>
                <div class="col title">
                    <span>
                        اسم شركة التصدير :
                    </span>
                    <span @if ($sale->company_name) class="data" @endif>
                        {{ $sale->company_name }}
                    </span>
                </div>
                <div class="col title">
                    <span>
                        اسم المخلص الجمركى :
                    </span>
                    <span @if ($sale->clearance_agent_name) class="data" @endif>
                        {{ $sale->clearance_agent_name }}
                    </span>
                </div>

                <div class="col title">
                    <span>
                        رقم هاتف المخلص الجمركى :
                    </span>
                    <span @if ($sale->clearance_agent_phone) class="data" @endif>
                        {{ $sale->clearance_agent_phone }}
                    </span>
                </div>

                <div class="col title">
                    <span>
                        تاريخ الفاتورة :
                    </span>
                    <span @if ($sale->purchase_date) class="data" @endif>
                        {{ $sale->purchase_date }}
                    </span>
                </div>
            </div>
        </div>
        <div class="row footer" style="position: absolute; bottom: 0;width: 100%;">
            <img src="{{ asset('acp/images/sudan_invoices/footer.png') }}" alt="" width="100%">
        </div>
    </page>
    <!-- <page size="A4"></page> -->
    <!-- <page size="A4" layout="landscape"></page> -->
    <!-- <page size="A5"></page> -->
    <!-- <page size="A5" layout="landscape"></page> -->
    <!-- <page size="A3"></page> -->
    <!-- <page size="A3" layout="landscape"></page> -->
</body>

</html>
