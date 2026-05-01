<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class project extends Model
{
    protected $fillable = [
        'user_id',
        'lead_id',
        'status',
        'total_harga',
        'total_harga_negosiasi',
        'harga_status',
        'harga_notes',
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
        'total_harga_negosiasi' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function leads(): BelongsTo
    {
        return $this->belongsTo(Leads::class, 'lead_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(ProjectItem::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'lead_id', 'lead_id');
    }

    public function calculateTotalHarga()
    {
        return $this->items->sum(function ($item) {
            return ($item->harga_negosiasi ?? $item->harga_dasar) * $item->quantity;
        });
    }
}
