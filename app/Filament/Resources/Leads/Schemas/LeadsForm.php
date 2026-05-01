<?php

namespace App\Filament\Resources\Leads\Schemas;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;


use Filament\Schemas\Schema;

class LeadsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label('Phone')
                    ->tel()
                    ->nullable(),
                Textarea::make('kebutuhan')
                    ->label('Kebutuhan')
                    ->nullable()
                    ->rows(4),
                
            ]);
    }
}
