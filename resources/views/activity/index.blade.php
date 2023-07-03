@extends('layouts.main')
@section('content')
    <div class="w-60">
      <div class="card" style="margin-bottom:1rem; min-width:fit-content;">
        <div class="card-header">
            <h3>Your activities</h3>
        </div>
        <div style="padding: 1rem 0.5rem 0 0.5rem">
          <table class="table table-hover">
            <thead>
                <tr class="text-center" >
                    <th scope="col">Date</th>
                    <th scope="col" style="width:25%">Name</th>
                    <th scope="col">Distance</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Avg. Pace</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 0; @endphp
                @foreach ($activities as $activity)
                    @php $class = $counter % 2 === 0 ? 'table-active' : 'table-default'; @endphp
                    <tr class="{{ $class }} text-center" onclick="if (!event.target.closest('a')) { window.location='{{ route('activities.show', $activity) }}'; }" style="cursor: pointer; vertical-align:middle;">
                        <td>{{ $activity->date }}</td>
                        <td>{{ $activity->name }}</td>
                        <td>{{ $activity->distance }} km</td>
                        <td>{{ $activity->duration }}</td>
                        <td>{{ $activity->avgPace }}</td>
                    </tr>
                    @php $counter++; @endphp
                @endforeach
            </tbody>
          </table>
          {{ $activities->links() }}
        </div>
      </div>
    </div>
@endsection