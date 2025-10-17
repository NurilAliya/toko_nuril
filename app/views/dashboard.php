<div class="container-fluid px-4">
    <!-- Welcome Banner -->
    <div class="card mb-4">
        <div class="card-body py-5 position-relative overflow-hidden">
            <div class="sweet-pattern position-absolute top-0 start-0 w-100 h-100"></div>
            <div class="row align-items-center position-relative">
                <div class="col-md-8">
                    <h1 class="pacifico text-primary mb-2">Sweet Bakery</h1>
                    <p class="lead mb-0">Sistem Manajemen Toko Kue</p>
                </div>
                <div class="col-md-4 text-end">
                    <i class="bi bi-cake2 text-primary icon-lg"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-4">
        <!-- Total Transaksi Card -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-circle p-3 stats-icon-primary">
                            <i class="bi bi-receipt text-white fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="card-title mb-0 text-primary">Pesanan Hari Ini</h6>
                            <h2 class="mt-2 mb-0"><?php echo $total_transaksi; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pendapatan Card -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-circle p-3 stats-icon-success">
                            <i class="bi bi-wallet2 text-white fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="card-title mb-0 text-success">Pendapatan</h6>
                            <h2 class="mt-2 mb-0">Rp <?php echo number_format($total_pendapatan,2,',','.'); ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kue Terlaris Card -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-circle p-3 stats-icon-warning">
                            <i class="bi bi-star-fill text-white fs-4"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="card-title mb-0 text-warning">Kue Terlaris</h6>
                            <h5 class="mt-2 mb-0">
                                <?php echo $barang_terlaris ? $barang_terlaris['nama_barang'].' ('.$barang_terlaris['terjual'].' terjual)' : '-'; ?>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4 mt-2">
        <div class="col-12">
            <h5 class="mb-3 pacifico text-primary">Menu Utama</h5>
        </div>
        <!-- Kelola Kue -->
        <div class="col-md-3">
            <a href="index.php?controller=Barang" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center stats-icon stats-icon-primary">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                        <h5 class="card-title text-primary">Kelola Kue</h5>
                        <p class="text-muted mb-0">Tambah dan update menu kue</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Kelola Pelanggan -->
        <div class="col-md-3">
            <a href="index.php?controller=Pembeli" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center stats-icon stats-icon-success">
                            <i class="bi bi-people-fill text-white fs-4"></i>
                        </div>
                        <h5 class="card-title text-success">Pelanggan</h5>
                        <p class="text-muted mb-0">Data pelanggan setia</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pesanan Baru -->
        <div class="col-md-3">
            <a href="index.php?controller=Transaksi" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center stats-icon stats-icon-warning">
                            <i class="bi bi-cart-plus-fill text-white fs-4"></i>
                        </div>
                        <h5 class="card-title text-warning">Pesanan Baru</h5>
                        <p class="text-muted mb-0">Catat pesanan baru</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Laporan Penjualan -->
        <div class="col-md-3">
            <a href="index.php?controller=Transaksi&action=laporan" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 hover-card">
                    <div class="card-body text-center p-4">
                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center stats-icon stats-icon-accent">
                            <i class="bi bi-graph-up text-white fs-4"></i>
                        </div>
                        <h5 class="card-title text-accent">Laporan</h5>
                        <p class="text-muted mb-0">Lihat laporan penjualan</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 pacifico text-primary">
                        Pesanan Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No. Pesanan</th>
                                    <th>Pelanggan</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($transaksi_terbaru)): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="bi bi-inbox display-4 d-block mb-3 text-secondary"></i>
                                        <p class="text-muted mb-0">Belum ada transaksi</p>
                                    </td>
                                </tr>
                                <?php else: ?>
                                    <?php foreach($transaksi_terbaru as $t): ?>
                                    <tr>
                                        <td><?php echo str_pad($t['id_transaksi'], 5, '0', STR_PAD_LEFT); ?></td>
                                        <td><?php echo htmlspecialchars($t['nama_pembeli']); ?></td>
                                        <td><?php echo htmlspecialchars($t['nama_barang']) . ' × ' . $t['jumlah']; ?></td>
                                        <td>Rp <?php echo number_format($t['total_harga'],2,',','.'); ?></td>
                                        <td>
                                            <?php 
                                            $tanggal = strtotime($t['tanggal']);
                                            if (date('Y-m-d') === date('Y-m-d', $tanggal)): ?>
                                                <span class="badge bg-primary">Hari Ini</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">
                                                    <?php echo date('d/m/Y', $tanggal); ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
    
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 text-center py-3">
                    <a href="index.php?controller=Transaksi" class="btn btn-light">
                        <i class="bi bi-list me-2"></i>Lihat Semua Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

