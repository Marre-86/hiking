<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function activities()
    {
        return $this->hasMany('App\Models\Activity', 'sport_id');
    }

    public function sport_types()            // phpcs:ignore
    {
        return $this->hasMany('App\Models\Activity', 'sport_id');
    }
}
