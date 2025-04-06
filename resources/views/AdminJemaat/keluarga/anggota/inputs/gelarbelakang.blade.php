<div class="form-group">
    <label for="gelarBelakangSelect">Gelar Belakang</label>
    <select class="form-control {{ $errors->has('gelar_belakang_id') ? 'is-invalid border-danger' : '' }}" id="gelarBelakangSelect" name="gelar_belakang_id">
        <option value="" disabled {{ old('gelar_belakang_id') == '' ? 'selected' : '' }}>Pilih gelar belakang</option>
        @foreach ($gelarBelakang as $item)
            <option value="{{ $item->id }}" {{ old('gelar_belakang_id', $anggota->gelar_belakang_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->gelarbelakang }} - {{ $item->keterangan }}
            </option>
        @endforeach
    </select>
    @error('gelar_belakang_id')
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
        </span>
    @enderror
</div>