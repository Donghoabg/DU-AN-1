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
    public function addDonHang($tai_khoan_id, $ten_nguoi_nhan, $email_nguoi_nhan, $sdt_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $tong_tien, $phuong_thuc_thanh_toan_id, $ngay_dat, $ma_don_hang, $trang_thai_id)
    {
        try {
            $sql = "INSERT INTO don_hangs (tai_khoan_id, ten_nguoi_nhan, email_nguoi_nhan, sdt_nguoi_nhan, dia_chi_nguoi_nhan, ghi_chu, tong_tien, phuong_thuc_thanh_toan_id, ngay_dat, ma_don_hang,trang_thai_id) VALUES(:tai_khoan_id, :ten_nguoi_nhan, :email_nguoi_nhan, :sdt_nguoi_nhan, :dia_chi_nguoi_nhan, :ghi_chu, :tong_tien, :phuong_thuc_thanh_toan_id, :ngay_dat ,:ma_don_hang,:trang_thai_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':tai_khoan_id' => $tai_khoan_id,
                    ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                    ':email_nguoi_nhan' => $email_nguoi_nhan,
                    ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                    ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                    ':ghi_chu' => $ghi_chu,
                    ':tong_tien' => $tong_tien,
                    ':phuong_thuc_thanh_toan_id' => $phuong_thuc_thanh_toan_id,
                    ':ngay_dat' => $ngay_dat,
                    ':ma_don_hang' => $ma_don_hang,
                    ':trang_thai_id' => $trang_thai_id,


                ]
            );
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    public function addDetailDonHang($don_hang_id, $san_pham_id, $don_gia, $so_luong, $thanh_tien)
    {
        try {
            $sql = "INSERT INTO chi_tiet_don_hangs (don_hang_id, san_pham_id, don_gia, so_luong, thanh_tien) VALUES(:don_hang_id, :san_pham_id, :don_gia, :so_luong,:thanh_tien)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':don_hang_id' => $don_hang_id,
                    ':san_pham_id' => $san_pham_id,
                    ':don_gia' => $don_gia,
                    ':so_luong' => $so_luong,
                    ':thanh_tien' => $thanh_tien,
                ]
            );
            return $don_hang_id;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getDonHangFromUser($taiKhanId)
    {
        try {
            $sql = "SELECT * FROM don_hangs WHERE tai_khoan_id = :tai_khoan_id order by id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':tai_khoan_id' => $taiKhanId,

                ]
            );

            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getTrangThaiDonHang()
    {
        try {
            $sql = "SELECT * FROM trang_thai_don_hangs  ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getPhuongThucThanhToan()
    {
        try {
            $sql = "SELECT * FROM phuong_thuc_thanh_toans  ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getDonHangById($donHangId)
    {
        try {
            $sql = "SELECT * FROM don_hangs WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $donHangId]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function  getChiTietDonHangByDonHangId($donHangId)
    {
        try {
            $sql = "SELECT
                         chi_tiet_don_hangs.*,
                         san_phams.ten_san_pham,
                         san_phams.hinh_anh
                     FROM 
                          chi_tiet_don_hangs
                          JOIN 
                          san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id
                      WHERE 
                         chi_tiet_don_hangs.don_hang_id = :don_hang_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':don_hang_id' => $donHangId]);

            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateTrangThaiDonHang($donHangId, $trangThaiId)
    {
        try {
            $sql = "UPDATE don_hangs SET trang_thai_id= :trang_thai_id WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':trang_thai_id' => $trangThaiId,
                ':id' => $donHangId

            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
