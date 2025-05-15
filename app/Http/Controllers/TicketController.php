<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Endroid\QrCode\Builder\Builder;

class TicketController extends Controller
{
    public function buy(Request $request, Event $event)
    {
        // Simulasi data tiket
        $ticketInfo = "Tiket Event: " . $event->title . "\nWaktu: " . $event->date;

        // Generate QR Code
        $qrResult = Builder::create()
            ->data($ticketInfo)
            ->size(300)
            ->margin(10)
            ->build();

        // Simpan QR ke public/qr
        $filename = 'qr_' . $ticket->ticket_code . '.png';
    $qrPath = public_path('qr/' . $filename);
    file_put_contents($qrPath, $qrResult->getString());

        // Tampilkan view sukses (boleh diubah sesuai kebutuhan)
        return view('ticket.show', [
            'ticket' => $ticket,
            'qrPath' => asset('qr/' . $filename)
        ]);
    }
}
