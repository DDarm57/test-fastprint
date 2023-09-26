<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FastPrint | <?= $title; ?></title>
    <link rel="icon" href="<?= base_url() ?>/img/logo_fastprint.png" type="image/gif">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>/template/dist/css/adminlte.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <img src="<?= base_url(); ?>/img/fastprint_img.png" alt="AdminLTE Logo" class="brand-image">
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?= base_url("produk"); ?>" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("produk/data_produk"); ?>" class="nav-link">Data Produk</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("kategoriProduk"); ?>" class="nav-link">Kategori Produk</a>
                        </li>
                    </ul>

                    <!-- SEARCH FORM -->
                    <form class="form-inline ml-0 ml-md-3">
                        <div class="input-group input-group-sm">
                            <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalLogout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </form>
                </div>
                <!-- Right navbar links -->
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $title; ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= site_url("produk"); ?>">Home</a></li>
                                <li class="breadcrumb-item active"><?= $title; ?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <?php
                    $cek_dataApi = session()->get('api_produk');
                    if (!$cek_dataApi) {
                        echo "
                        <script>
                        alert('Sesi telah berakhir. Silahkan login kembali');
                        window.location.href = 'auth/login'
                        </script>
                        ";
                    }
                    ?>
                    <?= $this->renderSection("content"); ?>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="py-4">
                                        <div class="text-center">
                                            <img src="<?= base_url(); ?>/img/logout_img.jpg" alt="logout" width="80%">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                                    <a href="<?= site_url("auth/logout"); ?>" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url(); ?>/template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>/template/dist/js/adminlte.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url(); ?>/template/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>/template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>/template/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url(); ?>/template/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url(); ?>/template/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url(); ?>/template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>/template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>/template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        $(document).ready(function() {
            function formatNumber(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            // funsi hapus
            $(document).on("click", ".hapus", function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus Data',
                    text: "Apakah anda yakin ingin menghapus data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus data!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let timerInterval
                        Swal.fire({
                            title: 'Validasi Data',
                            html: 'Sedang memvalidasi data <b></b>',
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.href = $(this).attr("href");
                            }
                        })
                    }
                })
            })
            //create form produk
            $('#produk-form').validate({ // initialize the plugin
                rules: {
                    nama_produk: {
                        required: true,
                    },
                    harga: {
                        required: true,
                    },
                    kategori_id: {
                        required: true,
                    },
                },
                messages: {
                    nama_produk: {
                        required: 'Nama produk tidak boleh kosong'
                    },
                    harga: {
                        required: 'Harga tidak boleh kosong'
                    },
                    kategori_id: {
                        required: 'Kategori tidak boleh kosong'
                    },
                }
            });

            $(".modal-body #form-produk").hide();
            $(document).on("click", ".insert-produk", function(e) {
                e.preventDefault();
                let nama_produk = $(this).data("nama_produk");
                let harga = $(this).data("harga");
                let kategori = $(this).data("kategori");
                let status = $(this).data("status");
                $(".modal-body #table-produk").slideUp(700);
                setTimeout(() => {
                    $(".modal-body #form-produk").slideDown();
                }, 700);
                $(".modal-body #nama_produk").val(nama_produk);
                $(".modal-body #harga").val(harga);
                $(".modal-body #kategori_id").val(kategori);
                $(".modal-body #status").text(status).change();
            })

            $(document).on("click", "#cancel-input", function() {
                $(".modal-body #form-produk").slideUp();
                setTimeout(() => {
                    $(".modal-body #table-produk").slideDown(700);
                }, 700);
                $(".modal-body #nama_produk").val("");
                $(".modal-body #harga").val("");
                $(".modal-body #kategori_id").val("");
                $(".modal-body #status").val("");
            })

            $("#harga").keyup(() => {
                const inputText = $("#harga").val();
                console.log(inputText);
                $("#view-harga").text("Rp. " + formatNumber(inputText))
            })

            //form kategori
            $("#kategori-form").validate({
                rules: {
                    nama_kategori: {
                        required: true,
                    },
                },
                messages: {
                    nama_kategori: {
                        required: 'Nama kategori tidak boleh kosong'
                    },
                }
            })
            //tambah kategori
            $(document).on("click", ".tambah-kategori", function() {
                $(".modal-body #nama_kategori").val("selected").change();
                $(".modal-body #kategori-form").attr("action", "/kategoriProduk/save_kategori");
            })
            // edit kategori
            $(document).on("click", ".edit-kategori", function(e) {
                e.preventDefault();
                let id_kategori = $(this).data("id_kategori");
                let nama_kategori = $(this).data("nama_kategori");

                $(".modal-body #nama_kategori").val(nama_kategori).change();
                $(".modal-body #kategori-form").attr("action", "/kategoriProduk/update_kategori/" + id_kategori);

            })
        })
    </script>
</body>

</html>