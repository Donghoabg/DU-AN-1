<?php
class AdminBinhLuanController {
    private $model; // Biến lưu model bình luận

    // Hàm khởi tạo controller, khởi tạo model bình luận
    public function __construct() {
        require_once __DIR__ . '/../models/AdminBinhLuan.php'; // Nhúng file model
        $conn = connectDB(); // Kết nối database
        $this->model = new AdminBinhLuan($conn); // Khởi tạo model bình luận
    }

    // Hiển thị danh sách bình luận
    public function danhSachBinhLuan() {
        $listBinhLuan = $this->model->getAll(); // Lấy toàn bộ bình luận
        include __DIR__ . '/../views/binhluan/listBinhLuan.php'; // Hiển thị view danh sách bình luận
    }

    // Xóa bình luận
    public function xoaBinhLuan() {
        if (isset($_GET['id'])) { // Kiểm tra có id bình luận cần xóa
            $this->model->delete($_GET['id']); // Xóa bình luận theo id
        }
        header('Location: index.php?act=list-binh-luan'); // Chuyển hướng về danh sách bình luận
        exit;
    }

    // // Duyệt bình luận (chức năng đang bị comment)
    // public function duyetBinhLuan() {
    //     if (isset($_GET['id'])) { // Kiểm tra có id bình luận cần duyệt
    //         $this->model->updateStatus($_GET['id'], 1); // Cập nhật trạng thái duyệt
    //     }
    //     header('Location: index.php?act=list-binh-luan'); // Chuyển hướng về danh sách bình luận
    //     exit;
    // }

    // Hiển thị chi tiết bình luận
    public function chiTietBinhLuan() {
        if (isset($_GET['id'])) { // Kiểm tra có id bình luận cần xem chi tiết
            $binhLuan = $this->model->getById($_GET['id']); // Lấy thông tin bình luận theo id
            include __DIR__ . '/../views/binhluan/detailBinhLuan.php'; // Hiển thị view chi tiết bình luận
        } else {
            header('Location: index.php?act=list-binh-luan'); // Nếu không có id, chuyển hướng về danh sách bình luận
            exit;
        }
    }
}
