<?php
session_start();
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ


require_once 'views/assets/PHPMailer-master/PHPMailer-master/src/Exception.php';
require_once 'views/assets/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require_once 'views/assets/PHPMailer-master/PHPMailer-master/src/SMTP.php';

require_once './controllers/HomeController.php';
require_once './controllers/TaiKhoan.php';
require_once './controllers/DanhMuc.php';
//san pham



require_once './models/TaiKhoan.php';

$controller = new HomeController();


$act = $_GET['act'] ?? '/';


match ($act) {

    '/' => (new HomeController())->home(),
    'lien-he' => (new HomeController())->lienHe(),
    'gioi-thieu' => (new HomeController())->gioiThieu(),


    'login' => (new TaiKhoanController())->formLogin(),
    'check-login' => (new TaiKhoanController())->postlogin(),
    'logout' => (new TaiKhoanController())->logout(),
    'quen-mat-khau' => (new TaiKhoanController())->quenMatKhau(),
    'lay-mat-khau' => (new TaiKhoanController())->layMatKhau(),
    'form-dang-ky' => (new TaiKhoanController())->formDangKy(),
    'dang-ky' => (new TaiKhoanController())->dangKy(),
    'doi-mat-khau' => (new TaiKhoanController())->doiMatKhau(),
    'tai-khoan' => (new TaiKhoanController())->taiKhoan(),
};
