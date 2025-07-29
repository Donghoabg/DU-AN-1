<?php
class DonHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllDonHang($id)
    {
        try {
            $sql = "SELECT don_hangs.*,trang_thai_don_hangs.ten_trang_thai  FROM don_hangs 
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id 
      
              WHERE don_hangs.id = :id ORDER BY don_hangs.id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id
                ]
            );
            $donHang =  $stmt->fetchAll();
            return $donHang;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}