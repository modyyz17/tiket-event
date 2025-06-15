<h2>Halo, {{ $tiket->name }}</h2>
<p>Berikut detail tiketmu:</p>

<ul>
    <li><strong>Event:</strong> {{ $tiket->event->title }}</li>
    <li><strong>Jumlah:</strong> {{ $tiket->quantity }}</li>
    <li><strong>Kode Tiket:</strong> {{ $tiket->ticket_code }}</li>
</ul>

<p>Terima kasih telah memesan tiket!</p>
