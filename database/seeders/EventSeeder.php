<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run()
    {
        Event::create([
            'title' => 'Seminar Nasional Pemuda',
            'location' => 'Jakarta',
            'date' => '2025-07-20',
            'price' => 45000.00,
            'description' => 'Seminar inspiratif bersama tokoh nasional.',
            'category' => 'seminar',
        ]);

        Event::create([
            'title' => 'Konser Musik Asik',
            'location' => 'Bandung',
            'date' => '2025-08-01',
            'price' => 45000.00,
            'description' => 'Konser seru bareng band indie populer.',
            'category' => 'konser',
        ]);

        Event::create([
            'title' => 'Pameran Seni Nusantara',
            'location' => 'Yogyakarta',
            'date' => '2025-09-10',
            'price' => 45000.00,
            'description' => 'Pameran karya seniman lokal dan nasional.',
            'category' => 'pameran',
        ]);

        Event::create([
            'title' => 'Game Show Edukasi',
            'location' => 'Surabaya',
            'date' => '2025-10-05',
            'price' => 45000.00,
            'description' => 'Seru-seruan sambil belajar bareng komunitas.',
            'category' => 'gameshow',
        ]);
    }
}
