<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id', 'handled_by', 'title', 'description', 'photo_url', 'status'
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }

    public function handler()
    {
        return $this->belongsTo(VillageOfficial::class, 'handled_by');
    }
}
