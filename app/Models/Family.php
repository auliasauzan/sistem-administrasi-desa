<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = ['family_card_number', 'address', 'neighborhood'];

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
