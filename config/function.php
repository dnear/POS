<?php 

function uploadimg($url = null){
    $namafile   = $_FILES['image']['name'];
    $ukuran     = $_FILES['image']['size']; 
    $tmp        = $_FILES['image']['tmp_name'];
    
    
    //validasi file gambar yang boleh diupload
    $ekstensiGambarValid    = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensiGambar         = explode('.', $namafile);
    $ekstensiGambar         =strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        if ($url != null) {
            echo '<script>
                alert("file yang anda upload bukan gambar, Data gagal di update !");
                document.location.href = "' . $url . '";
            </script>';
        die();
        } else {
        echo '<script>
                alert("file yang anda upload bukan gambar, Data gagal di tambahkan !");
            </script>';
        return false;
        }
    }

    //validasi ukuran gambar max 1 MB
    if ($ukuran>1000000) {
        if ($url != null) {
            echo '<script>
                alert("Ukuran gambar melebihi 1MB, Data gagal di update !");
                document.location.href = "' . $url . '";
            </script>';
        die();
        } else {
        echo '<script>
                alert("Ukuran gambar tidak boleh lebih dari 1 MB, Data gagal di tambahkan !");
            </script>';
        return false;
        }
    }

    $namaFileBaru = rand(10, 1000) . '-' . $namafile;
    
    move_uploaded_file($tmp,'../assets/image/' . $namaFileBaru );
    return $namaFileBaru;
}

function getData($sql){
    global $koneksi;

    $result = mysqli_query($koneksi, $sql);
    $row    = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

//fungsi user login

function userLogin(){
    $userActive = $_SESSION["ssUserPOS"];
    $dataUser   = getData("SELECT * FROM tbl_user WHERE username = '$userActive'")[0];
    return $dataUser;
}


?>