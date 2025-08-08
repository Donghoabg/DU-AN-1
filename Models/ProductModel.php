<?php
require_once 'db.php';
class ProductModel {
    private $pdo;
    public function __construct() { $this->pdo = DB::connect(); }

    public function getFilteredProducts($filters) {
    $sql = "SELECT DISTINCT s.* FROM san_phams s
            LEFT JOIN san_pham_bien_the b ON s.id = b.san_pham_id
            WHERE 1=1";
    $params = [];

    if (!empty($filters['color'])) {
        $sql .= " AND b.mau = :color";
        $params[':color'] = $filters['color'];
    }

    if (!empty($filters['size'])) {
        $sql .= " AND b.size = :size";
        $params[':size'] = $filters['size'];
    }

    if (!empty($filters['danh_muc_id'])) {
    $sql .= " AND s.danh_muc_id = :danh_muc_id";
    $params[':danh_muc_id'] = $filters['danh_muc_id'];
    }


    if (!empty($filters['price_range'])) {
        if ($filters['price_range'] == '1') {
            $sql .= " AND s.gia_khuyen_mai < 500000";
        } elseif ($filters['price_range'] == '2') {
            $sql .= " AND s.gia_khuyen_mai BETWEEN 500000 AND 1000000";
        } elseif ($filters['price_range'] == '3') {
            $sql .= " AND s.gia_khuyen_mai > 1000000";
        }
    }

    if (!empty($filters['keyword'])) {
        $sql .= " AND s.ten_san_pham LIKE :keyword";
        $params[':keyword'] = '%' . $filters['keyword'] . '%';
    }

    // Sort
    if (!empty($filters['sort'])) {
        if ($filters['sort'] == 'price_asc') $sql .= " ORDER BY s.gia_khuyen_mai ASC";
        elseif ($filters['sort'] == 'price_desc') $sql .= " ORDER BY s.gia_khuyen_mai DESC";
        elseif ($filters['sort'] == 'date') $sql .= " ORDER BY s.ngay_nhap DESC";
        else $sql .= " ORDER BY s.id DESC";
    } else {
        $sql .= " ORDER BY s.id DESC";
    }

    // Phân trang
    if (isset($filters['limit']) && isset($filters['offset'])) {
        $sql .= " LIMIT :limit OFFSET :offset";
        $params[':limit'] = (int)$filters['limit'];
        $params[':offset'] = (int)$filters['offset'];
    }

    $stmt = $this->pdo->prepare($sql);

    // Bind tất cả named parameters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




    public function getAllCategories() {
        return $this->pdo->query("SELECT * FROM danh_mucs")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProducts() {
        return $this->pdo->query("SELECT * FROM san_phams")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM san_phams WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addProduct($d) {
    $sql = "INSERT INTO san_phams
        (ten_san_pham, gia_san_pham, gia_khuyen_mai, hinh_anh, so_luong, luot_xem,
         ngay_nhap, mo_ta, danh_muc_id, trang_thai, is_hidden, mau_sac, kich_co)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        $d['ten_san_pham'], $d['gia_san_pham'], $d['gia_khuyen_mai'], $d['hinh_anh'],
        $d['so_luong'], $d['luot_xem'] ?? 0, $d['ngay_nhap'], $d['mo_ta'],
        $d['danh_muc_id'], $d['trang_thai'], $d['is_hidden'] ?? 0,
        $d['mau_sac'] ?? '', $d['kich_co'] ?? ''
    ]);

    return $this->pdo->lastInsertId(); // ✅ Trả về ID sản phẩm mới
}


    public function updateProduct($id, $d) {
        $sql = "UPDATE san_phams SET ten_san_pham = ?, gia_san_pham = ?, gia_khuyen_mai = ?, 
            hinh_anh = ?, so_luong = ?, luot_xem = ?, ngay_nhap = ?, mo_ta = ?, 
            danh_muc_id = ?, trang_thai = ?, is_hidden = ?, mau_sac = ?, kich_co = ?
            WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $d['ten_san_pham'], $d['gia_san_pham'], $d['gia_khuyen_mai'], $d['hinh_anh'],
            $d['so_luong'], $d['luot_xem'], $d['ngay_nhap'], $d['mo_ta'],
            $d['danh_muc_id'], $d['trang_thai'], $d['is_hidden'],
            $d['mau_sac'], $d['kich_co'], $id
        ]);
    }

    public function deleteProduct($id) {
        $this->pdo->prepare("DELETE FROM san_phams WHERE id = ?")->execute([$id]);
    }

    // — Các hàm danh mục
    public function getCategoryById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM danh_mucs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addCategory($d) {
        $stmt = $this->pdo->prepare("INSERT INTO danh_mucs (ten_danh_muc, mo_ta, trang_thai) VALUES (?, ?, ?)");
        $stmt->execute([$d['ten_danh_muc'], $d['mo_ta'], $d['trang_thai']]);
    }

    public function updateCategory($id, $d) {
        $stmt = $this->pdo->prepare("UPDATE danh_mucs SET ten_danh_muc = ?, mo_ta = ?, trang_thai = ? WHERE id = ?");
        $stmt->execute([$d['ten_danh_muc'], $d['mo_ta'], $d['trang_thai'], $id]);
    }

    public function deleteCategory($id) {
        $this->pdo->prepare("DELETE FROM danh_mucs WHERE id = ?")->execute([$id]);
    }
    public function addProductVariant($productId, $color, $size) {
    $sql = "INSERT INTO san_pham_bien_the (san_pham_id, mau, size) VALUES (?, ?, ?)";
    $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$productId, $color, $size]);
    }
    // Lấy tổng số sản phẩm (có thể kèm từ khóa tìm kiếm)
    public function countAllProducts($keyword = '') {
        if ($keyword !== '') {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM san_phams WHERE ten_san_pham LIKE ?");
            $stmt->execute(['%' . $keyword . '%']);
        } else {
            $stmt = $this->pdo->query("SELECT COUNT(*) FROM san_phams");
        }
        return $stmt->fetchColumn();
    }

    // Lấy sản phẩm có phân trang + tìm kiếm
    public function getProductsByPage($limit, $offset, $keyword = '') {
    $limit = (int)$limit;
    $offset = (int)$offset;

    $sql = "SELECT * FROM san_phams";
    $params = [];

    if ($keyword !== '') {
        $sql .= " WHERE ten_san_pham LIKE ?";
        $params[] = '%' . $keyword . '%';
    }

    $sql .= " ORDER BY ngay_nhap DESC LIMIT $limit OFFSET $offset";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll();
}

public function countFilteredProducts($filters) {
    $sql = "SELECT COUNT(DISTINCT s.id) FROM san_phams s
            LEFT JOIN san_pham_bien_the b ON s.id = b.san_pham_id
            WHERE 1=1";
    $params = [];

    if (!empty($filters['color'])) {
        $sql .= " AND b.mau = ?";
        $params[] = $filters['color'];
    }

    if (!empty($filters['size'])) {
        $sql .= " AND b.size = ?";
        $params[] = $filters['size'];
    }

    if (!empty($filters['danh_muc_id'])) {
    $sql .= " AND s.danh_muc_id = ?";
    $params[] = $filters['danh_muc_id'];
    }

    if (!empty($filters['price_range'])) {
        if ($filters['price_range'] == '1') {
            $sql .= " AND s.gia_khuyen_mai < 500000";
        } elseif ($filters['price_range'] == '2') {
            $sql .= " AND s.gia_khuyen_mai BETWEEN 500000 AND 1000000";
        } elseif ($filters['price_range'] == '3') {
            $sql .= " AND s.gia_khuyen_mai > 1000000";
        }
    }

    if (!empty($filters['keyword'])) {
        $sql .= " AND s.ten_san_pham LIKE ?";
        $params[] = '%' . $filters['keyword'] . '%';
    }

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchColumn();
}


}
