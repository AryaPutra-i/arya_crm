<?php

namespace App\Filament\Resources\Leads\Pages;

use App\Filament\Resources\Leads\LeadsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLeads extends CreateRecord
{
    protected static string $resource = LeadsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Auto-assign current user as sales_id
        $data['sales_id'] = auth()->id();
        
        return $data;
    }
}
