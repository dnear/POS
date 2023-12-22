<?php 

function insert($data){
    global $koneksi;

    $username   = strtolower(mysqli_real_escape_string($koneksi, $data['username']));
    $fullname   = mysqli_real_escape_string($koneksi, $data['fullname']);
    $password   = mysqli_real_escape_string($koneksi, $data['password']);
    $password2  = mysqli_real_escape_string($koneksi, $data['password2']);
    $level      = mysqli_real_escape_string($koneksi, $data['level']);
    $address    = mysqli_real_escape_string($koneksi, $data['address']);
    $gambar     = mysqli_real_escape_string($koneksi, $_FILES['image']['name']);

    if ($password !== $password2) {
        echo '<script>
                alert("Konfirmasi password tidak sesuai, User gagal di tambahkan !");
            </script>';
        return false;
    }

    $pass = password_hash($password, PASSWORD_DEFAULT);

    $cekUsername    = mysqli_query($koneksi, "SELECT username FROM tbl_user WHERE username = '$username'");
    if (mysqli_num_rows($cekUsername) > 0) {
        echo '<script>
                alert("Username sudah ada, User gagal di tambahkan !");
            </script>';
        return false;
    }

    if ($gambar != null) {
        $gambar = uploadimg();
    }else {
        $gambar = 'default.png';
    }

    //gambar tidak sesuai validasi
    if ($gambar == '') {
        return false;
    }

    $sqlUser    = "INSERT INTO tbl_user VALUE (null, '$username', '$fullname', '$pass', '$address', '$level', '$gambar')";
    mysqli_query($koneksi, $sqlUser);

    return mysqli_affected_rows($koneksi);

}

function delete($id, $foto){
    global $koneksi;

    $sqlDel = "DELETE FROM tbl_user WHERE userid = $id";
    mysqli_query($koneksi, $sqlDel);
    if ($foto != 'default.png') {
        unlink('../assets/image/' . $foto);
    }

    return mysqli_affected_rows($koneksi);
}

function selectUser1($level){
    $result = null;
    if ($level == 1) {
        $result = "selected";
    }
    return $result;
}
function selectUser2($level){
    $result = null;
    if ($level == 2) {
        $result = "selected";
    }
    return $result;
}
function selectUser3($level){
    $result = null;
    if ($level == 3) {
        $result = "selected";
    }
    return $result;
}

function update($data){
    global $koneksi;

    $iduser     = mysqli_real_escape_string($koneksi, $data['id']);
    $username   = strtolower(mysqli_real_escape_string($koneksi, $data['username']));
    $fullname   = mysqli_real_escape_string($koneksi, $data['fullname']);
    $level      = mysqli_real_escape_string($koneksi, $data['level']);
    $address    = mysqli_real_escape_string($koneksi, $data['address']);
    $gambar     = mysqli_real_escape_string($koneksi, $_FILES['image']['name']);
    $fotoLama   = mysqli_real_escape_string($koneksi, $data['oldImg']);

    //cek username sekarang
    $queryUsername = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE userid = $iduser");
    $dataUsername   = mysqli_fetch_assoc($queryUsername);
    $curUsername    = $dataUsername['username'];

    //cek username baru
    $newUSername = mysqli_query($koneksi, "SELECT username FROM tbl_user WHERE username = '$username'");

    if ($username != $curUsername) {
        if (mysqli_num_rows($newUSername)) {
            echo '<script>
                alert("Username sudah ada, Update data user gagal !");
            </script>';
        return false;
        }
    }

    //cek gambar
    if ($gambar != null) {
        $url = "data-user.php";
        $imgUser =uploadimg($url);
        if ($fotoLama != 'default.png') {
            @unlink('../assets/image/' . $fotoLama);
        }
    }else {
        $imgUser = $fotoLama;
    }


    mysqli_query($koneksi, "UPDATE tbl_user SET
                            username    = '$username',
                            fullname    = '$fullname',
                            address    = '$address',
                            level    = '$level',
                            foto    = '$imgUser'
                            WHERE userid = $iduser
                            ");

    return mysqli_affected_rows($koneksi);

}


?>