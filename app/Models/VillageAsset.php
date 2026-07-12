<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_code', 'name', 'quantity', 'condition', 'acquisition_date', 'location'
    ];

    protected $casts = [
        'acquisition_date' => 'date',
    ];
}
