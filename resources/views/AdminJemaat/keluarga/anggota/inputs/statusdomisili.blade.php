<div class="form-group">
    <label for="statusDomisiliSelect">Status Domisili</label>
    <select class="form-control {{ $errors->has('status_domisili_id') ? 'is-invalid border-danger' : '' }}" id="statusDomisiliSelect" name="status_domisili_id">
        <option value="" disabled {{ old('status_domisili_id') == '' ? 'selected' : '' }}>Pilih status domisili</option>
        @foreach ($statusDomisili as $item)
            <option value="{{ $item->id }}" {{ old('status_domisili_id', $anggota->status_domisili_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->statusdomisili }}
            </option>
        @endforeach
    </select>
    @error('status_domisili_id')
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
        </span>
    @enderror
</div>