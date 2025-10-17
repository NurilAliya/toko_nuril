<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0 pacifico text-warning">
                        Riwayat Transaksi
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
                        </ol>
                    </nav>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-2">
                    <a class="btn btn-warning shadow-sm" href="index.php?controller=Transaksi&action=create">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Transaksi
                    </a>
                    <a class="btn btn-outline-warning shadow-sm" href="index.php?controller=Transaksi&action=laporan">
                        <i class="bi bi-printer me-2"></i>Cetak Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-3" method="get" action="index.php">
                <input type="hidden" name="controller" value="Transaksi"/>
                <div class="col-12 col-md-4">
                    <div class="input-group">
                        <span class="input-group-text border-0 bg-light">
                            <i class="bi bi-calendar3 text-muted"></i>
                        </span>
                        <input type="date" 
                               name="from" 
                               class="form-control border-0 bg-light shadow-none" 
                               value="<?php echo htmlspecialchars($_GET['from'] ?? ''); ?>"
                               aria-label="Tanggal Mulai"/>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="input-group">
                        <span class="input-group-text border-0 bg-light">
                            <i class="bi bi-calendar3 text-muted"></i>
                        </span>
                        <input type="date" 
                               name="to" 
                               class="form-control border-0 bg-light shadow-none" 
                               value="<?php echo htmlspecialchars($_GET['to'] ?? ''); ?>"
                               aria-label="Tanggal Akhir"/>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <button class="btn btn-warning w-100" type="submit">
                        <i class="bi bi-funnel me-2"></i>Filter Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php if(!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <?php echo htmlspecialchars($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Main Content -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <?php if(empty($transaksis)): ?>
                <div class="text-center py-5">
                    <i class="bi bi-receipt text-muted fs-lg"></i>
                    <p class="text-muted mt-3">Belum ada data transaksi</p>
                    <a href="index.php?controller=Transaksi&action=create" class="btn btn-warning">
                        <i class="bi bi-plus-circle me-2"></i>Buat Transaksi Pertama
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">ID</th>
                                <th scope="col" class="border-0">Pembeli</th>
                                <th scope="col" class="border-0">Barang</th>
                                <th scope="col" class="border-0">Jumlah</th>
                                <th scope="col" class="border-0">Total</th>
                                <th scope="col" class="border-0">Tanggal</th>
                                <th scope="col" class="border-0 text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($transaksis as $t): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($t['id_transaksi']); ?></td>
                                <td><?php echo htmlspecialchars($t['nama_pembeli']); ?></td>
                                <td><?php echo htmlspecialchars($t['nama_barang']); ?></td>
                                <td><?php echo htmlspecialchars($t['jumlah']); ?></td>
                                <td class="fw-bold">Rp <?php echo number_format($t['total_harga'],2,',','.'); ?></td>
                                <td><?php echo htmlspecialchars($t['tanggal']); ?></td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-danger" 
                                       href="index.php?controller=Transaksi&action=delete&id=<?php echo htmlspecialchars($t['id_transaksi']); ?>"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')"
                                       title="Hapus Transaksi">
                                        <i class="bi bi-trash me-1"></i>Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .input-group-text,
    .form-control,
    .form-select {
        transition: all 0.3s ease-in-out;
    }
    
    .input-group:hover .input-group-text,
    .input-group:hover .form-control {
        background-color: #f8f9fa !important;
    }
    
    .form-control:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25) !important;
    }
    
    .btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }
    
    .btn-warning {
        color: #fff;
        background-color: var(--warning-color);
        border-color: var(--warning-color);
    }
    
    .btn-outline-warning:hover {
        color: #fff;
        background-color: var(--warning-color);
        border-color: var(--warning-color);
    }
</style>