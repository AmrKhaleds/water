<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اعادة التوجية...</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #25D366, #128C7E);
            color: #fff;
        }
        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.2);
            border-left-color: #fff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
        .message {
            font-size: 1.2em;
            text-align: center;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                // Open the URL in a new tab after 3 seconds
                window.open("{{ $url }}", "_blank");
                // Redirect the current tab to a different page
                // window.location.href = "{{ url('/acp/price-proposal') }}";
            }, 5000); // 3-second delay
        });
    </script>
</head>

<body>
    <div class="spinner"></div>
    <p class="message"> جارى إعادة توجيهك إلى WhatsApp...<br>فضلا انتظر لحظات.</p>
</body>

</html>
