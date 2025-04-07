@if (Request::segment('2') != 'jemaat')
    {{-- <td>{{ $data->keterangan ? $data->keterangan : '-' }}</td> --}}
@endif

@if (Auth::user()->hasRole('adminmaster'))
    <td>
        <small>{{ $data['created_at'] }}</small>
    </td>

    <td>
        <small>{{ $data['updated_at'] ?? 'updated_at' }}</small>
    </td>

    @if (Request::segment(3))
    <td class="d-flex gap-2">
        <a href="{{ route(Request::segment(1).'.'.Request::segment(2).'.'.Request::segment(3).'.show', $data['id']) }}" class="btn btn-xs btn-light"><i class="mdi mdi-eye"></i> Show</a>

        <a href="{{ route(Request::segment(1).'.'.Request::segment(2).'.'.Request::segment(3).'.edit', $data['id']) }}" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
        <form action="{{ route(Request::segment(1).'.'.Request::segment(2).'.'.Request::segment(3).'.destroy', $data['id']) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-xs btn-light"><i class="mdi mdi-trash-can"></i></button>
        </form>
    </td>
    @else
    <td class="d-flex gap-2">
        <a href="{{ route(Request::segment(1).'.'.Request::segment(2).'.show', $data['id']) }}" class="btn btn-xs btn-light"><i class="mdi mdi-eye"></i> Show</a>

        <a href="{{ route(Request::segment(1).'.'.Request::segment(2).'.edit', $data['id']) }}" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
        <form action="{{ route(Request::segment(1).'.'.Request::segment(2).'.destroy', $data['id']) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-xs btn-light"><i class="mdi mdi-trash-can"></i></button>
        </form>
    </td>
    @endif

@endif

@if (Auth::user()->hasRole('adminjemaat'))

<td class="d-flex gap-2">
    <a href="{{ route(Request::segment(1).'.'.Request::segment(2).'.show', $data['id']) }}" class="btn btn-xs btn-light"><i class="mdi mdi-eye"></i> Show</a>

    <a href="{{ route(Request::segment(1).'.'.Request::segment(2).'.edit', $data['id']) }}" class="btn btn-xs btn-light"><i class="mdi mdi-pencil"></i></a>
    <form action="{{ route(Request::segment(1).'.'.Request::segment(2).'.destroy', $data['id']) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-xs btn-light"><i class="mdi mdi-trash-can"></i></button>
    </form>
</td>

@endif
