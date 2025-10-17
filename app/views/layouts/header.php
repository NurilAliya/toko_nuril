<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sweet Bakery - Sistem Manajemen Toko Kue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <link href="/toko_nuril/public/css/style.css" rel="stylesheet">
    <link href="/toko_nuril/public/css/icons.css" rel="stylesheet">
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <!-- Sidebar Brand -->
        <div class="sidebar-brand">
            <h5 class="pacifico text-primary">Sweet Bakery Toko Nuril</h5>
            <p>Sistem Manajemen Toko Kue</p>
        </div>
        
        <div class="sidebar-sticky">
            <!-- Main Navigation -->
            <div class="sidebar-heading">Main Navigation</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= !isset($_GET['controller']) ? 'active' : '' ?>" href="index.php">
                        <i class="bi bi-grid-1x2-fill"></i>
                        Dashboard
                    </a>
                </li>
            </ul>

            <!-- Data Master -->
            <div class="sidebar-divider"></div>
            <div class="sidebar-heading">Data Master</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= isset($_GET['controller']) && $_GET['controller'] == 'Barang' ? 'active' : '' ?>" 
                       href="index.php?controller=Barang">
                        <i class="bi bi-box-seam-fill"></i>
                        Barang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isset($_GET['controller']) && $_GET['controller'] == 'Pembeli' ? 'active' : '' ?>" 
                       href="index.php?controller=Pembeli">
                        <i class="bi bi-people-fill"></i>
                        Pembeli
                    </a>
                </li>
            </ul>

            <!-- Transaksi -->
            <div class="sidebar-divider"></div>
            <div class="sidebar-heading">Transaksi</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= isset($_GET['controller']) && $_GET['controller'] == 'Transaksi' && !isset($_GET['action']) ? 'active' : '' ?>" 
                       href="index.php?controller=Transaksi">
                        <i class="bi bi-cart-fill"></i>
                        Transaksi
                    </a>
                </li>
            </ul>

            <!-- Laporan -->
            <div class="sidebar-divider"></div>
            <div class="sidebar-heading">Laporan</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= isset($_GET['controller']) && $_GET['controller'] == 'Transaksi' && isset($_GET['action']) && $_GET['action'] == 'laporan' ? 'active' : '' ?>" 
                       href="index.php?controller=Transaksi&action=laporan">
                        <i class="bi bi-file-earmark-text-fill"></i>
                        Laporan Penjualan
                    </a>
                </li>
            </ul>

            
        </div>
    </nav>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-top">
        <div class="container-fluid">
            <button class="btn btn-link btn-sm text-secondary d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                <i class="bi bi-list fs-4"></i>
            </button>

           

            <div class="d-flex align-items-center ms-auto">
                <!-- Notifications -->
                

                <!-- User Profile -->
                <div class="user-profile">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=4e73df&color=fff" alt="Admin">
                    <div class="d-none d-md-block">
                        <div class="fw-bold">Admin</div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <main class="main-content">
        <div class="content-wrapper">