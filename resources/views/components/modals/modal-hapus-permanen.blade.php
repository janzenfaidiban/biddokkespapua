@props([
    'id',
    'action',
    'title' => 'Hapus Permanen',
    'message' => 'Apakah Anda yakin ingin menghapus data ini secara permanen?',
    'itemName' => null,
])

<div class="modal fade" id="hapusPermanenModal-{{ $id }}" tabindex="-1" aria-labelledby="hapusPermanenModalLabel{{ $id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ $action }}" method="POST">
                @csrf
                @method('DELETE') {{-- Tetap gunakan DELETE jika route forceDelete pakai method ini --}}

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white" id="hapusPermanenModalLabel{{ $id }}">{{ $title }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    {{ $message }}
                    @if($itemName)
                        <strong>{{ $itemName }}</strong>
                    @endif
                    <br><small class="text-danger">Tindakan ini tidak dapat dibatalkan. Data akan dihapus secara permanen dan tidak bisa dikembalikan.</small>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! $iconBatal !!} Batal</button>
                    <button type="submit" class="btn btn-danger">{!! $iconTombolHapusPermanen !!} Ya, Hapus Permanen</button>
                </div>
            </form>
        </div>
    </div>
</div>
