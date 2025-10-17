<?php
require_once 'app/core/Controller.php';
require_once 'app/models/Transaksi.php';
class DashboardController extends Controller {
    public function index(){
        $m = new Transaksi();
        $data = [
            'total_transaksi' => $m->totalTransaksi(),
            'total_pendapatan' => $m->totalPendapatan(),
            'barang_terlaris' => $m->barangTerlaris(),
            'transaksi_terbaru' => $m->getLatestTransactions(3),
        ];
        $this->view('dashboard', $data);
    }
}
?>