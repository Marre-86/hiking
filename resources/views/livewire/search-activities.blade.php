<div style="padding: 1rem 0.5rem 0 0.5rem">

    <div class="row mb-3">
        <div class="search-activities">
            <input wire:model="searchActivityName" class="form-control" type="search" placeholder="Search activities...">
            <small class="form-text text-muted">Search by activity name</small>
        </div>
        <div class="search-activities">        
            <select wire:model="searchTag1" class="form-select" required>
            <option value="">Search tags...</option>
            @foreach ($tags as $tag)
                <option value="{{ $tag->name }}">{{ $tag->name }}</option>
            @endforeach
            </select>
            <small class="form-text text-muted">Search by tag 1</small>
        </div>
        <div class="search-activities">
            <select wire:model="searchTag2" class="form-select" required>
            <option value="">Search tags...</option>
            @foreach ($tags as $tag)
                <option value="{{ $tag->name }}">{{ $tag->name }}</option>
            @endforeach
            </select>
            <small class="form-text text-muted" >Search by tag 2</small>
        </div>
    </div>


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