<div class="container-fluid px-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0 pacifico text-warning">
                        Pesanan Baru
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="index.php?controller=Transaksi" class="text-decoration-none">Transaksi</a></li>
                            <li class="breadcrumb-item active">Pesanan Baru</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-cart-plus-fill fs-4 me-2 text-warning"></i>
                        <h5 class="mb-0">Detail Pesanan</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="post" class="needs-validation" novalidate>
                        <!-- Pilih Pelanggan -->
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-person-circle me-2"></i>Pelanggan
                            </label>
                            <select name="id_pembeli" class="form-select" required>
                                <option value="">Pilih Pelanggan</option>
                                <?php foreach($pembelis as $p): ?>
                                    <option value="<?php echo $p['id_pembeli']; ?>">
                                        <?php echo $p['nama_pembeli']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Silakan pilih pelanggan</div>
                        </div>

                        <!-- Pilih Menu Kue -->
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-cake2 me-2"></i>Pilih Menu Kue
                            </label>
                            <select name="id_barang" class="form-select" required>
                                <option value="">Pilih Menu Kue</option>
                                <?php foreach($barangs as $b): ?>
                                    <option value="<?php echo $b['id_barang']; ?>" <?php echo $b['stok'] <= 0 ? 'disabled' : ''; ?>>
                                        <?php echo $b['nama_barang']; ?> - Rp <?php echo number_format($b['harga'],2,',','.'); ?>
                                        (Stok: <?php echo $b['stok']; ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Silakan pilih menu kue</div>
                        </div>

                        <!-- Jumlah Pesanan -->
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-123 me-2"></i>Jumlah
                            </label>
                            <input name="jumlah" 
                                   type="number" 
                                   min="1" 
                                   class="form-control" 
                                   required 
                                   placeholder="Masukkan jumlah pesanan" />
                            <div class="invalid-feedback">Jumlah harus lebih dari 0</div>
                        </div>

                        <div class="d-flex gap-2">
                            <button class="btn btn-warning">
                                <i class="bi bi-save me-2"></i>Simpan Pesanan
                            </button>
                            <a class="btn btn-outline-secondary" href="index.php?controller=Transaksi">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Shopping Cart Preview -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-cart-check fs-4 me-2 text-warning"></i>
                        <h5 class="mb-0">Ringkasan Pesanan</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="text-center text-muted">
                        <i class="bi bi-cart3 display-4 mb-3"></i>
                        <p>Pilih menu dan jumlah pesanan untuk melihat ringkasan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    
    // Enable Bootstrap form validation
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });
});
</script>