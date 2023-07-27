<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function activities()
    {
        return $this->hasMany('App\Models\Activity', 'sport_type_id');
    }

    public function sport()
    {
        return $this->belongsTo('App\Models\Sport');
    }
}
