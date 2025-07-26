<?php

class TaiKhoan{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function checkLogin($email, $mat_khau)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            // Kiểm tra tài khoản tồn tại
            if (!$user) {
                return 'Tài khoản không tồn tại hoặc thông tin không chính xác';
            }

            // Kiểm tra mật khẩu
            if ($mat_khau !== $user['mat_khau']) {
                return 'Mật khẩu không đúng';
            }


            // Kiểm tra vai trò
            // Cho phép cả admin (1) và user (2) đăng nhập website
            if (($user['chuc_vu_id'] == 1 || $user['chuc_vu_id'] == 2) && $user['trang_thai'] == 1) {
                return $user['email']; // Đăng nhập thành công
            } else if ($user['trang_thai'] != 1) {
                return 'Tài khoản bị cấm';
            } else {
                return 'Tài khoản không có quyền đăng nhập';
            }
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    public function getTaiKhoanFromEmail($email)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':email' => $email
                ]
            );
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
   

    
    
}