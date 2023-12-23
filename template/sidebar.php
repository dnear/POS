<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Home</div>
                            <a class="nav-link" href="<?= $main_url ?>index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <!-- Master menu -->
                            <?php 
                            
                            if (userLogin()['level'] != 3) {
                                # code...

                            ?>
                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-user"></i></i></div>
                                Data User
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= $main_url ?>user/data-user.php"><div class="sb-nav-link-icon"><i class="fa-regular fa-id-card"></i></div> List User</a>
                                    <a class="nav-link" href="<?= $main_url ?>user/add-user.php"><div class="sb-nav-link-icon"><i class="fa-solid fa-user-plus"></i></div>Add User</a>
                                </nav>
                            </div>
                            <?php } ?>
                            <!-- End Master Menu -->
                            
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="<?= $main_url ?>charts.html">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-utensils"></i></div>
                                Makanan & Minuman
                            </a>
                            <div class="sb-sidenav-menu-heading">Transaksi</div>
                            <a class="nav-link" href="<?= $main_url ?>charts.html">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-trend-up"></i></div>
                                Penjualan
                            </a>
                            <!-- Admin menu -->
                            <?php 
                            if (userLogin()['level'] != 3) {
                                
                            ?>
                            <a class="nav-link" href="<?= $main_url ?>charts.html">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                                Pembelian
                            </a>
                            <?php } ?>
                            <!-- end admin menu -->

                            <div class="sb-sidenav-menu-heading">Report</div>
                            
                            <a class="nav-link" href="<?= $main_url ?>tables.html">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cubes-stacked"></i></div>
                                Stok Barang
                            </a>
                            <a class="nav-link" href="<?= $main_url ?>tables.html">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-sack-dollar"></i></div>
                                Keuangan
                            </a>
                        </div>
                        <!-- End admin Menu -->
                    </div>
                </nav>
            </div>