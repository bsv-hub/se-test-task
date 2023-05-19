<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'guid';
    protected $fillable = [
        'guid',
        'value',
        'product_guid',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}