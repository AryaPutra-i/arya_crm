<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectItem extends Model
{
    protected $fillable = [
        'project_id',
        'produk_id',
        'quantity',
        'harga_dasar',
        'harga_negosiasi',
    ];

    protected $casts = [
        'harga_dasar' => 'decimal:2',
        'harga_negosiasi' => 'decimal:2',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(project::class);
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(produk::class);
    }

    public function getHargaTotalAttribute()
    {
        return ($this->harga_negosiasi ?? $this->harga_dasar) * $this->quantity;
    }
}
