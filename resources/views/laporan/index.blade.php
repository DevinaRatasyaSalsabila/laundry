@extends('main')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Laporan</h1>
        {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the
            <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.
        </p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3  d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Laporan</h6>
                <div class="col-auto">
                    <!-- Tombol Export -->
                    {{-- <a href="{{ route('LaporanExport') }}" class="btn btn-primary btn-sm m-1">
                        <i class="fa fa-upload"></i>
                    </a> --}}

                    <!-- Tombol Import -->
                    <button type="button" class="btn btn-secondary btn-sm m-1" data-toggle="modal"
                        data-target="#exportModal">
                        <i class="fa fa-download"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jumlah Transaksi</th>
                                <th>Total Pendapatan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jumlah Transaksi</th>
                                <th>Total Pendapatan</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($laporan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $item->jumlah_transaksi }}</td>
                                    <td>Rp{{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('laporan.modal.export')
@endsection
