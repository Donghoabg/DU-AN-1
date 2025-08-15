<?php
require_once 'db.php';
class ProductModel {
    private $pdo;

    public function __construct() {
        require_once 'db.php';
        $this->pdo = DB::connect();
    }

    public function getFilteredProducts($filters) {
        $sql = "SELECT * FROM san_phams WHERE is_hidden = 0";
        $params = [];

        if ($filters['color']) {
            $sql .= " AND mau_sac = ?";
            $params[] = $filters['color'];
        }
        if ($filters['size']) {
            $sql .= " AND kich_co = ?";
            $params[] = $filters['size'];
        }
        if ($filters['price_range']) {
            switch ($filters['price_range']) {
                case '1':
                    $sql .= " AND gia_khuyen_mai < 500000";
                    break;
                case '2':
                    $sql .= " AND gia_khuyen_mai BETWEEN 500000 AND 1000000";
                    break;
                case '3':
                    $sql .= " AND gia_khuyen_mai > 1000000";
                    break;
            }
        }
        if ($filters['category']) {
            $sql .= " AND danh_muc_id = ?";
            $params[] = $filters['category'];
        }
        if ($filters['sort']) {
            switch ($filters['sort']) {
                case 'price_asc':
                    $sql .= " ORDER BY gia_khuyen_mai ASC";
                    break;
                case 'price_desc':
                    $sql .= " ORDER BY gia_khuyen_mai DESC";
                    break;
                case 'date':
                    $sql .= " ORDER BY ngay_nhap DESC";
                    break;
            }
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCategories() {
        $stmt = $this->pdo->query("SELECT * FROM danh_mucs WHERE trang_thai = 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProducts() {
        $stmt = $this->pdo->query("SELECT * FROM san_phams");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM san_phams WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addProduct($data) {
        $sql = "INSERT INTO san_phams (ten_san_pham, gia_san_pham, gia_khuyen_mai, hinh_anh, so_luong, luot_xem, ngay_nhap, mo_ta, danh_muc_id, trang_thai, is_hidden, mau_sac, kich_co)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['ten_san_pham'],
            $data['gia_san_pham'],
            $data['gia_khuyen_mai'],
            $data['hinh_anh'],
            $data['so_luong'],
            $data['luot_xem'] ?? 0,
            $data['ngay_nhap'],
            $data['mo_ta'],
            $data['danh_muc_id'],
            $data['trang_thai'],
            $data['is_hidden'] ?? 0,
            $data['mau_sac'],
            $data['kich_co']
        ]);
    }

    public function updateProduct($id, $data) {
        $sql = "UPDATE san_phams SET ten_san_pham = ?, gia_san_pham = ?, gia_khuyen_mai = ?, hinh_anh = ?, so_luong = ?, luot_xem = ?, ngay_nhap = ?, mo_ta = ?, danh_muc_id = ?, trang_thai = ?, is_hidden = ?, mau_sac = ?, kich_co = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['ten_san_pham'],
            $data['gia_san_pham'],
            $data['gia_khuyen_mai'],
            $data['hinh_anh'],
            $data['so_luong'],
            $data['luot_xem'],
            $data['ngay_nhap'],
            $data['mo_ta'],
            $data['danh_muc_id'],
            $data['trang_thai'],
            $data['is_hidden'],
            $data['mau_sac'],
            $data['kich_co'],
            $id
        ]);
    }

    public function deleteProduct($id) {
        $stmt = $this->pdo->prepare("DELETE FROM san_phams WHERE id = ?");
        $stmt->execute([$id]);
    }
}