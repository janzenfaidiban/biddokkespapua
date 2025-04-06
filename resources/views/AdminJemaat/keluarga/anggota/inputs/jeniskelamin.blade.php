<div class="form-group">
    <label for="jenisKelaminSelect">Jenis Kelamin <sup class="text-danger">*</sup></label>
    <select class="form-control {{ $errors->has('jenis_kelamin') ? 'is-invalid border-danger' : '' }}" id="jenisKelaminSelect" name="jenis_kelamin">
        <option value="" disabled {{ old('jenis_kelamin') == '' ? 'selected' : '' }}>Pilih jenis kelamin</option>
        <option value="Laki-Laki" {{ old('jenis_kelamin', $anggota->jenis_kelamin ?? '') == 'Laki-Laki' ? 'selected' : '' }}>
                Laki-Laki
        </option>
        <option value="Perempuan" {{ old('jenis_kelamin', $anggota->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>
                Perempuan
        </option>

    </select>
    @error('jenis_kelamin')
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
        </span>
    @enderror
</div>

