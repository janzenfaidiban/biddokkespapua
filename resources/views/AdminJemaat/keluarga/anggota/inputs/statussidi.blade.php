<div class="form-group">
    <label for="statusSidiSelect">Status Sidi</label>
    <select class="form-control {{ $errors->has('status_sidi_id') ? 'is-invalid border-danger' : '' }}" id="statusSidiSelect" name="status_sidi_id">
        <option value="" disabled {{ old('status_sidi_id') == '' ? 'selected' : '' }}>Pilih status sidi</option>
        @foreach ($statusSidi as $item)
            <option value="{{ $item->id }}" {{ old('status_sidi_id', $anggota->status_sidi_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->statussidi }}
            </option>
        @endforeach
    </select>
    @error('status_sidi_id')
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
        </span>
    @enderror
</div>