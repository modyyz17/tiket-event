@extends('layouts.app')

@section('content')
@if(session('success'))
  <div style="max-width:480px; margin: 20px auto; padding: 12px; background-color: #d1fae5; color: #065f46; border-radius: 8px; text-align:center;">
    {{ session('success') }}
  </div>
@endif

<style>
 body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f3f4f6;
    color: #374151;
    margin: 0;
    padding: 0;
  }

  .container {
    max-width: 480px;
    margin: 40px auto;
    background-color: #fff;
    padding: 24px 32px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    border-radius: 12px;
  }

  h2 {
    color: #ca8a04; /* kuning cerah */
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 20px;
    text-align: center;
  }

  p {
    font-size: 16px;
    line-height: 1.5;
  }

  .info-box {
    background-color: #f9fafb; /* abu muda */
    border-radius: 8px;
    padding: 16px 20px;
    margin-bottom: 24px;
    box-sizing: border-box;
  }

  .info-box p {
    margin: 6px 0;
  }

  .info-box strong {
    color: #111827;
  }

  .status-yellow {
    color: #ca8a04;
    font-weight: 700;
  }

  .status-green {
    color: #16a34a;
    font-weight: 700;
  }

  .status-red {
    color: #dc2626;
    font-weight: 700;
  }

  .payment-method {
    background-color: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 18px 24px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
  }

  .payment-method h3 {
    font-weight: 700;
    font-size: 18px;
    margin-bottom: 14px;
  }

  ul {
    padding-left: 20px;
    margin-top: 8px;
    margin-bottom: 0;
  }

  ul li {
    margin-bottom: 6px;
    font-size: 15px;
  }

  img.qris {
    display: block;
    margin: 0 auto;
    width: 190px;
    margin-top: 12px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  .footer-note {
    text-align: center;
    margin-top: 30px;
    font-size: 14px;
    color: #6b7280;
  }

  form.upload-form {
    margin-top: 30px;
  }

  form.upload-form label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
  }

  form.upload-form input[type="file"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    margin-bottom: 14px;
  }

  form.upload-form button {
    background-color: #ca8a04;
    color: white;
    font-weight: 700;
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    width: 100%;
  }

  #countdown {
    text-align: center;
    margin-top: 12px;
    font-weight: 700;
    color: #dc2626;
  }
</style>

<div class="container">
    <h2>🔁 Menunggu Pembayaran</h2>

    <p>Pesanan tiket kamu telah dibuat. Silakan lakukan pembayaran untuk menyelesaikan pemesanan.</p>

    <div class="info-box">
        @php
          $statusColors = [
            'pending' => 'status-yellow',
            'confirmed' => 'status-green',
            'expired' => 'status-red',
          ];
          $statusClass = $statusColors[$tiket->status] ?? 'status-yellow';
        @endphp
        <p><strong>Nama:</strong> {{ $tiket->name }}</p>
        <p><strong>Event:</strong> {{ $tiket->event->title }}</p>
        <p><strong>Jumlah Tiket:</strong> {{ $tiket->quantity }}</p>
        <p><strong>Total Bayar:</strong> Rp{{ number_format($tiket->total_price, 0, ',', '.') }}</p>
        <p><strong>Status:</strong> <span class="{{ $statusClass }}">{{ ucfirst($tiket->status) }}</span></p>
        <p><strong>Kode Tiket:</strong> {{ $tiket->ticket_code }}</p>
        <p><strong>Bayar Sebelum:</strong> {{ \Carbon\Carbon::parse($tiket->payment_expire_at)->translatedFormat('l, d M Y H:i') }}</p>
    </div>

    <div class="payment-method">
        <h3>🔐 Metode Pembayaran: {{ strtoupper($tiket->payment_method) }}</h3>

        @if ($tiket->payment_method === 'bank_transfer')
            <p>Silakan transfer ke rekening:</p>
            <ul>
                <li><strong>BCA</strong>: 1234567890 a.n PT Event Keren</li>
                <li><strong>Mandiri</strong>: 0987654321 a.n PT Event Keren</li>
            </ul>
        @elseif ($tiket->payment_method === 'qris')
            <p>Silakan scan QRIS berikut untuk membayar:</p>
            <img src="{{ asset('images/qris.png') }}" alt="QRIS" class="qris">
        @elseif ($tiket->payment_method === 'ewallet')
            <p>Silakan kirim ke salah satu dompet digital berikut:</p>
            <ul>
                <li><strong>Gopay</strong>: 0812-3456-7890</li>
                <li><strong>OVO</strong>: 0812-0000-1111</li>
                <li><strong>DANA</strong>: 0856-8888-9999</li>
            </ul>
        @endif
    </div>

    @if ($tiket->status === 'pending')
    <form action="{{ route('tiket.confirm_payment', $tiket->id) }}" method="POST" enctype="multipart/form-data" class="upload-form">
        @csrf
        <label for="payment_proof">Upload Bukti Pembayaran</label>
        <input type="file" name="payment_proof" id="payment_proof" required accept="image/jpeg,image/png,application/pdf" />
        
        @if ($errors->has('payment_proof'))
          <div style="color: #dc2626; font-size: 14px; margin-bottom: 10px;">
            {{ $errors->first('payment_proof') }}
          </div>
        @endif

        <button type="submit">Konfirmasi Pembayaran</button>
    </form>
    @endif

    <div id="countdown"></div>

    <div class="footer-note">
        <p>Setelah kamu membayar, tiketmu akan dikonfirmasi secara otomatis atau manual oleh admin.</p>

        <div style="margin-top: 24px; text-align: center;">
            <a href="{{ route('tiket.my') }}"
               style="background-color:#2563eb; color:white; padding: 12px 20px; border-radius: 8px; text-decoration:none;">
                🎫 Lihat Tiket Saya
            </a>

            <a href="{{ route('dashboard') }}"
               style="margin-left: 10px; background-color:#f3f4f6; color:#1f2937; padding: 12px 20px; border-radius: 8px; text-decoration:none;">
                🏠 Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<script>
  let expireTime = new Date("{{ $tiket->payment_expire_at }}").getTime();

  let countdown = setInterval(function() {
    let now = new Date().getTime();
    let distance = expireTime - now;

    if (distance < 0) {
      clearInterval(countdown);
      document.getElementById("countdown").innerHTML = "Waktu pembayaran sudah habis.";
    } else {
      let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      let seconds = Math.floor((distance % (1000 * 60)) / 1000);
      document.getElementById("countdown").innerHTML =
        "Batas pembayaran: " + hours + "j " + minutes + "m " + seconds + "s";
    }
  }, 1000);
</script>
@endsection
