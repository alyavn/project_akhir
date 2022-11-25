<?php
session_start();

if(!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

// koneksi database
require 'functions.php';

// ambil data dari tabel database (function)
$siswa = query("SELECT * FROM tb_siswa ORDER BY id ASC");

// tombol cari ditekan
if ( isset($_POST["cari"])) {
    $siswa = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP DATABASE</title>

    <style>
        body {
            background-image: url(img/bgimage.webp);
        }
    </style>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    

    <div class="container p-4 rounded mb-5 mt-5" style="width: 80%; margin:auto; background-color: lightgray;">
    <h1 class="text-center ">Daftar Siswa</h1>

    <a class="btn btn-warning mb-3" href="tambah.php">Tambah data mahasiswa</a>
    <a class="btn btn-warning mb-3" href="logout.php">Log Out</a>

    <form class="d-flex" action="" method="post">
        <input class="form-control me-3" type="text" name="keyword" size="25" autofocus placeholder="Telusuri..." autocomplete="off">
        <button class="btn btn-primary" type="submit" name="cari">Cari!</button>
    </form>
    <br>

    <table class="table table-striped mb-3 bg-body rounded" style="width: 97%; margin:auto;" cellspacing="0" cellpadding="10">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Jurusan</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach( $siswa as $student ) : ?> 
        <tr>
            <td><?= $i ?></td>
            <td>
                <a href="ubah.php?id=<?= $student["id"]; ?>">ubah</a> |
                <a href="hapus.php?id=<?= $student["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
            </td>
            <td><img src="img/<?= $student["gambar"]; ?>" alt="" width="50"></td>
            <td><?= $student["nis"]; ?></td>
            <td><?= $student["nama"]; ?></td>
            <td><?= $student["tempat_lahir"]; ?></td>
            <td><?= $student["tanggal_lahir"]; ?></td>
            <td><?= $student["jurusan"]; ?></td>
        </tr>
        <?php $i++ ; ?>
        <?php endforeach; ?>
    </table>
    </div>
</body>
</html>