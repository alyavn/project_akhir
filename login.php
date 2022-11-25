<?php
session_start();
require 'functions.php';

// cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
   $id = $_COOKIE['id'];
   $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if( $key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if( isset($_SESSION["login"])) {
    header("location: index.php");
    exit; 
}



if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query  ($koneksi,"SELECT * FROM user WHERE username = '$username'");

    // cek username
    // mysqli_num_rows() untul menghitung ada berapa baris yang dikembalikan dari fungsi select. kalo ketemu pasti nilainya 1 (kalo ada username didalam tabel user), tapi kalo ga ada nilainya pasti 0
    if( mysqli_num_rows($result) === 1 ) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;
            
            // cek remember me
            if (isset($_POST['remember'])) {
                // buat cookie

                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256', $row['username']), time()+60);
            }

            header("location: index.php");
            exit;
        }
    }

    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>
    <style>
        body {
            background-image: url(img/bgimage.webp);
        }
    </style>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-6 mt-5 offset-md-3 shadow p-3" style="background-color: lightgray;">

                <form action="" method="post">
                    <fieldset>
                        <legend class="text-center">Halaman Login</legend>
                        <?php if(isset($error)) :?>
                        <p style="color: red; font-style: italic;">username atau password salah</p>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" class="form-control" placeholder="Silahkan isi username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Silahkan isi password" name="password">
                        </div>
                        <div class="mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                        </div>
                        <div class="text-center mb-2">
                            <button type="submit" name="login" class="btn btn-primary">Log in</button>
                        </div>
                        <p class="text-center">belum punya akun? <a href="registrasi.php">Sign Up</a></p>
                    </fieldset>
                </form>

            </div>
        </div>

        




    </div>
</body>
</html>