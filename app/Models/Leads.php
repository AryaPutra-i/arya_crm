<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Leads extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'kebutuhan',
        'status',
        'sales_id',
        'customer_id',
        'lead_status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sales_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function project(): HasOne
    {
        return $this->hasOne(project::class, 'lead_id');
    }
}
