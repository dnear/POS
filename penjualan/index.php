<?php 

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../modul/mode-jual.php";
$tittle = "Penjualan";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$nojual =  generateNo();

?>

<div id="layoutSidenav_content">
                <main>
                    
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Penjualan</h1>
                        
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card mb-4">
                                <div class="card-header">
                                        <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card border-warning p-3">
                                                <div class="form-group row mb-2">
                                                    <label for="noNota" class="col-sm-2 col-form-label" >
                                                        Nota
                                                    </label>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="nobeli" class="form-control" id="noNota" value="<?= $nojual ?>">
                                                    </div>
                                                    <label for="tglNota" class="col-sm-2 col-form-label" >
                                                        Tanggal
                                                    </label>
                                                    <div class="col-sm-4">
                                                        <input type="date" name="tglNota" class="form-control" id="tglNota" value="<?= @$_GET['tgl'] ? @$_GET['tgl'] : date('Y-m-d') ?>" required>
                                                    </div>
                                                    <div class="form-group row mb-2 mt-2">
                                                        <div class="input-group">
                                                            <label for="barcode" class="col-sm-4 col-form-label pe-2">Barcode</label>
                                                            <input type="text" class="form-control col-sm-4" name="barcode" id="barcode" value="<?= @$_GET['barcode'] ? @$_GET['barcode'] : '' ?>" placeholder="Masukan barcode barang" >
                                                            <span class="btn btn-secondary" id="icon-barcode"><i class="fas fa-barcode"></i></span>
                                                        </div>    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card border-danger pt-3 px-3 pb-2">
                                                <h6 class="text-right">Total Penjualan</h6>
                                                <h1 class="text-right" style="font-size: 40pt;">
                                                <input type="hidden" name="total" value="<?= 0 ?>">
                                                Rp 0
                                            </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- <div class="card pt-1 pb-2 px-3"> -->
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="hidden" value="<?= @$_GET['barcode'] ? $selectBrg['id_barang'] : '' ?>" name="barcode">
                                                    <label for="namaBrg">Nama Barang</label>
                                                    <input type="text"  name="namaBrg" class="form-control form-control-sm " style="background-color: #d3d3d3;" id="namaBrg" value="<?= @$_GET['barcode'] ? $selectBrg['nama_barang'] : '' ?>"  readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <label for="stok">Stok</label>
                                                    <input type="number"  name="stok" class="form-control form-control-sm " style="background-color: #d3d3d3;" id="stok" value="<?= @$_GET['barcode'] ? $selectBrg['stock'] : '' ?>" readonly >
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <label for="satuan">Satuan</label>
                                                    <input type="text"  name="satuan" style="background-color: #d3d3d3;" class="form-control form-control-sm " id="satuan" value="<?= @$_GET['barcode'] ? $selectBrg['satuan'] : '' ?>" readonly >
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="harga">Harga</label>
                                                    <input type="number"  name="harga" class="form-control form-control-sm " style="background-color: #d3d3d3;" id="harga" value="<?= @$_GET['barcode'] ? $selectBrg['harga_jual'] : '' ?>" readonly >
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="qty">Qty</label>
                                                    <input type="number"  name="qty" class="form-control form-control-sm"  id="qty" value="<?= @$_GET['barcode'] ? 1 : '' ?>" >
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="jmlHarga">Jumlah Harga</label>
                                                    <input type="number" name="jmlHarga" class="form-control form-control-sm " style="background-color: #d3d3d3;" id="jmlHarga" value="<?= @$_GET['barcode'] ? $selectBrg['harga_jual'] : '' ?>" readonly >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 mt-3 mb-2">
                                            <button class="btn btn-primary" type="submit" name="addbrg"><i class="fa-solid fa-cart-plus"></i> Tambah Barang</button>
                                        </div>
                                    <!-- </div> -->
                                </div>
                                <div class="card-footer px-2">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th class="text-right">Harga</th>
                                                <th class="text-right">Qty</th>
                                                <th class="text-right">Jumlah Harga</th>
                                                <th class="text-center" width="7%" >Operasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 p-2">
                                            <div class="form-group row mb-2">
                                            <label for="customer" class="col-sm-4 col-form-label col-form-label-sm">Customer</label>
                                            <div class="col-sm-8">
                                                <select name="customer" id="customer" class="form-control form-control-sm">
                                                    <option value="">-- Customer --</option>
                                                    <?php 
                                                                $suppliers = getData("SELECT * FROM tbl_supplier");
                                                                foreach($suppliers as $supplier){ ?>
                                                                    <option value="<?= $supplier['nama'] ?>">
                                                                    <?= $supplier['nama'] ?>
                                                                    </option>
                                                                <?php }
                                                                ?>
                                                </select>
                                            </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="ketr" class="col-sm-4 col-form-label ">Keterangan</label>
                                                <div class="col-sm-8">
                                                    <textarea name="ketr" id="ketr" class="form-control form-control-sm"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 p-2">
                                            <div class="form-group row mb-2">
                                                <label for="" class="col-sm-4 col-form-label">Bayar</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="bayar" class="form-control form-control-sm text-end" id="bayar">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-2">
                                                <label for="" class="col-sm-4 col-form-label">Kembalian</label>
                                                <div class="col-sm-8">
                                                    <input type="number" name="kembalian" class="form-control form-control-sm text-end" id="kembalian" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 p-2 ">
                                            <div class="d-grid gap-2 m-2">
                                                <button class="btn btn-primary" type="submit" name="simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </main>


<?php 

require "../template/footer.php";

?>