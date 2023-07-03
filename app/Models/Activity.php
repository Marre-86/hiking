<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'track_file', 'distance', 'avgSpeed', 'avgPace', 'minAltitude', 'maxAltitude',
        'cumulativeElevationGain', 'cumulativeElevationLoss', 'startedAt', 'duration',
        'description'
    ];

    public function created_by()            // phpcs:ignore
    {
        return $this->belongsTo('App\Models\User');
    }
}
