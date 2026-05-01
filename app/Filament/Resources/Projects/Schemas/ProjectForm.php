<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\Leads;
use App\Models\produk;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Filament\Schemas\Schema;


class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Project Name')
                    ->required()
                    ->maxLength(255),
                Select::make('lead_id')
                    ->label('Lead / Customer')
                    ->options(Leads::pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Textarea::make('description')
                    ->label('Description')
                    ->nullable()
                    ->rows(4),
                Repeater::make('items')
                    ->label('Project Items')
                    ->schema([
                        Select::make('produk_id')
                            ->label('Produk')
                            ->options(produk::pluck('nama_produk', 'id'))
                            ->searchable()
                            ->required(),
                        TextInput::make('quantity')
                            ->label('Quantity')
                            ->numeric()
                            ->required(),       
                        TextInput::make('harga_dasar')
                            ->label('Harga Dasar')
                            ->numeric()
                            ->required(),
                    ]),
            ]);
    }
}
