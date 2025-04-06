<div class="form-group">
    <label for="email"> Email</label>
    <input type="text" name="email" class="form-control {{ Request::segment(4) == 'detail' ? 'border-secondary border-bottom bg-light' : '' }}" value="{{ old('email', isset($anggota) ? $anggota->email : '') }}"  {{ Request::segment(4) == 'detail' ? 'disabled' : '' }}>
    
    @if ($errors->has('email'))
        <span class="text-danger" role="alert">
            <small class="pt-1 d-block"><i class="fe-alert-triangle mr-1"></i> {{ $errors->first('email') }}</small>
        </span>
    @endif

</div> <!-- form-group row-->