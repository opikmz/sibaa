@extends('layouts.main')
@section('container')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            {{-- <h1 class="h3 mb-0 text-gray-800">Muzaki Perorangan</h1> --}}
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>

        <div class="card shadow mb-4">
            <div class="d-flex align-items-center justify-content-between card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Penghimpunan</h6>
                <div class="">
                    <a href="/muzaki_perorangan" class="btn btn-primary btn-sm">Tambah</a>
                    <a href="{{ route('export.penghimpunan.bulanan', [
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                    ]) }}"
                        class="btn btn-success btn-sm">
                        <i class="fa-solid fa-file-excel"></i>
                        Export to Excel
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ url()->current() }}" method="GET" class="mb-3">
                        <div class="row align-items-end">

                            <div class="col-md-3 mb-2">
                                <label for="bulan">Bulan</label>
                                <select name="bulan" id="bulan" class="form-control">
                                    @foreach (range(1, 12) as $b)
                                        <option value="{{ $b }}" {{ $bulan == $b ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($b)->locale('id')->translatedFormat('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mb-2">
                                <label for="tahun">Tahun</label>
                                <select name="tahun" id="tahun" class="form-control">
                                    @foreach (range(date('Y') - 5, date('Y') + 1) as $th)
                                        <option value="{{ $th }}" {{ $tahun == $th ? 'selected' : '' }}>
                                            {{ $th }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mb-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-filter"></i> Filter
                                </button>

                                <a href="{{ url()->current() }}" class="btn btn-secondary">
                                    Reset
                                </a>
                            </div>

                        </div>
                    </form>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <colgroup>
                            <col style="width:5%">
                            <col style="width:5%">
                            <col style="width:15%">
                            <col style="width:10%">
                            <col style="width:10%"> <!-- Nama Muzaki -->
                            <col style="width:17%">
                            <col style="width:8%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="myfs12">No</th>
                                <th class="myfs12">Tanggal</th>
                                <th class="myfs12">Nomor Transaksi</th>
                                <th class="myfs12">Nama</th>
                                <th class="myfs12">Nominal</th>
                                <th class="myfs12">Program</th>
                                <th class="myfs12">Lainnya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $t)
                                @php
                                    $muzaki = App\Models\muzakiPeroranganM::find($t->muzaki_id);
                                    $program = App\Models\ProgramM::find($t->program_id);
                                @endphp
                                <tr>
                                    <td class="myfs12">{{ $loop->iteration }}</td>
                                    <td class="myfs12">{{ $t->created_at->format('d/m/Y') }}</td>
                                    <td class="myfs12"> <a
                                            href="show_penghimpunan/{{ $t->id_transaksi }}">{{ $t->nomor_transaksi }}</a>
                                    </td>
                                    <td class="myfs12">{{ $muzaki->nama }}</td>
                                    <td class="myfs12">{{ number_format($t->nominal, 2) }}</td>
                                    <td class="">
                                        <div class="myfs12">
                                            {{ $program->program }}
                                        </div>
                                    </td>
                                    <td>
                                        {{-- <a href="" class="btn btn-primary myfs12">T</a> --}}
                                        <a href="{{ route('penghimpunan.edit', ['tipe' => 'perorangan', 'id' => $t->id_transaksi]) }}"
                                            class="btn btn-warning myfs12"><i class="fa-solid fa-pen"></i></a>

                                        <form action="destroy_penghimpunan/{{ $t->id_transaksi }}" method="POST"
                                            class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger myfs12 btn-delete"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
