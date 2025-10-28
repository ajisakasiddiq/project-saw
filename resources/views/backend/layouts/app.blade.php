<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ url('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ url('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ url('assets/img/ico/favicon.ico') }}" type="image/x-icon">
    <!-- <link rel="icon" href="{{ url('assets/') }}img/ico/favicon.ico" type="image/x-icon"> -->
    <!-- Fav Icon -->
    <link rel="icon" type="image/png" href="{{ url('assets/img/ico/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ url('assets/img/ico/favicon-16x16.png') }}" sizes="16x16" />

    <script src="{{ url('assets/vendor/jquery/jquery.min.js')}}"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

    <style>
        /* Customize the label (the container) */
        .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        /* Hide the browser's default radio button */
        .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
        }

        /* Create a custom radio button */
        .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border-radius: 50%;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
        background-color: #ccc;
        }

        /* When the radio button is checked, add a blue background */
        .container input:checked ~ .checkmark {
        background-color: #2196F3;
        }

        /* Create the indicator (the dot/circle - hidden when not checked) */
        .checkmark:after {
        content: "";
        position: absolute;
        display: none;
        }

        /* Show the indicator (dot/circle) when checked */
        .container input:checked ~ .checkmark:after {
        display: block;
        }

        /* Style the indicator (dot/circle) */
        .container .checkmark:after {
        top: 9px;
        left: 9px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('backend.layouts._sidebar')
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            
            <!-- Main Content -->
            <div id="content">
                
                @include('backend.layouts._navbar')

            @yield('content');

                
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SPK AHP UKT <?= date('Y') ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keluar ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah kamu yakin akan keluar (logout) ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="{{ route('logout')}}"><i class="fas fa-fw fa-sign-out-alt mr-1"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('assets/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{ url('assets/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ url('assets/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ url('assets/js/demo/chart-pie-demo.js')}}"></script>

    <!-- SweetAlert2 -->
    <script src="{{url('assets/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ url('assets/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{ url('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ url('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{ url('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ url('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <script>
    $.fn.DataTable.ext.pager.numbers_length = 4;
</script>

<script>
    $(function() {
        $("#user").DataTable({
            // "lengthChange": false,
            "responsive": true,
            "autoWidth": false
        }).buttons().container().appendTo('#user_wrapper .col-md-6:eq(0)');
    });
    $(function() {
        $("#mhs").DataTable({
            // "lengthChange": false,
            "responsive": false,
            "autoWidth": false
        }).buttons().container().appendTo('#mhs_wrapper .col-md-6:eq(0)');
    });
    $(function() {
        $("#rank").DataTable({
            "lengthChange": false,
            "responsive": false,
            "autoWidth": false
        }).buttons().container().appendTo('#rank_wrapper .col-md-6:eq(0)');
    });
    $(function() {
        $("#final").DataTable({
            // layout: {
                // topStart: {
                    buttons: [
                        'pdfHtml5', 'excel'
                    ],
                // },
                "lengthChange": false,
                "responsive": false,
                "autoWidth": false
            // }
        }).buttons().container().appendTo('#final_wrapper .col-md-6:eq(0)');
    });
</script>

<script type="text/javascript">

var rupiah = document.getElementById('ukt');
rupiah.addEventListener('keyup', function(e){
 // tambahkan 'Rp.' pada saat form di ketik
 // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
rupiah.value = formatRupiah(this.value, 'Rp. ');
});

 /* Fungsi formatRupiah */
function formatRupiah(angka, prefix){
var number_string = angka.replace(/[^,\d]/g, '').toString(),
split   = number_string.split(','),
sisa     = split[0].length % 3,
rupiah     = split[0].substr(0, sisa),
ribuan     = split[0].substr(sisa).match(/\d{3}/gi);

 // tambahkan titik jika yang di input sudah menjadi angka ribuan
if(ribuan){
separator = sisa ? '.' : '';
rupiah += separator + ribuan.join('.');
}

rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
</script>

<script>
    $('.del').on('click', function(e) {
        let form =  $(this).closest("form");
        event.preventDefault();

        Swal.fire({
            title: 'Anda yakin mau menghapus?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = this.href;
            }
        })
    });
    $('.del2').on('click', function(e) {
        let form =  $(this).closest("form");
        event.preventDefault();

        Swal.fire({
            title: 'Anda yakin mau menghapus?',
            text: "Data mahasiswa mungkin kurang lengkap atau kurang cocok!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = this.href;
            }
        })
    });
        $('.daf').on('click', function(e) {
        let form =  $(this).closest("form");
        event.preventDefault();

        Swal.fire({
            title: 'Apakah data yang dimasukkan sudah benar?',
            text: "Data yang disimpan tidak dapat di edit kembali!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, daftar!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = this.href;
            }
        })
    });
        $('.rank').on('click', function(e) {
        let form =  $(this).closest("form");
        event.preventDefault();

        Swal.fire({
            title: 'Lakukan Perangkingan?',
            text: "Proses yang dilakukan adalah menghitung seluruh data pendaftar!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, lakukan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = this.href;
            }
        })
    });
</script>
<script>
    $('#file01').on('change',function(){
        //get the file name
        var fileName = $(this).val();
            //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
        })
</script>
<script>
    $('.res').on('click', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');

        Swal.fire({
            title: 'Anda yakin mau mereset data?',
            text: "Data yang direset akan dikembalikan default!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, reset!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = this.href;
            }
        })
    });
</script>

</body>

</html>