<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css" integrity="sha512-3PN6gfRNZEX4YFyz+sIyTF6pGlQiryJu9NlGhu9LrLMQ7eDjNgudQoFDK3WSNAayeIKc6B8WXXpo4a7HqxjKwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }
    </style>
    <title>Login</title>
</head>

<body>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="text-center">
                                    <img src="<?= base_url(); ?>/img/fastprint_img.png" style="width: 185px;" alt="logo">
                                    <h4 class="mt-1 mb-4 pb-1"></h4>
                                </div>
                                <?php if (session()->getFlashdata('success')) : ?>
                                    <div class="alert alert-success">
                                        <?= session()->getFlashdata("success"); ?>
                                    </div>
                                <?php endif ?>
                                <?php if (session()->getFlashdata('error')) : ?>
                                    <div class="alert alert-danger">
                                        <?= session()->getFlashdata("error"); ?>
                                    </div>
                                <?php endif ?>
                                <p>Silahkan Login Untuk Mengakses WEB</p>
                                <form action="<?= site_url("auth/cek_login"); ?>" method="post" id="login-form">
                                    <div class="form-outline mb-2">
                                        <label class="form-label" for="form2Example11">Username</label>
                                        <input type="text" id="form2Example11" name="username" class="form-control" placeholder="Phone number or email address" />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example22">Password</label>
                                        <input type="password" id="form2Example22" name="password" class="form-control" />
                                        <div class="d-flex justify-content-start mt-1">
                                            <input type="checkbox" name="remember_me" value="true">
                                            <div class="px-1">Ingat Saya</div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button class="btn btn-primary btn-block mb-3" id="btn-login" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center">
                            <img src="<?= base_url(); ?>/img/login.jpg" alt="login" width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $(document).on("submit", "#login-form", function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr("action"),
                    type: "post",
                    dataType: "json",
                    data: $("#login-form").serialize(),
                    beforeSend: function() {
                        $("#btn-login").html('<i class="fas fa-sync fa-spin"></i>');
                    },
                    success: function(response) {
                        if (response.log == true) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: response.pesan,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(() => {
                                let timerInterval
                                Swal.fire({
                                    title: 'Redirect',
                                    html: 'Masuk ke halaman admin <b></b>',
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
                                        window.location.href = response.url;
                                    }
                                })

                            }, 1700);
                            $("#btn-login").html('Login');
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: response.pesan,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#btn-login").html('Login');
                        }
                    },
                    error: function(e) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: "Permintaan login gagal dilakukan. silahkan refresh ulang atau login kembali nanti",
                            showConfirmButton: true,
                            timer: 3000
                        })
                        $("#btn-login").html('Login');
                    }
                })
            })
        })
    </script>
</body>

</html>