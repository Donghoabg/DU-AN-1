<?php


class HomeController
{

    public $modelTaiKhoan;
   



    public function __construct()
    {
        $this->modelTaiKhoan = new TaiKhoan();

    }


    
    
    public function gioiThieu()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();


        require_once './views/gioiThieu.php';
    }

    
    
}
