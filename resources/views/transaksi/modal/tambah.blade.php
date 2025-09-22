<!-- Modal -->
<div class="modal fade" id="transaksiTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{ route('transaksiTambah') }}" method="POST">
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tanggal Transaksi</label>
                                <input name="tanggal" type="date" class="form-control" id="exampleInputLayanan"
                                    aria-describedby="emailHelp" placeholder="Masukkan Nama Layanan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Layanan</label>
                                <select name="id_layanan" class="form-control " id="exampleFormControlSelect1">
                                    <option value=" ">Pilih Layanan</option>
                                    @foreach ($layanan as $layan)
                                        <option value="{{ $layan->id_layanan }}">{{ $layan->nama_layanan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Berat</label>
                                <input name="berat" type="number" class="form-control" id="exampleInputHarga"
                                    placeholder="Masukkan Berat (Kg)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Pelanggan</label>
                                <input name="nama_pelanggan" type="text" class="form-control"
                                    id="exampleInputNama Layanan" placeholder="Nama Pelanggan">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
