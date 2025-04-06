@props([
    'id',
    'action',
    'title' => 'Konfirmasi Hapus',
    'message' => 'Apakah Anda yakin ingin menghapus data ini?',
    'itemName' => null,
])

<div class="modal fade" id="hapusModal-{{ $id }}" tabindex="-1" aria-labelledby="hapusModalLabel{{ $id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ $action }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white" id="hapusModalLabel{{ $id }}">{{ $title }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    {{ $message }}
                    @if($itemName)
                        <strong>{{ $itemName }}</strong>
                    @endif
                    <br><small class="text-muted">Data akan dipindahkan ke tempat sampah dan masih bisa dikembalikan jika diperlukan.</small>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! $iconBatal !!} Batal</button>
                    <button type="submit" class="btn btn-danger">{!! $iconTombolHapus !!} Pindahkan ke tempat sampah</button>
                </div>
            </form>
        </div>
    </div>
</div>
