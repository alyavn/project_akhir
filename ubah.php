<?php
session_start();

if(!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions.php';
// ambil data di url
$id = $_GET["id"];

// query data siswa berdasarkan id
$siswa = query("SELECT * FROM tb_siswa WHERE id = $id")[0];


// cek apakah tombol submit sudah ditekan atau belum
if ( isset($_POST["submit"]) ) {
    
    // cek apakah data berhasil diubah atau tidak
    if ( ubah ($_POST) > 0 ) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Siswa</title>
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
            <div class="col col-md-6 mt-5 offset-md-3 shadow p-4" style="background-color: lightgray;">
    

                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $siswa["id"]; ?>">
                    <input type="hidden" name="gambarLama" value="<?= $siswa["gambar"]; ?>">
                    <fieldset>
                        <h2 class="text-center">Ubah Data Siswa</h2>
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" id="nis" class="form-control" name="nis" required value="<?= $siswa["nis"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="nama" class="form-control" name="nama" required value="<?= $siswa["nama"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" class="form-control" name="tempat_lahir" required value="<?= $siswa["tempat_lahir"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" class="form-control" name="tanggal_lahir" required value="<?= $siswa["tanggal_lahir"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" id="jurusan" class="form-control" name="jurusan" required value="<?= $siswa["jurusan"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <img src="img/<?= $siswa['gambar']; ?>" width="50"> <br>
                            <input type="file" id="gambar" class="form-control" name="gambar" required>
                        </div>
                        <div class="text-center mb-2">
                            <button type="submit" name="submit" class="btn btn-primary">Ubah Data!</button>
                        </div>
                    </fieldset>
                </form>

                
            </div>
        </div>
    </div>
</body>
</html>