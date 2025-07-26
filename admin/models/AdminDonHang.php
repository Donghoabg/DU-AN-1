<?php
class AdminDonHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function convertToVND($amount)
{
    return number_format($amount, 0, ',', '.') . ' ₫';  // Định dạng số và thêm "₫" sau tiền
}
    public function getAllDonHang()
    {
        try {
            $sql = "SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai 
            FROM don_hangs
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
            ORDER BY don_hangs.id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $donHangs = $stmt->fetchAll();

            // Chuyển giá trị tiền thành VND nếu có trường 'tong_tien'
            foreach ($donHangs as &$donHang) {
                // Kiểm tra và chuyển các trường có giá trị tiền tệ (ví dụ: 'tong_tien')
                if (isset($donHang['tong_tien'])) {
                    $donHang['tong_tien'] = $this->convertToVND($donHang['tong_tien']);
                }

                // Nếu cần chuyển đổi các trường khác như giá sản phẩm, tổng giá trị, v.v.
                if (isset($donHang['gia_san_pham'])) {
                    $donHang['gia_san_pham'] = $this->convertToVND($donHang['gia_san_pham']);
                }

                // Bạn có thể thêm nhiều trường khác cần chuyển đổi tại đây, nếu có
            }

            return $donHangs;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getAllTrangThaiDonHang()
    {
        try {
            $sql = "SELECT * FROM trang_thai_don_hangs";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getDetailDonHang($id)
    {
        try {
            $sql = "SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai, 
                            tai_khoans.ho_ten, tai_khoans.email, tai_khoans.so_dien_thoai,
                            phuong_thuc_thanh_toans.ten_phuong_thuc
            FROM don_hangs 
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id 
            INNER JOIN tai_khoans ON don_hangs.tai_khoan_id = tai_khoans.id 
            INNER JOIN phuong_thuc_thanh_toans ON don_hangs.phuong_thuc_thanh_toan_id = phuong_thuc_thanh_toans.id 

            WHERE don_hangs.id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id
                ]
            );
            $donHang = $stmt->fetch();

        // Chuyển đổi các giá trị tiền thành VND nếu có
        if ($donHang) {
            if (isset($donHang['tong_tien'])) {
                $donHang['tong_tien'] = $this->convertToVND($donHang['tong_tien']);
            }

            if (isset($donHang['gia_san_pham'])) {
                $donHang['gia_san_pham'] = $this->convertToVND($donHang['gia_san_pham']);
            }
        }

        return $donHang;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getListSpDonHang($id)
    {
        try {
            $sql = "SELECT chi_tiet_don_hangs.*, san_phams.ten_san_pham
            FROM chi_tiet_don_hangs
            INNER JOIN san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id
          WHERE chi_tiet_don_hangs.don_hang_id = :id";

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

    public function updateDonHang($id, $ten_nguoi_nhan, $sdt_nguoi_nhan, $email_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $trang_thai_id)
    {

        try {
            $sql = "UPDATE don_hangs 
                    SET 
                    ten_nguoi_nhan = :ten_nguoi_nhan,
                    sdt_nguoi_nhan = :sdt_nguoi_nhan,
                    email_nguoi_nhan = :email_nguoi_nhan,
                    dia_chi_nguoi_nhan = :dia_chi_nguoi_nhan,
                    ghi_chu = :ghi_chu,
                    trang_thai_id = :trang_thai_id
                    WHERE id = :id

                                        ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                    ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                    ':email_nguoi_nhan' => $email_nguoi_nhan,
                    ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                    ':ghi_chu' => $ghi_chu,
                    ':trang_thai_id' => $trang_thai_id,
                    ':id' => $id
                ]
            );

            // Lấy id sản phẩm vừa thêm
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getDonHangFromKhachHang($id)
    {
        try {
            $sql = "SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai FROM don_hangs
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
            WHERE don_hangs.tai_khoan_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
