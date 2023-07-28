<div class="form-group row">
    <div class="create-form-sport">
        <select wire:model="sport" id="sport" name="sport" class="form-select" required>
            @foreach ($sports as $sport)
                <option value="{{ $sport->id }}">{{ $sport->name }}</option>
            @endforeach
        </select>
        <small class="form-text text-muted">Choose sport for activity</small>
    </div>
    <div class="create-form-sport">
        <select id="sportType" name="sportType" class="form-select">
            <option value=""></option>
            @foreach ($sportTypes as $sportType)
                <option value="{{ $sportType->id }}">{{ $sportType->name }}</option>
            @endforeach
        </select>
        <small class="form-text text-muted">Choose sport type for activity</small>
    </div>
</div>
