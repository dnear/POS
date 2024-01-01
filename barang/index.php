<?php 

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../modul/mode-barang.php";
$tittle = "Barang";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}else {
    $msg = '';
}

$alert = '';
//jalankan fungsi hapus barang
if ($msg == 'deleted') {
    $id = $_GET['id'];
    $gbr = $_GET['gbr'];
    delete($id, $gbr);
    $alert = 
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-regular fa-circle-check me-2"></i>
            <strong>Barang Berhasil Dihapus</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}

if ($msg == 'updated') {
    
    $alert = 
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-regular fa-circle-check me-2"></i>
            <strong>Barang Berhasil Diperbarui</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}

?>

<div id="layoutSidenav_content">
                <main>                    
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Barang</h1>
                        <div class="card mb-4">
                            <?php if ($alert != '') {
                                echo $alert;
                            } ?>
                            <div class="card-header">
                            <i class="fa-solid fa-list"></i> List Barang
                            <a href="<?= $main_url ?>barang/form-barang.php" class="btn btn-outline-primary float-end"><i class="fa-solid fa-plus"></i>Add Barang</a>
                            </div>
                            <div class="card-body table-responsive p-3">
                                <table class="table table-hover text-nowrap" id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>ID Barang</th>
                                            <th>Nama</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Operasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        $no     = 1;
                                        $barang  = getData("SELECT * FROM tbl_barang");
                                        foreach ($barang as $brg) :
                                        ?>

                                        <tr>
                                            <td>
                                                <img src="../assets/image/<?= $brg['gambar'] ?>" alt="<?= $brg['gambar'] ?>" class="rounded-circle" width="60px" >
                                            </td>
                                            <td><?= $brg['id_barang'] ?></td>
                                            <td><?= $brg['nama_barang'] ?></td>
                                            <td>Rp.<?= number_format($brg['harga_beli'],0,',','.') ?></td>
                                            <td>Rp.<?= number_format($brg['harga_jual'],0,',','.') ?></td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-sm btn-secondary" id="tombol"  data-barcode="<?= $brg['barcode'] ?>" data-nama="<?= $brg['nama_barang'] ?>" title="Cetak Barcode" >
                                                <i class="fas fa-barcode"></i>
                                                </button>
                                                <a href="form-barang.php?id=<?= $brg['id_barang'] ?>&gbr=<?= $brg['gambar'] ?>&msg=edit" title="Edit Barang"><button class="btn btn-sm btn-warning">Edit</button></a>
                                                <a href="?id=<?= $brg['id_barang'] ?>&gbr=<?= $brg['gambar'] ?>&msg=deleted" title="Hapus Barang" onclick="return confirm('Anda yakin menghapus barang ini ?')"><button class="btn btn-sm btn-danger">Hapus</button></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
    
            <!-- Modal -->
            <div class="modal" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cetak Barcode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tempat untuk menampilkan nilai -->
                    <div class="form-group row">
                        <label for="nmBrg" class="col-sm-3 col-form-label">Nama Barang</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="nmBrg" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="barcode" class="col-sm-3 col-form-label">Barcode</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="barcode" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jmlCetak" class="col-sm-3 col-form-label">Jumlah Cetak</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" min="1" max="10" value="1" title="Maksimal 10" id="jmlCetak">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="preview"><i class="fas fa-print"></i> Cetak</button>
                
                </div>
                </div>
            </div>
            </div>

<script>
    $(document).ready(function(){
        // Tangani klik pada tombol
        $(document).on("click", "#tombol", function(){
            // Ambil nilai dari tombol
            let barcode = $(this).data('barcode');
            let nama = $(this).data('nama');
            
            // Tampilkan nilai di modal
            $("#nmBrg").val(nama);
            $("#barcode").val(barcode);
            

            // Tampilkan modal
            $("#myModal").modal('show');
        });


        // Tangani klik pada tombol
        $(document).on("click", "#preview", function(){
            // Ambil nilai dari tombol
            let barcode = $('#barcode').val();
            let jmlCetak = $('#jmlCetak').val();
            if (jmlCetak > 0 && jmlCetak <= 10) {
                window.open("../report/r-barcode.php?barcode=" + barcode + "&jmlCetak=" + jmlCetak)
            }
            
        });
    });
</script>

<?php 

require "../template/footer.php";
?>