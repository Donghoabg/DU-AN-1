<?php
class AdminBinhLuan {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Lấy tất cả bình luận
        public function getAll() {
            $sql = "SELECT bl.*, sp.ten_san_pham, tk.ho_ten, tk.anh_dai_dien, bl.ngay_dang
                    FROM binh_luans bl
                    LEFT JOIN san_phams sp ON bl.san_pham_id = sp.id
                    LEFT JOIN tai_khoans tk ON bl.tai_khoan_id = tk.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    // Xóa bình luận theo id
    public function delete($id) {
        $sql = "DELETE FROM binh_luans WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Cập nhật trạng thái bình luận (duyệt)
    // public function updateStatus($id, $trang_thai) {
    //     $sql = "UPDATE binh_luans SET trang_thai = ? WHERE id = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     return $stmt->execute([$trang_thai, $id]);
    // }

    // Lấy chi tiết một bình luận theo id
    public function getById($id) {
        $sql = "SELECT bl.*, sp.ten_san_pham, tk.ho_ten, bl.ngay_dang FROM binh_luans bl
                LEFT JOIN san_phams sp ON bl.san_pham_id = sp.id
                LEFT JOIN tai_khoans tk ON bl.tai_khoan_id = tk.id
                WHERE bl.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
