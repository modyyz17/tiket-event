@extends('layouts.app')

@section('content')
<a href="/dashboard" class="btn-back">
    ← Kembali 
</a>
<div class="p-8 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold mb-8 text-center text-blue-700">🎨 Daftar Pameran</h1>



    <div class="card-grid">
        
        {{-- Kartu Konser 1 --}}
        <div class="concert-card">
            <img src="{{ asset('images/gambar1.jpg') }}" alt="Konser A" class="concert-image">
            <div class="concert-body">
                <h2 class="concert-title">Konser Musik A</h2>
                <p class="concert-info">📍 Jakarta</p>
                <p class="concert-info">📅 20 Juli 2025</p>
                <p class="concert-description">Konser spesial dengan musisi papan atas! Jangan lewatkan kemeriahan malam penuh musik dan cahaya.</p>
                <a href="#" class="btn-ticket">Beli Tiket</a>
            </div>
        </div>

        {{-- Kartu Konser 2 --}}
        <div class="concert-card">
            <img src="{{ asset('images/gambar1.jpg') }}" alt="Konser B" class="concert-image">
            <div class="concert-body">
                <h2 class="concert-title">Festival Akustik B</h2>
                <p class="concert-info">📍 Bandung</p>
                <p class="concert-info">📅 5 Agustus 2025</p>
                <p class="concert-description">Nikmati suasana hangat dan santai dengan pertunjukan akustik dari band indie terbaik Indonesia.</p>
                <a href="#" class="btn-ticket">Beli Tiket</a>
            </div>
        </div>

        {{-- Kartu Konser 3 --}}
        <div class="concert-card">
            <img src="{{ asset('images/gambar1.jpg') }}" alt="Konser C" class="concert-image">
            <div class="concert-body">
                <h2 class="concert-title">Live DJ Party C</h2>
                <p class="concert-info">📍 Surabaya</p>
                <p class="concert-info">📅 15 September 2025</p>
                <p class="concert-description">Malam seru dengan irama DJ terbaik! Lighting show spektakuler siap mengguncang suasana!</p>
                <a href="#" class="btn-ticket">Beli Tiket</a>
            </div>
        </div>

        <div class="concert-card">
            <img src="{{ asset('images/gambar1.jpg') }}" alt="Konser C" class="concert-image">
            <div class="concert-body">
                <h2 class="concert-title">Live DJ Party C</h2>
                <p class="concert-info">📍 Surabaya</p>
                <p class="concert-info">📅 15 September 2025</p>
                <p class="concert-description">Malam seru dengan irama DJ terbaik! Lighting show spektakuler siap mengguncang suasana!</p>
                <a href="#" class="btn-ticket">Beli Tiket</a>
            </div>
        </div>

        <div class="concert-card">
            <img src="{{ asset('images/gambar1.jpg') }}" alt="Konser C" class="concert-image">
            <div class="concert-body">
                <h2 class="concert-title">Live DJ Party C</h2>
                <p class="concert-info">📍 Surabaya</p>
                <p class="concert-info">📅 15 September 2025</p>
                <p class="concert-description">Malam seru dengan irama DJ terbaik! Lighting show spektakuler siap mengguncang suasana!</p>
                <a href="#" class="btn-ticket">Beli Tiket</a>
            </div>
        </div>

        <div class="concert-card">
            <img src="{{ asset('images/gambar1.jpg') }}" alt="Konser C" class="concert-image">
            <div class="concert-body">
                <h2 class="concert-title">Live DJ Party C</h2>
                <p class="concert-info">📍 Surabaya</p>
                <p class="concert-info">📅 15 September 2025</p>
                <p class="concert-description">Malam seru dengan irama DJ terbaik! Lighting show spektakuler siap mengguncang suasana!</p>
                <a href="#" class="btn-ticket">Beli Tiket</a>
            </div>
        </div>

        <div class="concert-card">
            <img src="{{ asset('images/gambar1.jpg') }}" alt="Konser C" class="concert-image">
            <div class="concert-body">
                <h2 class="concert-title">Live DJ Party C</h2>
                <p class="concert-info">📍 Surabaya</p>
                <p class="concert-info">📅 15 September 2025</p>
                <p class="concert-description">Malam seru dengan irama DJ terbaik! Lighting show spektakuler siap mengguncang suasana!</p>
                <a href="#" class="btn-ticket">Beli Tiket</a>
            </div>
        </div>

        <div class="concert-card">
            <img src="{{ asset('images/gambar1.jpg') }}" alt="Konser C" class="concert-image">
            <div class="concert-body">
                <h2 class="concert-title">Live DJ Party C</h2>
                <p class="concert-info">📍 Surabaya</p>
                <p class="concert-info">📅 15 September 2025</p>
                <p class="concert-description">Malam seru dengan irama DJ terbaik! Lighting show spektakuler siap mengguncang suasana!</p>
                <a href="#" class="btn-ticket">Beli Tiket</a>
            </div>
        </div>

        <div class="concert-card">
            <img src="{{ asset('images/gambar1.jpg') }}" alt="Konser C" class="concert-image">
            <div class="concert-body">
                <h2 class="concert-title">Live DJ Party C</h2>
                <p class="concert-info">📍 Surabaya</p>
                <p class="concert-info">📅 15 September 2025</p>
                <p class="concert-description">Malam seru dengan irama DJ terbaik! Lighting show spektakuler siap mengguncang suasana!</p>
                <a href="#" class="btn-ticket">Beli Tiket</a>
            </div>
        </div>

        <div class="concert-card">
            <img src="{{ asset('images/gambar1.jpg') }}" alt="Konser C" class="concert-image">
            <div class="concert-body">
                <h2 class="concert-title">Live DJ Party C</h2>
                <p class="concert-info">📍 Surabaya</p>
                <p class="concert-info">📅 15 September 2025</p>
                <p class="concert-description">Malam seru dengan irama DJ terbaik! Lighting show spektakuler siap mengguncang suasana!</p>
                <a href="#" class="btn-ticket">Beli Tiket</a>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const cards = document.querySelectorAll('.concert-card');

        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase();

            cards.forEach(function (card) {
                const title = card.querySelector('.concert-title').textContent.toLowerCase();
                const location = card.querySelectorAll('.concert-info')[0].textContent.toLowerCase(); // lokasi
                const date = card.querySelectorAll('.concert-info')[1].textContent.toLowerCase(); // tanggal
                const description = card.querySelector('.concert-description').textContent.toLowerCase();

                const match = title.includes(query) || location.includes(query) || date.includes(query) || description.includes(query);

                card.style.display = match ? 'block' : 'none';
            });
        });
    });
</script>
@endsection

<style>
    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        justify-items: center;
        padding: 1rem 0;
    }

    @media (min-width: 1280px) {
        .card-grid {
            grid-template-columns: repeat(5, 1fr);
        }
    }
    
.btn-back {
    display: inline-block;
    background-color: #e0f2fe; /* biru muda */
    color: #0284c7; /* biru laut */
    font-weight: 600;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    text-decoration: none;
    margin-bottom: 1.5rem;
    transition: background-color 0.25s ease, color 0.25s ease;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.btn-back:hover {
    background-color: #bae6fd; /* lebih terang saat hover */
    color: #0369a1; /* sedikit lebih gelap */
}


    .concert-card {
        background-color: #ffffff;
        border-radius: 0.75rem;
        overflow: hidden;
        width: 100%;
        max-width: 280px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .concert-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .concert-image {
        width: 100%;
        height: 160px;
        object-fit: cover;
        border-bottom: 1px solid #e5e7eb;
    }

    .concert-body {
        padding: 1rem;
    }

    .concert-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 0.5rem;
    }

    .concert-info {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }

    .concert-description {
        font-size: 0.9rem;
        color: #374151;
        margin-top: 0.75rem;
        line-height: 1.4;
    }

    .btn-ticket {
        display: inline-block;
        margin-top: 0.75rem;
        background-color: #3b82f6;
        color: #ffffff;
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        border-radius: 0.5rem;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.25s ease;
    }

    .btn-ticket:hover {
        background-color: #2563eb;
    }
</style>
