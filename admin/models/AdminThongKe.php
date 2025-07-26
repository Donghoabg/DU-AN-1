<?php
class AdminThongKe{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function convertToVND($amount)
    {
        return number_format($amount, 0, ',', '.') . ' ₫';  // Định dạng số và thêm "₫" sau tiền
    }
    
    public function getAllThongKe()
{
    try {
        // Cập nhật truy vấn để lấy thêm ngày đặt (ngay_dat)
        $sql = "SELECT 
                    trang_thai_don_hangs.ten_trang_thai, 
                    DATE(don_hangs.ngay_dat) as ngay_dat,  -- Lấy ngày đặt
                    COUNT(don_hangs.id) as totalOrders, 
                    SUM(don_hangs.tong_tien) as totalRevenue,
                    AVG(don_hangs.tong_tien) as avgOrderValue
                FROM don_hangs
                INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
                GROUP BY trang_thai_don_hangs.ten_trang_thai, DATE(don_hangs.ngay_dat)
                ORDER BY totalRevenue DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $thongKe = $stmt->fetchAll();

        // Chuyển đổi giá trị tiền tệ sang VND cho các cột liên quan
        foreach ($thongKe as &$item) {
            if (isset($item['totalRevenue'])) {
                $item['totalRevenue'] = $this->convertToVND($item['totalRevenue']);
            }
            if (isset($item['avgOrderValue'])) {
                $item['avgOrderValue'] = $this->convertToVND($item['avgOrderValue']);
            }
        }

        return $thongKe;
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

    
}