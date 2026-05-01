<?php

namespace App\Filament\Resources\Leads;

use App\Filament\Resources\Leads\Pages\CreateLeads;
use App\Filament\Resources\Leads\Pages\EditLeads;
use App\Filament\Resources\Leads\Pages\ListLeads;
use App\Filament\Resources\Leads\Schemas\LeadsForm;
use App\Filament\Resources\Leads\Tables\LeadsTable;
use App\Models\Leads;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LeadsResource extends Resource
{
    protected static ?string $model = Leads::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentArrowUp;

    protected static ?string $recordTitleAttribute = 'leads';

    public static function form(Schema $schema): Schema
    {
        return LeadsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LeadsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLeads::route('/'),
            'create' => CreateLeads::route('/create'),
            'edit' => EditLeads::route('/{record}/edit'),
        ];
    }
}
