
                                        

                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detailModal{{ $data->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $data->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title text-white" id="detailModalLabel{{ $data->id }}">Detail Poliklinik</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><strong>Nama Poliklinik:</strong> {{ $data->nama_poliklinik }}</li>
                                                    <li class="list-group-item"><strong>Alamat:</strong> {{ $data->alamat }}</li>
                                                    <li class="list-group-item"><strong>Nama Kepala:</strong> {{ $data->nama_kepala }}</li>
                                                    <li class="list-group-item"><strong>No Telepon:</strong> {{ $data->no_telp }}</li>
                                                    <li class="list-group-item"><strong>Email:</strong> {{ $data->email }}</li>
                                                    <li class="list-group-item"><strong>Dibuat:</strong> {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('l, d F Y H:i') }}</li>
                                                    <li class="list-group-item"><strong>Diubah Terakhir:</strong> {{ \Carbon\Carbon::parse($data->updated_at)->diffForHumans() }}</li>
                                                    </ul>
                                                </div>

                                                </div>
                                            </div>
                                        </div>