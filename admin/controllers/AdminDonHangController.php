<?php
class AdminDonHangController
{
    public $modelSanPham; // Biến lưu model sản phẩm
    public $modelDonHang; // Biến lưu model đơn hàng
    public $modelDanhMuc; // Biến lưu model danh mục

    // Hàm khởi tạo controller, khởi tạo các model
    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDonHang = new AdminDonHang();
        $this->modelDanhMuc = new AdminDanhMuc();
    }

    // Hiển thị danh sách đơn hàng
    public function danhSachDonHang()
    {
        $listDonHang = $this->modelDonHang->getAllDonHang(); // Lấy toàn bộ đơn hàng
        require_once "./views/DonHang/listDonHang.php"; // Hiển thị view danh sách đơn hàng
    }

    // Hiển thị chi tiết đơn hàng
    public function detailDonHang()
    {
        $don_hang_id = $_GET['id_don_hang']; // Lấy id đơn hàng

        // Lấy thông tin đơn hàng từ bảng don_hangs
        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);

        // Lấy danh sách sản phẩm đã đặt của đơn hàng
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);

        // Lấy danh sách trạng thái của đơn hàng
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();

        // Lấy bình luận cho từng sản phẩm trong đơn hàng
        $listBinhLuan = [];
        foreach ($sanPhamDonHang as $sanPham) {
            $listBinhLuan[$sanPham['id']] = $this->modelSanPham->getBinhLuanFromSanPham($sanPham['id']);
        }

        // Gom tất cả dữ liệu vào mảng $data
        $data = [
            'donHang' => $donHang,
            'sanPhamDonHang' => $sanPhamDonHang,
            'listTrangThaiDonHang' => $listTrangThaiDonHang,
            'listBinhLuan' => $listBinhLuan
        ];

        // Truyền dữ liệu vào view
        require_once './views/donhang/detailDonHang.php';
    }

    // Hiển thị form sửa đơn hàng
    public function formEditDonHang()
    {
        $id = $_GET['id_don_hang']; // Lấy id đơn hàng cần sửa
        $donHang = $this->modelDonHang->getDetailDonHang($id); // Lấy chi tiết đơn hàng
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang(); // Lấy danh sách trạng thái
        if ($donHang) {
            require_once './views/donHang/editDonHang.php'; // Hiển thị form sửa đơn hàng
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=don-hang'); // Nếu không có, chuyển hướng về danh sách
            exit();
        }
    }

    // Xử lý dữ liệu sửa đơn hàng
    public function postEditDonHang()
    {
        // Kiểm tra xem dữ liệu có phải được submit không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu từ form
            $don_hang_id = $_POST['don_hang_id'] ?? '';
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $trang_thai_id = $_POST['trang_thai_id'] ?? '';

            // Tạo mảng chứa lỗi
            $error = [];
            if (empty($ten_nguoi_nhan)) {
                $error['ten_nguoi_nhan'] = 'Tên người nhận không được để trống';
            }
            if (empty($sdt_nguoi_nhan)) {
                $error['sdt_nguoi_nhan'] = 'Số điện thoại không được để trống';
            }
            if (empty($email_nguoi_nhan)) {
                $error['email_nguoi_nhan'] = 'Email không được để trống';
            }
            if (empty($dia_chi_nguoi_nhan)) {
                $error['dia_chi_nguoi_nhan'] = 'Địa chỉ không được để trống';
            }
            if (empty($trang_thai_id)) {
                $error['trang_thai_id'] = 'Trạng thái không được để trống';
            }

            // Nếu không có lỗi -> tiến hành sửa đơn hàng
            if (empty($error)) {
                $this->modelDonHang->updateDonHang($don_hang_id, $ten_nguoi_nhan, $sdt_nguoi_nhan, $email_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $trang_thai_id);
                header("Location: " . BASE_URL_ADMIN . '?act=don-hang'); // Chuyển hướng về danh sách
                exit();
            } else {
                // Nếu có lỗi, trả về form và báo lỗi
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $don_hang_id);
                exit();
            }
        }
    }
}
