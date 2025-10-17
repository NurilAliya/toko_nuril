<?php require_once 'app/views/layouts/header.php'; ?>

<div class="container mt-4">
    <!-- Form Section -->
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h4 class="mb-0 text-center">Laporan Penjualan</h4>
        </div>
        <div class="card-body">
            <form method="POST" id="reportForm">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="from" class="form-control" 
                               value="<?= isset($from) ? $from : date('Y-m-01') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" name="to" class="form-control" 
                               value="<?= isset($to) ? $to : date('Y-m-d') ?>" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Jenis Laporan</label>
                        <select name="jenis" class="form-select" required>
                            <option value="default" <?= (!isset($type) || $type === 'default') ? 'selected' : '' ?>>
                                Detail Transaksi
                            </option>
                            <option value="by_item" <?= (isset($type) && $type === 'by_item') ? 'selected' : '' ?>>
                                Per Produk
                            </option>
                            <option value="by_customer" <?= (isset($type) && $type === 'by_customer') ? 'selected' : '' ?>>
                                Per Pelanggan
                            </option>
                            <option value="daily" <?= (isset($type) && $type === 'daily') ? 'selected' : '' ?>>
                                Harian
                            </option>
                            <option value="monthly" <?= (isset($type) && $type === 'monthly') ? 'selected' : '' ?>>
                                Bulanan
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-2"></i>Tampilkan Laporan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        @media print {
            @page {
                margin: 0 !important;
            }
            /* Sembunyikan elemen yang tidak perlu dicetak */
            .card.mb-4, 
            form,
            .btn,
            .no-print {
                display: none !important;
            }
            /* Reset dan atur margin body */
            body {
                margin: 0.2cm 2cm 0 2cm !important;
                padding: 0 !important;
            }
            .container {
                width: 100% !important;
                max-width: none !important;
                margin: 0 auto !important;
                padding: 0 !important;
            }
            /* Atur tampilan report */
            .card:not(.mb-4) {
                border: none !important;
                box-shadow: none !important;
                margin: 0 auto !important;
                width: 100% !important;
            }
            .card-body {
                padding: 0 !important;
                margin: 0 auto !important;
                width: 100% !important;
            }
            /* Atur header laporan */
            .text-center {
                margin: 0 auto !important;
                padding: 0 !important;
                width: 100% !important;
            }
            .h3, .h5 {
                margin: 0 0 0.2cm 0 !important;
            }
            /* Atur tabel */
            .table-responsive {
                margin: 0.2cm auto !important;
                width: auto !important;
                min-width: 50% !important;
                max-width: 100% !important;
                display: flex !important;
                justify-content: center !important;
            }
            .table {
                margin: 0 auto !important;
                width: auto !important;
                min-width: 50% !important;
            }
            .table th, .table td {
                white-space: nowrap !important;
                padding: 0.3cm 0.5cm !important;
            }
            .table td.text-end, 
            .table th.text-end {
                text-align: right !important;
            }
            .table td.text-center, 
            .table th.text-center {
                text-align: center !important;
            }
            /* Untuk tabel dengan sedikit data */
            .table:not(.table-full-width) {
                width: auto !important;
                margin: 0 auto !important;
            }
            /* Memastikan angka terlihat */
            .text-end {
                font-family: monospace !important;
            }
            /* Atur konten agar center */
            #printSection {
                width: 100% !important;
                margin: 0 auto !important;
            }
        }
    </style>
    
    <!-- Report Section -->
    <?php if (isset($transaksis) && is_array($transaksis)): ?>
    <div class="card">
        <div class="card-body" id="printSection">
            <!-- Report Header -->
            <div class="text-center" style="margin-bottom: 0.5cm !important;">
                <h3 class="h3" style="margin: 0 0 0.2cm 0 !important;">SWEET BAKERY</h3>
                <h4 class="h5" style="margin: 0 0 0.2cm 0 !important;">Laporan Penjualan</h4>
                <p style="margin: 0 0 0.1cm 0 !important;"><?= isset($jenis) ? $jenis : 'Laporan Detail Transaksi' ?></p>
                <p style="margin: 0 0 0.2cm 0 !important;">Periode: <?= date('d/m/Y', strtotime($from)) ?> - <?= date('d/m/Y', strtotime($to)) ?></p>
                <hr style="width: 50%; margin: 0.3cm auto !important; border-top: 1px solid #000;">
            </div>

            <!-- Report Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover <?= count($transaksis) > 5 ? 'table-full-width' : '' ?>">
                    <thead class="table-light">
                        <tr>
                            <?php if($type === 'by_item'): ?>
                                <th>Nama Produk</th>
                                <th class="text-center">Jumlah Terjual</th>
                                <th class="text-end">Total Penjualan</th>
                            <?php elseif($type === 'by_customer'): ?>
                                <th>Nama Pelanggan</th>
                                <th class="text-center">Jumlah Transaksi</th>
                                <th class="text-end">Total Pembelian</th>
                            <?php elseif($type === 'daily' || $type === 'monthly'): ?>
                                <th>Tanggal</th>
                                <th class="text-center">Jumlah Transaksi</th>
                                <th class="text-end">Total Penjualan</th>
                            <?php else: ?>
                                <th>Tanggal</th>
                                <th>Pembeli</th>
                                <th>Produk</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Total</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(!empty($transaksis)): 
                            $totalKeseluruhan = 0;
                            foreach($transaksis as $t): 
                                // Sesuaikan dengan nama field di database
                                if ($type === 'default') {
                                    $total = isset($t['total_harga']) ? (int)$t['total_harga'] : 0;
                                } elseif ($type === 'by_item') {
                                    $total = isset($t['total_pendapatan']) ? (int)$t['total_pendapatan'] : 0;
                                } elseif ($type === 'by_customer') {
                                    $total = isset($t['total_pembelian']) ? (int)$t['total_pembelian'] : 0;
                                } else {
                                    $total = isset($t['total_penjualan']) ? (int)$t['total_penjualan'] : 0;
                                }
                                $totalKeseluruhan += $total;
                        ?>
                            <?php if($type === 'by_item'): ?>
                                <tr>
                                    <td><?= htmlspecialchars($t['nama_barang'] ?? '') ?></td>
                                    <td class="text-center"><?= number_format(isset($t['total_jumlah']) ? (int)$t['total_jumlah'] : 0, 0, ',', '.') ?></td>
                                    <td class="text-end">Rp <?= number_format(isset($t['total_pendapatan']) ? (int)$t['total_pendapatan'] : 0, 0, ',', '.') ?></td>
                                </tr>
                            <?php elseif($type === 'by_customer'): ?>
                                <tr>
                                    <td><?= htmlspecialchars($t['nama_pembeli'] ?? '') ?></td>
                                    <td class="text-center"><?= number_format(isset($t['total_item']) ? (int)$t['total_item'] : 0, 0, ',', '.') ?></td>
                                    <td class="text-end">Rp <?= number_format(isset($t['total_pembelian']) ? (int)$t['total_pembelian'] : 0, 0, ',', '.') ?></td>
                                </tr>
                            <?php elseif($type === 'daily' || $type === 'monthly'): ?>
                                <tr>
                                    <td><?= isset($t['tanggal']) ? date('d/m/Y', strtotime($t['tanggal'])) : (isset($t['bulan']) ? date('m/Y', strtotime($t['bulan'].'-01')) : '-') ?></td>
                                    <td class="text-center"><?= number_format(isset($t['total_item']) ? (int)$t['total_item'] : 0, 0, ',', '.') ?></td>
                                    <td class="text-end">Rp <?= number_format(isset($t['total_penjualan']) ? (int)$t['total_penjualan'] : 0, 0, ',', '.') ?></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td><?= isset($t['tanggal']) ? date('d/m/Y', strtotime($t['tanggal'])) : '-' ?></td>
                                    <td><?= htmlspecialchars($t['nama_pembeli'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($t['nama_barang'] ?? '') ?></td>
                                    <td class="text-center"><?= number_format(isset($t['jumlah']) ? (int)$t['jumlah'] : 0, 0, ',', '.') ?></td>
                                    <td class="text-end">Rp <?= number_format(isset($t['total_harga']) ? (int)$t['total_harga'] : 0, 0, ',', '.') ?></td>
                                </tr>
                            <?php endif; ?>
                            <!-- Debug info -->
                            <?php
                                if (isset($t)) {
                                    echo "<!-- Debug: ";
                                    var_export($t);
                                    echo " -->";
                                }
                            ?>
                        <?php endforeach; ?>
                            <!-- Total Row -->
                            <tr class="table-warning fw-bold">
                                <td colspan="<?= ($type === 'default' ? '4' : '2') ?>" class="text-end">
                                    Total Keseluruhan:
                                </td>
                                <td class="text-end">Rp <?= number_format((int)$totalKeseluruhan, 0, ',', '.') ?></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data transaksi</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Print Button -->
            <div class="text-end mt-3 d-print-none">
                <button type="button" class="btn btn-primary" onclick="window.print()">
                    <i class="bi bi-printer me-2"></i>Cetak Laporan
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
    @media print {
        /* Reset page margins and size */
        @page {
            size: A4 portrait;
            margin: 0.5cm 1cm;
        }
        
        /* Reset body */
        body {
            margin: 0 !important;
            padding: 0 !important;
            width: 210mm; /* A4 width */
            min-height: 297mm; /* A4 height */
            background: white !important;
        }
        
        /* Hide all non-printable elements */
        body * {
            visibility: hidden;
        }
        
        /* Show only print section */
        #printSection, #printSection * {
            visibility: visible;
            margin-top: 0 !important;
        }
        
        /* Position print section */
        #printSection {
            position: relative;
            width: 100%;
            max-width: 190mm; /* A4 width - margins */
            margin: 0 auto !important;
            padding: 0 !important;
            background: white !important;
        }
        
        /* Hide non-printable elements */
        .d-print-none, .btn, .card-header {
            display: none !important;
        }
        
        /* Report header styles */
        #printSection .h3 {
            font-size: 14pt !important;
            font-weight: bold !important;
            margin: 0 !important;
            padding: 0 !important;
            color: #000 !important;
        }
        
        #printSection .h5 {
            font-size: 12pt !important;
            margin: 0 !important;
            padding: 0 !important;
            color: #000 !important;
        }
        
        #printSection p {
            font-size: 10pt !important;
            margin: 0 !important;
            padding: 0 !important;
            line-height: 1.2 !important;
        }
        
        /* Table container */
        .table-responsive {
            margin: 0 !important;
            padding: 0 !important;
            overflow: visible !important;
            page-break-inside: auto !important;
        }
        
        /* Table styles */
        .table {
            width: 100% !important;
            max-width: 190mm !important;
            border-collapse: collapse !important;
            border-spacing: 0 !important;
            margin: 0 !important;
            font-size: 9pt !important;
            page-break-inside: auto !important;
        }
        
        /* Table header */
        .table thead {
            display: table-header-group !important;
        }
        
        .table th {
            background-color: #f8f9fa !important;
            color: #000 !important;
            font-weight: bold !important;
            text-align: left !important;
            border: 0.75pt solid #000 !important;
            padding: 0.15cm 0.2cm !important;
            font-size: 9pt !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        /* Table body */
        .table tbody {
            display: table-row-group !important;
        }
        
        .table td {
            padding: 0.15cm 0.2cm !important;
            border: 0.75pt solid #000 !important;
            font-size: 9pt !important;
            page-break-inside: avoid !important;
        }
        
        /* Table rows */
        .table tr {
            page-break-inside: avoid !important;
        }
        
        /* Total row styling */
        .table-warning {
            background-color: #fff3cd !important;
            font-weight: bold !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        /* Text alignments */
        .text-center { text-align: center !important; }
        .text-end { text-align: right !important; }
        
        /* Format currency and numbers */
        .text-end {
            font-family: "Courier New", Courier, monospace !important;
            white-space: nowrap !important;
        }
        
        /* Remove card styling */
        .card {
            border: none !important;
            box-shadow: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .card-body {
            padding: 0 !important;
            margin: 0 !important;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reportForm');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            const from = new Date(form.from.value);
            const to = new Date(form.to.value);
            
            if (from > to) {
                e.preventDefault();
                alert('Tanggal awal tidak boleh lebih besar dari tanggal akhir');
                return false;
            }
        });
    }
});
</script>

<?php require_once 'app/views/layouts/footer.php'; ?>