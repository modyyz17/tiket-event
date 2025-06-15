<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Eventify - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

    .event-card:hover {
        transform: translateY(-4px);
        transition: all 0.3s ease-in-out;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .kategori:hover {
        background: linear-gradient(to right, #3b82f6, #60a5fa);
        color: white;
        transition: background 0.3s ease;
    }

    .btn-primary {
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #2563eb;
    }
</style>


</head>
<body class="bg-gray-100 text-gray-800">


<!-- Navbar -->
<nav class="bg-white shadow p-4 flex justify-between items-center sticky top-0 z-50">
<div class="text-2xl font-bold text-blue-600">Eventify</div>
<div class="flex gap-4 items-center">
    <input type="text" placeholder="Search event..." class="border rounded px-2 py-1 focus:outline-blue-500" />
    <a href="{{ route('login') }}" class="text-sm text-blue-500 hover:underline">Login</a>
    <a href="{{ route('register') }}" class="text-sm text-white bg-blue-500 px-3 py-1 rounded hover:bg-blue-600">Register</a>
</div>
</nav>

<!-- Profile Section -->
<section class="p-6">
    <h2 class="text-xl font-semibold mb-2">Hi 👋</h2>
    <div class="bg-white rounded shadow p-4">
        <p> Beli es kelapa di pinggir jalan,
        Nikmat banget di hari panas.</p>
        <p>Mau event hits? Pesan sekarang,
           Satu klik aja, langsung berangkat puas!</p>
        </div>
    </section>


<!-- Kategori Tiket -->
<!-- Kategori Tiket -->
<section class="p-6">
    <h2 class="text-xl font-semibold mb-4">Kategori Tiket</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="/events/konser" class="bg-white p-4 rounded shadow text-center kategori cursor-pointer hover:bg-gray-100 transition">🎤 Konser</a>
        <a href="/events/seminar" class="bg-white p-4 rounded shadow text-center kategori cursor-pointer hover:bg-gray-100 transition">🎓 Seminar</a>
        <a href="/events/pameran" class="bg-white p-4 rounded shadow text-center kategori cursor-pointer hover:bg-gray-100 transition">🎨 Pameran</a>
        <a href="/events/gameshow" class="bg-white p-4 rounded shadow text-center kategori cursor-pointer hover:bg-gray-100 transition">🎮 Game Show</a>
    </div>
</section>



<!-- Daftar Event -->
<section class="p-6">
    <h2 class="text-xl font-semibold mb-4">Tiket Tersedia</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @for ($i = 1; $i <= 6; $i++)
            <div class="bg-white p-4 rounded shadow event-card transition-all">
                <h3 class="font-bold text-lg">Event {{ $i }}</h3>
                <p class="text-sm text-gray-500">Tanggal: 12 Mei 2025</p>
                <p class="mt-2">Deskripsi singkat event ini.</p>
                <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded btn-primary">
                    Beli Tiket
                </button>
            </div>
        @endfor
    </div>
</section>

<!-- Footer -->
<footer class="bg-white shadow p-4 text-center mt-6">
    <p class="text-sm text-gray-500">© 2025 Eventify. All rights reserved.</p>
</footer>
</body>
</html>


