<?php


class SanPhamController
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
    public function  chiTietSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);
        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamdDanhMuc($sanPham['id'], $sanPham['danh_muc_id']);
        // var_dump($listSanPhamCungDanhMuc);die();

        if (isset($sanPham)) {
            require_once './views/detailSanPham.php';
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }
    public function guiBinhLuan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['binh_luan'], $_POST['san_pham_id'])) {
            if (isset($_SESSION['user_client'])) {
                $email = $_SESSION['user_client'];
                $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($email); // Lấy user từ email

                if ($user) {
                    $tai_khoan_id = $user['id'];
                    $binh_luan = trim($_POST['binh_luan']);
                    $san_pham_id = intval($_POST['san_pham_id']);
                    $ngay_dang = date('Y-m-d H:i:s');

                    if (!empty($binh_luan) && $san_pham_id > 0) {
                        $this->modelTaiKhoan->binhLuan($tai_khoan_id, $san_pham_id, $binh_luan, $ngay_dang);
                        header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);
                        exit();
                    }
                }
            }
        }

        header('Location: ' . BASE_URL . '?act=login');
        exit();
    }
    public function xoaBinhLuan()
    {
        //  var_dump($_POST);die();
        $id_binh_luan = $_POST['id_binh_luan'];
        // $san_pham_id = intval($_POST['san_pham_id']);
        // $name_view = $_POST['name_view'];



        $binhLuan = $this->modelSanPham->getDetailBinhLuan($id_binh_luan);
        $xoa = $this->modelSanPham->deleteBinhLuan($id_binh_luan);

        // var_dump($binhLuan);
        // die();
        // die();
        // $status = $this->modelSanPham->updateTrangThaiBinhLuan($id_binh_luan, $trang_thai_update);
        header('Location:' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $binhLuan['san_pham_id']);
    }
}
