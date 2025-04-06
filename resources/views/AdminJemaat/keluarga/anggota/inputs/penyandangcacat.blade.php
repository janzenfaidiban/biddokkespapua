<div class="form-group">
    <label for="penyandangCacatSelect">Penyandang Cacat</label>
    <select class="form-control {{ $errors->has('penyandang_cacat_id') ? 'is-invalid border-danger' : '' }}" id="penyandangCacatSelect" name="penyandang_cacat_id">
        <option value="" disabled {{ old('penyandang_cacat_id') == '' ? 'selected' : '' }}>Pilih status penyandang cacat</option>
        @foreach ($penyandangCacat as $item)
            <option value="{{ $item->id }}" {{ old('penyandang_cacat_id', $anggota->penyandang_cacat_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->penyandangcacat }} - {{ $item->keterangan }}
            </option>
        @endforeach
    </select>
    @error('penyandang_cacat_id')
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
        </span>
    @enderror
</div>