<?php
class SanPhamModel {
    private $pdo;

    public function __construct() {
        $this->pdo = DB::connect();
    }

    public function getFiltered($filter) {
        $sql = "SELECT * FROM san_phams WHERE 1=1";
        $params = [];

        if (!empty($filter['danh_muc_id'])) {
            $sql .= " AND danh_muc_id = ?";
            $params[] = $filter['danh_muc_id'];
        }

        if (!empty($filter['mau_sac'])) {
            $sql .= " AND mau_sac = ?";
            $params[] = $filter['mau_sac'];
        }

        if (!empty($filter['kich_co'])) {
            $sql .= " AND kich_co = ?";
            $params[] = $filter['kich_co'];
        }

        if (!empty($filter['gia'])) {
            switch ($filter['gia']) {
                case '1': $sql .= " AND gia_san_pham < 100000"; break;
                case '2': $sql .= " AND gia_san_pham BETWEEN 200000 AND 500000"; break;
                case '3': $sql .= " AND gia_san_pham BETWEEN 500000 AND 1000000"; break;
                case '4': $sql .= " AND gia_san_pham > 1000000"; break;
            }
        }

        if (!empty($filter['sort'])) {
            if ($filter['sort'] == 'asc') {
                $sql .= " ORDER BY gia_san_pham ASC";
            } elseif ($filter['sort'] == 'desc') {
                $sql .= " ORDER BY gia_san_pham DESC";
            }
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}