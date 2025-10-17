<?php
require_once 'app/core/Controller.php';
require_once 'app/models/Transaksi.php';
require_once 'app/models/Pembeli.php';
require_once 'app/models/Barang.php';
class TransaksiController extends Controller {
    private $m, $mp, $mb;
    public function __construct(){
        $this->m = new Transaksi();
        $this->mp = new Pembeli();
        $this->mb = new Barang();
    }
    public function index(){
        $from = $_GET['from'] ?? null;
        $to = $_GET['to'] ?? null;
        $this->view('transaksi/index', ['transaksis'=>$this->m->getAll($from,$to)]);
    }
    public function create(){
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $res = $this->m->create($_POST['id_pembeli'], $_POST['id_barang'], intval($_POST['jumlah']));
            if ($res === true) {
                $this->redirect('index.php?controller=Transaksi');
            } elseif ($res === 'stok_tidak_cukup') {
                $_SESSION['error'] = 'Jumlah melebihi stok tersedia.';
                $this->redirect('index.php?controller=Transaksi&action=create');
            } else {
                $_SESSION['error'] = 'Gagal menyimpan transaksi.';
                $this->redirect('index.php?controller=Transaksi&action=create');
            }
        }
        $data = ['pembelis'=>$this->mp->getAll(), 'barangs'=>$this->mb->getAll()];
        $this->view('transaksi/create', $data);
    }
    public function delete(){
        $id = $_GET['id'] ?? null;
        $this->m->delete($id);
        $this->redirect('index.php?controller=Transaksi');
    }
    public function laporan(){
        // Default values
        $data = [];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $from = $_POST['from'] ?? date('Y-m-01');
            $to = $_POST['to'] ?? date('Y-m-d');
            $jenis = $_POST['jenis'] ?? 'default';
            
            $data['from'] = $from;
            $data['to'] = $to;
            $data['type'] = $jenis;
            
            switch($jenis) {
                case 'by_item':
                    $data['transaksis'] = $this->m->getLaporanByItem($from, $to);
                    $data['jenis'] = 'Laporan Per Produk';
                    break;
                case 'by_customer':
                    $data['transaksis'] = $this->m->getLaporanByCustomer($from, $to);
                    $data['jenis'] = 'Laporan Per Pelanggan';
                    break;
                case 'daily':
                    $data['transaksis'] = $this->m->getLaporanHarian($from, $to);
                    $data['jenis'] = 'Laporan Harian';
                    break;
                case 'monthly':
                    $data['transaksis'] = $this->m->getLaporanBulanan($from, $to);
                    $data['jenis'] = 'Laporan Bulanan';
                    break;
                default:
                    $data['transaksis'] = $this->m->getAll($from, $to);
                    $data['jenis'] = 'Laporan Detail Transaksi';
                    break;
            }
        } else {
            // Default values for initial load
            $data['from'] = date('Y-m-01'); // First day of current month
            $data['to'] = date('Y-m-d');    // Today
            $data['type'] = 'default';
        }

        return $this->view('transaksi/laporan', $data);
    }
}
?>