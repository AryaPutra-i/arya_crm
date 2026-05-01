<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use App\Models\Leads;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Auto-assign current user as project owner (sales)
        $data['user_id'] = auth()->id();

        // Calculate total harga from items
        $totalHarga = 0;
        $totalNegotiasi = 0;
        
        if (isset($data['items']) && is_array($data['items'])) {
            foreach ($data['items'] as $item) {
                $harga = $item['harga_dasar'] ?? 0;
                $qty = $item['quantity'] ?? 1;
                $totalHarga += $harga * $qty;
                
                if (isset($item['harga_negosiasi']) && $item['harga_negosiasi']) {
                    $totalNegotiasi += $item['harga_negosiasi'] * $qty;
                }
            }
        }

        $data['total_harga'] = $totalHarga;
        $data['total_harga_negosiasi'] = $totalNegotiasi ?: null;

        // Update lead status to customer
        if (isset($data['lead_id'])) {
            Leads::find($data['lead_id'])->update([
                'lead_status' => 'customer',
                'status' => 1, // Set status to 1 (sudah menjadi pelanggan)
            ]);
        }

        return $data;
    }
}
