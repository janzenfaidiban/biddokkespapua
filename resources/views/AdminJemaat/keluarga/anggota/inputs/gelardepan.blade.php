<div class="form-group">
    <label for="gelarDepanSelect">Gelar Depan</label>
    <select class="form-control {{ $errors->has('gelar_depan_id') ? 'is-invalid border-danger' : '' }}" id="gelarDepanSelect" name="gelar_depan_id">
        <option value="" disabled {{ old('gelar_depan_id') == '' ? 'selected' : '' }}>Pilih gelar depan</option>
        @foreach ($gelarDepan as $item)
            <option value="{{ $item->id }}" {{ old('gelar_depan_id', $anggota->gelar_depan_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->gelardepan }} - {{ $item->keterangan }}
            </option>
        @endforeach
    </select>
    @error('gelar_depan_id')
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
        </span>
    @enderror
</div>