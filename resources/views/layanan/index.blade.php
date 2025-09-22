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
                <div class="col-auto">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#layananTambah">
                        <i class="bi bi-file-earmark-plus"></i>
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
                                    <td>{{ $item->harga_satuan }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning me-1" data-toggle="modal"
                                            data-target="#layananEdit{{$item->id_layanan}}">
                                            <i class="bi bi-pen"></i>
                                        </button>
                                        {{-- <form action="{{ route('hapusLokasi', $lok->id_lokasi) }}" method="POST"
                                        onsubmit="return confirm('Apakah kamu yakin mau hapus data ini?')">
                                        @csrf
                                        @method('DELETE') --}}
                                        <button type="#" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        {{-- </form> --}}
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

    @include('layanan.modal.tambah')
@endsection
