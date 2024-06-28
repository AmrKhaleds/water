<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض سعر</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <style>
        /* @page {
            size: A4;
            margin: 10mm;
        } */
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            justify-content: space-between;
            overflow: scroll;
        }
        
        .header {
            display: flex;
        }
        
        .header img {
            max-width: 250px;
            max-height: 150px;
            margin: 10px 20px;
        }
        
        .content {
            flex: 1;
            padding: 20mm 0;
            border-left: 20px solid #245799;
            margin: 0 20px;
        }
        
        .title {
            font-size: 20px;
            font-weight: bold;
            color: #245799;
            display: block;
            margin-bottom: 20px;
        }
        
        .footer {
            padding: 10mm;
            border-left: 20px solid #e83729;
            text-align: left;
            margin: 0 20px;
            color: #24579d;
            font-weight: bold;
        }
        .footer .contacts{
            display: block;
        }
        
        .fa {
            margin-right: 10px;
            color: #e83729;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table,
        th,
        td {
            border: 1px solid black;
        }
        
        th,
        td {
            padding: 10px;
            text-align: right;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        .notes-table {
            margin-top: 20px;
        }
        
        .table-view {
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <div class="header">
        <img src="{{ asset('acp/images/capital.png') }}" alt="Logo" class="logo">
    </div>
    <!-- CONTENT -->
    <div class="content">
        <div>
            <div class="title">
                    التاريخ / {{ Carbon\Carbon::parse($price_proposal->date)->format('d/m/Y') }}
            </div>
            <div class="title" style="font-size: 20px; font-weight: bold; color: #245799;">
                    السادة / ....................................
            </div>
            <div class="title" style="font-size: 20px; font-weight: bold; color: #245799;">
                    عرض اسعار سارى لمدة 15 يوم
            </div>
        </div>

        <div class="table-view">
            <!-- Price Proposal -->
            <table>
                <thead>
                    <tr>
                        <th>البيان</th>
                        <th>السعر</th>
                    </tr>
                </thead>
                <tbody id="price-rows">
                    @foreach ($statements as $statement)
                        <tr>
                            <td style="width: 80%">{{ $statement['statement'] }}</td>
                            <td class="price">{{ number_format($statement['price']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="1">الإجمالي الكلي (حروف)</th>
                        <th id="total-price">{{ $total_price_in_arabic }}</th>
                    </tr>
                    <tr>
                        <th colspan="1">الإجمالي الكلي (ارقام)</th>
                        <th id="total-price">{{ number_format($total_price) }} جنيهًا فقط لا غير</th>
                    </tr>
                </tfoot>
            </table>
            <!-- Notes -->
            <table class="notes-table">
                <thead>
                    <tr>
                        <th>ملاحظات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{ $price_proposal->notes }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- FOOTER -->
    <div class="footer">
        <div class="contacts">
            010-22-767-010 :
            الهاتف 
            <i class="fa fa-phone-square" aria-hidden="true"></i> 
        </div>
        <div class="contacts">
            mrisuzu4@gmail.com :
            البريد الإلكترونى 
            <i class="fa fa-envelope" aria-hidden="true"></i>
        </div>
        <div class="contacts">
            Egypt, Cairo, Nasr City :
            العنوان 
            <i class="fa fa-location-arrow" aria-hidden="true"></i>
        </div>
        <div class="contacts">
            www.egypt100100.com :
            الموقع الإلكترونى 
            <i class="fa fa-globe" aria-hidden="true"></i>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>