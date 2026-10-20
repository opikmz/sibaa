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
                            <label for="" class="m-0 myfs12"> <b>Jumlah</b> <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="nominal" class="form-control mb-3" required>
                            <div class="mb-3">
                                <label for="tahun">Tahun</label>
                                <select name="tahun" class="form-control">
                                    <option value="">Pilih Tahun</option>
                                    @for ($i = date('Y'); $i >= 2000; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3 mx-3">Tambah</button>
                    </form>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card shadow mb-4 ">
                    <div class="d-flex align-items-center justify-content-between card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Riwayat</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <colgroup>
                                    {{--
                                <col style="width:5%"> --}}
                                    <col style="width:aut o">
                                    <col style="width:auto">
                                    <col style="width:30%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th class="myfs12">Tahun</th>
                                        <th class="myfs12">Jumlah</th>
                                        <th class="myfs12">Lainnya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($danaAwal as $d)
                                        <tr>
                                            {{-- <td class="myfs12">{{ $loop->iteration }}</td> --}}
                                            <td class="myfs12">{{ $d->tahun }}</td>
                                            <td class="myfs12">{{ $d->nominal }}</td>
                                            <td class="myfs12">

                                                <button type="button" class="btn btn-warning myfs12" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $d->saldo_awal }}">
                                                    <i class="fa-solid fa-pen"></i>
                                                </button>


                                                <form action="{{ route('dana_awal.destroy', $d->saldo_awal) }}"
                                                    method="POST" class="d-inline form-delete">
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

                            @foreach ($danaAwal as $d)
                                <div class="modal fade" id="editModal{{ $d->saldo_awal }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Dana</h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                            </div>

                                            <form action="/update_dana_awal/{{ $d->saldo_awal }}" method="POST">
                                                @csrf
                                                @method('POST')

                                                <div class="modal-body">

                                                     <label for="" class="m-0 myfs12"> <b>Jumlah</b> <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" name="nominal" class="form-control mb-3"
                                                            value="{{ $d->nominal }}" required>

                                                </div>

                                                <div class="modal-footer">

                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Batal
                                                    </button>

                                                    <button type="submit" class="btn btn-primary">
                                                        Simpan
                                                    </button>

                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
