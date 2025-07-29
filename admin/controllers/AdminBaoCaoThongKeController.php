<?php 
// Controller quản lý báo cáo thống kê trong admin

class AdminBaoCaoThongKeController{
    
    public $modelThongKe; // Biến lưu model thống kê

    // Hàm khởi tạo controller, khởi tạo model thống kê
    public function __construct()
    {
        $this->modelThongKe = new AdminThongKe();
    }

    // Hiển thị trang tổng quan thống kê
    public function home(){
        $listThongKe = $this->modelThongKe->getAllThongKe(); // Lấy toàn bộ dữ liệu thống kê
        // var_dump($listThongKe);die(); // Debug dữ liệu thống kê
        require_once './views/home.php'; // Hiển thị view home
    }

    // Hiển thị biểu đồ thống kê
    public function bieuDo(){
        $listThongKe = $this->modelThongKe->getAllThongKe(); // Lấy toàn bộ dữ liệu thống kê
        // var_dump($listThongKe);die(); // Debug dữ liệu thống kê
        require_once './views/bieudo/bieuDo.php'; // Hiển thị view biểu đồ

    }
}