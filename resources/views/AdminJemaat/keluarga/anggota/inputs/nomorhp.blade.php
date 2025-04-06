<div class="form-group">
    <label for="nomor_hp"> Nomor HP</label>
    <input type="text" name="nomor_hp" class="form-control {{ Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : '' }}" value="{{ old('nomor_hp', isset($anggota) ? $anggota->nomor_hp : '') }}"  {{ Request::segment(4) == 'detail' ? 'disabled' : '' }}>
    
    @if ($errors->has('nomor_hp'))
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $errors->first('nomor_hp') }}</small>
        </span>
    @endif

</div> <!-- form-group row-->