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

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}else {
    $msg = '';
}

if ($msg == 'delete') {
    $idbrg = $_GET['idbrg'];
    $idbeli = $_GET['idbeli'];
    $qty = $_GET['qty'];
    $tgl = $_GET['tgl'];

    delete($idbrg, $idbeli,$qty);
    echo "<script>
            document.location = '?tgl=$tgl';
        </script>";
}

$kode = @$_GET['pilihbrg'] ? @$_GET['pilihbrg'] : '';
if ($kode) {
    $selectBrg = getData("SELECT * FROM tbl_barang WHERE id_barang = '$kode'")[0];
}

if (isset($_POST['addbrg'])) {
    $tgl = $_POST['tglNota'];
    if (insert($_POST)) {
        echo "<script>
            document.location = '?tgl=$tgl';
        </script>";
    }
}

if (isset($_POST['simpan'])) {
    if (simpan($_POST)) {
        echo "<script>
            alert('data pembelian berhasil disimpan');
            document.location = 'index.php?msg=sukses';
        </script>";
    }
}

$noBeli = generateNo();

?>

<div id="layoutSidenav_content">
                <main>
                    
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Pembelian</h1>
                        
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
                                                        <input type="text" name="nobeli" class="form-control" id="noNota" value="<?= $noBeli ?>">
                                                    </div>
                                                    <label for="tglNota" class="col-sm-2 col-form-label" >
                                                        Tanggal
                                                    </label>
                                                    <div class="col-sm-4">
                                                        <input type="date" name="tglNota" class="form-control" id="tglNota" value="<?= @$_GET['tgl'] ? @$_GET['tgl'] : date('Y-m-d') ?>" required>
                                                    </div>
                                                    <div class="form-group row mb-2 mt-2">
                                                        <label for="kodeBrg" class="col-sm-2 col-form-label">SKU</label>
                                                        <div class="col-sm-10">
                                                            <select name="kodeBrg" id="kodeBrg" class="form-control">
                                                            <option value="">-- Pilih Kode Barang --</option>
                                                                <?php 
                                                                $barang = getData("SELECT * FROM tbl_barang");
                                                                foreach($barang as $brg){ ?>
                                                                    <option value="?pilihbrg=<?= $brg['id_barang'] ?> <?= @$_GET['pilihbrg'] == $brg['id_barang'] ? 'selected' : null ?>">
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
                                                <h1 class="text-right" style="font-size: 40pt;">
                                                <input type="hidden" name="total" value="<?= totalBeli($noBeli) ?>">
                                                Rp <?= number_format(totalBeli($noBeli),0,',','.') ?>
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
                                                    <input type="hidden" value="<?= @$_GET['pilihbrg'] ? $selectBrg['id_barang'] : '' ?>" name="kodeBrg">
                                                    <label for="namaBrg">Nama Barang</label>
                                                    <input type="text"  name="namaBrg" class="form-control form-control-sm " style="background-color: #d3d3d3;" id="namaBrg" value="<?= @$_GET['pilihbrg'] ? $selectBrg['nama_barang'] : '' ?>"  readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <label for="stok">Stok</label>
                                                    <input type="number"  name="stok" class="form-control form-control-sm " style="background-color: #d3d3d3;" id="stok" value="<?= @$_GET['pilihbrg'] ? $selectBrg['stock'] : '' ?>" readonly >
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <label for="satuan">Satuan</label>
                                                    <input type="text"  name="satuan" style="background-color: #d3d3d3;" class="form-control form-control-sm " id="satuan" value="<?= @$_GET['pilihbrg'] ? $selectBrg['satuan'] : '' ?>" readonly >
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="harga">Harga</label>
                                                    <input type="number"  name="harga" class="form-control form-control-sm " style="background-color: #d3d3d3;" id="harga" value="<?= @$_GET['pilihbrg'] ? $selectBrg['harga_beli'] : '' ?>" readonly >
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="qty">Qty</label>
                                                    <input type="number"  name="qty" class="form-control form-control-sm"  id="qty" value="<?= @$_GET['pilihbrg'] ? 1 : '' ?>" >
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="jmlHarga">Jumlah Harga</label>
                                                    <input type="number" name="jmlHarga" class="form-control form-control-sm " style="background-color: #d3d3d3;" id="jmlHarga" value="<?= @$_GET['pilihbrg'] ? $selectBrg['harga_beli'] : '' ?>" readonly >
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
                                            <?php 
                                            $no = 1;
                                            $brgDetail = getData("SELECT * FROM tbl_beli_detail WHERE no_beli = '$noBeli'");
                                            if ($brgDetail = $brgDetail) {
                                                foreach ($brgDetail as $detail){?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $detail['kode_brg'] ?></td>
                                                        <td><?= $detail['nama_brg'] ?></td>
                                                        <td>Rp <?= number_format($detail['harga_beli'],0,',','.') ?></td>
                                                        <td><?= number_format($detail['qty'],0,',','.') ?></td>
                                                        <td>Rp <?= number_format($detail['jml_harga'],0,',','.') ?></td>
                                                        <td>
                                                            <a href="?idbrg=<?= $detail['kode_brg'] ?>&idbeli=<?= $detail['no_beli'] ?>&qty=<?= $detail['qty'] ?>&tgl=<?= $detail['tgl_beli'] ?>&msg=delete" class="btn btn-sm btn-danger" title="hapus barang" onclick="return confirm('Anda yakin akan menghapus barang ini ?')">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                } 
                                            }
                                            
                                            ?>
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
                                                <button class="btn btn-primary" type="submit" name="simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </main>

<script>
    let pilihbrg = document.getElementById('kodeBrg');
    pilihbrg.addEventListener('change', function(){
        document.location.href = this.options[this.selectedIndex].value;
    })

    let qty = document.getElementById('qty');
    let jmlHarga = document.getElementById('jmlHarga');
    let harga = document.getElementById('harga');
    qty.addEventListener('input', function(){
        jmlHarga.value = qty.value * harga.value;
    })
</script>

<?php 

require "../template/footer.php";

?>