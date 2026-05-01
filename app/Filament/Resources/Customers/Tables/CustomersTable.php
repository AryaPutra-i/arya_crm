<?php

namespace App\Filament\Resources\Customers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kebutuhan')
                    ->label('Kebutuhan')
                    ->limit(50)
                    ->tooltip(fn (TextColumn $column): ?string => $column->getState()),
                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (int $state): string => $state === 1 ? 'Pelanggan' : 'Calon'),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->modifyQueryUsing(fn ($query) => $query->where('status', 1))
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
