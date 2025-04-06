<div class="form-group">
    <label for="statusBaptisSelect">Status Baptis</label>
    <select class="form-control {{ $errors->has('status_baptis_id') ? 'is-invalid border-danger' : '' }}" id="statusBaptisSelect" name="status_baptis_id">
        <option value="" disabled {{ old('status_baptis_id') == '' ? 'selected' : '' }}>Pilih status baptis</option>
        @foreach ($statusBaptis as $item)
            <option value="{{ $item->id }}" {{ old('status_baptis_id', $anggota->status_baptis_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->statusbaptis }}
            </option>
        @endforeach
    </select>
    @error('status_baptis_id')
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
        </span>
    @enderror
</div>