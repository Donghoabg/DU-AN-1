<?php


class HomeController
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


    public function home()
    {
        $chiTietGioHang = $this->modelSanPham->getAllDanhMuc();

        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        $listtop10 = $this->modelSanPham->top10();

        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once('./views/home.php');
    }
    public function timKiem()
    {
        // Lấy danh sách danh mục và top 10 sản phẩm để hiển thị lên giao diện
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();
        $listtop10 = $this->modelSanPham->top10();

        // Kiểm tra nếu phương thức gửi dữ liệu là POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy từ khóa từ người dùng và loại bỏ khoảng trắng thừa
            $keyword = trim($_POST['keyword'] ?? '');

            if (empty($keyword)) {
                // Nếu từ khóa rỗng, chuyển hướng hoặc hiển thị thông báo
                $error = "Vui lòng nhập từ khóa tìm kiếm.";
                header("Location: " . BASE_URL);
                return;
            }

            // Tìm kiếm sản phẩm theo từ khóa
            $listSanPhamTimKiem = $this->modelSanPham->search(htmlspecialchars($keyword));

            // Hiển thị trang tìm kiếm
            require_once './views/timKiemSp.php';
        } else {
            // Chuyển hướng về trang chủ nếu không phải phương thức POST
            header("Location: " . BASE_URL);
            exit;
        }
    }





    public function lienHe()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();


        require_once './views/lienHe.php';
    }
    public function gioiThieu()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();


        require_once './views/gioiThieu.php';
    }

    public function lichSuMuaHang()
    {
        if (isset($_SESSION['user_client'])) {
            // lấy ra thông tin tài khẩn đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            // lấy ra danh sách trạng thái đoewn hàng
            $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

            $arrTrangThaiDonHang = $this->modelDonHang->getTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');

            // lấy ra danh sách phương thức thanh toán 
            $arrPhuongThucThanhToan = $this->modelDonHang->getPhuongThucThanhToan();
            $PhuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');


            // lấy ra danh sachs tất cả trangj thái đơn hàng

            $donHangs = $this->modelDonHang->getDonHangFromUser($tai_khoan_id);
            require_once "./views/lichSuMuaHang.php";
        } else {
            var_dump('Bạn chưa đăng  nhập');
            die;
        }
    }
    public function chiTietMuaHang()
    {
        if (isset($_SESSION['user_client'])) {
            // lấy ra thông tin tài khẩn đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];
            $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

            // lấy ìD đơn truyền từ url
            $donHangId = $_GET['id'];

            $arrTrangThaiDonHang = $this->modelDonHang->getTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');

            // lấy ra danh sách phương thức thanh toán 
            $arrPhuongThucThanhToan = $this->modelDonHang->getPhuongThucThanhToan();
            $PhuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');

            // LẤY rA THÔNG TIN ĐƠN HÀNG THAOE ID
            $donHang = $this->modelDonHang->getDonHangById($donHangId);


            //lấy thôn gtin sản phảm của đon hàng trong san rphaamr chi tiết của đơn hàng
            $chiTietDonHang = $this->modelDonHang->getChiTietDonHangByDonHangId($donHangId);


            //  echo "<pre>";
            //  print_r($donHang);
            //  print_r($chiTietDonHang);


            if ($donHang['tai_khoan_id'] !=  $tai_khoan_id) {
                echo "Bạn không có quyền có truy cập đơn hàng này";
                exit;
            }

            require_once "./views/chiTietMuaHang.php";
        } else {
            echo "Bạn chưa đăng nhập";
        }
    }


    public function huyDonHang()
    {
        if (isset($_SESSION['user_client'])) {
            // lấy ra thông tin tài khẩn đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            // lấy ì đơn truyền từ url
            $donHangId = $_GET['id'];

            // kiểm tra có đơn hàng hay khong
            $donHang = $this->modelDonHang->getDonHangById($donHangId);

            if ($donHang['tai_khoan_id'] != $tai_khoan_id) {
                echo "bạn k có quyền hủy đơn hàng này";
                exit;
            }

            if ($donHang['trang_thai_id'] != 1) {
                echo "Chỉ đơn hàng ở trạng thái 'Chưa xác nhận mới có thể hủy'";
                exit;
            }

            // hủy đơn hàng 
            $this->modelDonHang->updateTrangThaiDonHang($donHangId, 15);
            header("location: " . BASE_URL . '?act=lich-su-mua-hang');
            exit;
        } else {
            // var_dump('Bạn chưa đăng  nhập');
            header("location: " . BASE_URL . 'login');
            die;
        }
    }
}
