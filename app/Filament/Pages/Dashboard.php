<?php

namespace App\Filament\Pages;

use App\Models\Leads;
use App\Providers\Filament\CustomerChart;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;

class Dashboard extends \Filament\Pages\Dashboard
{
    public function getWidgets(): array
    {
        return [
            CustomerChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('download_excel')
                ->label('Download Data Customer')
                ->color('success')
                ->icon('heroicon-o-document-arrow-down')
                ->action(function () {
                    $user = auth()->user();
                    $query = Leads::with('user')->where('status', 1);

                    if ($user->role === 'sales') {
                        $query->where('sales_id', $user->id);
                    }

                    $data = $query->select('sales_id', DB::raw('count(*) as total'))
                        ->groupBy('sales_id')
                        ->get();

                    // Membuat stream file CSV yang bisa langsung dibuka di Excel
                    return response()->streamDownload(function () use ($data) {
                        $handle = fopen('php://output', 'w');
                        fputcsv($handle, ['Nama Sales', 'Total Customer']); // Header kolom
                        
                        foreach ($data as $row) {
                            fputcsv($handle, [$row->user->name ?? 'Unknown', $row->total]);
                        }
                        
                        fclose($handle);
                    }, 'Data_Customer_Berlangganan.csv');
                }),
        ];
    }
}