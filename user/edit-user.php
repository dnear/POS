<?php 

require "../config/config.php";
require "../config/function.php";
require "../modul/mode-user.php";
$tittle = "Update User";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

$id = $_GET['id'];
$sqlEdit = "SELECT * FROM tbl_user WHERE userid = $id";
$user    = getData($sqlEdit)[0];
$level   = $user['level'];

if (isset($_POST['koreksi'])) {
    if (update($_POST)) {
        echo '<script>
                alert("Data user berhasil di update !");
                document.location.href = "data-user.php";
            </script>';
    }
}

?>


<div id="layoutSidenav_content">
                <main>
                    
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">User</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="card mb-4">
                            <div class="card-header">
                            <i class="fa-solid fa-plus"></i> Update User
                            <button type="submit" name="koreksi" class="btn btn-warning float-end ">Update</button>
                            <a href="data-user.php" class="btn btn-danger float-end me-2">Batal</a>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="<?= $user['userid'] ?>" name="id" >
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Masukan Username" value="<?= $user['username'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Fullname</label>
                                    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukan Nama Lengkap" value="<?= $user['fullname'] ?>" required>
                                </div> 
                                
                                <div class="mb-3">
                                    <label for="level" class="form-label">Level</label>
                                    <select class="form-select" name="level" id="level">
                                    <option value="">-- Pilih Jenis Akun --</option>
                                    <option value="2" <?= selectUser2($level) ?>>Admin</option>
                                    <option value="3" <?= selectUser3($level) ?>>Kasir</option>
                                </select>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" name="address" id="address" placeholder="Masukan Alamat"  rows="3" required><?= $user['address'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" value="<?= $user['foto'] ?>">
                                    <label for="foto" class="form-label">Update Foto</label><br>
                                    <img src="<?= $main_url ?>/assets/image/<?= $user['foto'] ?>" width="100px" class="pb-2">
                                    <input class="form-control" type="file" id="foto" name="image">
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </main>

<?php 

require "../template/footer.php";

?>