<!-- Modal Expoe -->
<div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content shadow-lg rounded">
            <div class="modal-header border-0">
                <h5 class="modal-title w-100 text-center" id="importModalLabel">
                    <i class="fa fa-cloud-upload mr-2"></i> Export Excel
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="fa fa-cloud-download-alt fa-4x text-primary mb-3"></i>
                    <p class="text-muted">
                        Unduh laporan laundry dalam format Excel dengan sekali klik.
                    </p>
                </div>

                <a href="{{ route('LaporanExport') }}" class="btn btn-primary px-4 py-2 fw-bold">
                    <i class="fa fa-download mr-2"></i> Download Laporan Excel
                </a>
            </div>
        </div>
    </div>
</div>
