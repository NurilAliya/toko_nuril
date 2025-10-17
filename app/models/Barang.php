<?php
require_once 'app/core/Model.php';
class Barang extends Model {
    public function getAll($search = '', $sort = 'terbaru'){
        $sql = "SELECT * FROM barang WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (nama_barang LIKE ? OR CAST(harga AS CHAR) LIKE ?)";
            $searchTerm = "%{$search}%";
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }

        // Add sorting
        switch ($sort) {
            case 'terbaru':
                $sql .= " ORDER BY id_barang DESC";
                break;
            case 'terlama':
                $sql .= " ORDER BY id_barang ASC";
                break;
            case 'nama_desc':
                $sql .= " ORDER BY nama_barang DESC";
                break;
            case 'nama_asc':
                $sql .= " ORDER BY nama_barang ASC";
                break;
            case 'harga_asc':
                $sql .= " ORDER BY harga ASC";
                break;
            case 'harga_desc':
                $sql .= " ORDER BY harga DESC";
                break;
            case 'stok_asc':
                $sql .= " ORDER BY stok ASC";
                break;
            case 'stok_desc':
                $sql .= " ORDER BY stok DESC";
                break;
            default:
                $sql .= " ORDER BY id_barang DESC";
                break;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    public function find($id){
        $stmt = $this->db->prepare("SELECT * FROM barang WHERE id_barang = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function create($nama, $harga, $stok){
        $nama = strtoupper($nama);
        $stmt = $this->db->prepare("INSERT INTO barang (nama_barang, harga, stok) VALUES (?, ?, ?)");
        return $stmt->execute([$nama, $harga, $stok]);
    }
    public function update($id, $nama, $harga, $stok){
        $nama = strtoupper($nama);
        $stmt = $this->db->prepare("UPDATE barang SET nama_barang=?, harga=?, stok=? WHERE id_barang=?");
        return $stmt->execute([$nama, $harga, $stok, $id]);
    }
    public function delete($id){
        $stmt = $this->db->prepare("DELETE FROM barang WHERE id_barang=?");
        return $stmt->execute([$id]);
    }
}
?>