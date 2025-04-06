<!-- Modal Ubah-->
<div class="modal fade" id="ubahModal{{ $data->id }}" tabindex="-1" aria-labelledby="ubahLabel{{ $data->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form action="{{ route('admin.poliklinik.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="ubahLabel{{ $data->id }}">Ubah Poliklinik</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <div class="modal-body">
            <div class="form-group">
                <label>Nama Poliklinik</label>
                <input type="text" name="nama_poliklinik" class="form-control" value="{{ $data->nama_poliklinik ?? ''}}" required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ $data->alamat ?? ''}}" required>
            </div>

            <div class="form-group">
                <label>Nama Kepala</label>
                <input type="text" name="nama_kepala" class="form-control" value="{{ $data->nama_kepala ?? ''}}" required>
            </div>

            <div class="form-group">
                <label>No Telepon</label>
                <input type="text" name="no_telp" class="form-control" value="{{ $data->no_telp ?? ''}}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $data->email ?? ''}}" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! $iconBatal !!} Batal</button>
            <button type="submit" class="btn btn-primary">{!! $iconTombolSimpan !!} Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>
