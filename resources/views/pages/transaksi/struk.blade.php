<!DOCTYPE html>
<html lang="en">

<body>

    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="container">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h1>Simbaa</h1>
                            <p class="pt-0">Bukti pembayaran </p>
                        </div>
                    </div>
                    @php
                    $muzaki = App\Models\muzakiPeroranganM::find($transaksi->muzaki_id)->first();
                    $program = App\Models\programM::find($transaksi->program_id)->first();
                    @endphp

                    <div class="row">
                        <div class="col-xl-6">
                            <ul class="list-unstyled">
                                <li class="text-muted">Nama:</span>      {{ $muzaki->nama }}</li>
                                <li class="text-muted">Jumlah: RP.{{ $transaksi->nominal }}</span></li>
                                <li class="text-muted">Tanggal: {{ $transaksi->created_at->format('d/m/Y') }}</span></li>
                                <li class="text-muted">Program: {{ $program->program }}</span></li>
                                <li class="text-muted">Keterangan</span></li>
                                <p>{{ $transaksi->keterangan }}</p>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="col-xl-8">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<div id="btn" class="col-xl-2">
    <h6> <a href="/" class="" class="btn btn-primary">Kembali</a></h6>
</div>
<script defer>
    window.print();
</script>


</html>
