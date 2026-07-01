@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    </div>

    <!-- DataTales Example -->
    <div class="row gap-2">
        <div class="col-xl-6">
            <div class="card shadow mb-4 ">
                <div class="d-flex align-items-center justify-content-between card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Saldo Awal</h6>
                </div>
                <form action="/store_saldo_awal" method="post" enctype="">
                    @csrf
                    <div class="card-body">
                        <label for="" class="m-0 myfs12"> <b>Jumlah</b> <span class="text-danger">*</span> </label>
                        <input type="number" name="nominal" class="form-control mb-3" value="{{ $danaAwal->nominal }}" required>
                        <div class="mb-3">
                            <label for="tahun">Tahun</label>
                            <select name="tahun" class="form-control">
                                <option value="">Pilih Tahun</option>
                                @for ($i = date('Y'); $i >= 2025; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3 mx-3">Tambah</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
