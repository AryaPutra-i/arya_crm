<?php

namespace App\Providers\Filament;

use App\Models\Leads;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class CustomerChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Customer Berlangganan per Sales';
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $user = auth()->user();

        $query = Leads::with('user')
            ->where('status', 1) // status 1 = sudah menjadi pelanggan
            ->select('sales_id', DB::raw('count(*) as total'))
            ->groupBy('sales_id');

        // Membatasi query jika user adalah sales
        if ($user && $user->role === 'sales') {
            $query->where('sales_id', $user->id);
        }

        $results = $query->get();

        $labels = [];
        $data = [];

        foreach ($results as $row) {
            // Mengambil nama sales dari relasi user
            $labels[] = $row->user->name ?? 'Unknown';
            $data[] = $row->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Customer',
                    'data' => $data,
                    'backgroundColor' => ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
