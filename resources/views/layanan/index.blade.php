@extends('main')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Layanan</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the
            <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.
        </p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3  d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Layanan</h6>
                <div class="col-auto d-flex align-items-center gap-2">
                    <!-- Tombol Tambah -->
                    <button type="button" class="btn btn-success btn-sm m-1" data-toggle="modal" data-target="#layananTambah">
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
                                <th>Nama Layanan</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Layanan</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($layanan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_layanan }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="d-flex text-align-center">
                                        <button type="button" class="btn btn-sm btn-warning m-1" data-toggle="modal"
                                            data-target="#layananEdit{{ $item->id_layanan }}">
                                            <i class="bi bi-pen"></i>
                                        </button>
                                        <form action="{{ route('layananDestroy', $item->id_layanan) }}" method="POST"
                                            id="deleteForm{{ $item->id_layanan }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm m-1"
                                                onclick="confirmDelete({{ $item->id_layanan }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @include('layanan.modal.edit')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('layanan.modal.export')
    @include('layanan.modal.tambah')
    @include('layanan.modal.import')

    @push('script')
        <script>
            document.querySelectorAll('.btn-simpan-layanan').forEach(btn => {
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
                            Swal.fire("Saved!", "", "success");
                            document.getElementById('formLayanan' + id).submit();
                        } else if (result.isDenied) {
                            Swal.fire("Perubahan Tidak Disimpan", "", "info");
                        }
                    });
                });
            });
        </script>

        <script>
            function confirmDelete(id) {
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
                        document.getElementById('deleteForm' + id).submit();
                    }
                });
            }
        </script>
        <script>
            document.getElementById('simpanLayanan').addEventListener('click', function(event) {
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
                        document.getElementById('formLayanan').submit(); // submit manual
                    }
                });
            });
        </script>
    @endpush
@endsection
