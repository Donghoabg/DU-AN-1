<?php
class AdminDanhMucController
{
     public $modelDanhMuc; // Biến lưu model danh mục

     // Hàm khởi tạo controller, khởi tạo model danh mục
     public function __construct()
     {
          $this->modelDanhMuc = new AdminDanhMuc(); // Khởi tạo model danh mục
     }

     // Hiển thị danh sách danh mục
     public function danhSachDanhMuc()
     {
          $listDanhMuc = $this->modelDanhMuc->getAllDanhMucAdmin(); // Lấy toàn bộ danh mục
          require_once "./views/danhmuc/listDanhMuc.php"; // Hiển thị view danh sách danh mục
     }

     // Hiển thị form thêm danh mục
     public function formAddDanhMuc()
     {
          require_once "./views/danhmuc/addDanhMuc.php"; // Hiển thị form nhập danh mục
          deleteSessionError(); // Xóa lỗi session nếu có
     }

     // Xử lý thêm danh mục mới
     public function postAddDanhMuc()
     {
          // Kiểm tra phương thức POST
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               // Lấy dữ liệu từ form
               $ten_danh_muc = $_POST['ten_danh_muc']?? '';
               $mo_ta = $_POST['mo_ta']?? '';

               $errors = []; // Mảng chứa lỗi

               // Kiểm tra tên danh mục
               if (empty($ten_danh_muc)) {
                    $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
               }
               $_SESSION['error'] = $errors; // Lưu lỗi vào session

               // Nếu không có lỗi, thêm danh mục vào database
               if (empty($errors)) {
                    $this->modelDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta); // Thêm danh mục
                    header('location: ' . BASE_URL_ADMIN. '?act=danh-muc-mi-pham'); // Chuyển hướng về danh sách
                    exit();
               } else {
                    // Nếu có lỗi, trả về form và hiển thị lỗi
                    $_SESSION['flash'] = true;
                    header('location: ' . BASE_URL_ADMIN. '?act=form-them-danh-muc');
                    exit();
               }
          }
     }

     // Hiển thị form sửa danh mục
     public function formEditDanhMuc()
     {
          $id=$_GET['id_danh_muc']; // Lấy id danh mục cần sửa
          $danhmuc=$this->modelDanhMuc->getDetailDanhMuc($id); // Lấy chi tiết danh mục
          if(isset($danhmuc)){
               require_once "./views/danhmuc/editDanhMuc.php"; // Hiển thị form sửa
          }else{
               header('location: ' . BASE_URL_ADMIN. '?act=danh-muc-mi-pham'); // Nếu không có, chuyển hướng về danh sách
               exit();
          }
     }

     // Xử lý sửa danh mục
     public function postEditDanhMuc()
     {
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               $id = $_POST['id'];
               $ten_danh_muc = $_POST['ten_danh_muc'];
               $mo_ta = $_POST['mo_ta'];

               $errors = []; // Mảng chứa lỗi

               // Kiểm tra tên danh mục
               if (empty($ten_danh_muc)) {
                    $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
               }

               // Nếu không có lỗi, cập nhật danh mục
               if (empty($errors)) {
                    $this->modelDanhMuc->updateDanhMuc($id,$ten_danh_muc, $mo_ta); // Sửa danh mục
                    header('location: ' . BASE_URL_ADMIN. '?act=danh-muc-mi-pham'); // Chuyển hướng về danh sách
                    exit();
               } else {
                    // Nếu có lỗi, trả về form và hiển thị lỗi
                    $danhmuc=['id'=>$id,'ten_danh_muc'=>$ten_danh_muc,'mo_ta'=>$mo_ta];
                    require_once './views/danhmuc/editDanhMuc.php';
               }
          }
     }

     // Ẩn danh mục
     public function anDanhMuc() {
        $id = $_GET['id_danh_muc'] ?? null; // Lấy id danh mục cần ẩn
        if ($id) {
            $this->modelDanhMuc->anDanhMuc($id); // Gọi hàm ẩn danh mục
        }
        header('location: ' . BASE_URL_ADMIN . '?act=danh-muc-mi-pham'); // Chuyển hướng về danh sách
        exit();
    }

    // Hiện danh mục
    public function hienDanhMuc() {
        $id = $_GET['id_danh_muc'] ?? null; // Lấy id danh mục cần hiện
        if ($id) {
            $this->modelDanhMuc->hienDanhMuc($id); // Gọi hàm hiện danh mục
        }
        header('location: ' . BASE_URL_ADMIN . '?act=danh-muc-mi-pham'); // Chuyển hướng về danh sách
        exit();
    }
}
