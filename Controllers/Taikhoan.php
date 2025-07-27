<?php


class TaiKhoanController{
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
    public function taiKhoan()
    {
        $email = $_SESSION['user_client'];
        $thongTin = $this->modelTaiKhoan->getTaiKhoanFromEmail($email);
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        require_once './views/taikhoan.php';
        deleteSessionErrors();
    }
    public function formLogin()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        if (isset($_SESSION['user_client'])) {
            header('Location:' . BASE_URL);
            exit();
        }
        require_once './views/auth/formLogin.php';
        deleteSessionErrors();
    }
    public function postlogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lay dl
            $email = $_POST['email'];
            $password = $_POST['password'];

            // xử lý kiểm tra thông tin đăng nhập
            $user = $this->modelTaiKhoan->checkLogin($email, $password);
            //    var_dump($user);die();

            if ($user == $email) {
                // dn thanh cong
                // Luu thong tin vao session
                $_SESSION['user_client'] = $user;
                header("Location:" . BASE_URL);
                exit();
            } else {
                // Lỗi thì lưu lỗi vào session
                $_SESSION['errors'] = $user;
                //    var_dump($_SESSION['errors']);die();

                $_SESSION['flash'] = true;

                header("Location:" . BASE_URL . '?act=login');
                exit();
            }
        }
    }



    public function formDangKy()
    {

        if (isset($_SESSION['user_client'])) {
            header('Location:' . BASE_URL);
            exit();
        }
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        require_once('./views/auth/formDangKy.php');
        deleteSessionErrors();
    }
    public function dangKy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $ho_ten = $_POST['ho_ten'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $mat_khau = $_POST['mat_khau'] ?? '';
            $anh_dai_dien = $_FILES['anh_dai_dien'] ?? null;
            $file_thumb = uploadFile($anh_dai_dien, './uploads/');
            $chuc_vu = 2;

            $_SESSION['old_data'] = array(
                'ho_ten' => $ho_ten,
                'ngay_sinh' => $ngay_sinh,
                'email' => $email,
                'so_dien_thoai' => $so_dien_thoai,
                'gioi_tinh' => $gioi_tinh,
                'dia_chi' => $dia_chi,
                'mat_khau' => $mat_khau,
            );

            // Tạo mảng để lưu lỗi
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }
            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = 'Ngày sinh không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
            }
            if (empty($mat_khau)) {
                $errors['mat_khau'] = 'Mật khẩu không được để trống';
            }
            if (empty($dia_chi)) {
                $errors['dia_chi'] = 'Địa chỉ không được để trống';
            }

            $_SESSION['errors'] = $errors;

            // Nếu không có lỗi, thêm tài khoản
            if (empty($errors)) {
                // Mã hóa mật khẩu trước khi lưu
                $mat_khau_hashed = $mat_khau;

                // Gọi model để lưu dữ liệu
                $tai_khoan = $this->modelTaiKhoan->insertTaiKhoan(
                    $ho_ten,
                    $ngay_sinh,
                    $email,
                    $so_dien_thoai,
                    $gioi_tinh,
                    $dia_chi,
                    $mat_khau_hashed, // Lưu mật khẩu mã hóa
                    $chuc_vu,
                    $file_thumb
                );

                // Hiển thị thông báo và chuyển trang sau 2 giây
                echo "
                <script>
                    alert('Đăng ký thành công! Vui lòng chờ để chuyển đến trang đăng nhập.');
                    setTimeout(function() {
                        window.location.href = '" . BASE_URL . "?act=login';
                    });
                </script>
            ";
                exit();
            } else {
                // Trả về lỗi
                $_SESSION['flash'] = true;
                $_SESSION['thongBao'] = 'Đăng ký thất bại';
                header("Location: " . BASE_URL . '?act=form-dang-ky');
                exit();
            }
        }
    }




    public function logout()
    {
        if (isset($_SESSION['user_client'])) {
            unset($_SESSION['user_client']);
            header('Location:' . BASE_URL . '?act=login');
        }
    }

    public function quenMatKhau()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        $tai_khoan_id = $_SESSION['user_client']['id'] ?? '';

        $thongTin = $this->modelTaiKhoan->thongTinTaiKhoan($tai_khoan_id);
        // var_dump($thongTin);die();

        require_once './views/quenMatKhau.php';
        deleteSessionErrors();
    }

    public function layMatKhau()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dl

            $email = $_POST['email'] ?? '';

            $checkEmail = $this->modelTaiKhoan->getTaiKhoanFromEmail($email);
            // var_dump($checkEmail);die();



            if (is_array($checkEmail) && $checkEmail['chuc_vu_id'] == 2) {
                //     $_SESSION['user_id'] = $checkUser[0]['id'];

                $_SESSION['layMk'] = 'Mật khẩu của bạn là: ' . $checkEmail['mat_khau'];


                header('Location:' . BASE_URL . '?act=quen-mat-khau');
            } else {
                $_SESSION['flash'] = true;
                $_SESSION['layMk'] = 'Email không tồn tại';

                header('Location:' . BASE_URL . '?act=quen-mat-khau');
            }
        }
    }


    public function suaThongTinCaNhan()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tai_khoan_id = $_POST['tai_khoan_id'];
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? 1;
            $id = $_POST['tai_khoan_id'] ?? '';

            // Xử lý upload ảnh đại diện nếu có
            $anh_dai_dien = $_FILES['anh_dai_dien'] ?? null;
            $file_thumb = null;
            if ($anh_dai_dien && $anh_dai_dien['error'] == UPLOAD_ERR_OK) {
                require_once './commons/function.php';
                $file_thumb = uploadFile($anh_dai_dien, './uploads/');
            }
        }

    
    // Kiểm tra lỗi
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
            }
            if (empty($dia_chi)) {
                $errors['dia_chi'] = 'Địa chỉ không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($errors)) {
                // Nếu không có lỗi, gọi model để cập nhật thông tin
                $status = $this->modelTaiKhoan->updateTaiKhoan($tai_khoan_id, $ho_ten, $email, $so_dien_thoai, $ngay_sinh, $gioi_tinh, $dia_chi, $trang_thai, $file_thumb);
                if ($status) {
                    $_SESSION['successTt'] = "Đã đổi thông tin thành công";
                    $_SESSION['flash'] = true;
                    header("Location: " . BASE_URL . '?act=tai-khoan');
                    exit();
                } else {
                    $_SESSION['errors']['update'] = 'Cập nhật thất bại. Vui lòng thử lại.';
                }
            } else {
                $_SESSION['errors'] = $errors;
            }
            header("Location: " . BASE_URL . '?act=tai-khoan');
            exit();
        }
        
    

    public function doiMatKhau()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin từ form

            $old_pass = htmlspecialchars(trim($_POST['old_pass']));
            $new_pass = htmlspecialchars(trim($_POST['new_pass']));
            $confirm_pass = htmlspecialchars(trim($_POST['confirm_pass']));

            // Lấy thông tin user từ session
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

            // Kiểm tra mật khẩu cũ
            $errors = [];
            if (empty($old_pass)) {
                $errors['old_pass'] = 'Mật khẩu cũ không được để trống';
            } elseif ($old_pass !== $user['mat_khau']) {
                $errors['old_pass'] = 'Mật khẩu cũ không đúng';
            }

            // Kiểm tra mật khẩu mới
            if (empty($new_pass)) {
                $errors['new_pass'] = 'Mật khẩu mới không được để trống';
            }

            // Kiểm tra xác nhận mật khẩu
            if (empty($confirm_pass)) {
                $errors['confirm_pass'] = 'Mật khẩu nhập lại không được để trống';
            } elseif ($new_pass !== $confirm_pass) {
                $errors['confirm_pass'] = 'Mật khẩu nhập lại không đúng';
            }

            // Nếu có lỗi, lưu vào session và chuyển hướng
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['flash'] = true;
                header("Location:" . BASE_URL . '?act=tai-khoan');
                exit();
            }

            // Nếu không có lỗi, cập nhật mật khẩu mới
            $hashPass = $new_pass;
            $status = $this->modelTaiKhoan->resetPassword($user['id'], $hashPass);
            // var_dump($hashPass);
            // die();

            if ($status) {
                $_SESSION['success'] = "Đã đổi mật khẩu thành công";
                $_SESSION['flash'] = true;
            } else {
                $_SESSION['errors']['system'] = "Có lỗi xảy ra, vui lòng thử lại sau.";
            }

            // Chuyển hướng sau khi xử lý
            header("Location:" . BASE_URL . '?act=tai-khoan');
            exit();
        }
    }
}