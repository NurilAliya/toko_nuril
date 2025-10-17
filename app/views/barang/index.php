<div class="container-fluid px-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0 pacifico text-primary">Menu Kue</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active">Menu Kue</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex flex-column flex-md-row gap-3">
                    <div class="d-flex flex-column flex-md-row gap-3 flex-grow-1">
                        <!-- Search Bar -->
                        <div class="flex-grow-1">
                            <form method="get" action="index.php" class="d-flex">
                                <input type="hidden" name="controller" value="Barang"/>
                                <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sort ?? 'nama_asc'); ?>"/>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light">
                                        <i class="bi bi-search text-muted"></i>
                                    </span>
                                    <input type="text"
                                           class="form-control border-0 bg-light shadow-none" 
                                           name="q" 
                                           placeholder="Cari menu kue..." 
                                           value="<?php echo htmlspecialchars($search ?? ''); ?>"
                                           aria-label="Cari menu"
                                    />
                                    <button class="btn" type="submit" 
                                            class="btn btn-primary">
                                        <i class="bi bi-search me-1"></i>
                                        Cari
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Sort Dropdown -->
                        <div class="table-min-width">
                            <form method="get" action="index.php" class="d-flex" id="sortForm">
                                <input type="hidden" name="controller" value="Barang"/>
                                <input type="hidden" name="q" value="<?php echo htmlspecialchars($search ?? ''); ?>"/>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light">
                                        <i class="bi bi-sort-alpha-down text-muted"></i>
                                    </span>
                                    <select class="form-select border-0 bg-light shadow-none" 
                                            name="sort" 
                                            aria-label="Urutkan berdasarkan"
                                            onchange="this.form.submit()"
                                            class="text-body">
                                        <optgroup label="Urutan Waktu">
                                            <option value="terbaru" <?php echo ($sort ?? 'terbaru') === 'terbaru' ? 'selected' : ''; ?>>Terbaru</option>
                                            <option value="terlama" <?php echo ($sort ?? '') === 'terlama' ? 'selected' : ''; ?>>Terlama</option>
                                        </optgroup>
                                        <optgroup label="Urutan Nama">
                                            <option value="nama_asc" <?php echo ($sort ?? '') === 'nama_asc' ? 'selected' : ''; ?>>Nama (A-Z)</option>
                                            <option value="nama_desc" <?php echo ($sort ?? '') === 'nama_desc' ? 'selected' : ''; ?>>Nama (Z-A)</option>
                                        </optgroup>
                                        <optgroup label="Urutan Harga">
                                            <option value="harga_asc" <?php echo ($sort ?? '') === 'harga_asc' ? 'selected' : ''; ?>>Harga (Terendah)</option>
                                            <option value="harga_desc" <?php echo ($sort ?? '') === 'harga_desc' ? 'selected' : ''; ?>>Harga (Tertinggi)</option>
                                        </optgroup>
                                        <optgroup label="Urutan Stok">
                                            <option value="stok_asc" <?php echo ($sort ?? '') === 'stok_asc' ? 'selected' : ''; ?>>Stok (Terendah)</option>
                                            <option value="stok_desc" <?php echo ($sort ?? '') === 'stok_desc' ? 'selected' : ''; ?>>Stok (Tertinggi)</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Add Button -->
                    <div>
                        <a class="btn shadow-sm w-100" 
                           href="index.php?controller=Barang&action=create" 
                           class="btn btn-primary">
                            <i class="bi bi-plus-lg me-2"></i>Tambah Menu
                        </a>
                    </div>
                </div>
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
        .input-group:hover .form-control,
        .input-group:hover .form-select {
            background-color: #f8f9fa !important;
        }
        
        .form-control:focus,
        .form-select:focus {
            background-color: #fff !important;
            box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.25) !important;
        }
        
        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        
        .hover-card {
            transition: all 0.3s ease;
        }
        
        .hover-card:hover {
            transform: translateY(-5px);
        }
    </style>

    <?php if (empty($barangs) && !empty($search)): ?>
    <div class="text-center my-5">
        <i class="bi bi-search display-1 text-muted mb-3"></i>
        <h4 class="text-muted">Tidak ada menu yang cocok dengan pencarian "<?php echo htmlspecialchars($search); ?>"</h4>
        <p class="text-muted">Coba kata kunci lain atau ubah filter pencarian</p>
        <a href="index.php?controller=Barang" class="btn btn-outline-primary mt-3">
            <i class="bi bi-arrow-left me-2"></i>Tampilkan Semua Menu
        </a>
    </div>
    <?php elseif (empty($barangs)): ?>
    <div class="text-center my-5">
        <i class="bi bi-cake2 display-1 text-muted mb-3"></i>
        <h4 class="text-muted">Belum ada menu yang tersedia</h4>
        <p class="text-muted">Mulai dengan menambahkan menu kue pertama Anda</p>
        <a href="index.php?controller=Barang&action=create" class="btn mt-3" 
           class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Tambah Menu Kue
        </a>
    </div>
    <?php else: ?>
    <div class="row g-4">
        <?php foreach($barangs as $b): ?>
        <div class="col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        <i class="bi bi-cake2 display-4 text-primary"></i>
                    </div>
                    <h5 class="card-title text-center mb-2"><?php echo $b['nama_barang']; ?></h5>
                    <p class="card-text text-center text-primary mb-2 fw-bold">
                        Rp <?php echo number_format($b['harga'],2,',','.'); ?>
                    </p>
                    <div class="d-flex justify-content-center mb-3">
                        <?php if($b['stok'] > 10): ?>
                            <span class="badge bg-success">Tersedia</span>
                        <?php elseif($b['stok'] > 0): ?>
                            <span class="badge bg-warning">Hampir Habis</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Habis</span>
                        <?php endif; ?>
                    </div>
                    <div class="text-center">
                        <small class="text-muted">Stok: <?php echo $b['stok']; ?></small>
                    </div>
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="index.php?controller=Barang&action=edit&id=<?php echo $b['id_barang']; ?>" 
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                onclick="if(confirm('Apakah Anda yakin ingin menghapus menu ini?')) 
                                window.location.href='index.php?controller=Barang&action=delete&id=<?php echo $b['id_barang']; ?>'">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>