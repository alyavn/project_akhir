<?php 
require 'functions.php';

if (isset($_POST["register"])) {
    // kalau nilainya lebih dari 0 artinya ada user baru yang berhasil masuk ke database
    if ( registrasi($_POST) > 0 ) {
        echo "<script>
                alert('user baru berhasil ditambahkan');
              </script>";
    } else {
        echo mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <style>
        body {
            background-image: url(img/bgimage.webp);
        }
    </style>
    </style>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-6 mt-5 offset-md-3 shadow p-4" style="background-color: lightgray;">

                <form action="" method="post">
                    <fieldset>
                        <legend class="text-center">Halaman Registrasi</legend>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" class="form-control" placeholder="Silahkan isi username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Silahkan isi password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="form-label">Konfirmasi password</label>
                            <input type="password" id="password2" class="form-control" placeholder="Silahkan konfirmasi password" name="password2">
                        </div>
                        <div class="text-center mb-2">
                            <button type="submit" name="register" class="btn btn-primary">Sign Up</button>
                        </div>
                        <div class="text-center mb-2">
                            <p>kembali ke halaman <a href="login.php">log in</a></p>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>
</body>
</html>