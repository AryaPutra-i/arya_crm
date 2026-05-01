<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $fillable = [
        'nama_produk',
        'hpp',
        'harga_jual',
        'margin_sales',
    ];

    public static function booted(): void
    {
        // static::saving akan otomatis mendeteksi ketika ada proses Create ATAUPUN Update (Edit)
        static::saving(function ($produk) {
            if ($produk->hpp && $produk->margin_sales) {
                $produk->harga_jual = $produk->hpp + ($produk->hpp * $produk->margin_sales);
            }
        });
    }
}
