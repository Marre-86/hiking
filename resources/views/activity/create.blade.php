@extends('layouts.main')

@push('scripts')
    <!-- For Tags input-->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@section('content')

<div class="w-30">

    <div class="card">
        <div class="card-header">
            <h3>Add activity</h3>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('activities.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                    </div>  
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-3 col-form-label">Price</label>
                    <div class="col-sm-9">
                        <input type="number" id="price" step="0.01" name="price" class="form-control" value="{{ old('price') }}">
                    </div>          
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    </div>          
                </div>
                <div class="form-group">
                    <label for="track_file" class="col-sm-3 col-form-label">Track file</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="track_file" name="track_file" value="" placeholder="">
                    </div>          
                </div>
                <div class="form-group">
                    <label for="image" class="col-sm-3 col-form-label">Image</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="image" name="image" value="" placeholder="">
                    </div>          
                </div>
                <div class="form-group">
                    <label for="tags" class="col-sm-3 col-form-label">Tags</label>
                    <div class="col-sm-9">
                        <select id="tags" name="tags[]" class="form-control" multiple>
                            @foreach ($tags as $tag)
                                <option>{{  $tag->name  }}</option>
                            @endforeach
                        </select>
                    </div>          
                </div>



                <div style="margin-top:20px">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#tags').select2({
        tags: true,
        tokenSeparators: [','],
    });
});
</script>
@endsection