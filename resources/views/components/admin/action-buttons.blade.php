@props([
    'data',
    'action',
    'iconTombolDetail' => '',
    'iconTombolUbah' => '',
    'iconTombolHapus' => '',
    'iconTombolKembalikan' => '',
    'iconTombolHapusPermanen' => '',
    'isTrash' => Request::segment(3) === 'trash'
])

@if (!$isTrash)
    <td class="text-right">
        <button type="button" class="btn text-primary"
            data-toggle="modal"
            data-target="#detailModal{{ $data->id }}">
            {!! $iconTombolDetail !!} Detail
        </button>

        <a href="#" class="btn"
            data-toggle="modal"
            data-target="#ubahModal{{ $data->id }}">
            {!! $iconTombolUbah !!}
        </a>

        <a href="#" class="btn"
            data-toggle="modal"
            data-target="#hapusModal-{{ $data->id }}">
            {!! $iconTombolHapus !!}
        </a>
    </td>
@else
    <td class="text-right">
    
        <form action="{{ $action }}" method="POST" class="d-inline">
            @csrf
            @method('PUT')
            <button type="submit" class="btn">
                {!! $iconTombolKembalikan !!} Kembalikan
            </button>
        </form>

        <a href="#" class="btn text-danger" data-toggle="modal" data-target="#hapusPermanenModal-{{ $data->id }}">
            {!! $iconTombolHapusPermanen !!}
        </a>
    </td>
@endif
