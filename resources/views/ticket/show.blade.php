<!DOCTYPE html>
<html>
<head>
    <title>Tiket Kamu</title>
</head>
<body>
    <h1>Tiket untuk Event ID: {{ $ticket->event_id }}</h1>
    <p>Kode Tiket: <strong>{{ $ticket->ticket_code }}</strong></p>
    <p>QR Code Tiket:</p>
    <img src="{{ $qrPath }}" alt="QR Code">
</body>
</html>
