@extends('layouts.main')
@section('container')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Registrasi Muzaki Perorangan</h1> --}}
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="mt-2 ">
        <div class="card shadow p-0 mb-4 ">
            <div class="d-flex align-items-center justify-content-between card-header py-3">
                <h6 class="m-0 ">  <span class="font-weight-bold text-primary" >Nomor transaksi </span> <span class="font-weight-bold text-dark"> {{ $penghimpunan->nomor_transaksi }} </span>  </h6>
                {{-- <a href="/create_muzaki_perorangan" class="btn btn-primary btn-sm">Regristrasi Muzaki</a> --}}
            </div>
            <form action="/store_transaksi" method="post" enctype="">
                @csrf
                <div class="card-body">
                    @php
                    $nama = App\Models\muzakiPeroranganM::find($penghimpunan->muzaki_id);
                    $program = App\Models\programM::find($penghimpunan->program_id);
                    @endphp
                    <label for="" class="m-0 myfs12"> <b>Nama</b> <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control mb-3" value="{{ $nama->nama }}" readonly>

                    <label for="" class="m-0 myfs12"> <b>Tipe Muzaki</b> <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control mb-3" name="tipe_muzaki"
                        value="{{ $penghimpunan->tipe_muzaki }}" readonly>

                    <label for="" class="m-0 myfs12"> <b>Nominal</b> </label><span class="text-danger">*</span>
                    <input type="number" min="1000" name="nominal" class="form-control mb-3"
                        value="{{ $penghimpunan->nominal }}" readonly>

                    <label class="myfs12"><b>Program</b></label><span class="text-danger">*</span>
                    <input type="text" class="form-control mb-3" name="tipe_muzaki"
                        value="{{ $program->program }}" readonly>

                    <label for="" class="m-0 myfs12"> <b>Keterangan</b> </label>
                    <textarea class="form-control" name="keterangan" id="" cols="20" rows="5" readonly></textarea>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection