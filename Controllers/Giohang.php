<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class GioHangDonHangController{
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

    public addGioHang(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_SESSION['user_client'])) {
                $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

                //Lấy dữ liệu Giỏ hàng
                $gioHang = $this->modelGioHang->getGioHangFromUser( $mail['id']);
                if(!$gioHang){
                    $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                    $gioHang = ['id' => $gioHangId];
                    $chiTietGioHang = $this->modelGioHang->getDatailGioHang($gioHang['id']);
                }else{
                    $chiTietGioHang = $this->modelGioHang->getDatailGioHang($gioHang['id']);
                }
                $sanpham_id = $_POST['san_pham_id'];
                $so_luong = $_POST['so_luong'];

                $checkSanpham = false;
                foreach ($chiTietGioHang as $detail){
                    if ($detail['san_pham_id'] == $san_pham_id) {
                        $newSoLuong = $detail['so_luong'] + $so_luong;
                        $this->modelGioHang->updateSoluong($gioHang['id'],$san_pham_id,$newSoLuong);
                        $checkSanpham = true;
                        break;
                    }
                }
                if(!$checkSanpham) {
                    $this->modelGioHang->addDetailGioHang($gioHang['id'],$san_pham_id,$so_luong);
                }
                header('Location:' . BASE_URL . '?act=gio-hang');                
            } else {
                header('Location:' . BASE_URL . '?act=login');
            }
        }
    }
    public function gioHang() {
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        if (isset($_SESSION['user_client'])) {
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            //    var_dump($mail);die();

            // lẤy dl giỏ hàng
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
            //    var_dump($gioHang);die();

            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                // var_dump($gioHangId);die();

                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

            } else {
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                // var_dump($chiTietGioHang);
                // die();

            }

            require_once './views/gioHang.php';
        } else {
            header('Location:' . BASE_URL . '?act=login');
        }
    }
    public function xoaSp() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $chi_tiet_gio_hang_id = $_POST['chi_tiet_gio_hang_id'];
            $xoa = $this->modelGioHang->deleteChiTietGioHang($chi_tiet_gio_hang_id);
            header('Location:' . BASE_URL . '?act=gio-hang');
        }
     }
    public function lichSuDonHang() {
        // Giả sử bạn có model DonHang.php với method lấy đơn hàng theo user
        session_start();

        if (!isset($_SESSION['user_id'])) {
            // Chưa đăng nhập thì chuyển hướng về login
            header('Location: index.php?act=login');
            exit;
        }

        // Gọi model để lấy danh sách đơn hàng
        $userId = $_SESSION['user_id'];
        $donHangModel = new DonHang();
        $orders = $donHangModel->getOrdersByUser($userId);

        require_once './views/lich-su-don-hang.php';
    }
    public function xoaSanPhamGioHang() {
        if (isset($_SESSION['user_client']) && isset($_GET['id_chi_tiet_gio_hang'])) {
            $chi_tiet_gio_hang_id = $_GET['id_chi_tiet_gio_hang'];
            $this->modelGioHang->deleteChiTietGioHang($chi_tiet_gio_hang_id);
        }
        header('Location:' . BASE_URL . '?act=gio-hang');
        exit;
    }

}