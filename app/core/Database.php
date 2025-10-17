<?php
class Database {
    private $host = '127.0.0.1';
    private $db   = 'toko_nuril';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    public $pdo;
    public function __construct(){
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $opt = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC];
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $opt);
        } catch (PDOException $e){
            die('Koneksi DB gagal: '.$e->getMessage());
        }
    }
}
?>