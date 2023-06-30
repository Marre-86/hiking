<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'track_file', 'distance', 'avgSpeed', 'avgPace', 'minAltitude', 'maxAltitude',
        'cumulativeElevationGain', 'cumulativeElevationLoss', 'startedAt', 'finishedAt'
    ];
}
