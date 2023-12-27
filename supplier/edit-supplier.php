<?php 

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../modul/mode-supplier.php";
$tittle = "Edit Supplier";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

//jalankan func update data
if (isset($_POST['update'])) {
    if (update($_POST) > 0) {
        echo "<script>
            document.location.href = 'data-supplier.php?msg=updated';
        </script>";
    }
}

$id = $_GET['id'];

$sqlEdit = "SELECT * FROM tbl_supplier WHERE id_supplier = $id";
$supplier = getData($sqlEdit)[0];




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
                            <i class="fa-solid fa-plus"></i> edit Supplier
                            <button type="submit" name="update" class="btn btn-warning float-end ">Ubah</button>
                            <a href="../supplier/data-supplier.php" class="btn btn-danger float-end me-2">Batal</a>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="id" value="<?= $supplier['id_supplier'] ?>">
                                <!-- <?php if ($alert != '') {
                                    echo $alert;
                                } ?> -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" value="<?= $supplier['nama'] ?>" name="nama" class="form-control" id="nama" placeholder="Masukan Nama Supplier" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telpon" class="form-label">Telpon</label>
                                    <input type="text" name="telpon" value="<?= $supplier['telpon'] ?>" class="form-control" id="telpon" placeholder="No Telpon Suplier" pattern="[0-9]{5,}" title="minimal 5 angka" required>
                                </div> 
                                <div class="mb-3">
                                    <label for="ketr" class="form-label">Deskripsi</label>
                                    <textarea name="ketr" id="ketr" rows="1" class="form-control" placeholder="Keterangan Supplier" required><?= $supplier['deskripsi'] ?></textarea>
                                </div> 
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea name="alamat" id="alamat"  rows="3" class="form-control" placeholder="Alamat" required><?= $supplier['alamat'] ?></textarea>
                                </div> 
                                
                            </div>
                            </form>
                        </div>
                    </div>
                </main>



<?php 

require "../template/footer.php";

?>