<?php
// Check if barang exists
if (!isset($barang) || !$barang) {
    echo '<div class="alert alert-danger">Data barang tidak ditemukan</div>';
    exit;
}

// Initialize error array
$errors = isset($errors) ? $errors : [];
?>
<div class="container-fluid px-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">Edit Barang</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="index.php?controller=Barang" class="text-decoration-none">Barang</a></li>
                            <li class="breadcrumb-item active">Edit Barang</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($errors)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5 class="alert-heading"><i class="bi bi-exclamation-triangle me-2"></i>Error!</h5>
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="post" class="needs-validation" novalidate id="editBarangForm">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        <input type="hidden" name="id" value="<?php echo $barang['id_barang']; ?>" />
                        
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" 
                                           class="form-control <?php echo isset($errors['nama_barang']) ? 'is-invalid' : ''; ?>" 
                                           id="nama_barang" 
                                           name="nama_barang" 
                                           value="<?php echo htmlspecialchars($barang['nama_barang']); ?>"
                                           placeholder="Nama Barang"
                                           required
                                           pattern=".{3,}"
                                           title="Minimal 3 karakter">
                                    <label for="nama_barang">Nama Barang</label>
                                    <div class="invalid-feedback">
                                        <?php echo isset($errors['nama_barang']) ? $errors['nama_barang'] : 'Nama barang harus diisi (minimal 3 karakter)'; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" 
                                           class="form-control <?php echo isset($errors['harga']) ? 'is-invalid' : ''; ?>" 
                                           id="harga" 
                                           name="harga" 
                                           step="100" 
                                           min="0"
                                           value="<?php echo $barang['harga']; ?>"
                                           placeholder="Harga"
                                           required>
                                    <label for="harga">Harga (Rp)</label>
                                    <div class="invalid-feedback">
                                        <?php echo isset($errors['harga']) ? $errors['harga'] : 'Harga harus diisi dengan angka valid'; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" 
                                           class="form-control <?php echo isset($errors['stok']) ? 'is-invalid' : ''; ?>" 
                                           id="stok" 
                                           name="stok" 
                                           min="0"
                                           value="<?php echo $barang['stok']; ?>"
                                           placeholder="Stok"
                                           required>
                                    <label for="stok">Stok</label>
                                    <div class="invalid-feedback">
                                        <?php echo isset($errors['stok']) ? $errors['stok'] : 'Stok harus diisi dengan angka valid'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="index.php?controller=Barang" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body p-4">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-info-circle me-2"></i>
                        Detail Barang
                    </h5>
                    <div class="mb-3">
                        <small class="text-muted d-block">ID Barang:</small>
                        <strong><?php echo $barang['id_barang']; ?></strong>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block">Status Stok:</small>
                        <?php if($barang['stok'] > 10): ?>
                            <span class="badge bg-success">Tersedia</span>
                        <?php elseif($barang['stok'] > 0): ?>
                            <span class="badge bg-warning">Hampir Habis</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Habis</span>
                        <?php endif; ?>
                    </div>
                    <hr>
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-lightbulb me-2"></i>
                        Pastikan data yang diubah sudah benar sebelum menyimpan perubahan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Form validation
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})()

// Format currency input
document.getElementById('harga').addEventListener('input', function(e) {
    // Remove non-numeric characters
    let value = this.value.replace(/[^\d]/g, '');
    
    // Ensure minimum value
    if (value < 0) value = 0;
    
    // Update input value
    this.value = value;
});

// Confirm before submitting
document.getElementById('editBarangForm').addEventListener('submit', function(e) {
    if (!confirm('Apakah Anda yakin ingin menyimpan perubahan?')) {
        e.preventDefault();
    }
});
</script>