<?php
require_once 'app/core/Controller.php';
require_once 'app/models/Pembeli.php';
class PembeliController extends Controller {
    private $m;
    public function __construct(){ $this->m = new Pembeli(); }
    public function index(){
        $search = isset($_GET['q']) ? trim($_GET['q']) : '';
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'terbaru';
        
        $data = [
            'pembelis' => $this->m->getAll($search, $sort),
            'search' => $search,
            'sort' => $sort
        ];
        $this->view('pembeli/index', $data);
    }
    public function create(){
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $this->m->create($_POST['nama_pembeli'], $_POST['alamat']);
            $this->redirect('index.php?controller=Pembeli');
        }
        $this->view('pembeli/create');
    }
    public function edit(){
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $this->m->update($_POST['id'], $_POST['nama_pembeli'], $_POST['alamat']);
            $this->redirect('index.php?controller=Pembeli');
        }
        $data = ['pembeli'=>$this->m->find($id)];
        $this->view('pembeli/edit', $data);
    }
    public function delete(){
        $id = $_GET['id'] ?? null;
        $this->m->delete($id);
        $this->redirect('index.php?controller=Pembeli');
    }
}
?>