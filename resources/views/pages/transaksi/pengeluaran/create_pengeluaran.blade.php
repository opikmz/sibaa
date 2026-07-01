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
                <h6 class="m-0 font-weight-bold text-primary">Pengeluaran</h6>
                {{-- <a href="/create_muzaki_perorangan" class="btn btn-primary btn-sm">Regristrasi Muzaki</a> --}}
            </div>
            <form action="/store_pengeluaran" method="post" enctype="">
                @csrf
                <div class="card-body">
                    <label for="" class="m-0 myfs12"> <b>Pengeluaran</b> <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control mb-3" value="" name="pengeluaran">

                    <label for="" class="m-0 myfs12"> <b>Nominal</b> </label><span class="text-danger">*</span>
                    <input type="number" min="1000" name="nominal" class="form-control mb-3" required>

                    <label class="myfs12"><b>Program</b></label><span class="text-danger"></span>
                    <select name="program_id" class="form-control" >
                        <option value="">Pilih Program</option>
                        @foreach ($program as $p)
                        <option value="{{ $p->id_program }}">{{ $p->program }}</option>
                        @endforeach
                    </select>

                    <label for="" class="m-0 myfs12"> <b>Keterangan</b> </label>
                    <textarea class="form-control" name="keterangan" id="" cols="20" rows="5"></textarea>

                </div>
                <button type="submit" class="btn btn-primary mb-3 mx-3">Tambah</button>
            </form>
        </div>
    </div>
</div>
@endsection
