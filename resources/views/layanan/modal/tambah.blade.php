<!-- Modal -->
<div class="modal fade" id="layananTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{ route('layananTambah') }}" method="post" id="formLayanan">
                    @method('post')
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Layanan</label>
                        <input name="nama_layanan" type="text" class="form-control" id="exampleInputLayanan"
                            aria-describedby="emailHelp" placeholder="Masukkan Nama Layanan" required>
                    </div>
                    <div class="form-group">
                        <label for="">Harga</label>
                        <div class="input-group input-group-sm mb-3">
                            <input name="harga_satuan" type="number" class="form-control" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm" placeholder="Masukkan Harga Satuan" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">kg</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" type="text" class="form-control" id="exampleInputDeskripsi"
                            placeholder="Masukkan Deskripsi" required> 
                        </textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="simpanLayanan">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
