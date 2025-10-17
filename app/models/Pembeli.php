<?php
require_once 'app/core/Model.php';
class Pembeli extends Model {
    public function getAll($search = '', $sort = 'terbaru'){
        $sql = "SELECT * FROM pembeli WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (nama_pembeli LIKE ? OR alamat LIKE ?)";
            $searchTerm = "%{$search}%";
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }

        // Add sorting
        switch ($sort) {
            case 'terlama':
                $sql .= " ORDER BY id_pembeli ASC";
                break;
            case 'nama_asc':
                $sql .= " ORDER BY nama_pembeli ASC";
                break;
            case 'nama_desc':
                $sql .= " ORDER BY nama_pembeli DESC";
                break;
            case 'alamat_asc':
                $sql .= " ORDER BY alamat ASC";
                break;
            case 'alamat_desc':
                $sql .= " ORDER BY alamat DESC";
                break;
            case 'terbaru':
            default:
                $sql .= " ORDER BY id_pembeli DESC";
                break;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    public function find($id){
        $stmt = $this->db->prepare("SELECT * FROM pembeli WHERE id_pembeli=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function searchByName($keyword){
        $stmt = $this->db->prepare("SELECT * FROM pembeli WHERE nama_pembeli LIKE ? ORDER BY id_pembeli DESC");
        $stmt->execute(['%'.$keyword.'%']);
        return $stmt->fetchAll();
    }
    public function create($nama, $alamat){
        $stmt = $this->db->prepare("INSERT INTO pembeli (nama_pembeli, alamat) VALUES (?, ?)");
        return $stmt->execute([$nama, $alamat]);
    }
    public function update($id, $nama, $alamat){
        $stmt = $this->db->prepare("UPDATE pembeli SET nama_pembeli=?, alamat=? WHERE id_pembeli=?");
        return $stmt->execute([$nama, $alamat, $id]);
    }
    public function delete($id){
        $stmt = $this->db->prepare("DELETE FROM pembeli WHERE id_pembeli=?");
        return $stmt->execute([$id]);
    }
}
?>