@extends('main')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Beranda</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i>
                Download Laporan
            </a> --}}
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Layanan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahLayanan }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Transaksi
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahTransaksi }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Pendapatan
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            Rp{{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="col">
                                        {{-- <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Belum Diambil
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $belumDiambil }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-9">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Transaksi Terbaru</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
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
                                        {{-- <th>Aksi</th> --}}
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
                                        {{-- <th>Aksi</th> --}}
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
                                        </tr>
                                        @include('transaksi.modal.edit')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Layanan Terlaris</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart" data-labels='@json($layananTerlaris->pluck('nama_layanan'))'
                                data-values='@json($layananTerlaris->pluck('total_dibeli'))'>
                            </canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2"><i class="fas fa-circle text-primary"></i> Layanan Terlaris</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection


@push('script')
    <!-- Tambahkan Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("myPieChart");

            // Ambil data dari atribut HTML
            var labels = JSON.parse(ctx.dataset.labels || "[]");
            var data = JSON.parse(ctx.dataset.values || "[]");

            // Warna utama (bisa ditambah jika layanan lebih dari 3)
            var backgroundColors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'];
            var hoverColors = ['#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#be2617'];

            // Buat chart
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels.length ? labels : ["Direct", "Referral", "Social"],
                    datasets: [{
                        data: data.length ? data : [55, 30, 15],
                        backgroundColor: backgroundColors.slice(0, labels.length || 3),
                        hoverBackgroundColor: hoverColors.slice(0, labels.length || 3),
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyColor: "#858796",
                            borderColor: "#dddfeb",
                            borderWidth: 1,
                            padding: 10,
                            displayColors: false,
                            caretPadding: 10,
                        },
                    },
                    cutout: "80%",
                },
            });
        });
    </script>
@endpush
