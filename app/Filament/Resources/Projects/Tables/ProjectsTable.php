<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('leads.name')
                    ->label('Lead / Customer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Sales')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('total_harga')
                    ->label('Total Harga Dasar')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_harga_negosiasi')
                    ->label('Total Harga Negosiasi')
                    ->numeric()
                    ->sortable(),
                BadgeColumn::make('harga_status')
                    ->label('Approval Harga')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state)),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->modifyQueryUsing(function ($query) {
                $user = auth()->user();
                
                // Sales hanya melihat project mereka sendiri
                if ($user && $user->role === 'sales') {
                    $query->where('user_id', $user->id);
                }
            })
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
