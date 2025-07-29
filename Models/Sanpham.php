<?php
//require_once './admin/models/AdminSanPham.php';

class SanPham
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }


    public function getAllSanPham()
    {
        try {
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id WHERE san_phams.is_hidden = 0 AND danh_mucs.trang_thai = 1 ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    public function getDetailSanPham($id)
    {
        try {
            $sql = "SELECT  san_phams.*, danh_mucs.ten_danh_muc 
            FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id  
          WHERE san_phams.id = :id AND san_phams.is_hidden = 0 AND danh_mucs.trang_thai = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id
                ]
            );
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getListAnhSanPham($id)
    {
        try {
            $sql = "SELECT * FROM hinh_anh_san_phams WHERE san_pham_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id
                ]
            );
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getBinhLuanFromSanPham($id)
    {
        try {
            $sql = "SELECT binh_luans.*, tai_khoans.ho_ten, tai_khoans.anh_dai_dien FROM binh_luans
            INNER JOIN tai_khoans ON binh_luans.tai_khoan_id = tai_khoans.id
            WHERE binh_luans.san_pham_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    private function getDanhMucId($id)
    {
        $sql = "SELECT danh_muc_id FROM san_phams WHERE id = :id  ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        return $result['danh_muc_id'];
    }
    public function getListSanPhamdDanhMuc($id, $danh_muc_id)
    {
        try {
            if (!is_numeric($id) || !is_numeric($danh_muc_id)) {
                throw new Exception("Tham số không hợp lệ.");
            }
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc 
                FROM san_phams 
                INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                WHERE san_phams.danh_muc_id = :danh_muc_id 
                AND san_phams.id <> :id
                AND san_phams.is_hidden = 0
                AND danh_mucs.trang_thai = 1
                ORDER BY san_phams.id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':danh_muc_id' => intval($danh_muc_id),
                ':id' => intval($id),
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Lỗi lấy danh sách sản phẩm theo danh mục: " . $e->getMessage());
            return false;
        }
    }
    




    
}
