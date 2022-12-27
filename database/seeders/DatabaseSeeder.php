<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
use App\Models\Pembeli;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Barang::create([
            'nm_barang' => 'Sabun Detol',
            'harga' => 5000,
            'stok' => 100,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Barang::create([
            'nm_barang' => 'Pepsodent',
            'harga' => 7000,
            'stok' => 100,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Barang::create([
            'nm_barang' => 'Shampo Lifebuoy',
            'harga' => 10000,
            'stok' => 100,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Pembeli::create([
            'nama' => 'Budi',
            'saldo' => 200000,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Pembeli::create([
            'nama' => 'Udin',
            'saldo' => 200000,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
