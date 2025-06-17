<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Eventify - Dashboard</title>
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
    <div class="flex gap-4 items-center">
        <span class="text-gray-700">👋 {{ Auth::user()->name }}</span>
        
        <a href="{{ route('profile.show') }}" class="text-sm text-white bg-blue-500 px-3 py-1 rounded hover:bg-blue-600">
            Profil
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-white bg-red-500 px-3 py-1 rounded hover:bg-red-600">Logout</button>
        </form>
    </div>
</nav>

<!-- Welcome Section -->
<section class="p-6">
    <h2 class="text-xl font-semibold mb-2">Selamat datang kembali, {{ Auth::user()->name }}!</h2>
    <div class="bg-white rounded shadow p-4">
        <p>Mau event hits? Pesan sekarang,</p>
        <p>Satu klik aja, langsung berangkat puas!</p>
    </div>
</section>

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

<!-- Berita Konser -->
<!-- Berita Konser -->
<section class="p-6 bg-gradient-to-tr from-blue-50 via-white to-blue-100">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">🎶 Berita Konser Terbaru</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        <!-- Berita 1 -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg group transition-all hover:shadow-xl">
            <div class="relative">
                <img src="{{ asset('images/gambar2.jpg') }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" alt="Muse dan Foo Fighters">
                <span class="absolute top-2 left-2 bg-blue-600 text-white text-xs font-medium px-3 py-1 rounded-full">2 Okt 2025</span>
            </div>
            <div class="p-4 space-y-2">
                <h3 class="font-bold text-lg text-gray-800">🎸 Muse dan Foo Fighters</h3>
                <p class="text-sm text-gray-600">Dua band legendaris dunia siap guncang Jakarta! Tiket mulai Rp1,7 Juta!</p>
                <a href="#" class="inline-block text-sm text-white bg-blue-600 px-4 py-1 rounded hover:bg-blue-700 transition">Lihat Detail</a>
            </div>
        </div>

        <!-- Berita 2 -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg group transition-all hover:shadow-xl">
            <div class="relative">
                <img src="{{ asset('images/gambar1.jpg') }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" alt="D13 HARO">
                <span class="absolute top-2 left-2 bg-blue-600 text-white text-xs font-medium px-3 py-1 rounded-full">28 Jun 2025</span>
            </div>
            <div class="p-4 space-y-2">
                <h3 class="font-bold text-lg text-gray-800">🔥 D13 HARO</h3>
                <p class="text-sm text-gray-600">Dentuman musik rock menyala di malam puncak Bandung! Siap ikut?</p>
                <a href="#" class="inline-block text-sm text-white bg-blue-600 px-4 py-1 rounded hover:bg-blue-700 transition">Lihat Detail</a>
            </div>
        </div>

        <!-- Berita 3 -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg group transition-all hover:shadow-xl">
            <div class="relative">
                <img src="{{ asset('images/gambar3.jpg') }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" alt="Cigarettes After Sex">
                <span class="absolute top-2 left-2 bg-blue-600 text-white text-xs font-medium px-3 py-1 rounded-full">17 Jan 2025</span>
            </div>
            <div class="p-4 space-y-2">
                <h3 class="font-bold text-lg text-gray-800">🌙 Cigarettes After Sex</h3>
                <p class="text-sm text-gray-600">Band dreamy pop ini akan hadir di Ancol! Tiket terbatas, segera pesan!</p>
                <a href="#" class="inline-block text-sm text-white bg-blue-600 px-4 py-1 rounded hover:bg-blue-700 transition">Lihat Detail</a>
            </div>
        </div>

        <!-- Berita 4 -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg group transition-all hover:shadow-xl">
            <div class="relative">
                <img src="{{ asset('images/gambar4.jpg') }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" alt="NIKI Buzz World Tour">
                <span class="absolute top-2 left-2 bg-blue-600 text-white text-xs font-medium px-3 py-1 rounded-full">14-15 Feb 2025</span>
            </div>
            <div class="p-4 space-y-2">
                <h3 class="font-bold text-lg text-gray-800">🎤 NIKI Buzz World Tour</h3>
                <p class="text-sm text-gray-600">Musisi Indonesia mendunia kembali tampil dua malam di Beach City!</p>
                <a href="#" class="inline-block text-sm text-white bg-blue-600 px-4 py-1 rounded hover:bg-blue-700 transition">Lihat Detail</a>
            </div>
        </div>

    </div>
</section>


<!-- Event yang Akan Datang -->
<section class="p-6 bg-white">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">📅 Event yang Akan Datang</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

        <!-- Event 1 -->
        <div class="bg-gradient-to-br from-purple-200 to-white rounded-xl shadow hover:shadow-lg transition-all overflow-hidden">
            <img src="{{ asset('images/gambar8.png') }}" alt="IIMS 2025" class="w-full h-40 object-cover">
            <div class="p-4 space-y-2">
                <h3 class="text-lg font-bold text-purple-800">Ailee ASCEND Concert</h3>
                <p class="text-sm text-gray-700">25 Oktober 2025</p>
                <p class="text-sm text-gray-600">Penyanyi berbakat asal korea selatan Ailee akan kembali ke jakarta setelah lebih dari satu dekade.</p>
                <button class="mt-2 text-sm bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700 transition">Lihat Detail</button>
            </div>
        </div>

        <!-- Event 2 -->
        <div class="bg-gradient-to-br from-pink-200 to-white rounded-xl shadow hover:shadow-lg transition-all overflow-hidden">
            <img src="{{ asset('images/gambar9.png') }}" alt="Webinar Manajemen" class="w-full h-40 object-cover">
            <div class="p-4 space-y-2">
                <h3 class="text-lg font-bold text-pink-800">Jakarta Fair 2025</h3>
                <p class="text-sm text-gray-700">19 Juni - 13 Juli 2025</p>
                <p class="text-sm text-gray-600"> Jakarta Fair 2025 kembali digelar dalam rangka memperingati HUT ke-498 Jakarta.</p>
                <button class="mt-2 text-sm bg-pink-600 text-white px-3 py-1 rounded hover:bg-pink-700 transition">Lihat Detail</button>
            </div>
        </div>

        <!-- Event 3 -->
        <div class="bg-gradient-to-br from-green-200 to-white rounded-xl shadow hover:shadow-lg transition-all overflow-hidden">
           <img src="{{ asset('images/gambar10.png') }}" alt="Webinar Manajemen" class="w-full h-40 object-cover">
            <div class="p-4 space-y-2">
                <h3 class="text-lg font-bold text-green-800">Konser My First Story</h3>
                <p class="text-sm text-gray-700">26 Juli 2025</p>
                <p class="text-sm text-gray-600">Grup band rock asal Jepang, My First Story menggelar konser di Istora Senayan, Jakarta </p>
                <button class="mt-2 text-sm bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">Lihat Detail</button>
            </div>
        </div>

        <!-- Event 4 -->
        <div class="bg-gradient-to-br from-yellow-200 to-white rounded-xl shadow hover:shadow-lg transition-all overflow-hidden">
            <img src="{{ asset('images/gambar11.png') }}" alt="Webinar Manajemen" class="w-full h-40 object-cover">
            <div class="p-4 space-y-2">
                <h3 class="text-lg font-bold text-yellow-800">Konser Soundrenaline</h3>
                <p class="text-sm text-gray-700">9-10 Agustus 2025</p>
                <p class="text-sm text-gray-600">Festival terbesar di Asia Tenggara kembali! Saksikan penampilan spesial top Indonesia dan internasional </p>
                <button class="mt-2 text-sm bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Lihat Detail</button>
            </div>
        </div>

    </div>
</section>


<!-- Footer -->
<footer class="bg-white shadow p-4 text-center mt-6">
    <p class="text-sm text-gray-500">© 2025 Eventify. All rights reserved.</p>
</footer>

</body>
</html>
