<?php

namespace App\Filament\Resources\Leads\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
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
                TextColumn::make('user.name')
                    ->label('Sales')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->modifyQueryUsing(function ($query) {
                $user = auth()->user();
                
                // If user is a sales person, only show their leads
                if ($user && $user->role === 'sales') {
                    $query->where('sales_id', $user->id);
                }
                
                // Filter by status 0 (belum menjadi pelanggan)
                return $query->where('status', 0);
            })
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('User deleted')
                            ->body('The user has been deleted successfully.'),
                    ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
