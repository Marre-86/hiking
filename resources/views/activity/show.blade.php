@extends('layouts.main')

@push('scripts')
    <!-- For Leaflet-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    <!-- leaflet-elevation -->
    <link rel="stylesheet" href="https://unpkg.com/@raruto/leaflet-elevation/dist/leaflet-elevation.css" />
    <script src="https://unpkg.com/@raruto/leaflet-elevation/dist/leaflet-elevation.js"></script>
@endpush

@section('content')
    <div class="w-100">
        <p>Show given activity page</p>
        <div style="float:left">
            @if ($activity->track_file)
                <div id="map" data-track-file="{{ $activity->track_file }}"></div>
            @else
                <p>No track for this activity</p>
            @endif
        </div>
        @if ($activity->track_file)
            <ul class="list-group" style="float:left; margin-left:2rem;">
                <li class="list-group-item d-flex align-items-baseline">
                    Distance<span class="fs-4 text-primary" style="margin:0 5px 0 10px;">{{ $activity->distance }}</span>m
                </li>
                <li class="list-group-item d-flex align-items-baseline">
                    Average Speed<span class="fs-4 text-primary" style="margin:0 5px 0 10px;">{{ $activity->avgSpeed }}</span>
                </li>
                <li class="list-group-item d-flex align-items-baseline">
                    Average Pace<span class="fs-4 text-primary" style="margin:0 5px 0 10px;">{{  $activity->avgPace }}</span>
                </li>
                <li class="list-group-item d-flex align-items-baseline">
                    Min Altitude<span class="fs-4 text-primary" style="margin:0 5px 0 10px;">{{  $activity->minAltitude }}</span>m
                </li>
                <li class="list-group-item d-flex align-items-baseline">
                    Max Altitude<span class="fs-4 text-primary" style="margin:0 5px 0 10px;">{{  $activity->maxAltitude }}</span>m
                </li>
                <li class="list-group-item d-flex align-items-baseline">
                    Elevation Gain<span class="fs-4 text-primary" style="margin:0 5px 0 10px;">{{  $activity->cumulativeElevationGain }}</span>m
                </li>
                <li class="list-group-item d-flex align-items-baseline">
                    Elevation Loss<span class="fs-4 text-primary" style="margin:0 5px 0 10px;">{{  $activity->cumulativeElevationLoss }}</span>m
                </li>
                <li class="list-group-item d-flex align-items-baseline">
                    Started At<span class="fs-4 text-primary" style="margin:0 0 0 10px;">{{  $activity->startedAt }}</span>
                </li>
                <li class="list-group-item d-flex align-items-baseline">
                    Finished At<span class="fs-4 text-primary" style="margin:0 0 0 10px;">{{  $activity->finishedAt }}</span>
                </li>
            </ul>
        @endif
    </div>
@endsection