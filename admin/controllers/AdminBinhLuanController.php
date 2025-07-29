<?php
class AdminBinhLuanController {
    private $model;

    public function __construct() {
        require_once __DIR__ . '/../models/AdminBinhLuan.php';
        $conn = connectDB();
        $this->model = new AdminBinhLuan($conn);
    }

    // Hiển thị danh sách bình luận
    public function danhSachBinhLuan() {
        $listBinhLuan = $this->model->getAll();
        include __DIR__ . '/../views/binhluan/listBinhLuan.php';
    }

    // Xóa bình luận
    public function xoaBinhLuan() {
        if (isset($_GET['id'])) {
            $this->model->delete($_GET['id']);
        }
        header('Location: index.php?act=list-binh-luan');
        exit;
    }

    // // Duyệt bình luận
    // public function duyetBinhLuan() {
    //     if (isset($_GET['id'])) {
    //         $this->model->updateStatus($_GET['id'], 1);
    //     }
    //     header('Location: index.php?act=list-binh-luan');
    //     exit;
    // }

    // Hiển thị chi tiết bình luận
    public function chiTietBinhLuan() {
        if (isset($_GET['id'])) {
            $binhLuan = $this->model->getById($_GET['id']);
            include __DIR__ . '/../views/binhluan/detailBinhLuan.php';
        } else {
            header('Location: index.php?act=list-binh-luan');
            exit;
        }
    }
}
