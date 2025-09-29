<!-- Modal Import -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content shadow-lg rounded">
            <div class="modal-header border-0">
                <h5 class="modal-title w-100 text-center" id="importModalLabel">
                    <i class="fa fa-cloud-upload mr-2"></i> Import Excel
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Download Format Button -->
                <div class="text-center mb-4">
                    <a href="{{ asset('format/FormatTransaksi.xlsx') }}" class="btn btn-outline-primary btn-block" download>
                        Download Format Import
                    </a>
                </div>
                <!-- Form Upload -->
                <form action="{{route('TransaksiImport')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="file"><b>Pilih File Excel Untuk di Import</b>
                            <span class="text-danger" style="font-size: 0.8em; display: none;" id="warning-format">
                                Pastikan file yang di upload sesuai format!
                            </span>
                        </label>
                        <input type="file" name="file" id="file" class="form-control shadow-sm" required
                            onmouseover="document.getElementById('warning-format').style.display = 'block';"
                            onmouseout="document.getElementById('warning-format').style.display = 'none';">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block shadow-sm">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
