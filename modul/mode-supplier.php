<?php 

if (userLogin()['level'] == 3) {
    header("location:" . $main_url . "404.html");
    exit();
}

function insert($data){
    global $koneksi;

    $nama   = mysqli_real_escape_string($koneksi, $data['nama']);
    $telpon   = mysqli_real_escape_string($koneksi, $data['telpon']);
    $alamat   = mysqli_real_escape_string($koneksi, $data['alamat']);
    $ketr   = mysqli_real_escape_string($koneksi, $data['ketr']);

    $sqlSuplier     = "INSERT INTO tbl_supplier VALUES (null, '$nama', '$telpon', '$ketr', '$alamat')";
    mysqli_query($koneksi, $sqlSuplier);

    return mysqli_affected_rows($koneksi);
}

function delete($id){
    global $koneksi;

    $sqlDelete = "DELETE FROM tbl_supplier WHERE id_supplier = $id";
    mysqli_query($koneksi, $sqlDelete);

    return mysqli_affected_rows($koneksi);
}

function update($data){
    global $koneksi;

    $id   = mysqli_real_escape_string($koneksi, $data['id']);
    $nama   = mysqli_real_escape_string($koneksi, $data['nama']);
    $telpon   = mysqli_real_escape_string($koneksi, $data['telpon']);
    $alamat   = mysqli_real_escape_string($koneksi, $data['alamat']);
    $ketr   = mysqli_real_escape_string($koneksi, $data['ketr']);

    $sqlSuplier     = "UPDATE tbl_supplier SET 
                        nama    = '$nama',
                        telpon  = '$telpon',
                        deskripsi   = '$ketr',
                        alamat  = '$alamat'
                        WHERE id_supplier = $id
                        ";
    mysqli_query($koneksi, $sqlSuplier);

    return mysqli_affected_rows($koneksi);

}

?>