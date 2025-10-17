<div class="container-fluid px-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0 pacifico text-primary">
                        Tambah Menu Kue Baru
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="index.php?controller=Barang" class="text-decoration-none">Menu Kue</a></li>
                            <li class="breadcrumb-item active">Tambah Menu</li>
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
                        <i class="bi bi-cake2 fs-4 me-2 text-primary"></i>
                        <h5 class="mb-0">Detail Menu Kue</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="post" class="needs-validation" novalidate>
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" 
                                           class="form-control" 
                                           id="nama_barang" 
                                           name="nama_barang" 
                                           placeholder="Nama Kue"
                                           required>
                                    <label for="nama_barang">Nama Kue</label>
                                    <div class="invalid-feedback">
                                        Nama kue harus diisi
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" 
                                           class="form-control" 
                                           id="harga" 
                                           name="harga" 
                                           step="0.01" 
                                           min="0"
                                           placeholder="Harga"
                                           required>
                                    <label for="harga">Harga (Rp)</label>
                                    <div class="invalid-feedback">
                                        Harga harus diisi dengan angka valid
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" 
                                           class="form-control" 
                                           id="stok" 
                                           name="stok" 
                                           min="0"
                                           placeholder="Stok"
                                           required>
                                    <label for="stok">Stok</label>
                                    <div class="invalid-feedback">
                                        Stok harus diisi dengan angka valid
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="index.php?controller=Barang" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Simpan
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
                        Panduan Pengisian
                    </h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="bi bi-dot"></i>
                            Nama barang harus diisi dengan jelas dan deskriptif
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-dot"></i>
                            Harga diisi dalam format angka tanpa separator
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-dot"></i>
                            Stok minimal adalah 0 (nol)
                        </li>
                    </ul>
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
</script>