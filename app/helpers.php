<?php

use Carbon\Carbon;
use App\Models\Sport;

function formatStats($stats)
{

    $stats['distance'] = round($stats['distance'] / 1000, 2);
    $stats['duration'] = round($stats['duration'], 0);
    unset($stats['avgSpeed']);
    unset($stats['avgPace']);

    return $stats;
}

function getDefaultName($startTime)
{
    $startHour = Carbon::parse($startTime)->hour;
    switch (true) {
        case in_array($startHour, range(0, 4)):
            return "Night activity";
            break;
        case in_array($startHour, range(5, 11)):
            return "Morning activity";
            break;
        case in_array($startHour, range(12, 16)):
            return "Afternoon activity";
            break;
        case in_array($startHour, range(17, 21)):
            return "Evening activity";
            break;
        case in_array($startHour, range(22, 24)):
            return "Night activity";
            break;
    }
}

function formatDuration($totalSeconds)
{
    $carbon = Carbon::createFromTimestamp($totalSeconds);
    $formattedDuration = sprintf('%d:%02d:%02d', $carbon->hour, $carbon->minute, $carbon->second);

    return $formattedDuration;
}

function getActivityDate($input)
{
    $startedAt = new Carbon($input);
    $date = $startedAt->format('d-M-Y');
    return $date;
    $startTime = $startedAt->format('H:i');
}

function getActivityStartTime($input)
{
    $startedAt = new Carbon($input);
    $startTime = $startedAt->format('H:i');
    return $startTime;
}

function setAvgPaceAccordingToSport($totalSeconds, $sportId, $distance)
{
    $sport = Sport::where('id', $sportId)->first();
    $carbon = Carbon::createFromTimestamp($totalSeconds);

    switch ($sport->name) {
        case 'Running':
            $secondsPerKilometer = $totalSeconds / $distance;
            $carbon = Carbon::createFromTimestamp($secondsPerKilometer);
            $runPace = ltrim($carbon->format('i:s'), 0);
            return $runPace . ' min/km';
            break;
        case 'Swimming':
            $secondsPer100m = $totalSeconds / $distance / 10;
            $carbon = Carbon::createFromTimestamp($secondsPer100m);
            $swimPace = ltrim($carbon->format('i:s'), 0);
            return $swimPace . ' min/100m';
            break;
        default:
            $speedKmPerHour = round(3600 * $distance / $totalSeconds, 1);
            return $speedKmPerHour . ' km/h';
            break;
    }
}
