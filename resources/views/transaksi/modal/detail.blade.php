<!-- Modal -->
<div class="modal fade" id="detail{{ $item->id_transaksi }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Layanan</th>
                                <th>Berat (Kg)</th>
                                <th>Harga Satuan</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach ($detail[$item->id_transaksi] as $d)
                                @php
                                    $subtotal = $d->harga_satuan * $d->berat;
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>{{ $d->nama_layanan }}</td>
                                    <td>{{ $d->berat }}</td>
                                    <td>Rp{{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                                    <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-right">Total</th>
                                <th>Rp{{ number_format($total, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
        </div>
        </form>
    </div>
</div>
