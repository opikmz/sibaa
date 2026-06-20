<!-- Bootstrap core JavaScript-->
<script src="{{ asset('asset') }}/vendor/jquery/jquery.min.js"></script>
<script src="{{ asset('asset') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('asset') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('asset') }}/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="{{ asset('asset') }}/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('asset') }}/js/demo/chart-area-demo.js"></script>
<script src="{{ asset('asset') }}/js/demo/chart-pie-demo.js"></script>

<script src="{{ asset('asset') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('asset') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="{{ asset('asset') }}/js/demo/datatables-demo.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('asset') }}/js/demo/chart-area-demo.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {

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

      document.querySelectorAll('.btn-Nactive').forEach(button => {
        button.addEventListener('click', function () {

            const form = this.closest('.form-Nactive');

            Swal.fire({
                title: 'Nonaktif?',
                text: 'Data ini akan di nonaktifkan',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, nonaktifkaan',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

        });
    });
    //   document.querySelectorAll('.btn-Active').forEach(button => {
    //     button.addEventListener('click', function () {

    //         const form = this.closest('.form-Active');

    //         Swal.fire({
    //             title: 'Aktif?',
    //             text: 'Data ini akan di aktikan',
    //             icon: 'warning',
    //             showCancelButton: true,
    //             confirmButtonText: 'Ya, aktifkan',
    //             cancelButtonText: 'Batal',
    //             reverseButtons: true
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 form.submit();
    //             }
    //         });

    //     });
    // });
});
</script>