                                        <!-- Modal Konfirmasi Hapus / pindahkan ke tempat sampah -->
                                        <div class="modal fade" id="hapusModal-{{ $data->id }}" tabindex="-1" aria-labelledby="hapusModalLabel{{ $data->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('admin.poliklinik.destroy', $data->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title text-white" id="hapusModalLabel{{ $data->id }}">Konfirmasi Hapus</h5>
                                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus <strong>{{ $data->nama_poliklinik }}</strong>? Data akan dipindahkan ke tempat sampah dan masih bisa dikembalikan jika diperlukan.
                                                        </div>
                                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! $iconBatal !!} Batal</button>
                                                            <button type="submit" class="btn btn-danger">{!! $iconTombolHapus !!} Pindahkan ke tempat sampah</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>