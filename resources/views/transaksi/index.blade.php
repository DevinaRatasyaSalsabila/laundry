@extends('main')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Transaksi</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3  d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>
                <div class="col-auto d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-success btn-sm m-1" data-toggle="modal"
                        data-target="#transaksiTambah">
                        <i class="bi bi-file-earmark-plus"></i>
                    </button>
                    <!-- Tombol Import -->
                    <button type="button" class="btn btn-secondary btn-sm m-1" data-toggle="modal"
                        data-target="#importModal">
                        <i class="fa fa-download"></i>
                    </button>
                    <button type="button" class="btn btn-primary btn-sm m-1" data-toggle="modal"
                        data-target="#exportModal">
                        <i class="fa fa-upload"></i>
                    </button>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Transaksi</th>
                                {{-- <th>Nama Layanan</th>
                                <th>Berat</th> --}}
                                <th>Total</th>
                                <th>Nama Pelanggan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Transaksi</th>
                                {{-- <th>Nama Layanan</th> --}}
                                {{-- <th>Berat</th> --}}
                                <th>Total</th>
                                <th>Nama Pelanggan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>


                            @foreach ($transaksi as $item)
                                {{-- @php
                                    $total = $item->berat;
                                @endphp --}}
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    {{-- <td>{{ $item->nama_layanan }}</td>
                                    <td>{{ $item->berat }}</td> --}}
                                    <td>Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                                    <td>{{ $item->nama_pelanggan }}</td>
                                    <td>
                                        @if ($item->status == 'Diambil')
                                            <span class="badge badge-success">
                                                Diambil
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                Belum Diambil
                                            </span>
                                        @endif

                                    </td>
                                    <td class="d-flex text-align-center">
                                        <button type="button" class="btn btn-sm btn-info m-1" data-toggle="modal"
                                            data-target="#detail{{ $item->id_transaksi }}">
                                            <i class="bi bi-clipboard"></i>
                                        </button>
                                        @include('transaksi.modal.detail')
                                        <button type="button" class="btn btn-sm btn-warning m-1" data-toggle="modal"
                                            data-target="#transaksiEdit{{ $item->id_transaksi }}">
                                            <i class="bi bi-pen"></i>
                                        </button>
                                        <a href="{{ route('transaksi.cetak', $item->id_transaksi) }}" target="_blank"
                                            class="btn btn-sm btn-primary m-1">
                                            <i class="fa fa-print"></i>
                                        </a>
                                        <form action="{{ route('transaksiDestroy', $item->id_transaksi) }}" method="POST"
                                            id="deleteTransaksi{{ $item->id_transaksi }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm m-1"
                                                onclick="deleteTransaksi({{ $item->id_transaksi }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @include('transaksi.modal.edit')
                                @push('script')
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            let indexEdit{{ $item->id_transaksi }} = {{ count($detail) }};
                                            document.getElementById("tambah-layanan-edit{{ $item->id_transaksi }}").addEventListener("click",
                                                function() {
                                                    let wrapper = document.getElementById(
                                                        "layanan_multiple_edit{{ $item->id_transaksi }}");
                                                    let newItem = wrapper.querySelector(".layanan-item").cloneNode(true);

                                                    // reset value
                                                    newItem.querySelector("select").value = "";
                                                    newItem.querySelector("input").value = "";

                                                    newItem.querySelector("select").setAttribute("name",
                                                        `layanan[${indexEdit{{ $item->id_transaksi }}}][id_layanan]`);
                                                    newItem.querySelector("input").setAttribute("name",
                                                        `layanan[${indexEdit{{ $item->id_transaksi }}}][berat]`);

                                                    wrapper.appendChild(newItem);
                                                    indexEdit{{ $item->id_transaksi }}++;
                                                });
                                        });
                                    </script>
                                @endpush
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('transaksi.modal.export')
    @include('transaksi.modal.import')
    @include('transaksi.modal.tambah')
    @push('script')
        <script>
            document.querySelectorAll('.btn-simpan-transaksi').forEach(btn => {
                btn.addEventListener('click', function(event) {
                    event.preventDefault();

                    let id = this.dataset.id; // ambil id_layanan dari data-id

                    Swal.fire({
                        title: "Apakah Kamu Yakin Ingin Menyimpan Perubahan?",
                        showDenyButton: true,
                        confirmButtonText: "Simpan",
                        denyButtonText: "Batalkan Perubahan"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire("Tersimpan!", "", "success");
                            document.getElementById('editTransaksi' + id).submit();
                        } else if (result.isDenied) {
                            Swal.fire("Perubahan Tidak Disimpan", "", "info");
                        }
                    });
                });
            });
        </script>
        <script>
            function deleteTransaksi(id) {
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data ini akan dihapus dan tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteTransaksi' + id).submit();
                    }
                });
            }
        </script>
        <script>
            let index = 1;
            document.getElementById('tambah-layanan').addEventListener('click', function() {
                let wrapper = document.getElementById('layanan_multiple');
                let newItem = document.querySelector('.layanan-item').cloneNode(true);

                // ganti name sesuai index
                newItem.querySelector('select').setAttribute('name', `layanan[${index}][id_layanan]`);
                newItem.querySelector('input').setAttribute('name', `layanan[${index}][berat]`);
                wrapper.appendChild(newItem);
                index++;
            });
        </script>
        <script>
            document.getElementById('simpanTransaksi').addEventListener('click', function(event) {
                event.preventDefault(); // stop submit form dulu

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Pastikan semua data sudah benar sebelum disimpan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('formTransaksi').submit(); // submit manual
                    }
                });
            });
        </script>
    @endpush
@endsection
