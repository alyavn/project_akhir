<?php 
// CADANGAN

// koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "db_siswa");

// ambil data dari tabel database
$result = mysqli_query($koneksi, "SELECT * FROM tb_siswa");

// ambil data (fecth) siswa dari object result
// mysqli_fetch_row() yaitu mengembalikan array numeric
// mysqli_fetch_assoc() yaitu mengembalikan array associative 
// mysqli_fetch_array() yaitu mengembalikan array numeric & associative
// mysqli_fetch_object()
// contoh
// $siswa = mysqli_fetch_object ($result);
// var_dump ($siswa->nama)

// looping
// while ( $siswa = mysqli_fetch_assoc($result) ) {
//     var_dump($siswa);
// }

// cara mengecek isi table
// var_dump ($result);

// cara mengecek apakah error atau tidak
// if ( !$result ) {
//     echo mysqli_error($koneksi);
// }
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP DATABASE</title>
</head>
<body>
    <h1>Daftar Siswa</h1>
    <table border="1" cellspacing="0" cellpadding="8">
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
        <?php while ( $siswa = mysqli_fetch_assoc($result) ) : ?> 
        <tr>
            <td><?= $i ?></td>
            <td>
                <a href="">ubah</a> |
                <a href="">hapus</a>
            </td>
            <td><img src="img/<?= $siswa["gambar"]; ?>" alt="" width="50"></td>
            <td><?= $siswa["nis"]; ?></td>
            <td><?= $siswa["nama"]; ?></td>
            <td><?= $siswa["tempat_lahir"]; ?></td>
            <td><?= $siswa["tanggal_lahir"]; ?></td>
            <td><?= $siswa["jurusan"]; ?></td>
        </tr>
        <?php $i++ ; ?>
        <?php endwhile; ?>
    </table>
</body>
</html>