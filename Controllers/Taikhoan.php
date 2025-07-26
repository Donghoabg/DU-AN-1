<?php


class TaiKhoanController
{
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
    }
    public function taiKhoan()
    {
        $email = $_SESSION['user_client'];
        $thongTin = $this->modelTaiKhoan->getTaiKhoanFromEmail($email);
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        require_once './views/taikhoan.php';
        deleteSessionErrors();
    }
    public function formLogin()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        if (isset($_SESSION['user_client'])) {
            header('Location:' . BASE_URL);
            exit();
        }
        require_once './views/auth/formLogin.php';
        deleteSessionErrors();
    }
    public function postlogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lay dl
            $email = $_POST['email'];
            $password = $_POST['password'];

            // xử lý kiểm tra thông tin đăng nhập
            $user = $this->modelTaiKhoan->checkLogin($email, $password);
            //    var_dump($user);die();

            if ($user == $email) {
                // dn thanh cong
                // Luu thong tin vao session
                $_SESSION['user_client'] = $user;
                header("Location:" . BASE_URL);
                exit();
            } else {
                // Lỗi thì lưu lỗi vào session
                $_SESSION['errors'] = $user;
                //    var_dump($_SESSION['errors']);die();

                $_SESSION['flash'] = true;

                header("Location:" . BASE_URL . '?act=login');
                exit();
            }
        }
    }



    public function formDangKy()
    {

        if (isset($_SESSION['user_client'])) {
            header('Location:' . BASE_URL);
            exit();
        }
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        require_once('./views/auth/formDangKy.php');
        deleteSessionErrors();
    }

    
}
