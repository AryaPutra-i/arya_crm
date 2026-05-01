<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('approve')
                ->label('Approve')
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['harga_status' => 'approved']);
                    Notification::make()
                        ->success()
                        ->title('Harga Berhasil Disetujui')
                        ->send();
                })
                ->visible(fn () => $this->record->harga_status !== 'approved'),
            
            Action::make('reject')
                ->label('Reject')
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->form([
                    Textarea::make('harga_notes')
                        ->label('Alasan Penolakan')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $this->record->update([
                        'harga_status' => 'rejected',
                        'harga_notes' => $data['harga_notes'],
                    ]);
                    Notification::make()
                        ->success()
                        ->title('Harga Ditolak')
                        ->send();
                })
                ->visible(fn () => $this->record->harga_status !== 'rejected'),

            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
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

        // If price negotiation exists and status changes to approved, show notification
        if ($totalNegotiasi && $data['harga_status'] === 'approved' && $this->record->harga_status !== 'approved') {
            Notification::make()
                ->success()
                ->title('Harga Disetujui!')
                ->body("Harga negosiasi sebesar Rp" . number_format($totalNegotiasi, 0, ',', '.') . " telah disetujui.")
                ->send();
        }

        return $data;
    }
}
