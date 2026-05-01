<?php

namespace Database\Seeders;

use App\Models\Leads;
use App\Models\produk;
use App\Models\project;
use App\Models\ProjectItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sales = User::where('role', 'sales')->first();
        $leads = Leads::take(2)->get();

        if (!$sales || $leads->isEmpty()) {
            $this->command->info('Tidak ada data sales atau lead. Seeder project dibatalkan.');
            return;
        }

        // Memastikan ada data produk di database untuk diinput ke dalam item project
        $produk1 = produk::firstOrCreate(
            ['nama_produk' => 'Paket Internet 50Mbps'],
            ['hpp' => 200000, 'margin_sales' => 0.2] // harga_jual akan terisi otomatis via model event
        );

        $produk2 = produk::firstOrCreate(
            ['nama_produk' => 'Dedicated Internet 100Mbps'],
            ['hpp' => 500000, 'margin_sales' => 0.3]
        );

        // --- Project 1: Status Pending ---
        $project1 = project::create([
            'user_id' => $sales->id,
            'lead_id' => $leads[0]->id,
            'status' => 'waiting approval',
            'total_harga' => $produk1->harga_jual * 2, // 2 Quantity
            'total_harga_negosiasi' => ($produk1->harga_jual - 10000) * 2,
            'harga_status' => 'pending',
        ]);

        ProjectItem::create([
            'project_id' => $project1->id,
            'produk_id' => $produk1->id,
            'quantity' => 2,
            'harga_dasar' => $produk1->harga_jual,
            'harga_negosiasi' => $produk1->harga_jual - 10000,
        ]);

        $leads[0]->update(['lead_status' => 'customer', 'status' => 1]);

        // --- Project 2: Status Approved ---
        if (isset($leads[1])) {
            $project2 = project::create([
                'user_id' => $sales->id,
                'lead_id' => $leads[1]->id,
                'status' => 'approved',
                'total_harga' => $produk2->harga_jual * 1,
                'total_harga_negosiasi' => null, // Tidak ada negosiasi
                'harga_status' => 'approved',
            ]);

            ProjectItem::create([
                'project_id' => $project2->id,
                'produk_id' => $produk2->id,
                'quantity' => 1,
                'harga_dasar' => $produk2->harga_jual,
            ]);

            $leads[1]->update(['lead_status' => 'customer', 'status' => 1]);
        }
    }
}