<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Automatic Machine',
            'Akses Kontrol',
            'GPS Tracker',
            'Software Parkir',
            'Automatic Gate',
            'Periferal',
            'Paket Alat Parkir',
            'Paket Turnstile Gate',
            'Peralatan Parkir',
            'Wilayah',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name
            ]);
        }
    }
}
