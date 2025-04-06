<div class="form-group">
    <label for="hubunganKeluargaSelect">Hubungan Keluarga <sup class="text-danger">*</sup></label>
    <select class="form-control {{ $errors->has('hubungan_keluarga_id') ? 'is-invalid border-danger' : '' }}" id="hubunganKeluargaSelect" name="hubungan_keluarga_id">
        <option value="" disabled {{ old('hubungan_keluarga_id') == '' ? 'selected' : '' }}>Pilih hubungan keluarga</option>
        @foreach ($hubunganKeluarga as $item)
            <option value="{{ $item->id }}" {{ old('hubungan_keluarga_id', $anggota->hubungan_keluarga_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->hubungankeluarga }}
            </option>
        @endforeach
    </select>
    @error('hubungan_keluarga_id')
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
        </span>
    @enderror
</div>
