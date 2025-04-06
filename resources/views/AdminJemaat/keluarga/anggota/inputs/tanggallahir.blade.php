<div class="form-group">
    <label for="tanggal_lahir">Tanggal Lahir <sup class="text-danger">*</sup></label>
    <input type="date" name="tanggal_lahir" class="form-control {{ Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : '' }}" value="{{ old('tanggal_lahir', isset($anggota) ? $anggota->tanggal_lahir : '') }}" {{ Request::segment(4) == 'detail' ? 'disabled' : '' }}>
    
    @if ($errors->has('tanggal_lahir'))
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $errors->first('tanggal_lahir') }}</small>
        </span>
    @endif
</div> <!-- form-group -->