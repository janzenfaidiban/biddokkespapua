<div class="form-group">
    <label for="sukuSelect">Suku</label>
    <select class="form-control {{ $errors->has('suku_id') ? 'is-invalid border-danger' : '' }}" id="sukuSelect" name="suku_id">
        <option value="" disabled {{ old('suku_id') == '' ? 'selected' : '' }}>Pilih suku</option>
        @foreach ($suku as $item)
            <option value="{{ $item->id }}" {{ old('suku_id', $anggota->suku_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->suku }} - {{ $item->keterangan }}
            </option>
        @endforeach
    </select>
    @error('suku_id')
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
        </span>
    @enderror
</div>
