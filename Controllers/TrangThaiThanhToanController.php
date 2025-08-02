<?php
require_once './models/TrangThaiThanhToan.php';
class TrangThaiThanhToanController
{
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;
    public $modelTrangThaiThanhToan;
    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
        $this->modelTrangThaiThanhToan = new TrangThaiThanhToan();
    }
    public function lichSuMuaHang()
    {
        if (!isset($_SESSION['user_client'])) {
            header('Location: index.php?act=login');
            exit;
        }
        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
        if (!$user) {
            header('Location: index.php?act=login');
            exit;
        }
        $tai_khoan_id = $user['id'];
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();
        $arrTrangThaiDonHang = $this->modelDonHang->getTrangThaiDonHang();
        $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');
        $arrPhuongThucThanhToan = $this->modelDonHang->getPhuongThucThanhToan();
        $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');
        $arrTrangThaiThanhToan = $this->modelTrangThaiThanhToan->getAll();
        $trangThaiThanhToan = array_column($arrTrangThaiThanhToan, 'ten_trang_thai', 'id');
        $donHangs = $this->modelDonHang->getDonHangFromUser($tai_khoan_id) ?: [];
        require_once "./views/lichSuMuaHang.php";
    }
}
