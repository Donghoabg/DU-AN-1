<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class GioHangDonHangController
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



    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {
                $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
                //    var_dump($mail['id']);die();

                // lẤy dl giỏ hàng
                $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
                if (!$gioHang) {
                    $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                    $gioHang = ['id' => $gioHangId];
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                } else {
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                }

                $san_pham_id = $_POST['san_pham_id'];
                $so_luong = $_POST['so_luong'];
                $size = $_POST['size'] ?? '';
                $mau_sac = $_POST['mau_sac'] ?? '';


                $checkSanPham = false;
                foreach ($chiTietGioHang as $detail) {
                if (
                    $detail['san_pham_id'] == $san_pham_id &&
                    $detail['size'] == $size &&
                    $detail['mau_sac'] == $mau_sac
                ) {
                    $newSoLuong = $detail['so_luong'] + $so_luong;
                    $this->modelGioHang->updateSoLuongTheoBienThe($gioHang['id'], $san_pham_id, $size, $mau_sac, $newSoLuong);
                    $checkSanPham = true;
                    break;
                }
                }

                if (!$checkSanPham) {
                    $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong, $size, $mau_sac);
                }
                header('Location:' . BASE_URL . '?act=gio-hang');
            } else {
                header('Location:' . BASE_URL . '?act=login');
            }
        }
    }

    public function gioHang()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        if (isset($_SESSION['user_client'])) {
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            //    var_dump($mail);die();

            // lẤy dl giỏ hàng
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
            //    var_dump($gioHang);die();

            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                // var_dump($gioHangId);die();

                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

            } else {
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                // var_dump($chiTietGioHang);
                // die();

            }

            require_once './views/gioHang.php';
        } else {
            header('Location:' . BASE_URL . '?act=login');
        }
    }
    public function capNhatGioHang()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_SESSION['user_client'])) {
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

            $san_pham_ids = $_POST['san_pham_id'];
            $sizes = $_POST['size'];
            $mau_sacs = $_POST['mau_sac'];
            $id_chi_tiet_gio_hangs = $_POST['id_chi_tiet_gio_hang'];
            $so_luongs = $_POST['so_luong'];

            foreach ($so_luongs as $index => $so_luong) {
                if ($so_luong > 0) {
                    $san_pham_id = $san_pham_ids[$index];
                    $size = $sizes[$index];
                    $mau_sac = $mau_sacs[$index];
                    $id_chi_tiet_gio_hang = $id_chi_tiet_gio_hangs[$index];

                    // Cập nhật số lượng theo biến thể
                    $this->modelGioHang->updateSoLuongTheoBienThe($gioHang['id'], $san_pham_id, $size, $mau_sac, $so_luong);

                    // Hoặc nếu có hàm update theo id chi tiết thì dùng:
                    // $this->modelGioHang->updateSoLuongByIdChiTietGioHang($id_chi_tiet_gio_hang, $so_luong);
                }
            }
            header('Location:' . BASE_URL . '?act=gio-hang');
            exit;
        } else {
            header('Location:' . BASE_URL . '?act=login');
            exit;
        }
    }
    }


    public function daDatHang()
    {
        // Kiểm tra nếu có thông tin đơn hàng trong session
        if (isset($_SESSION['thong_tin_don_hang']['id'])) {
            $thongTinDonHang = $this->modelDonHang->getAllDonHang($_SESSION['thong_tin_don_hang']['id']);
        } else {
            $_SESSION['flash'] = true;
            $_SESSION['dat_hang_error'] = 'Thông tin đơn hàng không hợp lệ!';
            header('Location:' . BASE_URL);
            exit;
        }

        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        if (isset($_SESSION['user_client'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

            // Lấy thông tin giỏ hàng
            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
            if (!$gioHang) {
                $_SESSION['flash'] = true;
                $_SESSION['dat_hang_thanh_cong'] = 'Đã đặt hàng thành công! Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi';
                $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $_SESSION['flash'] = true;
                $_SESSION['dat_hang_thanh_cong'] = 'Đã đặt hàng thành công! Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi';
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }

            // Xóa toàn bộ sản phẩm trong giỏ hàng
            if (!empty($gioHang['id'])) {
                $this->modelGioHang->deleteAllChiTietGioHang($gioHang['id']);
            }
        } else {
            header('Location:' . BASE_URL . '?act=login');
        }

        require_once './views/daDatHang.php';
        deleteSessionErrors();
    }

    public function thanhToan()
    {
        deleteSessionErrors();
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        if (isset($_SESSION['user_client'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            //    var_dump($mail['id']);die();

            // lẤy dl giỏ hàng
            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }

            require_once './views/thanhToan.php';
        } else {
            header('Location:' . BASE_URL . '?act=login');
        }
    }

    public function postThanhToan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // var_dump($_POST);die();
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];

            $ngay_dat = date('Y-m-d');
            $trang_thai_id = 1;

            $ma_don_hang = 'DH-' . rand(1000, 9999);

            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
            $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            // var_dump($chiTietGioHang);die();


            $donHangId = $this->modelDonHang->addDonHang($tai_khoan_id, $ten_nguoi_nhan, $email_nguoi_nhan, $sdt_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $tong_tien, $phuong_thuc_thanh_toan_id, $ngay_dat, $ma_don_hang, $trang_thai_id);
            $donHang = ['id' => $donHangId];
            $tong_tien = 0;

            foreach ($chiTietGioHang as $sanPham) {
                // var_dump($sanPham);die();
                if (!empty($sanPham['gia_khuyen_mai']) && $sanPham['gia_khuyen_mai'] > 0) {
                    $don_gia = $sanPham['gia_khuyen_mai'];
                } else {
                    $don_gia = $sanPham['gia_san_pham'];
                }
                $tongTien = $don_gia * $sanPham['so_luong'];


                $donHangId = $this->modelDonHang->addDetailDonHang($donHang['id'], $sanPham['san_pham_id'], $don_gia, $sanPham['so_luong'], $tongTien);
                // var_dump($addChiTietDonHang);die();

            }

            // var_dump($donHangId);die();

            if ($donHangId) {
                $donHang = $this->modelDonHang->getAllDonHang($donHangId);

                // Đăng nhập thành công

                if (!empty($donHang) && is_array($donHang)) {
                    $id = $donHang[0]['id'];
                    // Lưu thông tin vào session
                    $_SESSION['thong_tin_don_hang'] = [
                        'id' => $id,
                    ];
                    $thongTinDonHang = $this->modelDonHang->getAllDonHang($_SESSION['thong_tin_don_hang']['id']);

                    $_SESSION['flash'] = true;
                    $_SESSION['dat_hang_thanh_cong'] = 'Đã đặt hàng thành công! Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi';
                    $subject = 'Shop NBH ';
                    $content = "'Xin chào '.$ten_nguoi_nhan.'! <br> Đơn hàng của bạn đã được đặt thành công. Chúng tôi sẽ tiếp nhận đơn hàng và giao hàng cho bạn trong thời gian sớm nhất. <br> Mã đơn hàng của bạn là: '.$ma_don_hang.' <br> ";
                    $this->guimail($email_nguoi_nhan, $subject, $content);
                    header('Location:' . BASE_URL . '?act=da-dat-hang');
                    exit();
                }
            }
        }
    }
    public function guimail($to, $subject, $content)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'namvtph51016@gmail.com';                     //SMTP username
            $mail->Password   = 'uaeo giqt noxb noyp';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Set encoding to UTF-8
            $mail->CharSet = 'UTF-8';

            //Recipients
            $mail->setFrom('namvtph51016@gmail.com', '=?UTF-8?B?' . base64_encode('Vũ Trọng Nam') . '?=');
            $mail->addAddress($to);     //Add a recipient
            //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject; //Set email subject
            $mail->Body    = $content;

            $mail->send();
            echo 'Bạn Đã gửi thành công';
        } catch (Exception $e) {
            echo "Gửi mail thất bại Mailer Error: {$mail->ErrorInfo}";
        }
    }
public function xoaSp()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $chi_tiet_gio_hang_id = $_POST['chi_tiet_gio_hang_id'];
        $xoa = $this->modelGioHang->deleteChiTietGioHang($chi_tiet_gio_hang_id);
        header('Location:' . BASE_URL . '?act=gio-hang');
    }
}
    public function lichSuDonHang() {
        // Giả sử bạn có model DonHang.php với method lấy đơn hàng theo user
        session_start();

        if (!isset($_SESSION['user_id'])) {
            // Chưa đăng nhập thì chuyển hướng về login
            header('Location: index.php?act=login');
            exit;
        }

        // Gọi model để lấy danh sách đơn hàng
        $userId = ['user_id'];
        $donHangModel = new DonHang();
        $orders = $this->$donHangModel->getOrdersByUser($userId);

        // Truyền dữ liệu sang view
        require_once './views/lich-su-don-hang.php';
    }
public function xoaSanPhamGioHang() {
        if (isset($_SESSION['user_client']) && isset($_GET['id_chi_tiet_gio_hang'])) {
            $chi_tiet_gio_hang_id = $_GET['id_chi_tiet_gio_hang'];
            $this->modelGioHang->deleteChiTietGioHang($chi_tiet_gio_hang_id);
        }
        header('Location:' . BASE_URL . '?act=gio-hang');
        exit;
    }
}
