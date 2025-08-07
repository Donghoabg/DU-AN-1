<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chính Sách</title>
    <style>
        .grid-container {
    display: grid;
    grid-template-columns: repeat(3, 380px); /* 3 cột, mỗi cột 380px */
    grid-template-rows: repeat(2, 388px);     /* 2 hàng, mỗi hàng 388px */
    gap: 10px;                                /* khoảng cách giữa các ô (cả dọc và ngang) */
    justify-content: center;                  /* căn giữa theo chiều ngang */
    margin-top: 20px;                         /* khoảng cách với top nếu muốn */
    }

    .grid-item {
    }
    .chinhsach h2{
        font-family: sans-serif;
        margin-left: 180px ;
        font-size: 36px;
        font-weight: 500;
    }
    .link{
        margin-left: 180px;
        background-color: #F5F5F5;
        width: 1160px;
        padding: 5px;
    }
    .link a{
        font-size: 13px;
        font-family: sans-serif;
        text-decoration: none;
        font-weight: 200;
        padding-left: 7px;
        font-style: italic;
        color: #000000;
    }
    .anh1 img{
        padding-left: 40px;
        padding-right: 40px;
        height: 240px;
        border: 1px solid #C0C0C0	;
    }
    .anh2{
        align-items: center;
        border: 1px solid #C0C0C0;
    }
    .anh2 img{
        height: 240px;
        margin-left: 9px;
    }
    .tieude1{
        margin-top: 10px;
        font-family: Arial, Helvetica, sans-serif;
        font-family: 'Roboto', sans-serif;
        color: #252a2b;
        letter-spacing: 1px;
    }
    .tieude2{
        font-size: 14px;
        letter-spacing: 1px;
        font-family: 'Roboto', sans-serif;
        color: #666666	;
        font-weight: 300;
    }
    .xemthem{
        margin-top: 60px;
        color: red;
        margin-left: 10px;
        font-style: italic;
        font-weight: 200;
    }

    </style>
</head>
<body>
    
    <div class="chinhsach">
        <h2>Chính Sách</h2>
    </div>
    
    <div class="link">
        <a href="">Trang chủ</a>
        <a href="" style="color: #999;">/</a>
        <a href="">Thông Tin</a>
    </div>
    <div class="grid-container">
    <div class="grid-item">
        <div class="anh1">
            <img src="uploads/chinhsach1.jpg" alt="">
        </div>
        <div class="tieude1">TẦM NHÌN - SỨ MỆNH SENMOOD</div>
        <div class="tieude2">TẦM NHÌN - SỨ MỆNH SENMOOD</div>
        <div class="xemthem">Xem thêm</div>
    </div>
    <div class="grid-item">
        <div class="anh2">
            <img src="uploads/chinhsach3.webp" alt="">
        </div>
        <div class="tieude1">Hệ Thống Cửa Hàng</div>
        <div class="tieude2">Hệ Thống Cửa Hàng</div>
        <div class="xemthem">Xem thêm</div>
    </div>
    <div class="grid-item">
        <div class="anh2">
            <img src="uploads/chinhsach4.webp" alt="">
        </div>
        <div class="tieude1">Chính sách bảo mật thông tin</div>
        <div class="tieude2">Chính sách bảo mật thông tin</div>
        <div class="xemthem">Xem thêm</div>
    </div>
    <div class="grid-item">
        <div class="anh2">
            <img src="uploads/chinhsach5.webp" alt="">
        </div>
        <div class="tieude1">Hướng dẫn mua hàng</div>
        <div class="tieude2"> Cách thức xem hàng và đặt hàng </div>
        <div class="xemthem">Xem thêm</div>
    </div>
    <div class="grid-item">
        <div class="anh2">
            <a href=""><img src="uploads/chinhsach6.jpg" alt=""></a>
            
        </div>
        <div class="tieude1">Chính sách đổi hàng</div>
        <div class="tieude2">QUY ĐỊNH ĐỔI HÀNG</div>
        <div class="xemthem">Xem thêm</div>
    </div>
    <div class="grid-item">
        <div class="anh2">
            <img src="uploads/chinhsach7.jpg" alt="">
        </div>
        <div class="tieude1">Chính sách vận chuyển</div>
        <div class="tieude2">VẬN CHUYỂN</div>
        <div class="xemthem">Xem thêm</div>
    </div>
</div>

</div>

</body>
</html>
<?php require_once 'layout/footer.php'; ?>