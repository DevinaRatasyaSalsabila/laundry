<!-- Modal -->
<div class="modal fade" id="detail{{ $item->id_transaksi }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- biar lebih lebar -->
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h5 class="modal-title">Detail Transaksi #{{ $item->id_transaksi }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Informasi pelanggan di pojok kanan atas -->
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <p><strong>Nama Pelanggan:</strong> {{ $item->nama_pelanggan }}</p>
                        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</p>
                    </div>
                    <div class="text-right">
                        <span class="badge 
                            @if($item->status == 'Belum Diambil') bg-warning text-light
                            @elseif($item->status == 'Diambil') bg-success text-light
                            @else bg-secondary @endif
                        ">
                            {{ $item->status }}
                        </span>
                    </div>
                </div>

                <!-- Tabel layanan -->
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
    </div>
</div>
