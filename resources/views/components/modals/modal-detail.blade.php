@props(['id', 'title' => 'Detail Data', 'items' => []])

<div class="modal fade" id="detailModal{{ $id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="detailModalLabel{{ $id }}">{{ $title }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    @foreach ($items as $label => $value)
                        <li class="list-group-item">
                            <strong>{{ $label }}:</strong>
                            {{ $value }}
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
