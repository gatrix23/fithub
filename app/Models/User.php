<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'exp',
        'level',
    ];

    // Opsional: auto-update level berdasarkan exp
    public function setExpAttribute($value)
    {
        $this->attributes['exp'] = $value;
        $this->attributes['level'] = $this->calculateLevel($value);
    }

    protected function calculateLevel($exp)
    {
        // Skema level: 
        // Level 1: 0–99
        // Level 2: 100–249
        // Level 3: 250–499
        // Level 4: 500–899
        // Level 5: 900+
        if ($exp >= 900) return 5;
        if ($exp >= 500) return 4;
        if ($exp >= 250) return 3;
        if ($exp >= 100) return 2;
        return 1;
    }
}