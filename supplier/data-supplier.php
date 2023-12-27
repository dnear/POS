<?php 

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../modul/mode-supplier.php";

$tittle = "Daftar Supplier";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}else {
    $msg = '';
}

$alert = '';
if ($msg == 'deleted') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa-regular fa-circle-check me-2"></i>
    <strong>Supplier Berhasil Dihapus</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

if ($msg == 'aborted') {
    $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i>
    <strong>Supplier Berhasil Dihapus</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

if ($msg == 'updated') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="fa-regular fa-pen-to-square"></i>
    <strong>Data supplier Berhasil Diperbaharui</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>


<div id="layoutSidenav_content">
                <main>
                    
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Supplier</h1>
                
                        <div class="card mb-4">
                            <?php if ($alert != '') {
                                echo $alert;
                            } ?>
                            <div class="card-header">
                            <i class="fa-solid fa-list"></i> List Supplier
                            <a href="<?= $main_url ?>supplier/add-supplier.php" class="btn btn-outline-primary float-end"><i class="fa-solid fa-plus"></i>Add Supplier</a>
                            </div>
                            <div class="card-body table-responsive p-3">
                                <table class="table table-hover text-nowrap" id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Telpon</th>
                                            <th>Alamat</th>
                                            <th>Deskripsi</th>
                                            <th style="width: 10%;">Operasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        $no     = 1;
                                        $suppliers  = getData("SELECT * FROM tbl_supplier");
                                        foreach ($suppliers as $supplier) :
                                        ?>

                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $supplier['nama'] ?></td>
                                            <td><?= $supplier['telpon'] ?></td>
                                            <td><?= $supplier['alamat'] ?></td>
                                            <td><?= $supplier['deskripsi'] ?></td>
                                            <td>
                                                <a href="edit-supplier.php?id=<?= $supplier['id_supplier'] ?>" title="edit supplier"><button class="btn btn-sm btn-warning">Edit</button></a>
                                                <a href="del-supplier.php?id=<?= $supplier['id_supplier'] ?>" title="hapus supplier" onclick="return confirm('Anda yakin menghapus supplier ini ?')"><button class="btn btn-sm btn-danger">Hapus</button></a>
                                            </td>
                                        </tr>

                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </main>



<?php 

require "../template/footer.php"

?>