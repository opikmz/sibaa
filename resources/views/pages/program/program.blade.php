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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Program</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col style="width:5%">
                                <col style="width:auto">
                                <col style="width:auto">
                                <col style="width:30%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="myfs12">No</th>
                                    <th class="myfs12">Program</th>
                                    <th class="myfs12">Kategori</th>
                                    <th class="myfs12">Lainnya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($program as $p)
                                <tr>
                                    <td class="myfs12">{{ $loop->iteration }}</td>
                                    <td class="myfs12">{{ $p->program }}</td>
                                    <td class="myfs12">{{ $p->kategori }}</td>
                                    <td class="myfs12">kosong</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card shadow mb-4 ">
                <div class="d-flex align-items-center justify-content-between card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Program</h6>
                </div>
                <form action="/store_program" method="post" enctype="">
                    @csrf
                    <div class="card-body">
                        <label for="" class="m-0 myfs12"> <b>Program</b> <span class="text-danger">*</span> </label>
                        <input type="text" name="program" class="form-control mb-3" required>
                        <div class="form-group">
                            <label class="myfs12"><b>Jenis</b></label>
                            <select name="kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <option value="infaq">Infaq</option>
                                <option value="zakat">Zakat</option>
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
