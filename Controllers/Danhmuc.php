<?php 
class DanhMucController {
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;
    public function __construct(){
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan -new TaiKhoan();
        $this->modelGioHang -new GioHang();
        $this->modelDonHang -new DonHang();
    }

    public function sanPhamDanhMuc(){
        $listtop10 = $this->modelSanPham->top10();

        if(isset($_GET['danh_muc_id']) && $_GET['danh_muc_id'] > 0){
            $iddm = $_GET['danh_muc_id'];
            $spdm = $this->modelSanPham->sanPhamTheoDanhMuc($iddm);

            $listDanhMuc = $this->modelSanPham->getAllDanhMuc();
            require_once './Views/sanPhamTheoDanhMuc.php';
        }else{
            $listDanhMuc = $this->modelSanPham->getAllDanhmuc();
            $listSanpham = $this->modelSanPham->getAllSanPham();
            $listtop10 = $this->modelSanPham->top10();
            require_once './Views/sanPham.php';
        }
    }
}
?>