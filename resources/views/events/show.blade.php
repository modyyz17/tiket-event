@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-3xl p-4">
    <h2 class="text-2xl font-bold mb-4">{{ $event->title }}</h2>
    <p><strong>Lokasi:</strong> {{ $event->location }}</p>
    <p><strong>Tanggal:</strong> {{ $event->date }}</p>
    <p class="mt-4">{{ $event->description }}</p>
</div>
@endsection
