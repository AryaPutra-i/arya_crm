<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class leadseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('leads')->insert([
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@contoh.com',
                'phone' => '081234567890',
                'kebutuhan' => 'Paket Internet 50Mbps',
                'status' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti.aminah@contoh.com',
                'phone' => '081298765432',
                'kebutuhan' => 'Paket Internet 100Mbps',
                'status' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Andi Wijaya',
                'email' => 'andi.wijaya@contoh.com',
                'phone' => '085711223344',
                'kebutuhan' => 'Dedicated Internet 20Mbps',
                'status' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Rina Melati',
                'email' => 'rina.melati@contoh.com',
                'phone' => '081344556677',
                'kebutuhan' => 'Paket Internet 50Mbps',
                'status' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Joko Susilo',
                'email' => 'joko.susilo@contoh.com',
                'phone' => '081999888777',
                'kebutuhan' => 'Paket Internet 100Mbps',
                'status' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Maya Sari',
                'email' => 'maya.sari@contoh.com',
                'phone' => '087812312312',
                'kebutuhan' => 'Paket Broadband 20Mbps',
                'status' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Hendra Setiawan',
                'email' => 'hendra.setiawan@contoh.com',
                'phone' => '081122223333',
                'kebutuhan' => 'Dedicated Internet 50Mbps',
                'status' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Putri Pertiwi',
                'email' => 'putri.pertiwi@contoh.com',
                'phone' => '085677778888',
                'kebutuhan' => 'Paket Internet 50Mbps',
                'status' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Agus Pratama',
                'email' => 'agus.pratama@contoh.com',
                'phone' => '082233445566',
                'kebutuhan' => 'Paket Internet 100Mbps',
                'status' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@contoh.com',
                'phone' => '089911112222',
                'kebutuhan' => 'Paket Broadband 20Mbps',
                'status' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
