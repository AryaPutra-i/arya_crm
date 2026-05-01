<?php

namespace App\Filament\Resources\Produks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Get;
use Filament\Forms\Set;

class ProdukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_produk')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(255),
                TextInput::make('hpp')
                    ->label('HPP')
                    ->numeric()
                    ->required(),
                TextInput::make('margin_sales')
                    ->label('Margin Sales')
                    ->numeric()
                    ->required(),

            ]);
    }

    
}
