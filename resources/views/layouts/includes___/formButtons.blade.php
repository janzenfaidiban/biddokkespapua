<div class="form-group mb-3">
    @if (Request::segment(5) == 'show')
    <a href="{{ route(''.Request::segment(1).'.'.Request::segment(2).'.'.Request::segment(3).'.edit', $data['id']) }}" class="btn btn-sm btn-primary waves-effect waves-light">
        <i class="fa fa-edit"></i> Edit
    </a>
    @else
    <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">
        <i class="fa fa-save"></i> Save
    </button>
    @endif
    <a href="{{ url('/'.Request::segment(1)) }}" class="btn btn-sm btn-outline-dark waves-effect waves-light">
        <i class="fa fa-reply"></i> Back
    </a>
</div>
