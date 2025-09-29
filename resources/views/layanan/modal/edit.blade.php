
<!-- Modal -->
<div class="modal fade" id="layananEdit{{ $item->id_layanan }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" action="{{ url('layanan/update/'.$item->id_layanan) }}" method="POST" id="formLayanan{{ $item->id_layanan }}">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Layanan</label>
                        <input name="nama_layanan" type="text" class="form-control" id="exampleInputLayanan"
                            aria-describedby="emailHelp" placeholder="Masukkan Nama Layanan"
                            value="{{ $item->nama_layanan }}">
                    </div>
                    <div class="form-group">
                        <label for="">Harga</label>
                        <div class="input-group input-group-sm mb-3">
                            <input name="harga_satuan" type="number" class="form-control"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                                value="{{ $item->harga_satuan }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">kg</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" type="text" class="form-control" id="exampleInputDeskripsi"
                            placeholder="Masukkan Deskripsi">{{ $item->deskripsi }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn-simpan-layanan"  data-id="{{ $item->id_layanan }}" id="editLayanan{{ $item->id_layanan }}">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
