@extends('layouts.main')
@section('container')

@if ($errors->any())
<div class="alert alert-danger d-flex align-items-start" role="alert">
    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
        class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16">
        <path
            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
    </svg> --}}
    <div>
        <ul class="mb-0">
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

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
                <h6 class="m-0 font-weight-bold text-primary">Registrasi Muzaki Perorangan</h6>
                {{-- <a href="/create_muzaki_perorangan" class="btn btn-primary btn-sm">Regristrasi Muzaki</a> --}}
            </div>
            <form action="/store_muzakip" method="post" enctype="">
                @csrf
                <div class="card-body">
                    <label for="" class="m-0 myfs12"> <b>Nama</b> <span class="text-danger">*</span> </label>
                    <input type="text" name="nama" class="form-control mb-3" required>
                    <label for="" class="m-0 myfs12"> <b>NPWZ</b>  </label>
                    <input type="text" name="npwz" class="form-control mb-3">
                    <label for="" class="m-0 myfs12"> <b>NPWP</b> </label>
                    <input type="text" name="npwp" class="form-control mb-3">
                    <label for="" class="m-0 myfs12"> <b>Tempat lahir</b></label>
                    <input type="text" name="tempat_lahir" class="form-control mb-3">
                    <label for="" class="m-0 myfs12"> <b>Tanggal Lahir</b> <span class="text-danger">*</span> </label>
                    <input type="date" name="tanggal_lahir" class="form-control mb-3">
                    <label for="" class="m-0 myfs12"> <b>Jenis Kelamin</b> <span class="text-danger">*</span> </label> <br>
                    <input type="radio" name="jk" value="lk" id="" required> Laki Laki
                    <input type="radio" name="jk" value="pr" id="" class="mb-3"> Perempuan <br>
                    <label for="" class="m-0 myfs12"> <b>Alamat</b> <span class="text-danger">*</span> </label>
                    <input type="text" name="alamat" class="form-control mb-3" required>
                    <label for="" class="m-0 myfs12"> <b>No Handphone</b> <span class="text-danger">*</span> </label>
                    <input type="text" inputmode="numeric" pattern="[0-9]*" name="no_handphone"
                        class="form-control mb-3">
                    <label for="" class="m-0 myfs12"> <b>Keterangan</b>  </label>
                    <textarea class="form-control" name="keterangan" id="" cols="20" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-3 mx-3">Tambah</button>
            </form>
        </div>
    </div>
</div>
@endsection
