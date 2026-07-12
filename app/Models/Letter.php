<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id', 'letter_type_id', 'approved_by', 'status', 'note'
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function letterType()
    {
        return $this->belongsTo(LetterType::class);
    }

    public function approver()
    {
        return $this->belongsTo(VillageOfficial::class, 'approved_by');
    }
}
