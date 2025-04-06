@if (Auth::user()->hasRole('adminmaster'))
    @if (Request::segment(3))
    <div class="mb-3">
        <a href="{{ route(Request::segment(1).'.'.Request::segment(2).'.'.Request::segment(3).'.create')  }}" class="btn btn-sm btn-primary waves-effect waves-light">
            <i class="fa fa-plus"></i> Create
        </a>
    </div>
    @else
    <div class="mb-3">
        <a href="{{ route(Request::segment(1).'.'.Request::segment(2).'.create')  }}" class="btn btn-sm btn-primary waves-effect waves-light">
            <i class="fa fa-plus"></i> Create
        </a>
    </div>
    @endif
@elseif(Auth::user()->hasRole('adminjemaat'))
<div class="mb-3">
    <a href="{{ route(Request::segment(1).'.'.Request::segment(2).'.create')  }}" class="btn btn-sm btn-primary waves-effect waves-light">
        <i class="fa fa-plus"></i> Create
    </a>
</div>
@endif
