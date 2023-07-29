@extends('layouts.main')
@section('content')

    <div class="w-60">
      <div class="card" style="margin-bottom:1rem; min-width:fit-content;">
        <div class="card-header">
            <h3>Your activities</h3>
        </div>
        @livewire('search-activities')
      </div>
    </div>
  
@endsection