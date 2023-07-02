<?php

use Carbon\Carbon;

function formatStats($stats)
{

    $stats['distance'] = round($stats['distance'] / 1000, 2);
    $stats['avgSpeed'] = round($stats['avgSpeed'] * 3.6, 1);
    $stats['avgPace'] = ltrim(Carbon::createFromTimestamp($stats['avgPace'])->format('i:s'), 0);

    $startTime = new Carbon($stats['startedAt']);
    $finishTime = new Carbon($stats['finishedAt']);
    $diff = $startTime->diff($finishTime);
    $stats['duration'] = sprintf('%d:%02d:%02d', $diff->h, $diff->i, $diff->s);

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
