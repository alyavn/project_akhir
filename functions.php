<?php 
// koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "db_siswa");

function query($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($post) {
    global $koneksi;
    // ambil data dari tiap elemen dalam form
    $nis = htmlspecialchars($post["nis"]);
    $nama = htmlspecialchars($post["nama"]);
    $tempat_lahir = htmlspecialchars($post["tempat_lahir"]);
    $tanggal_lahir = htmlspecialchars($post["tanggal_lahir"]);
    $jurusan = htmlspecialchars($post["jurusan"]);

    // upload gambar
    $gambar = upload();
    if ( !$gambar ) {
        return false;
    }

    // query insert data
    $query = "INSERT INTO tb_siswa
                VALUES
                ('', '$nis', '$nama', '$tempat_lahir', '$tanggal_lahir', '$jurusan', '$gambar')
                ";
    mysqli_query($koneksi,  $query);

    return mysqli_affected_rows($koneksi);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yg diupload
    // jika 4 berarti tidak ada gambar yang diupload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
              </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar');
              </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
        return false;
    }

    // jika lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    // uniqid() akan membangkitkan string random (angka) yang nantinya akan jadi nama gambar
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapus($id) {
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_siswa WHERE id = $id");

    return mysqli_affected_rows($koneksi);
}

function ubah($post) {
    global $koneksi;
    // ambil data dari tiap elemen dalam form
    $id = $post["id"];
    $nis = htmlspecialchars($post["nis"]);
    $nama = htmlspecialchars($post["nama"]);
    $tempat_lahir = htmlspecialchars($post["tempat_lahir"]);
    $tanggal_lahir = htmlspecialchars($post["tanggal_lahir"]);
    $jurusan = htmlspecialchars($post["jurusan"]);
    $gambarLama = htmlspecialchars($post["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    // query insert data
    $query = "UPDATE tb_siswa SET
                nis = '$nis',
                nama = '$nama',
                tempat_lahir = '$tempat_lahir',
                tanggal_lahir = '$tanggal_lahir',
                jurusan ='$jurusan',
                gambar = '$gambar'
              WHERE id = $id
                ";
    mysqli_query($koneksi,  $query);

    return mysqli_affected_rows($koneksi);
}

function cari($keyword) {
    $query = "SELECT * FROM tb_siswa
                WHERE
              nama LIKE '%$keyword%' OR
              nis LIKE '%$keyword%' OR
              tempat_lahir LIKE '%$keyword%' OR
              tanggal_lahir LIKE '%$keyword%' OR
              jurusan LIKE '%$keyword%'
            ";
    return query($query);
}
// kalau sama dengan (=) harus sama
// kalau (LIKE dengan % di depan dan dibelakang keyword) tidak harus sama keywordnya

function registrasi($post) {
    global $koneksi;
    $username = strtolower(stripslashes($post["username"]));
    $password = mysqli_real_escape_string($koneksi, $post["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $post["password2"]);
    // mysqli_real_escape_string() adalah untuk memungkinkan usernya masukan password ada tanda kutipnya, dan tanda kutipnya akan dimasukkan ke database secara aman

    // cek username sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username yang dipilih sudah terdaftar!')
              </script>";
        return false;
    }
 
    // cek konfirmasi password
    if ( $password !== $password2 ) {
        echo "<script>
                alert(' konfirmasi password tidak sesuai!');
              </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($koneksi, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($koneksi);
}
?>  