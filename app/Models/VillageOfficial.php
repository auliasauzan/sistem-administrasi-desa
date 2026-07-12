<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillageOfficial extends Model
{
    protected $fillable = ['user_id', 'position', 'employee_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
