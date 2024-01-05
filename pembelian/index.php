<?php 

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../modul/mode-beli.php";
$tittle = "Transaksi";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$noBeli = generateNo();

?>

<div id="layoutSidenav_content">
                <main>
                    
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Pembelian</h1>
                        
                        <form action="">
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
                                                        <input type="text" name="nobeli" class="form-control" id="noNota" value="<?= $noBeli ?>">
                                                    </div>
                                                    <label for="tglNota" class="col-sm-2 col-form-label" >
                                                        Tanggal
                                                    </label>
                                                    <div class="col-sm-4">
                                                        <input type="date" name="tglNota" class="form-control" id="tglNota" value="<?= date('Y-m-d') ?>" required>
                                                    </div>
                                                    <div class="form-group row mb-2 mt-2">
                                                        <label for="kodeBrg" class="col-sm-2 col-form-label">SKU</label>
                                                        <div class="col-sm-10">
                                                            <select name="kodeBrg" id="kodeBrg" class="form-control">
                                                            <option value="">-- Pilih Kode Barang --</option>
                                                                <?php 
                                                                $barang = getData("SELECT * FROM tbl_barang");
                                                                foreach($barang as $brg){ ?>
                                                                    <option value="<?= $brg['id_barang'] ?>">
                                                                    <?= $brg['id_barang'] . " | " . $brg['nama_barang'] ?>
                                                                    </option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card border-danger pt-3 px-3 pb-2">
                                                <h6 class="text-right">Total Pembelian</h6>
                                                <h1 class="text-right" style="font-size: 40pt;">0</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- <div class="card pt-1 pb-2 px-3"> -->
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="namaBrg">Nama Barang</label>
                                                    <input type="text"  name="namaBrg" class="form-control form-control-sm" id="namaBrg" disabled readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <label for="stok">Stok</label>
                                                    <input type="number"  name="stok" class="form-control form-control-sm" id="stok" readonly disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <label for="satuan">Satuan</label>
                                                    <input type="text"  name="satuan" class="form-control form-control-sm" id="satuan" readonly disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="harga">Harga</label>
                                                    <input type="number"  name="harga" class="form-control form-control-sm" id="harga" readonly disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="qty">Qty</label>
                                                    <input type="number"  name="qty" class="form-control form-control-sm" id="qty" >
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="jmlHarga">Jumlah Harga</label>
                                                    <input type="number" name="jmlHarga" class="form-control form-control-sm" id="jmlHarga" readonly disabled>
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
                                                <th class="text-center" width="10%" >Operasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 p-2">
                                            <label for="suplier" class="col-sm-3 col-form-label col-form-label-sm">Supplier</label>
                                            <div class="col-sm-9">
                                                <select name="suplier" id="suplier" class="form-control form-control-sm">
                                                    <option value="">-- Pilih Supplier --</option>
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
                                            <div class="form-group mb-2">
                                                <label for="ketr" class="col-sm-3 col-form-label ">Keterangan</label>
                                                <div class="col-sm-9">
                                                    <textarea name="ketr" id="ketr" class="form-control form-control-sm"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-2 ">
                                            <div class="d-grid gap-2 m-2">
                                                <button class="btn btn-primary" type="submit" name="addbrg"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
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