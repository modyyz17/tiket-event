<!DOCTYPE html>
<html>
<head>
    <title>Tiket Berhasil Dibeli</title>
</head>
<body>
    <h1>Tiket Kamu untuk Event: {{ $event->title }}</h1>
    <p>Scan QR Code di bawah untuk check-in:</p>
    <img src="{{ $qr }}" alt="QR Code Tiket">
</body>
</html>
