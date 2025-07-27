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
    

}