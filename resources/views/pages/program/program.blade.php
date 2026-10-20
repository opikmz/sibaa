@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    </div>

    <!-- DataTales Example -->
    <div class="row gap-2">
        <div class="col-xl-8">
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
                                <col style="width:20%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="myfs12">No</th>
                                    <th class="myfs12">Program</th>
                                    <th class="myfs12">Progres</th>
                                    <th class="myfs12">Lainnya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($program as $p)
                                @php
                                $total = $totalPenghimpunanPerProgram[$p->id_program] ?? 0;

                                $progresPenghimpunan = ($p->target_penghimpunan > 0)
                                ? ($total / $p->target_penghimpunan) * 100
                                : 0;

                                $progresPenghimpunan = min($progresPenghimpunan, 100);
                                @endphp
                                <tr>
                                    <td class="myfs12">{{ $loop->iteration }}</td>
                                    <td class="myfs12">
                                        <div class="">
                                            <a href="/show_program/{{ $p->id_program }}">{{ $p->program }}</a>

                                        </div>
                                        @if ($p->is_active)
                                        <div class=""
                                            style="background:#1daf92; padding:3px 10px; display: inline-block; color:white; border-radius: 0.35rem;">
                                            Aktif</div>
                                        @else
                                        <div class=""
                                            style="background:#af1d1d; padding:3px 10px; display: inline-block; color:white; border-radius: 0.35rem;">
                                            Tidak Aktif</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="progress mt-2" style="height: 20px;">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $progresPenghimpunan }}%;"
                                                aria-valuenow="{{ $progresPenghimpunan }}" aria-valuemin="0"
                                                aria-valuemax="100">

                                                {{ number_format($progresPenghimpunan, 1) }}%

                                            </div>
                                        </div>
                                    </td>


                                    <td class="myfs12  justify-content-center">
                                        <button type="button" class="btn btn-warning myfs12" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $p->id_program }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>


                                        <form action="destroy_program/{{ $p->id_program }}" method="POST"
                                            class="d-inline form-delete">

                                            @csrf
                                            @method('DELETE')

                                            @if ($p->is_active == 0)
                                            <button type="button" class="btn btn-primary myfs12" onclick="Active(this)">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-danger myfs12" onclick="Nactive(this)">
                                                <i class="fa-solid fa-ban"></i>
                                            </button>
                                            @endif

                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- //Modal Edit --}}

                        @foreach ($program as $p)

                        <div class="modal fade" id="editModal{{ $p->id_program }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Program</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>

                                    <form action="/update_program/{{ $p->id_program }}" method="POST">
                                        @csrf
                                        @method('POST')

                                        <div class="modal-body">

                                            <label class="myfs12">
                                                <b>Program</b>
                                            </label>

                                            <input type="text" name="program" class="form-control"
                                                value="{{ $p->program }}" required>

                                            <label class="myfs12">
                                                <b>Target Penghimpunan</b>
                                            </label>

                                            <input type="number" name="target_penghimpunan" class="form-control" step="0.01"
                                                value="{{ $p->target_penghimpunan }}" required>

                                        </div>

                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
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
        <div class="col-xl-4">
            <div class="card shadow mb-4 ">
                <div class="d-flex align-items-center justify-content-between card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Program</h6>
                </div>
                <form action="/store_program" method="post" enctype="">
                    @csrf
                    <div class="card-body">
                        <label for="" class="m-0 myfs12"> <b>Program</b> <span class="text-danger"></label>
                        <input type="text" name="program" class="form-control mb-3" placeholder="Nama Program" required>
                        <input type="number" name="target_penghimpunan" class="form-control mb-3" step="0.01"
                            placeholder="Target Penghimpunan">


                        {{-- <div class="form-group">
                            <label class="myfs12"><b>Jenis</b></label>
                            <select name="kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <option value="infaq">Infaq</option>
                                <option value="zakat">Zakat</option>
                            </select>
                        </div> --}}


                    </div>
                    <button type="submit" class="btn btn-primary mb-3 mx-3">Tambah</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
@if ($program)
<script>
    document.getElementById('editBtn{{ $p->id_program }}').addEventListener('click', function() {
            document.querySelectorAll('.editBtn').forEach(button => {
                button.addEventListener('click', function() {

                    const form = this.closest('.form-delete');

                    Swal.fire({
                        title: 'Hapus?',
                        text: 'Data ini akan dihapus permanen',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });

                });
            });
        });

        function Nactive(button) {

            const form = button.closest('.form-delete');

            Swal.fire({
                title: 'Nonaktifkan?',
                text: 'Nonaktifkan Program ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, nonaktifkan',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });
        }
        function Active(button) {

            const form = button.closest('.form-delete');

            Swal.fire({
                title: 'Aktifkan?',
                text: 'Aktifkan Program ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, aktifkan',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });
        }
</script>
@endif
