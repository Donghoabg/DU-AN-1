<?php
class AdminSanPhamController
{
    public $modelDonHang;
    public $modelSanPham;
    public $modelDanhMuc;
    
    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachSanPham()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once "./views/sanpham/listSanPham.php";
    }
    public function formAddSanPham()
    {
        // hiển thị form nhập
        //var_dump('form them');
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/sanpham/addSanPham.php';
        // Xóa session sau khi load trang
        deleteSessionErrors();
    }
    public function postAddSanPham()
    {
        // xử lý form nhập
        //var_dump($_POST);
        // Kiểm tra xem dữ dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dl
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            // Đặt giá trị mặc định cho các trường
            $danh_muc_id =  $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'];

            $hinh_anh = $_FILES['hinh_anh'] ?? null;

            // Lưu dữ liệu vào session
            $_SESSION['old_data'] = array(
                'ten_san_pham' => $_POST['ten_san_pham'],
                'gia_san_pham' => $_POST['gia_san_pham'],
                'gia_khuyen_mai' => $_POST['gia_khuyen_mai'],
                'so_luong' => $_POST['so_luong'],
                'ngay_nhap' => $_POST['ngay_nhap'],
                'mo_ta' => $_POST['mo_ta']
            );

            //  Lưu hình ảnh vào
            $file_thumb = uploadFile($hinh_anh, './uploads/');

            $img_array = $_FILES['img_array'];

            // Tạo 1 mảng trống để chứa dl
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
            }
            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống';
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = 'Số lượng sản phẩm không được để trống';
            }
            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập sản phẩm không được để trống';
            }
            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Vui lòng chọn danh mục sản phẩm';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Vui lòng chọn trạng thái sản phẩm';
            }
            if ($hinh_anh['errors'] === '') {
                $errors['hinh_anh'] = 'Vui lòng chọn ảnh sản phẩm';
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $_SESSION['old_data'] = $_POST;
            }

            $_SESSION['errors'] = $errors;

            // Nếu k có lỗi thì thêm sản phẩm
            if (empty($errors)) {
                $san_pham_id = $this->modelSanPham->insertSanPham($ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $file_thumb);
                // Xử lý thêm album ảnh sp
                if (!empty($img_array['name'])) {
                    foreach ($img_array['name'] as $key => $value) {
                        $file = [
                            'name' => $img_array['name'][$key],
                            'type' => $img_array['type'][$key],
                            'tmp_name' => $img_array['tmp_name'][$key],
                            'error' => $img_array['error'][$key],
                            'size' => $img_array['size'][$key]
                        ];
                        $link_hinh_anh = uploadFile($file, './uploads/');
                        $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh);
                    }
                }

                //  var_dump($san_pham_id);die;
                header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                // trả lỗi
                // Đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-them-san-pham');
                exit();
            }
        }
    }


    public function formEditSanPham()
    {
        // hiển thị form nhập
        // Lấy ra thông tin của sản phẩm cần sửa
        $id = $_GET['id_san_pham'];
        $sanpham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listDanhMuc =  $this->modelDanhMuc->getAllDanhMuc();
        if (isset($sanpham)) {
            require_once './views/sanpham/editSanPham.php';
            deleteSessionErrors();
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
    }
    public function postEditSanPham()
    {
        // xử lý form nhập
        //var_dump($_POST);
        // Kiểm tra xem dữ dữ liệu có phải đc submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dl
            // Lấy ra dữ liệu của sản phẩm
            $san_pham_id = $_POST['san_pham_id'] ?? '';
            // Truy vấn 
            $sanPhamOld = $this->modelSanPham->getDetailSanPham($san_pham_id);
            $old_file = $sanPhamOld['hinh_anh']; // Lấy ảnh cũ để phục vụ cho sửa ảnh

            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            // Đặt giá trị mặc định cho các trường
            $danh_muc_id =  $_POST['danh_muc_id'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'];

            $hinh_anh = $_FILES['hinh_anh'] ?? null;
            // var_dump($hinh_anh); die();

            // Tạo 1 mảng trống để chứa dl
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
            }
            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống';
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = 'Số lượng sản phẩm không được để trống';
            }
            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập sản phẩm không được để trống';
            }
            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Vui lòng chọn danh mục sản phẩm';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Vui lòng chọn trạng thái sản phẩm';
            }

            $_SESSION['errors'] = $errors;

            // Logic sửa ảnh
            if (isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK) {
                // upload file ảnh mới lên
                $new_file = uploadFile($hinh_anh, './uploads/');
                if (!empty($old_file)) { // Nếu có ảnh cũ thì xóa đi
                    deleteFile($old_file);
                }
            } else {
                $new_file = $old_file;
            }

            $_SESSION['errors'] = $errors;


            // Nếu k có lỗi thì thêm sản phẩm
            if (empty($errors)) {
                $san_pham_id = $this->modelSanPham->updateSanPham($san_pham_id, $ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $new_file);
                header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                // trả lỗi
                // Đặt chỉ thị xóa session sau khi hiển thị form
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
                exit();
            }
        }
    }

    /* Sửa album ảnh
    - Sửa ảnh cũ
    +Thêm ảnh mới
    + Không thêm ảnh mới

    - Không sửa ảnh cũ: 
    + Thêm ảnh mới
    + Không thêm ảnh mới
    */
    public function postEditAnhSanPham()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $san_pham_id = $_POST['san_pham_id'] ?? '';

            // Lấy danh sách ảnh hiện tại của sản phẩm
            $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);
            // var_dump($listAnhSanPhamCurrent); die;

            // Xử lý các ảnh đc gửi từ form
            $img_array = $_FILES['img_array'];
            $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
            $current_img_ids = $_POST['current_img_ids'] ?? [];
            //  var_dump($current_img_ids); die;

            // Khai báo mản để lưu ảnh thêm mới hoặc thay thế ảnh cũ
            $upload_file = [];
            /*    foreach($img_array['name'] as $key => $value){
                if($img_array['error'][$key] == UPLOAD_ERR_OK){
                    $new_file = uploadFileAlbum($img_array, './uploads/', $key);
                    if($new_file){
                        $uploadFile[] =[
                            'id' => $current_img_ids[$key] ?? null,
                            'file' =>$new_file
                        ];
                    }
                }
            }
            // Lưu ảnh và db và xóa ảnh cũ nếu có
          /*  foreach($upload_file as $file_info){
                if($file_info['id']){
                    $old_file = $this->modelSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];

                    // Cập nhật ảnh cũ
                    $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);

                    // Xoa anh cu
                    deleteFile($old_file);

                }else{
                    $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id,$file_info['file']);
                }
            }*/
            foreach ($img_array['name'] as $key => $value) {
                $current_img_id = $current_img_ids[$key] ?? null;
                $upload_file[] = [
                    'id' => $current_img_id,
                    'file' => $img_array['error'][$key] == UPLOAD_ERR_OK ? uploadFileAlbum($img_array, './uploads/', $key) : null // Include null for empty file input
                ];
            }

            foreach ($upload_file as $file_info) {
                if ($file_info['id'] && $file_info['file']) { // Update only if ID exists and a new file is uploaded
                    $old_file = $this->modelSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];
                    $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);
                    deleteFile($old_file);
                } else if (!$file_info['id']) { // Insert new image
                    $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
                }
            }

            // Xu ly xoa anh
            foreach ($listAnhSanPhamCurrent as $anhSP) {
                $anh_id = $anhSP['id'];
                if (in_array($anh_id, $img_delete)) {
                    // Xoa anh trong db
                    $this->modelSanPham->destroyAnhSanPham($anh_id);

                    // Xoa file
                    deleteFile($anhSP['link_hinh_anh']);
                }
            }
            header("Location: " . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham= ' . $san_pham_id);
            exit();
        }
    }

    public function deleteSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        if ($sanPham) {
            $this->modelSanPham->hideSanPham($id); // Chuyển sang ẩn sản phẩm
            // Không xoá file hình ảnh nữa để giữ dữ liệu
        }
        // Không xoá ảnh sản phẩm nữa
        header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
        exit();
    }
    public function detailSanPham()
    {
        // hiển thị form nhập
        // Lấy ra thông tin của sản phẩm cần sửa
        $id = $_GET['id_san_pham'];
        $sanpham  = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);
        if (isset($sanpham)) {
            require_once './views/sanpham/detailSanPham.php';
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
    }

    public function updateTrangThaiBinhLuan()
    {
        //  var_dump($_POST);die();
        $id_binh_luan = $_POST['id_binh_luan'];
        $name_view = $_POST['name_view'];


        $binhLuan = $this->modelSanPham->getDetailBinhLuan($id_binh_luan);

        if ($binhLuan) {
            $trang_thai_update = '';
            if ($binhLuan['trang_thai'] == 1) {
                $trang_thai_update = 2;
            } else {
                $trang_thai_update = 1;
            }
            $status = $this->modelSanPham->updateTrangThaiBinhLuan($id_binh_luan, $trang_thai_update);

            if ($status) {
                if ($name_view == 'detail_khach') {
                    header('Location:' . BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $binhLuan['tai_khoan_id']);
                    // exit();
                } else {
                    header('Location:' . BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $binhLuan['san_pham_id']);
                }
            }
        }
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
        header('Location:' . BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $binhLuan['san_pham_id']);
    }

    public function xoaBinhLuanKhachHang()
    {
        //  var_dump($_POST);die();
        $id_binh_luan = $_POST['id_binh_luan'];
        $tai_khoan_id = $_POST['tai_khoan_id'];
        // var_dump($tai_khoan_id);die();
        // $name_view = $_POST['name_view'];
        // var_dump($xoa);die();


        $xoa = $this->modelSanPham->deleteBinhLuan($id_binh_luan);
        $binhLuan = $this->modelSanPham->getDetailBinhLuan($id_binh_luan);

        // die();
        // $status = $this->modelSanPham->updateTrangThaiBinhLuan($id_binh_luan, $trang_thai_update);
        header("Location: " . BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $tai_khoan_id);
    }

    // Hàm ẩn sản phẩm (chuyển trạng thái sản phẩm sang ẩn)
    public function anSanPham() {
        $id = $_GET['id_san_pham'] ?? null; // Lấy id sản phẩm từ URL, nếu không có thì gán null
        if ($id) { // Nếu có id sản phẩm
            $this->modelSanPham->anSanPham($id); // Gọi hàm model để ẩn sản phẩm theo id
        }
        header('location: ' . BASE_URL_ADMIN . '?act=san-pham'); // Chuyển hướng về trang danh sách sản phẩm
        exit(); // Kết thúc hàm
    }

    // Hàm hiện sản phẩm (chuyển trạng thái sản phẩm sang hiện)
    public function hienSanPham() {
        $id = $_GET['id_san_pham'] ?? null; // Lấy id sản phẩm từ URL, nếu không có thì gán null
        if ($id) { // Nếu có id sản phẩm
            $this->modelSanPham->hienSanPham($id); // Gọi hàm model để hiện sản phẩm theo id
        }
        header('location: ' . BASE_URL_ADMIN . '?act=san-pham'); // Chuyển hướng về trang danh sách sản phẩm
        exit(); // Kết thúc hàm
    }
}
