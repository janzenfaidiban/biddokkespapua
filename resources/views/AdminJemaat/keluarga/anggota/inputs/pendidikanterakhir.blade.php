<div class="form-group">
    <label for="pendidikanTerakhirSelect">Pendidikan Terakhir</label>
    <select class="form-control {{ $errors->has('pendidikan_terakhir_id') ? 'is-invalid border-danger' : '' }}" id="pendidikanTerakhirSelect" name="pendidikan_terakhir_id">
        <option value="" disabled {{ old('pendidikan_terakhir_id') == '' ? 'selected' : '' }}>Pilih pendidikan terakhir</option>
        @foreach ($pendidikanTerakhir as $item)
            <option value="{{ $item->id }}" {{ old('pendidikan_terakhir_id', $anggota->pendidikan_terakhir_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->pendidikanterakhir }} - {{ $item->keterangan }}
            </option>
        @endforeach
    </select>
    @error('pendidikan_terakhir_id')
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
        </span>
    @enderror
</div>
