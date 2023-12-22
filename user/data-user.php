<?php 

require "../config/config.php";
require "../config/function.php";
require "../modul/mode-user.php";

$tittle = "Daftar User";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php"

?>


<div id="layoutSidenav_content">
                <main>
                    
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data User</h1>
                
                        <div class="card mb-4">
                            <div class="card-header">
                            <i class="fa-solid fa-list"></i> List User
                            <a href="<?= $main_url ?>user/add-user.php" class="btn btn-outline-primary float-end"><i class="fa-solid fa-plus"></i>Add User</a>
                            </div>
                            <div class="card-body table-responsive p-3">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Username</th>
                                            <th>Fullname</th>
                                            <th>Alamat</th>
                                            <th>Level User</th>
                                            <th style="width: 10%;">Operasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                        $no     = 1;
                                        $users  = getData("SELECT * FROM tbl_user");
                                        foreach ($users as $user) :
                                        ?>

                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><img src="../assets/image/<?= $user['foto'] ?>" class="rounded-circle" alt="" width="60px"></td>
                                            <td><?= $user['username'] ?></td>
                                            <td><?= $user['fullname'] ?></td>
                                            <td><?= $user['address'] ?></td>
                                            <td>
                                                <?php 
                                                if ($user['level'] == 1) {
                                                    echo "Master";
                                                }elseif ($user['level'] == 2) {
                                                    echo "Admin";
                                                }else {
                                                    echo "Kasir";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="edit-user.php?id=<?= $user['userid'] ?>" title="edit user"><button class="btn btn-sm btn-warning">Edit</button></a>
                                                <a href="del-user.php?id=<?= $user['userid'] ?>&foto=<?= $user['foto'] ?>" title="hapus user" onclick="return confirm('Anda yakin menghapus user ini ?')"><button class="btn btn-sm btn-danger">Hapus</button></a>
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