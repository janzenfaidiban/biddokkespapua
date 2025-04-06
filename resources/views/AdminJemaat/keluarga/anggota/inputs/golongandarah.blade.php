<div class="form-group">
    <label for="golonganDarahSelect">Golongan Darah</label>
    <select class="form-control {{ $errors->has('golongan_darah_id') ? 'is-invalid border-danger' : '' }}" id="golonganDarahSelect" name="golongan_darah_id">
        <option value="" disabled {{ old('golongan_darah_id') == '' ? 'selected' : '' }}>Pilih golongan darah</option>
        @foreach ($golonganDarah as $item)
            <option value="{{ $item->id }}" {{ old('golongan_darah_id', $anggota->golongan_darah_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->golongandarah }}
            </option>
        @endforeach
    </select>
    @error('golongan_darah_id')
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
        </span>
    @enderror
</div>