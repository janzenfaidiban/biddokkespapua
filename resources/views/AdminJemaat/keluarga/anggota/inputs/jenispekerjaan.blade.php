<div class="form-group">
    <label for="jenisPekerjaanSelect">Jenis Pekerjaan</label>
    <select class="form-control {{ $errors->has('jenis_pekerjaan_id') ? 'is-invalid border-danger' : '' }}" id="jenisPekerjaanSelect" name="jenis_pekerjaan_id">
        <option value="" disabled {{ old('jenis_pekerjaan_id') == '' ? 'selected' : '' }}>Pilih jenis pekerjaan</option>
        @foreach ($jenisPekerjaan as $item)
            <option value="{{ $item->id }}" {{ old('jenis_pekerjaan_id', $anggota->jenis_pekerjaan_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->jenispekerjaan }} - {{ $item->keterangan }}
            </option>
        @endforeach
    </select>
    @error('jenis_pekerjaan_id')
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
        </span>
    @enderror
</div>