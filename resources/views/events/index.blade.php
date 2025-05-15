<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
</head>
<body>
    <h1>Daftar Event</h1>
    <ul>
        @foreach($events as $event)
            <li><a href="/event/{{ $event->id }}">{{ $event->name }}</a> - {{ $event->location }} - {{ $event->event_date }}</li>
        @endforeach
    </ul>
</body>
</html>
