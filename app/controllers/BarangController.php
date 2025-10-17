<?php
require_once 'app/core/Controller.php';
require_once 'app/models/Barang.php';
class BarangController extends Controller {
    private $m;
    public function __construct(){ $this->m = new Barang(); }
    public function index(){ 
        $search = isset($_GET['q']) ? trim($_GET['q']) : '';
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'nama_asc';
        $this->view('barang/index', [
            'barangs' => $this->m->getAll($search, $sort),
            'search' => $search,
            'sort' => $sort
        ]); 
    }
    public function create(){
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $this->m->create($_POST['nama_barang'], $_POST['harga'], max(0,intval($_POST['stok'])));
            $this->redirect('index.php?controller=Barang');
        }
        $this->view('barang/create');
    }
    protected function validateCSRFToken() {
        if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || 
            $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            throw new Exception('Invalid CSRF token');
        }
    }

    public function edit(){
        $id = $_GET['id'] ?? null;
        
        try {
            // Validate ID
            if (!$id) {
                throw new Exception('ID Barang tidak valid');
            }

            // Get existing barang
            $barang = $this->m->find($id);
            if (!$barang) {
                throw new Exception('Data barang tidak ditemukan');
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Validate CSRF token
                $this->validateCSRFToken();

                // Validate input
                $errors = [];
                
                $nama_barang = trim($_POST['nama_barang'] ?? '');
                if (empty($nama_barang)) {
                    $errors['nama_barang'] = 'Nama barang harus diisi';
                } elseif (strlen($nama_barang) < 3) {
                    $errors['nama_barang'] = 'Nama barang minimal 3 karakter';
                }

                $harga = $_POST['harga'] ?? '';
                if (!is_numeric($harga) || $harga < 0) {
                    $errors['harga'] = 'Harga harus berupa angka positif';
                }

                $stok = $_POST['stok'] ?? '';
                if (!is_numeric($stok) || $stok < 0) {
                    $errors['stok'] = 'Stok harus berupa angka non-negatif';
                }

                // If no errors, proceed with update
                if (empty($errors)) {
                    $this->m->update(
                        $_POST['id'],
                        $nama_barang,
                        $harga,
                        max(0, intval($stok))
                    );
                    // Generate new CSRF token after successful update
                    $_SESSION['csrf_token'] = Security::generateCSRFToken();
                    $this->redirect('index.php?controller=Barang');
                } else {
                    // If there are errors, show form again with errors
                    $data = [
                        'barang' => $barang,
                        'errors' => $errors
                    ];
                    $this->view('barang/edit', $data);
                    return;
                }
            }

            // Show edit form
            $data = ['barang' => $barang];
            $this->view('barang/edit', $data);

        } catch (Exception $e) {
            // Log error
            error_log("Error in BarangController::edit: " . $e->getMessage());
            
            // Redirect to error page or show error message
            $this->view('error', ['message' => $e->getMessage()]);
        }
    }
    public function delete(){
        $id = $_GET['id'] ?? null;
        $this->m->delete($id);
        $this->redirect('index.php?controller=Barang');
    }
}
?>