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
                        <strong class="text-dark">
                            Nomor Regristrasi:
                        </strong>
                        {{ $muzakip->nomor_registrasi }}
                    </div>
                    <div class="myfs14">
                        <strong class="text-dark">
                            Nama:
                        </strong>
                        {{ $muzakip->nama }}
                    </div>
                    <div class="myfs14">
                        <strong class="text-dark">
                            NPWZ:
                        </strong>
                        {{ $muzakip->npwz }}
                    </div>
                    <div class="myfs14">
                        <strong class="text-dark">
                            NPWP:
                        </strong>
                        {{ $muzakip->npwp }}
                    </div>
                    @if ($muzakip->is_active == 1)
                    <div class="myfs14">
                        <form action="{{ route('destroy_muzakip', $muzakip->id_muzaki_perorangan) }}" method="POST"
                            class="d-inline form-Nactive" id="NactiveMuzaki">
                            @csrf
                            @method('DELETE')
                            <strong class="text-dark">
                                Status
                            </strong>
                            <button type="button" onclick="Nactive()" class="btn btn-primary myfs12 btn-Nctive">Aktif</button>
                        </form>
                    </div>

                    @else
                    <form action="{{ route('destroy_muzakip', $muzakip->id_muzaki_perorangan) }}" method="POST"
                        class="d-inline form-Nactive" id="ActiveMuzaki">
                        @csrf
                        @method('DELETE')
                        <strong class="text-dark">
                            Status
                        </strong>
                        <button type="button" onclick="Active()" class="btn btn-danger myfs12 btn-Active">Nonaktif</button>
                    </form>
                    @endif
                </div>
                <div class="col">
                    <div class="myfs14">
                        <strong class="text-dark">
                            Tempat Lahir:
                        </strong>
                        {{ $muzakip->tempat_lahir }}
                    </div>
                    <div class="myfs14">
                        <strong class="text-dark">
                            Tempat Lahir:
                        </strong>
                        {{ $muzakip->tanggal_lahir }}
                    </div>
                    <div class="myfs14">
                        <strong class="text-dark">
                            Alamat:
                        </strong>
                        {{ $muzakip->alamat }}
                    </div>
                    <div class="myfs14">
                        <strong class="text-dark">
                            No Handphone:
                        </strong>
                        {{ $muzakip->no_handphone }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="d-flex align-items-center justify-content-between card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Penghimpunan</h6>
            {{-- <a href="/muzaki_perorangan" class="btn btn-primary btn-sm">Tambah</a> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <colgroup>
                        <col style="width:5%">
                        <col style="width:5%">
                        <col style="width:%">
                        <col style="width:10%">
                        <col style="width:10%"> <!-- Nama Muzaki -->
                        <col style="width:17%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="myfs12">No</th>
                            <th class="myfs12">Tanggal</th>
                            <th class="myfs12">Nomor Transaksi</th>
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
                            <td class="myfs12">
                                {{-- <a href="show_transaksi/{{ $t->id_transaksi }}">{{ $t->nomor_transaksi
                                    }}</a> </td> --}}
                                    <a href="/show_penghimpunan/{{ $t->id_transaksi }}">{{ $t->nomor_transaksi }}</a>
                            <td class="myfs12">{{ number_format($t->nominal,2) }}</td>
                            <td class="myfs12">{{ $program->program }}</td>
                            <td>
                                <a href="{{ route('penghimpunan.edit',['tipe'=>'perorangan','id'=>$t->id_transaksi]) }}" class="btn btn-warning myfs12">
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
