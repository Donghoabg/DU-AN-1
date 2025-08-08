    <?php require_once 'layout/header.php'; ?>
    <?php require_once 'layout/menu.php'; ?>
    <style>
    /* =================== GIAO DIỆN CHUNG =================== */
    body {font-family: Arial,sans-serif;color:#333;}
    .container-detail {max-width:1310px;margin:40px auto;display:flex;gap:50px;flex-wrap:wrap;}
    .breadcrumb {font-size:14px;color:#888;margin-bottom:20px;}
    .breadcrumb a {color:#555;text-decoration:none;}
    .breadcrumb a:hover {text-decoration:underline;}

    /* =================== HÌNH ẢNH SẢN PHẨM =================== */
    .detail-left {flex:1 1 45%;position:relative;}
    .main-image-wrapper {width:100%;
        border:1px solid #eee;
        overflow:hidden;
        margin-left: 140px;
    }
    .main-image-wrapper img {width:100%;transition:transform 0.3s ease-in-out;}
    .main-image-wrapper:hover img {transform:scale(1.5);cursor:zoom-in;}
    .thumb-list {
        margin-left: 50px;
        margin-top: -593px;
        display:flex;
        flex-direction:column;
        gap:10px;
        float: left;
    }
    .thumb-item img {
        padding: 5px;
        width:80px;
        height:80px;
        border:1px solid #ddd;
        cursor:pointer;
        transition:all 0.2s;
        
    }
    .thumb-item img:hover {border-color:#000;}

    /* =================== THÔNG TIN SẢN PHẨM =================== */
    .detail-right {
        flex: 1 40%;
        margin-left: 140px;
    }
    .product-name {
        font-size:20px;
        font-weight: 600;
        margin-bottom:15px;
        font-family: Arial, Helvetica, sans-serif;
    }
    .product-price {
        font-size:21px;
        font-weight:bold;
        font-family: sans-serif;
        margin-bottom:10px;
        margin-top: 8px;
    }
    .product-old-price {
        font-family: sans-serif;
        font-size:15px;
        color:#999;
        text-decoration:line-through;
        margin-left:10px;
    }
    .availability {
        font-size:15px;
        color: black;
        margin-top: -7px;
        margin-bottom:15px;
        
    }
    .product-desc {
        font-size:16px;
        line-height:1.5;
        margin-bottom:25px;
        
    }
    .kethang{
        border-bottom: 0.1px dashed #DDDDDD	;
    }
    .option-title {
        font-weight: 700;
        font-size:13px;
        font-family: Arial, Helvetica, sans-serif;
        margin-right:10px;
        
    }
    .size-list button {border:1px solid #ddd;padding:6px 12px;margin-right:8px;background:#fff;cursor:pointer;
    margin-top: 10px;}
    .size-list button.active {border-color:#000;background:#000;color:#fff;}
    .quantity-box {
        display: flex;
        align-items: center;
        max-width: 140px;
        border: 1px solid #ccc;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .quantity-box button {
        width: 50px;
        height: 40px;
        font-size: 18px;
        user-select: none ;
        
    }
    .buttonright{
        border-left: 1px solid #ccc;
    }
    .buttonleft{
        border-right: 1px solid #ccc;
    }
    .quantity-box input[type="number"] {
        width: 50px;
        text-align: center;
        border: none;
        outline: none;
        font-size: 14px;
        margin-left: 10px;
        font-weight: 400;
    }
    .addcart{
        background:#000;
        color:#fff;
        padding:12px 28px;
        font-size:15px;
        cursor:pointer;
        
        transition:0.3s;
        margin-right:15px;
    }
    .btn-buy{
        background:#000;
        color:#fff;
        padding:16.5px 28px;
        font-size:15px;
        cursor:pointer;
        
        transition:0.3s;
        margin-right:15px;
    }
    .addcart:hover{
        color: #0066CC;
    }
    .btn-buy:hover,.addcart {background:#333;}

    /* =================== BÌNH LUẬN =================== */
    .review-section {margin-top:50px;}
    .comtainercomment{width: 1360px; margin: 0 auto; height: 150px;}
    .review-section h3 {font-size:22px;margin-bottom:20px;;}
    .review-item {border-bottom:1px solid #eee;padding:15px 0;}
    .review-item:last-child{border-bottom:none;}
    .review-item .avatar {width:40px;height:40px;border-radius:50%;margin-right:10px;}
    .review-item .info {display:flex;align-items:center;margin-bottom:5px;}
    .review-item .info strong{margin-right:10px;}
    .review-form textarea {width:100%;border:1px solid #ccc;;padding:10px;resize:none;}
    .review-form button {margin-top:10px;}

    /* =================== SẢN PHẨM LIÊN QUAN =================== */
    .related-products {margin-top: 180px;  }
    .related-products h3 {font-size:24px;margin-bottom:20px;text-align:center; margin-left: -25px;}
    .related-list {display:flex;margin-top: 70px; flex-wrap:wrap;gap:20px;justify-content:center;}
    .related-item {width:250px; height: 420px; text-align:center;border:1px solid #eee;overflow:hidden;transition:transform 0.3s;}
    .related-item:hover{transform:translateY(-5px);}
    .related-item img{width:100%;height:auto;}
    .related-item h4{font-size:16px;margin:10px 0; margin-top: 20px;}
    .related-item .price{color:#e53935;font-weight:bold;}
    .size-list button.active {
    border-color: #000;
    background-color: #000;
    color: #fff;
    }
    .breadcrumb{
        height: 35px;
        border-bottom: 1px solid #DDDDDD	;
        width: 100%;
    }
    .a{
        margin-left: 50px;
        line-height: 35px;
    }
    .formthem{
        margin-top: 40px;
    }
    .breadcrumb .a a,
    .breadcrumb .a span {
        margin-right: 10px;
    }


    </style>

    <?php
// Xử lý danh sách size và màu sắc từ biến thể
$sizes = [];
$colors = [];
foreach ($listBienThe as $bt) {
    if (!in_array($bt['size'], $sizes)) $sizes[] = $bt['size'];
    if (!in_array($bt['mau'], $colors)) $colors[] = $bt['mau'];
}
?>

<nav class="breadcrumb">
    <div class="a">
        <a href="<?= BASE_URL ?>"><i class="fa fa-home"></i> Trang chủ</a> / 
        <a href="<?= BASE_URL . '?act=products' ?>">Sản phẩm</a> / 
        <span><?= htmlspecialchars($sanPham['ten_san_pham']) ?></span>
    </div>
    </nav>
<div class="container-detail">
    <!-- HÌNH ẢNH SẢN PHẨM -->
    <div class="detail-left">
        <div class="main-image-wrapper">
            <img src="<?= !empty($listAnhSanPham) ? BASE_URL . $listAnhSanPham[0]['link_hinh_anh'] : 'default.jpg' ?>" alt="product-main">
        </div>
        <div class="thumb-list">
            <?php foreach ($listAnhSanPham as $anh): ?>
            <div class="thumb-item">
                <img src="<?= BASE_URL . $anh['link_hinh_anh'] ?>" onclick="document.querySelector('.main-image-wrapper img').src=this.src;">
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- THÔNG TIN CHI TIẾT -->
    <div class="detail-right">
        

        <h1 class="product-name"><?= htmlspecialchars($sanPham['ten_san_pham']) ?></h1>

        <div class="availability">Còn hàng: <?= htmlspecialchars($sanPham['so_luong']) ?> sản phẩm</div>
        <div class="kethang"></div>
        <div class="product-price">
            <?= formatPrice($sanPham['gia_khuyen_mai'] ?: $sanPham['gia_san_pham']) ?>đ
            <?php if($sanPham['gia_khuyen_mai']): ?>
                <span class="product-old-price"><?= formatPrice($sanPham['gia_san_pham']) ?>đ</span>
            <?php endif; ?>
        </div>

        
        <div class="formthem">

            <form onsubmit="return themVaoGioHangAjax(this, event)">
                <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                <input type="hidden" name="size" id="selectedSize">
                <input type="hidden" name="mau_sac" id="selectedColor">
    
                <!-- SIZE -->
                <div class="option-title">KÍCH CỠ</div>
                <div class="size-list" style="margin-bottom: 20px;">
                    <?php foreach($sizes as $size): ?>
                        <button type="button" class="btn-size"><?= htmlspecialchars($size) ?></button>
                    <?php endforeach; ?>
                </div>
    
                <!-- MÀU -->
                <div class="option-title">MÀU SẮC</div>
                <div class="size-list" style="margin-bottom: 20px;">
                    <?php foreach($colors as $color): ?>
                        <button type="button" class="btn-color"><?= htmlspecialchars($color) ?></button>
                    <?php endforeach; ?>
                </div>
    
                <!-- SỐ LƯỢNG -->
                <div class="quantity-box">
                    <button class="buttonleft" type="button" onclick="decrease()">−</button>
                    <input type="number" name="so_luong" id="so_luong" value="1" min="1" max="<?= $sanPham['so_luong'] ?>">
                    <button class="buttonright" type="button" onclick="increase()">+</button>
                </div>
    
                <button type="submit" class="addcart">Thêm vào giỏ hàng</button>
                <a href="<?= BASE_URL . '?act=thanh-toan' ?>" class="btn-buy">Mua ngay</a>
            </form>
        </div>
        <!-- FORM THÊM GIỎ HÀNG -->
        <div class="product-desc"><?= nl2br(htmlspecialchars($sanPham['mo_ta'])) ?></div>
    </div>
</div>

<!-- BÌNH LUẬN -->
<div class="comtainercomment">
    <h3>Bình luận (<?= count($listBinhLuan) ?>)</h3>
    <?php foreach($listBinhLuan as $bl): ?>
    <div class="review-item d-flex">
        <img src="<?= htmlspecialchars($bl['anh_dai_dien']) ?>" class="avatar" alt="avatar">
        <div>
            <div class="info">
                <strong><?= htmlspecialchars($bl['ho_ten']) ?></strong>
                <small><?= htmlspecialchars($bl['ngay_dang']) ?></small>
            </div>
            <p><?= htmlspecialchars($bl['noi_dung']) ?></p>
        </div>
    </div>
    <?php endforeach; ?>

    <?php if(isset($_SESSION['user_client'])): ?>
    <form action="<?= BASE_URL . '?act=gui-binh-luan' ?>" method="POST" class="review-form">
        <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
        <textarea name="binh_luan" rows="4" required placeholder="Nhập bình luận của bạn..."></textarea>
        <button type="submit" class="btn-cart">Gửi bình luận</button>
    </form>
    <?php else: ?>
        <p>Vui lòng <a href="<?= BASE_URL . '?act=login' ?>">đăng nhập</a> để gửi bình luận.</p>
    <?php endif; ?>
</div>

<!-- SẢN PHẨM LIÊN QUAN -->
<div class="container-detail related-products">
    <h3>Sản phẩm liên quan</h3>
    <div class="related-list">
        <?php foreach($listSanPhamCungDanhMuc as $sp): ?>
        <div class="related-item">
            <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sp['id'] ?>">
                <img src="<?= BASE_URL . $sp['hinh_anh'] ?>" alt="related">
                <h4><?= htmlspecialchars($sp['ten_san_pham']) ?></h4>
                <div class="price"><?= formatPrice($sp['gia_khuyen_mai'] ?: $sp['gia_san_pham']) ?>đ</div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- SCRIPT CHỌN SIZE - MÀU -->
<script>
function themVaoGioHangAjax(form, event) {
    event.preventDefault();

    const size = document.getElementById('selectedSize').value;
    const color = document.getElementById('selectedColor').value;

    if (!size) {
        alert('Vui lòng chọn kích cỡ (Size) trước khi thêm vào giỏ hàng.');
        return false;
    }
    if (!color) {
        alert('Vui lòng chọn màu sắc trước khi thêm vào giỏ hàng.');
        return false;
    }

    let formData = new FormData(form);
    fetch('<?= BASE_URL . '?act=them-gio-hang' ?>', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(data => alert('Đã thêm vào giỏ hàng!'))
    .catch(() => alert('Có lỗi xảy ra!'));

    return false;
}

document.addEventListener("DOMContentLoaded", function() {
    const sizeButtons = document.querySelectorAll(".btn-size");
    const inputSize = document.getElementById("selectedSize");

    sizeButtons.forEach(button => {
        button.addEventListener("click", function() {
            sizeButtons.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
            inputSize.value = this.textContent.trim();
        });
    });

    const colorButtons = document.querySelectorAll(".btn-color");
    const inputColor = document.getElementById("selectedColor");

    colorButtons.forEach(button => {
        button.addEventListener("click", function() {
            colorButtons.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
            inputColor.value = this.textContent.trim();
        });
    });
});
function increase() {
    const input = document.getElementById('so_luong');
    const max = parseInt(input.max);
    let value = parseInt(input.value);
    if (value < max) {
        input.value = value + 1;
    }
}

function decrease() {
    const input = document.getElementById('so_luong');
    const min = parseInt(input.min);
    let value = parseInt(input.value);
    if (value > min) {
        input.value = value - 1;
    }
}
</script>

<?php require_once 'layout/footer.php'; ?>