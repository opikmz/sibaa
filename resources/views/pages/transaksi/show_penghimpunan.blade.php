@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data {{ $muzakip->nama }}</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="myfs14">
                        Nomor Regristrasi: {{ $muzakip->nomor_registrasi }}
                    </div>
                    <div class="myfs14">
                        Nama: {{ $muzakip->nama }}
                    </div>
                    <div class="myfs14">
                        NPWZ: {{ $muzakip->npwz }}
                    </div>
                    <div class="myfs14">
                        NPWP: {{ $muzakip->npwp }}
                    </div>
                    @if ($muzakip->is_active == 1)
                    <div class="myfs14">
                        <form action="{{ route('destroy_muzakip', $muzakip->id_muzaki_perorangan) }}" method="POST"
                            class="d-inline form-Nactive">
                            @csrf
                            @method('DELETE')
                                Status
                            <button type="button" class="btn btn-primary myfs12 btn-Nactive">Aktif</button>
                        </form>
                    </div>
                    @else
                         <form action="{{ route('destroy_muzakip', $muzakip->id_muzaki_perorangan) }}" method="POST"
                            class="d-inline form-Nactive">
                            @csrf
                            @method('DELETE')
                            Status
                            <button type="button" class="btn btn-danger myfs12 btn-Nactive">Nonaktif</button>
                        </form>
                    @endif
                </div>
                <div class="col">
                    <div class="myfs14">
                        Tempat Lahir: {{ $muzakip->tempat_lahir }}
                    </div>
                    <div class="myfs14">
                        Tanggal Lahir: {{ $muzakip->tanggal_lahir }}
                    </div>
                    <div class="myfs14">
                        Alamat: {{ $muzakip->alamat }}
                    </div>
                    <div class="myfs14">
                        No Handphone: {{ $muzakip->no_handphone }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <colgroup>
                        <col style="width:5%">
                        <col style="width:15%">
                        {{--
                        <col style="width:10%"> --}}
                        <col style="width:15%"> <!-- Nama Muzaki -->
                        <col style="width:20%">
                        <col style="width:15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="myfs12">No</th>
                            <th class="myfs12">Tanggal</th>
                            {{-- <th class="myfs12">Nama</th> --}}
                            <th class="myfs12">Nominal</th>
                            <th class="myfs12">Program</th>
                            <th class="myfs12">Lainnya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $t)
                        @php
                        $program = App\Models\ProgramM::find($t->program_id);
                        @endphp
                        <tr>
                            <td class="myfs12">{{ $loop->iteration }}</td>
                            <td class="myfs12">{{ $t->created_at->format('d/m/Y') }}</td>
                            <td class="myfs12">{{ number_format($t->nominal,2) }}</td>
                            <td class="myfs12">{{ $program->program }}</td>
                            <td>
                                <a href="" class="btn btn-warning myfs12">E</a>
                                <form action="" method="POST" class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger myfs12 btn-delete">H</button>
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