<!-- Modal Edit -->
<div class="modal fade" id="transaksiEdit{{ $item->id_transaksi }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('transaksiUpdate', $item->id_transaksi) }}" method="POST" id="editTransaksi{{$item->id_transaksi}}">
                    @csrf
                    @method('POST')

                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Tanggal Transaksi</label>
                            <input name="tanggal" type="date" class="form-control" value="{{ $item->tanggal }}">
                        </div>
                        <div class="col-md-6">
                            <label for="">Nama Pelanggan</label>
                            <input name="nama_pelanggan" type="text" class="form-control"
                                value="{{ $item->nama_pelanggan }}">
                        </div>
                    </div>

                    <div id="layanan_multiple_edit{{ $item->id_transaksi }}">
                        @foreach ($detail[$item->id_transaksi] ?? [] as $i => $det)
                            <div class="row layanan-item mb-2">
                                <div class="col-md-6">
                                    <label for="">Nama Layanan</label>
                                    <select name="layanan[{{ $i }}][id_layanan]" class="form-control">
                                        <option value="">Pilih Layanan</option>
                                        @foreach ($layanan as $layan)
                                            <option value="{{ $layan->id_layanan }}"
                                                {{ $layan->nama_layanan == $det->nama_layanan ? 'selected' : '' }}>
                                                {{ $layan->nama_layanan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Berat</label>
                                    <input type="number" class="form-control"
                                        name="layanan[{{ $i }}][berat]" value="{{ $det->berat }}">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="tambah-layanan-edit{{ $item->id_transaksi }}"
                        class="btn btn-success btn-sm">+ Tambah Layanan</button>

                    <div class="form-group mt-3">
                        <label for="">Status</label>
                        <select name="status" class="form-control">
                            <option value="Diambil" {{ $item->status == 'Diambil' ? 'selected' : '' }}>Diambil</option>
                            <option value="Belum Diambil" {{ $item->status == 'Belum Diambil' ? 'selected' : '' }}>
                                Belum Diambil</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-simpan-transaksi" data-id={{$item->id_transaksi}}>Simpan Perubahan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
