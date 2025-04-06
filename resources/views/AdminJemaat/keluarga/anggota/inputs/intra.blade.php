<div class="form-group">
    <label for="intraSelect">Intra</label>
    <select class="form-control {{ $errors->has('intra_id') ? 'is-invalid border-danger' : '' }}" id="intraSelect" name="intra_id">
        <option value="" disabled {{ old('intra_id') == '' ? 'selected' : '' }}>Pilih intra</option>
        @foreach ($intra as $item)
            <option value="{{ $item->id }}" {{ old('intra_id', $anggota->intra_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->intra }}
            </option>
        @endforeach
    </select>
    @error('intra_id')
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $message }}</small>
        </span>
    @enderror
</div>