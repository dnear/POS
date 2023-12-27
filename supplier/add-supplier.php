<?php 

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../modul/mode-supplier.php";
$tittle = "Tambah Supplier";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$alert = '';

if (isset($_POST['simpan'])) {
    if (insert($_POST) > 0) {
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-circle-check me-2"></i>
        <strong>Supplier Berhasil Ditambahkan!</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

?>

<div id="layoutSidenav_content">
                <main>
                    
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Supplier</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Supplier</li>
                        </ol>
                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="card mb-4">
                            <div class="card-header">
                            <i class="fa-solid fa-plus"></i> Add Supplier
                            <button type="submit" name="simpan" class="btn btn-primary float-end ">Simpan</button>
                            <button type="reset" class="btn btn-danger float-end me-2">Batal</button>
                            </div>
                            <div class="card-body">
                                <?php if ($alert != '') {
                                    echo $alert;
                                } ?>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan Nama Supplier" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telpon" class="form-label">Telpon</label>
                                    <input type="text" name="telpon" class="form-control" id="telpon" placeholder="No Telpon Suplier" pattern="[0-9]{5,}" title="minimal 5 angka" required>
                                </div> 
                                <div class="mb-3">
                                    <label for="ketr" class="form-label">Deskripsi</label>
                                    <textarea name="ketr" id="ketr"  rows="1" class="form-control" placeholder="Keterangan Supplier" required></textarea>
                                </div> 
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea name="alamat" id="alamat"  rows="3" class="form-control" placeholder="Alamat" required></textarea>
                                </div> 
                                
                            </div>
                            </form>
                        </div>
                    </div>
                </main>



<?php 

require "../template/footer.php";

?>