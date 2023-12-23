<?php 

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../modul/mode-password.php";

$tittle = "Change Password";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

//update password
if (isset($_POST['simpan'])) {
    if (update($_POST)) {
        echo "<script>
                alert('Password berhasil diperbaharui..');
                document.location='change-password.php';
            </script>";
    }
}

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}else {
    $msg = '';
}

$alert1 = '<small class="text-danger pl-2">Konfirmasi password tidak sama dengan password baru</small>';
$alert2 = '<small class="text-danger pl-2">Current password tidak sama</small>';


?>

<div id="layoutSidenav_content">
                <main>
                    
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Password</h1>
                        <form action="" method="post">
                        <div class="card mb-4">
                            <div class="card-header">
                            <i class="fa-solid fa-key"></i> Change Password
                            <button type="submit" name="simpan" class="btn btn-primary float-end ">Simpan</button>
                            <button type="reset" class="btn btn-danger float-end me-2">Batal</button>
                            </div>
                            <div class="card-body p-3">
                                <div class="mb-3">
                                    <label for="curPass" class="form-label">Current Password</label>
                                    <input type="password" class="form-control" name="curPass" id="curPass" placeholder="Masukan password anda saat ini" required>
                                    <?php if ($msg == 'err2') {
                                        echo $alert2;
                                    } ?>
                                </div>
                                <div class="mb-3">
                                    <label for="newPass" class="form-label">New Password</label>
                                    <input type="password" class="form-control" name="newPass" id="newPass" placeholder="Masukan password baru" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confPass" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="confPass" id="confPass" placeholder="Masukan kembali password baru" required>
                                    <?php if ($msg == 'err1') {
                                        echo $alert1;
                                    } ?>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </main>


<?php 

require "../template/footer.php";

?>