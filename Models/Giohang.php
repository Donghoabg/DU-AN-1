<?php
class GioHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getGioHangFromUser($id)
    {
        try {
            $sql = "SELECT * FROM gio_hangs WHERE tai_khoan_id = :tai_khoan_id  ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':tai_khoan_id' => $id
                ]
            );
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getDetailGioHang($id)
    {
        try {
            $sql = "SELECT chi_tiet_gio_hangs.*, san_phams.ten_san_pham, san_phams.hinh_anh, san_phams.gia_san_pham, san_phams.gia_khuyen_mai
                FROM chi_tiet_gio_hangs
                INNER JOIN san_phams ON chi_tiet_gio_hangs.san_pham_id = san_phams.id
                WHERE chi_tiet_gio_hangs.gio_hang_id = :gio_hang_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':gio_hang_id' => $id
                ]
            );
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    public function addGioHang($id)
    {
        try {
            $sql = "INSERT INTO gio_hangs (tai_khoan_id) VALUES(:id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id
                ]
            );
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateSoLuong($gio_hang_id, $san_pham_id, $so_luong)
    {
        //   var_dump($gio_hang_id);
        // var_dump($san_pham_id);
        // var_dump($so_luong);

        //                 die;
        try {
            $sql = "UPDATE chi_tiet_gio_hangs 
      SET so_luong = :so_luong
      WHERE gio_hang_id = :gio_hang_id AND san_pham_id = :san_pham_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':gio_hang_id' => $gio_hang_id,
                    ':san_pham_id' => $san_pham_id,
                    ':so_luong' => $so_luong,


                ]
            );
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
 



    public function addDetailGioHang($gio_hang_id, $san_pham_id, $so_luong, $size, $mau_sac)
{
    try {
        // Kiểm tra sản phẩm đã có chưa
        $tonTai = $this->getChiTietGioHangTonTai($gio_hang_id, $san_pham_id, $size, $mau_sac);
        
        if ($tonTai) {
            // Nếu đã có, cộng thêm số lượng
            $sql = "UPDATE chi_tiet_gio_hangs 
                    SET so_luong = so_luong + :so_luong 
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':so_luong' => $so_luong,
                ':id' => $tonTai['id']
            ]);
        } else {
            // Nếu chưa có, thêm mới
            $sql = "INSERT INTO chi_tiet_gio_hangs 
                    (gio_hang_id, san_pham_id, so_luong, size, mau_sac) 
                    VALUES(:gio_hang_id, :san_pham_id, :so_luong, :size, :mau_sac)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':gio_hang_id' => $gio_hang_id,
                ':san_pham_id' => $san_pham_id,
                ':so_luong' => $so_luong,
                ':size' => $size,
                ':mau_sac' => $mau_sac,
            ]);
        }

        return true;
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}




public function deleteChiTietGioHang($chi_tiet_gio_hang_id)
{
    try {
        $sql = "DELETE FROM chi_tiet_gio_hangs WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $chi_tiet_gio_hang_id]);
        return true;
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

public function deleteAllChiTietGioHang($gio_hang_id)
    {
        try {
            $sql = "DELETE FROM chi_tiet_gio_hangs WHERE gio_hang_id = :gio_hang_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':gio_hang_id' => $gio_hang_id
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getChiTietGioHangTonTai($gio_hang_id, $san_pham_id, $size, $mau_sac)
{
    try {
        $sql = "SELECT * FROM chi_tiet_gio_hangs 
                WHERE gio_hang_id = :gio_hang_id 
                AND san_pham_id = :san_pham_id 
                AND size = :size 
                AND mau_sac = :mau_sac";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':gio_hang_id' => $gio_hang_id,
            ':san_pham_id' => $san_pham_id,
            ':size' => $size,
            ':mau_sac' => $mau_sac
        ]);
        return $stmt->fetch();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
    }
    public function updateSoLuongTheoBienThe($gio_hang_id, $san_pham_id, $size, $mau_sac, $so_luong)
    {
        try {
            $sql = "UPDATE chi_tiet_gio_hangs 
                    SET so_luong = :so_luong 
                    WHERE gio_hang_id = :gio_hang_id 
                    AND san_pham_id = :san_pham_id 
                    AND size = :size 
                    AND mau_sac = :mau_sac";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':so_luong' => $so_luong,
                ':gio_hang_id' => $gio_hang_id,
                ':san_pham_id' => $san_pham_id,
                ':size' => $size,
                ':mau_sac' => $mau_sac
            ]);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function deleteChiTietGioHangTheoSP($gio_hang_id, $san_pham_id)
    {
        try {
            $sql = "DELETE FROM chi_tiet_gio_hangs WHERE gio_hang_id = :gio_hang_id AND san_pham_id = :san_pham_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':gio_hang_id' => $gio_hang_id,
                ':san_pham_id' => $san_pham_id
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
