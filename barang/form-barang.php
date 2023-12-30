<?php 

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../modul/mode-barang.php";
$tittle = "Form Barang";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    $id = $_GET['id'];
    $sqlEdit = "SELECT * FROM tbl_barang WHERE id_barang = '$id'";
    $barang = getData($sqlEdit)[0];
}else {
    $msg = '';
}

$alert = '';

if (isset($_POST['simpan'])) {
    if ($msg != '') {
        if (update($_POST)) {
            echo "
                <script>document.location.href = 'index.php?msg=updated';</script>
            ";
        }else {
            echo "
            <script>document.location.href = 'index.php';</script>
        ";
        }
    }else {
    if (insert($_POST)) {
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-circle-check me-2"></i>
        <strong>Data Barang Berhasil Ditambahkan!</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    }
}

?>

<div id="layoutSidenav_content">
                <main>
                    
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Barang</li>
                        </ol>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fa-solid fa-plus"></i> <?= $msg  != '' ? 'Edit Barang' : 'Add Barang' ; ?>
                                    <button type="submit" name="simpan" class="btn btn-primary float-end ">Simpan</button>
                                    <button type="reset" class="btn btn-danger float-end me-2">Batal</button>
                                </div>
                                <div class="card-body">
                                    <?php if ($alert != '') {
                                        echo $alert;
                                    } ?>
                                    <div class="mb-3">
                                        <label for="kode" class="form-label">Kode Barang</label>
                                        <input type="text" value="<?= $msg  != '' ? $barang['id_barang'] : generateId() ; ?>" name="kode" class="form-control bg-secondary text-light" id="kode" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="barcode" class="form-label">Barcode *</label>
                                        <input type="text" name="barcode" class="form-control" value="<?= $msg  != '' ? $barang['barcode'] : null ; ?>" id="barcode" placeholder="Barcode" autocomplete="off" autofocus required>
                                    </div> 
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama *</label>
                                        <input type="text" name="name" class="form-control" value="<?= $msg  != '' ? $barang['nama_barang'] : null ; ?>" id="name" placeholder="Nama Barang" autocomplete="off" autofocus required>
                                    </div> 
                                    <div class="mb-3">
                                        <label for="satuan" class="form-label">Satuan *</label>
                                        <select name="satuan" id="satuan" class="form-control" required>
                                            <?php 
                                                if ($msg != '') {
                                                    $satuan = ["piece", "botol", "kaleng", "pouch"];
                                                    foreach ($satuan as $sat) {
                                                        if ($barang['satuan '] == $sat) { ?>
                                                            <option value="<?= $sat ?>" selected><?= $sat ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $sat ?>"><?= $sat ?></option>
                                                            <?php 
                                                        }
                                                    }
                                                }else { ?>
                                                <option value="">-- Satuan Barang --</option>
                                            <option value="piece">PCS</option>
                                            <option value="botol">Botol</option>
                                            <option value="kaleng">Kaleng</option>
                                            <option value="pouch">Pouch</option>    
                                            <?php        
                                                }
                                            ?>
                                            
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga_beli" class="form-label">Harga Beli</label>
                                        <input type="number" name="harga_beli" value="<?= $msg  != '' ? $barang['harga_beli'] : null ; ?>" class="form-control" id="harga_beli" placeholder="Rp 0" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga_jual" class="form-label">Harga Jual</label>
                                        <input type="number" name="harga_jual" class="form-control" value="<?= $msg  != '' ? $barang['harga_jual'] : null ; ?>" id="harga_jual" placeholder="Rp 0" autocomplete="off" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stock_minimal" class="form-label">Stok Minimal</label>
                                        <input type="number" name="stock_minimal" class="form-control" value="<?= $msg  != '' ? $barang['stock_minimal'] : null ; ?>" id="stock_minimal" placeholder="0" autocomplete="off" required>
                                    </div> 
                                    <div class="mb-3">
                                        <input type="hidden" name="oldImg" value="<?= $msg  != '' ? $barang['gambar'] : null ; ?>" >
                                        <label for="foto" class="form-label">Foto Barang</label><br>
                                        <img src="<?= $main_url ?>/assets/image/<?= $msg  != '' ? $barang['gambar'] : 'default-brg.png' ; ?>" width="100px" class="pb-2">
                                        <input class="form-control" type="file" name="image">
                                        <span class="text-muted small">Format gambar harus PNG | JPG | GIF</span>
                                    </div>
                                </div>
                            
                        </form>
                        </div>
                    </div>
                </main>

<?php 

require "../template/footer.php";
?>