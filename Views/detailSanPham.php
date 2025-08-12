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
    .related-item h4{font-size:16px;margin:10px 0; margin-top: 20px     ;}
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

<<<<<<< HEAD
                                </div>
                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                    <?php foreach ($listAnhSanPham as $key => $anhSanPham) { ?>

                                        <div class="pro-nav-thumb">
                                        <img src="<?= BASE_URL . $anhSanPham['link_hinh_anh'] ?>"alt="product-details"
                                                style='width:75px; height: 75px;' />
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <div class="manufacturer-name">
                                        <a href="#"><?= $sanPham['ten_danh_muc'] ?></a>
                                    </div>
                                    <h3 class="product-name"><?= $sanPham['ten_san_pham'] ?></h3>
                                    <div class="ratings d-flex">
                                        <div class="pro-review">
                                            <?php $countComment = count($listBinhLuan); ?>
                                            <span><?= $countComment . ' Bình luận' ?></span>
                                        </div>
                                    </div>
                                    <div class="price-box">
                                        <?php if ($sanPham['gia_khuyen_mai'] > 0) { ?>
                                            <span
                                                class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ'; ?></span>
                                            <span
                                                class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                        <?php } else { ?>
                                            <span
                                                class="price-regular"><?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?></span>
                                        <?php }    ?>

                                    </div>

                                    <!-- check số lượng sản phẩm  -->
                                    <div class="availability">
                                        <i class="fa fa-check-circle"></i>
                                        <span><?= $sanPham['so_luong'] . ' sản phẩm' ?></span>
                                    </div>

                                    <p class="pro-desc"><?= $sanPham['mo_ta'] ?></p>
                                    <form action="submit.php" method="post" style="font-family: Arial, sans-serif;">
                                        <div style="font-weight: bold; font-size: 14px; margin-bottom: 5px;">
                                            KÍCH THƯỚC 
                                            <span style="text-decoration: underline; font-size: 14px; color: #333; cursor: pointer;">
                                            Hướng Dẫn Chọn Size
                                            </span>
                                        </div>

                                        <div style="display: flex; gap: 10px; margin-top: 10px;">
                                            <input type="radio" name="size" value="2XL" id="s2xl" style="display: none;">
                                            <label for="s2xl" style="width: 50px; height: 50px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; font-weight: bold; cursor: pointer;">2XL</label>

                                            <input type="radio" name="size" value="XL" id="sxl" style="display: none;">
                                            <label for="sxl" style="width: 50px; height: 50px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; font-weight: bold; cursor: pointer;">XL</label>

                                            <input type="radio" name="size" value="L" id="sl" style="display: none;">
                                            <label for="sl" style="width: 50px; height: 50px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; font-weight: bold; cursor: pointer;">L</label>

                                            <input type="radio" name="size" value="M" id="sm" style="display: none;">
                                            <label for="sm" style="width: 50px; height: 50px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; font-weight: bold; cursor: pointer;">M</label>
                                        </div>

                                        <button type="submit" style="margin-top: 15px; padding: 8px 20px; cursor: pointer;">Xác Nhận</button>
                                        </form>
                                        <form action="<?= BASE_URL . '?act=them-gio-hang' ?>" method="POST" onsubmit="return themVaoGioHangAjax(this, event)">

                                            <div class="quantity-cart-box d-flex align-items-center">
                                                <h6 class="option-title">Số lượng:</h6>
                                                <div class="quantity">
                                                    <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                                                    <div class="pro-qty">
                                                        <input type="number" value="1" name="so_luong" min="1" max="<?= $sanPham['so_luong'] ?>">
                                                        <div id="soLuongMsg" class="so-luong-error" style="display: none;"></div>
                                                    </div>
                                                </div>
                                                <div class="action_link">
                                                    <button class="btn btn-cart2" type="submit">Thêm vào giỏ hàng</button>
                                                </div>
                                            </div>
                                        </form>
                                <script>
                                function themVaoGioHangAjax(form, event) {
                                    event.preventDefault();
                                    var formData = new FormData(form);
                                    fetch('<?= BASE_URL . '?act=them-gio-hang' ?>', {
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then(response => response.text())
                                    .then(data => {
                                        alert('Đã thêm vào giỏ hàng!');
                                    })
                                    .catch(error => {
                                        alert('Có lỗi xảy ra!');
                                    });
                                    return false;
                                }
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews section-padding pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">

                                        <li>
                                            <a class="active" data-bs-toggle="tab" href="#tab_three">Bình luận
                                                (<?= $countComment ?>)</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">

                                        <div class="tab-pane fade show active" id="tab_three">

                                            <div class="tab-content reviews-tab">
                                                <div class="tab-pane fade show active" id="tab_three">

                                                    <!-- Hiển thị danh sách bình luận -->
                                                    <?php foreach ($listBinhLuan as $binhLuan): ?>
                                                        <div class="total-reviews d-flex align-items-start mb-3">
                                                            <div class="rev-avatar me-3">
                                                                <img src="<?= htmlspecialchars($binhLuan['anh_dai_dien']) ?>" alt="Avatar" class="rounded-circle" style="width: 50px; height: 50px;">
                                                            </div>
                                                            <div class="review-box w-100">
                                                                <div class="post-author mb-2">
                                                                    <p class="mb-1">
                                                                        <strong><?= htmlspecialchars($binhLuan['ho_ten']) ?></strong>
                                                                        <small class="text-muted ms-2"><?= htmlspecialchars($binhLuan['ngay_dang']) ?></small>
                                                                    </p>
                                                                </div>
                                                                <p class="mb-2"><?= htmlspecialchars($binhLuan['noi_dung']) ?></p>
                                                                <!-- Nút "Thu Hồi Bình Luận" căn phải -->
                                                                <div class="text-end">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>

                                                    <!-- Form gửi bình luận -->
                                                    <form action="<?= BASE_URL . '?act=gui-binh-luan' ?>" method="POST" class="review-form">
                                                        <!-- Gửi ID sản phẩm qua form -->
                                                        <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">

                                                        <!-- Kiểm tra nếu người dùng chưa đăng nhập -->
                                                        <?php if (!isset($_SESSION['user_client'])): ?>
                                                            <p class="text-danger">Vui lòng <a href="<?= BASE_URL . '?act=login' ?>">đăng nhập</a> để gửi bình luận.</p>
                                                        <?php else: ?>
                                                            <!-- Gửi ID tài khoản người dùng qua form -->
                                                            <input type="hidden" name="tai_khoan_id" value="<?= $_SESSION['user_client'] ?>">

                                                            <div class="form-group row">
                                                                <div class="col">
                                                                    <label for="binh_luan" class="col-form-label">
                                                                        <span class="text-danger">*</span> Nội Dung Bình Luận
                                                                    </label>
                                                                    <textarea name="binh_luan" class="form-control" id="binh_luan" rows="3" required></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group mt-3">
                                                                <button type="submit" class="btn btn-primary">Gửi Bình Luận</button>
                                                            </div>
                                                        <?php endif; ?>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->
                </div>
                <!-- product details wrapper end -->
            </div>
=======
        <div class="availability">Còn hàng: <?= htmlspecialchars($sanPham['so_luong']) ?> sản phẩm</div>
        <div class="kethang"></div>
        <div class="product-price">
            <?= formatPrice($sanPham['gia_khuyen_mai'] ?: $sanPham['gia_san_pham']) ?>đ
            <?php if($sanPham['gia_khuyen_mai']): ?>
                <span class="product-old-price"><?= formatPrice($sanPham['gia_san_pham']) ?>đ</span>
            <?php endif; ?>
>>>>>>> 6ba463a1fd84a3b43452e910b27bb1ed6c5255ac
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