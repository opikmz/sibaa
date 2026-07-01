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
            <h6 class="m-0 font-weight-bold text-primary">Data Pengeluaran</h6>
            <a href="/create_pengeluaran" class="btn btn-primary btn-sm">Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <colgroup>
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
                            <th class="myfs12">Nama</th>
                            <th class="myfs12">Tanggal</th>
                            <th class="myfs12">Nominal</th>
                            <th class="myfs12">Program</th>
                            <th class="myfs12">Lainnya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengeluaran as $p)
                        @php
                        $program = App\Models\ProgramM::find($p->program_id);
                        @endphp
                        <tr>
                            <td class="myfs12">{{ $loop->iteration }}</td>
                            <td class="myfs12"> <a href="show_pengeluaran/{{ $p->pengeluaran }}">{{
                                    $p->pengeluaran
                                    }}</a> </td>
                            <td class="myfs12">{{ $p->created_at->format('d/m/Y') }}</td>
                            <td class="myfs12">{{ number_format($p->nominal,2) }}</td>
                            {{-- <td class="myfs12">{{ $muzaki->nama }}</td> --}}

                            <td class="">
                                <div class="myfs12">
                                    @if ($program)
                                    {{ $program->program }}

                                    @endif
                                </div>
                                {{-- <div class="myfs12">
                                    <div class=""
                                        style="background:#1daf92; padding:3px 10px; display: inline-block; color:white; border-radius: 0.35rem;">
                                        {{ $t->kategori_transaksi }}</div>
                                </div> --}}
                            </td>
                            <td>
                                <a href="edit_pengeluaran/{{ $p->id_pengeluaran }}"
                                    class="btn btn-warning myfs12"><i class="fa-solid fa-pen"></i></a>

                                <form action="{{ route('pengeluaran.destroy', $p->id_pengeluaran) }}" method="POST" class="d-inline form-delete">
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
