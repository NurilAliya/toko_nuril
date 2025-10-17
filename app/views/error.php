<?php
// app/views/error.php
require_once 'app/core/Security.php';
?>
<div class="container-fluid px-4">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="bi bi-exclamation-circle text-danger fs-xl"></i>
                    </div>
                    <h3 class="card-title mb-3">Oops! Terjadi Kesalahan</h3>
                    <p class="card-text text-muted mb-4">
                        <?= htmlspecialchars($message ?? 'Terjadi kesalahan sistem', ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <div class="d-grid gap-2 col-md-6 mx-auto">
                        <a href="<?= BASE_URL ?>" class="btn btn-primary">
                            <i class="bi bi-house-door me-2"></i>Kembali ke Dashboard
                        </a>
                        <button onclick="history.back()" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Halaman Sebelumnya
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>