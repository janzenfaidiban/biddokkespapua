<!-- Modal deleteFotoGerejaModal-->
<div class="modal fade" id="deleteFotoGerejaModal" tabindex="-1" aria-labelledby="deleteFotoGerejaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteFotoGerejaLabel">Konfirmasi Hapus Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus foto Gereja ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! $iconBatal !!} Batal</button>
                <form action="{{ route('adminmaster.jemaat.delete.fotoGereja', $data->user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{!! $iconTombolHapusPermanen !!} Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal deleteFotoGerejaModal End -->