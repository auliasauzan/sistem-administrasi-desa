<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id', 'certificate_number', 'area_size', 'location'
    ];

    public function owner()
    {
        return $this->belongsTo(Resident::class, 'owner_id');
    }
}
