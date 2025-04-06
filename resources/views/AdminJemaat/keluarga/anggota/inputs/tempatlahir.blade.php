<div class="form-group">
    <label for="tempat_lahir">Tempat Lahir <sup class="text-danger">*</sup></label>
    <input type="text" name="tempat_lahir" class="form-control {{ Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : '' }}" value="{{ old('tempat_lahir', isset($anggota) ? $anggota->tempat_lahir : '') }}" {{ Request::segment(4) == 'detail' ? 'disabled' : '' }}>

    @if ($errors->has('tempat_lahir'))
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $errors->first('tempat_lahir') }}</small>
        </span>
    @endif
</div> <!-- form-group -->