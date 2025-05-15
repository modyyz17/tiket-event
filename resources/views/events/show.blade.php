<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->name }}</title>
</head>
<body>
    <h1>{{ $event->name }}</h1>
    <p>{{ $event->description }}</p>
    <p><strong>Location:</strong> {{ $event->location }}</p>
    <p><strong>Date:</strong> {{ $event->event_date }}</p>
    <a href="#">Beli Tiket</a>
</body>
</html>
