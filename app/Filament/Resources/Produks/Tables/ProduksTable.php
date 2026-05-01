<?php

namespace App\Filament\Resources\Produks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;

class ProduksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_produk')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('hpp')
                    ->label('HPP')
                    ->money('IDR', true)
                    ->sortable(),
                TextColumn::make('harga_jual')
                    ->label('Harga Jual')
                    ->money('IDR', true)
                    ->sortable(),
                TextColumn::make('margin_sales')
                    ->label('Margin Sales')
                    ->formatStateUsing(fn (string $state): string => ($state * 100) . '%')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('product deleted')
                            ->body('The product has been deleted successfully.'),
                    ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
