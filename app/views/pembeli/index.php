<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Title and Breadcrumb -->
                <div>
                    <h3 class="mb-0 pacifico text-success">
                        Pelanggan Setia
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="index.php" class="text-decoration-none">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Pelanggan</li>
                        </ol>
                    </nav>
                </div>
                
                <!-- Search, Sort, and Add Button -->
                <div class="d-flex flex-column flex-md-row gap-3">
                    <div class="d-flex flex-column flex-md-row gap-3 flex-grow-1">
                        <!-- Search Bar -->
                        <div class="flex-grow-1">
                            <form method="get" action="index.php" class="d-flex">
                                <input type="hidden" name="controller" value="Pembeli"/>
                                <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sort ?? 'terbaru'); ?>"/>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light">
                                        <i class="bi bi-search text-muted"></i>
                                    </span>
                                    <input type="text"
                                           class="form-control border-0 bg-light shadow-none" 
                                           name="q" 
                                           placeholder="Cari nama atau alamat pelanggan..." 
                                           value="<?php echo htmlspecialchars($search ?? ''); ?>"
                                           aria-label="Cari pelanggan"
                                    />
                                    <button class="btn btn-success" type="submit">
                                        <i class="bi bi-search me-1"></i>
                                        Cari
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Sort Dropdown -->
                        <div class="table-min-width">
                            <form method="get" action="index.php" class="d-flex" id="sortForm">
                                <input type="hidden" name="controller" value="Pembeli"/>
                                <input type="hidden" name="q" value="<?php echo htmlspecialchars($search ?? ''); ?>"/>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light">
                                        <i class="bi bi-sort-alpha-down text-muted"></i>
                                    </span>
                                    <select class="form-select border-0 bg-light shadow-none" 
                                            name="sort" 
                                            aria-label="Urutkan berdasarkan"
                                            onchange="this.form.submit()"
                                            style="color: var(--bs-body-color);">
                                        <optgroup label="Urutan Waktu">
                                            <option value="terbaru" <?php echo ($sort ?? 'terbaru') === 'terbaru' ? 'selected' : ''; ?>>Terbaru Ditambahkan</option>
                                            <option value="terlama" <?php echo ($sort ?? '') === 'terlama' ? 'selected' : ''; ?>>Terlama Ditambahkan</option>
                                        </optgroup>
                                        <optgroup label="Urutan Nama">
                                            <option value="nama_asc" <?php echo ($sort ?? '') === 'nama_asc' ? 'selected' : ''; ?>>Nama (A-Z)</option>
                                            <option value="nama_desc" <?php echo ($sort ?? '') === 'nama_desc' ? 'selected' : ''; ?>>Nama (Z-A)</option>
                                        </optgroup>
                                        <optgroup label="Urutan Alamat">
                                            <option value="alamat_asc" <?php echo ($sort ?? '') === 'alamat_asc' ? 'selected' : ''; ?>>Alamat (A-Z)</option>
                                            <option value="alamat_desc" <?php echo ($sort ?? '') === 'alamat_desc' ? 'selected' : ''; ?>>Alamat (Z-A)</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Add Button -->
                    <div>
                        <a class="btn btn-success shadow-sm w-100" 
                           href="index.php?controller=Pembeli&action=create">
                            <i class="bi bi-person-plus-fill me-2"></i>Tambah Pelanggan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles -->
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
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25) !important;
        }
        
        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
    </style>

    <!-- Main Content -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <?php if (empty($pembelis)): ?>
                <div class="text-center py-5">
                    <i class="bi bi-people text-muted fs-lg"></i>
                    <p class="text-muted mt-3">Belum ada data pelanggan</p>
                    <a href="index.php?controller=Pembeli&action=create" class="btn btn-success">
                        <i class="bi bi-person-plus-fill me-2"></i>Tambah Pelanggan Pertama
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">ID</th>
                                <th scope="col" class="border-0">Nama Pelanggan</th>
                                <th scope="col" class="border-0">Alamat</th>
                                <th scope="col" class="border-0 text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pembelis as $p): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($p['id_pembeli']); ?></td>
                                <td><?php echo htmlspecialchars($p['nama_pembeli']); ?></td>
                                <td><?php echo htmlspecialchars($p['alamat']); ?></td>
                                <td class="text-end">
                                    <div class="btn-group" role="group" aria-label="Aksi Pelanggan">
                                        <a class="btn btn-sm btn-outline-warning" 
                                           href="index.php?controller=Pembeli&action=edit&id=<?php echo htmlspecialchars($p['id_pembeli']); ?>"
                                           title="Edit Pelanggan">
                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                        </a>
                                        <a class="btn btn-sm btn-outline-danger" 
                                           href="index.php?controller=Pembeli&action=delete&id=<?php echo htmlspecialchars($p['id_pembeli']); ?>"
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')"
                                           title="Hapus Pelanggan">
                                            <i class="bi bi-trash me-1"></i>Hapus
                                        </a>
                                    </div>
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