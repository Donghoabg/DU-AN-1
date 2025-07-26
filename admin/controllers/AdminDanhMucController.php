<?php
class AdminDanhMucController
{
     public $modelDanhMuc;
     public function __construct()
     {
          $this->modelDanhMuc = new AdminDanhMuc();
     }
     public function danhSachDanhMuc()
     {
          $listDanhMuc = $this->modelDanhMuc->getAllDanhMucAdmin();
          require_once "./views/danhmuc/listDanhMuc.php";
     }
     public function formAddDanhMuc()
     {
          //ham nay hien thi form nhap
          require_once "./views/danhmuc/addDanhMuc.php";
          deleteSessionError();

     }
     public function postAddDanhMuc()
     {
          //dung de xu li them du lieu
          // Kiểm tra xem dữ liệu có phải do submit lên không
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               // Lấy ra dữ liệu
               $ten_danh_muc = $_POST['ten_danh_muc']?? '';
               $mo_ta = $_POST['mo_ta']?? '';

               // Tạo một mảng trống để chứa dữ liệu lỗi
               $errors = [];

               // Kiểm tra tên danh mục
               if (empty($ten_danh_muc)) {
                    $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
               }
               $_SESSION['error'] = $errors;


               // Nếu không có lỗi, tiến hành thêm danh mục
               if (empty($errors)) {
                    // Code xử lý khi không có lỗi, ví dụ thêm vào cơ sở dữ liệu
                    echo 'Dữ liệu hợp lệ. Tiến hành thêm danh mục...';
                    // Bạn có thể thêm lệnh chèn dữ liệu vào cơ sở dữ liệu ở đây
                    $this->modelDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta);
                    header('location: ' . BASE_URL_ADMIN. '?act=danh-muc-mi-pham');
                    exit();
               } else {
                    // Trả về form và hiển thị lỗi
                    $_SESSION['flash'] = true;
                    header('location: ' . BASE_URL_ADMIN. '?act=form-them-danh-muc');
                    exit();
               }
          }
     }
     public function formEditDanhMuc()
     {
          //ham nay hien thi form nhap
          $id=$_GET['id_danh_muc'];
          $danhmuc=$this->modelDanhMuc->getDetailDanhMuc($id);
          if(isset($danhmuc)){
               require_once "./views/danhmuc/editDanhMuc.php";
          }else{
               header('location: ' . BASE_URL_ADMIN. '?act=danh-muc-mi-pham');
               exit();
          }
     }
     public function postEditDanhMuc()
     {
          //dung de xu li them du lieu
          // Kiểm tra xem dữ liệu có phải do submit lên không
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               // Lấy ra dữ liệu
               $id = $_POST['id'];

               $ten_danh_muc = $_POST['ten_danh_muc'];
               $mo_ta = $_POST['mo_ta'];

               // Tạo một mảng trống để chứa dữ liệu lỗi
               $errors = [];

               // Kiểm tra tên danh mục
               if (empty($ten_danh_muc)) {
                    $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
               }

               // Nếu không có lỗi, tiến hành sửa danh mục
               if (empty($errors)) {
                    // Code xử lý khi không có lỗi, ví dụ sửa vào cơ sở dữ liệu
                    echo 'Dữ liệu hợp lệ. Tiến hành thêm danh mục...';
                    // Bạn có thể thêm lệnh chèn dữ liệu vào cơ sở dữ liệu ở đây
                    $this->modelDanhMuc->updateDanhMuc($id,$ten_danh_muc, $mo_ta);
                    header('location: ' . BASE_URL_ADMIN. '?act=danh-muc-mi-pham');
                    exit();
               } else {
                    // Trả về form và hiển thị lỗi
                    $danhmuc=['id'=>$id,'ten_danh_muc'=>$ten_danh_muc,'mo_ta'=>$mo_ta];
                    require_once './views/danhmuc/editDanhMuc.php';
               }
          }
     }
     // public function deleteDanhMuc(){
     //      $id = $_GET['id_danh_muc'];
     //      $danhmuc = $this->modelDanhMuc->getDetailDanhMuc($id);
     //      if($danhmuc){
     //           $this->modelDanhMuc->destroyDanhMuc($id);
     //      }
     //      header('location: ' . BASE_URL_ADMIN. '?act=danh-muc-mi-pham');
     //      exit();
     // }
     public function anDanhMuc() {
        $id = $_GET['id_danh_muc'] ?? null;
        if ($id) {
            $this->modelDanhMuc->anDanhMuc($id);
        }
        header('location: ' . BASE_URL_ADMIN . '?act=danh-muc-mi-pham');
        exit();
    }
    public function hienDanhMuc() {
        $id = $_GET['id_danh_muc'] ?? null;
        if ($id) {
            $this->modelDanhMuc->hienDanhMuc($id);
        }
        header('location: ' . BASE_URL_ADMIN . '?act=danh-muc-mi-pham');
        exit();
    }
}
