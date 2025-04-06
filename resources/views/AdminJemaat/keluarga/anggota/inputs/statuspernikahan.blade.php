<div class="form-group">
    <label for="statusPernikahanSelect">Status Pernikahan</label>
    <select class="form-control {{ $errors->has('status_pernikahan_id') ? 'is-invalid border-danger' : '' }}" id="statusPernikahanSelect" name="status_pernikahan_id">
        <option value="" disabled {{ old('status_pernikahan_id') == '' ? 'selected' : '' }}>Pilih status pernikahan</option>
        @foreach ($statusPernikahan as $item)
            <option value="{{ $item->id }}" {{ old('status_pernikahan_id', $anggota->status_pernikahan_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->statuspernikahan }}
            </option>
        @endforeach
    </select>
    @error('status_pernikahan_id')
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
        </span>
    @enderror
</div>