<?php 

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../modul/mode-user.php";
$tittle = "Add User";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_POST['simpan'])) {
    if (insert($_POST) > 0) {
        echo '<script>
                alert("User baru berhasil diregistrasi.. !");
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
                            <i class="fa-solid fa-plus"></i> Add User
                            <button type="submit" name="simpan" class="btn btn-primary float-end ">Simpan</button>
                            <button type="reset" class="btn btn-danger float-end me-2">Batal</button>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Masukan Username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Fullname</label>
                                    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukan Nama Lengkap" required>
                                </div> 
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Kata Sandi" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password2" class="form-label">Confirm Password</label>
                                    <input type="password" name="password2" class="form-control" id="password2" placeholder="Masukan Kembali Kata Sandi" required>
                                </div>
                                <div class="mb-3">
                                    <label for="level" class="form-label">Level</label>
                                    <select class="form-select" name="level" id="level">
                                    <option value="">-- Pilih Jenis Akun --</option>
                                    <option value="2">Admin</option>
                                    <option value="3">Kasir</option>
                                </select>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" name="address" id="address" placeholder="Masukan Alamat"  rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Upload Foto</label>
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