@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data {{ $program->program }}</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="myfs14">
                        <strong class="text-dark">
                            Progres Penghimpunan:
                        </strong>

                        <div class="progress mt-2" style="height: 20px;">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ $progresPenghimpunan }}%;" aria-valuenow="{{ $progresPenghimpunan }}"
                                aria-valuemin="0" aria-valuemax="100">

                                {{ number_format($progresPenghimpunan, 1) }}%

                            </div>
                        </div>


                        <div class="mb-2">
                            Rp {{ number_format($totalPenghimpunanPerProgram, 2) }}
                            dari
                            Rp {{ number_format($program->target_penghimpunan, 2) }}
                        </div>
                        {{-- <small class="text-muted">
                        </small> --}}
                        <strong class="text-dark">
                            Pengeluaran:
                        </strong>
                        <div class="progress mt-2" style="height: 20px;">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ $progresPengeluaran }}%;" aria-valuenow="{{ $progresPengeluaran }}"
                                aria-valuemin="0" aria-valuemax="100">

                                {{ number_format($progresPengeluaran, 1) }}%

                            </div>
                        </div>
                        <div class="mb-2">
                            Rp {{ number_format($totalPengeluaranPerProgram, 2) }}
                            dari
                            Rp {{ number_format($program->target_penghimpunan, 2) }}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="chart-bar">
                        <canvas id="programHarianChart"></canvas>

                        {{-- @dd($keuangan); --}}
                    </div>
                    {{-- <canvas id="programHarianChart"></canvas> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="d-flex align-items-center justify-content-between card-header py-3">
            <div class="">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Penghimpunan</h6>

                <div class="myfs14 ">
                    <strong class="text-dark">{{ $program->program }}</strong>
                </div>
                <small class="text-muted text-dark text-bold"></small>

            </div>
            <a href="{{ route('export.penghimpunan', $program->id_program) }}" class="btn btn-success myfs12">
                <i class="fa-solid fa-file-excel"></i>
                Export Excel
            </a>
            {{-- <a href="/muzaki_perorangan" class="btn btn-primary btn-sm">Tambah</a> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <colgroup>
                        <col style="width:5%">
                        <col style="width:5%">
                        <col style="width:%">
                        <col style="width:20%">
                        <col style="width:10%"> <!-- Nama Muzaki -->
                        <col style="width:17%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="myfs12">No</th>
                            <th class="myfs12">Tanggal</th>
                            <th class="myfs12">Nama</th>
                            <th class="myfs12">Nomor Transaksi</th>
                            <th class="myfs12">Nominal</th>
                            {{-- <th class="myfs12">Program</th> --}}
                            <th class="myfs12">Lainnya</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($penghimpunanProgram as $pp)
                        @php
                        // $program = App\Models\ProgramM::find($pp->program_id);
                        // $muzaki = App\Models\muzakiPeroranganM::find($pp->muzaki_id);
                        @endphp
                        <tr>
                            <td class="myfs12">{{ $loop->iteration }}</td>
                            <td class="myfs12">{{ $pp->created_at->format('d/m/Y') }}</td>
                            <td class="myfs12">{{ $pp->muzaki->nama ?? 'N/A' }}</td>

                            <td class="myfs12">
                                <a href="/show_penghimpunan/{{ $pp->id_transaksi }}">{{ $pp->nomor_transaksi }}</a>
                            <td class="myfs12">{{ number_format($pp->nominal,2) }}</td>
                            <td>
                                <a href="{{ route('penghimpunan.edit',['tipe'=>'perorangan','id'=>$pp->id_transaksi]) }}"
                                    class="btn btn-warning myfs12">
                                    <i class="fa-solid fa-pen"></i></a>
                                <form action="" method="POST" class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger myfs12 btn-delete">
                                        <i class="fa-solid fa-trash"></i></a>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    {{-- <tbody>
                        @foreach ($transaksi as $t)
                        @php
                        $program = App\Models\ProgramM::find($t->program_id);
                        @endphp
                        <tr>
                            <td class="myfs12">{{ $loop->iteration }}</td>
                            <td class="myfs12">{{ $t->created_at->format('d/m/Y') }}</td>
                            <td class="myfs12"> <a href="show_transaksi/{{ $t->id_transaksi }}">{{ $t->nomor_transaksi
                                    }}</a> </td>
                            <td class="myfs12">{{ $muzaki->nama }}</td>
                            <td class="myfs12">{{ number_format($t->nominal,2) }}</td>
                            <td class="">
                                <div class="myfs12">
                                    {{ $program->program }}
                                </div>
                                <div class="myfs12">
                                    <div class=""
                                        style="background:#1daf92; padding:3px 10px; display: inline-block; color:white; border-radius: 0.35rem;">
                                        {{ $t->kategori_transaksi }}</div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('transaksi.edit',['tipe'=>'perorangan','id'=>$t->id_transaksi]) }}"
                                    class="btn btn-warning myfs12"><i class="fa-solid fa-pen"></i></a>
                                <form action="" method="POST" class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger myfs12 btn-delete"><i
                                            class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function Nactive(){
         Swal.fire({
                title: 'Nonaktifkan?',
                text: 'Nonaktifkan Muzaki',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, nonaktifkan',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('NactiveMuzaki').submit();
                }
            });
    }
    function Active(){
         Swal.fire({
                title: 'Aktifkan?',
                text: 'Aktifkaan Muzaki',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, aktifkan',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('ActiveMuzaki').submit();
                }
            });
    }

</script>
<script src="{{ asset('asset/vendor/chart.js/Chart.min.js') }}"></script>
<script>
    let tanggalPenghimpunanHarian = @json(
        $penghimpunanHarian->pluck('tanggal')
    );

    let dataPenghimpunanHarian = @json(
        $penghimpunanHarian->pluck('total')
    );
</script>

{{-- <script src="{{ asset('/js/chart/chart-bar-program-harian.js') }}"></script> --}}