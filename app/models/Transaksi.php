<?php
require_once "app/core/Model.php";

class Transaksi extends Model {
    protected string $table = "transaksi";
    protected string $primaryKey = "id_transaksi";

    public function getLaporanByItem($from=null, $to=null) {
        $sql = "SELECT b.id_barang, b.nama_barang, COUNT(t.id_transaksi) as jumlah_transaksi, 
                SUM(t.jumlah) as total_jumlah, SUM(t.total_harga) as total_pendapatan,
                MIN(t.tanggal) as pertama_terjual, MAX(t.tanggal) as terakhir_terjual,
                AVG(t.total_harga/t.jumlah) as rata_rata_harga 
                FROM barang b 
                LEFT JOIN transaksi t ON b.id_barang = t.id_barang";
        $params = [];
        if ($from && $to) {
            $sql .= " WHERE DATE(t.tanggal) BETWEEN ? AND ?";
            $params = [$from, $to];
        }
        $sql .= " GROUP BY b.id_barang, b.nama_barang ORDER BY total_jumlah DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getLaporanByCustomer($from=null, $to=null) {
        $sql = "SELECT p.id_pembeli, p.nama_pembeli, COUNT(t.id_transaksi) as jumlah_transaksi,
                SUM(t.jumlah) as total_item, SUM(t.total_harga) as total_pembelian,
                MIN(t.tanggal) as pertama_beli, MAX(t.tanggal) as terakhir_beli 
                FROM pembeli p 
                LEFT JOIN transaksi t ON p.id_pembeli = t.id_pembeli";
        $params = [];
        if ($from && $to) {
            $sql .= " WHERE DATE(t.tanggal) BETWEEN ? AND ?";
            $params = [$from, $to];
        }
        $sql .= " GROUP BY p.id_pembeli, p.nama_pembeli ORDER BY total_pembelian DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getLaporanHarian($from=null, $to=null) {
        $sql = "SELECT DATE(t.tanggal) as tanggal, COUNT(t.id_transaksi) as jumlah_transaksi,
                SUM(t.jumlah) as total_item, SUM(t.total_harga) as total_penjualan,
                GROUP_CONCAT(DISTINCT CONCAT(b.nama_barang, ' (', t.jumlah, ')') SEPARATOR ', ') as items_terjual 
                FROM transaksi t 
                JOIN barang b ON t.id_barang = b.id_barang";
        $params = [];
        if ($from && $to) {
            $sql .= " WHERE DATE(t.tanggal) BETWEEN ? AND ?";
            $params = [$from, $to];
        }
        $sql .= " GROUP BY DATE(t.tanggal) ORDER BY tanggal DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getLaporanBulanan($from=null, $to=null) {
        $sql = "SELECT DATE_FORMAT(t.tanggal, '%Y-%m') as bulan, 
                COUNT(t.id_transaksi) as jumlah_transaksi,
                SUM(t.jumlah) as total_item, SUM(t.total_harga) as total_penjualan,
                COUNT(DISTINCT DATE(t.tanggal)) as jumlah_hari,
                COUNT(DISTINCT t.id_pembeli) as jumlah_pembeli 
                FROM transaksi t";
        $params = [];
        if ($from && $to) {
            $sql .= " WHERE DATE(t.tanggal) BETWEEN ? AND ?";
            $params = [$from, $to];
        }
        $sql .= " GROUP BY DATE_FORMAT(t.tanggal, '%Y-%m') ORDER BY bulan DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM transaksi WHERE id_transaksi=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($id_pembeli, $id_barang, $jumlah) {
        // check stok
        $b = $this->db->prepare("SELECT stok, harga FROM barang WHERE id_barang=?");
        $b->execute([$id_barang]);
        $row = $b->fetch();
        
        if (!$row) return false;
        if ($jumlah > $row["stok"]) return "stok_tidak_cukup";
        
        $total = $row["harga"] * $jumlah;
        $stmt = $this->db->prepare("INSERT INTO transaksi (id_pembeli, id_barang, jumlah, total_harga, tanggal) VALUES (?,?,?,?,NOW())");
        $ok = $stmt->execute([$id_pembeli, $id_barang, $jumlah, $total]);
        
        if ($ok) {
            // kurangi stok
            $u = $this->db->prepare("UPDATE barang SET stok = stok - ? WHERE id_barang=?");
            $u->execute([$jumlah, $id_barang]);
            return true;
        }
        return false;
    }

    public function delete($id) {
        // rollback stok (simple approach)
        $t = $this->find($id);
        if (!$t) return false;
        
        $u = $this->db->prepare("UPDATE barang SET stok = stok + ? WHERE id_barang=?");
        $u->execute([$t["jumlah"], $t["id_barang"]]);
        
        $d = $this->db->prepare("DELETE FROM transaksi WHERE id_transaksi=?");
        return $d->execute([$id]);
    }

    public function getLatestTransactions($limit = 3) {
        $sql = "SELECT t.*, p.nama_pembeli, b.nama_barang, b.harga 
                FROM transaksi t 
                JOIN pembeli p ON t.id_pembeli = p.id_pembeli 
                JOIN barang b ON t.id_barang = b.id_barang 
                ORDER BY t.tanggal DESC, t.id_transaksi DESC 
                LIMIT " . (int)$limit;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function totalTransaksi() {
        $stmt = $this->db->query("SELECT COUNT(*) AS total FROM transaksi");
        return $stmt->fetchColumn();
    }

    public function totalPendapatan() {
        $stmt = $this->db->query("SELECT COALESCE(SUM(total_harga),0) AS total FROM transaksi");
        return $stmt->fetchColumn();
    }

    public function barangTerlaris() {
        $stmt = $this->db->query("SELECT b.nama_barang, SUM(t.jumlah) as terjual 
                                 FROM transaksi t 
                                 JOIN barang b ON t.id_barang=b.id_barang 
                                 GROUP BY b.id_barang 
                                 ORDER BY terjual DESC 
                                 LIMIT 1");
        return $stmt->fetch();
    }

    public function getAll($from = null, $to = null) {
        $sql = "SELECT t.*, p.nama_pembeli, b.nama_barang, b.harga 
                FROM transaksi t 
                JOIN pembeli p ON t.id_pembeli = p.id_pembeli 
                JOIN barang b ON t.id_barang = b.id_barang";
        $params = [];
        
        if ($from && $to) {
            $sql .= " WHERE DATE(t.tanggal) BETWEEN ? AND ?";
            $params = [$from, $to];
        }
        
        $sql .= " ORDER BY t.tanggal DESC, t.id_transaksi DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
