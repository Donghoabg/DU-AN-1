<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>
<style>
    .pro-large-img {
        position: relative;
        overflow: hidden;
        width: 100%;
        height: 400px;
    }

    .pro-large-img img {
        width: 100%;
        height: 100%;
        transition: transform 0.3s ease-in-out;
    }

    .pro-large-img:hover img {
        transform: scale(1.5);
        /* Phóng to ảnh khi hover */
        cursor: zoom-in;
    }

    .so-luong-error {
        display: none;
        background: #fff0f0;
        color: #d8000c;
        border: 1px solid #f5c6cb;
        border-radius: 6px;
        padding: 8px 12px;
        margin-top: 6px;
        font-size: 15px;
        font-weight: 500;
        box-shadow: 0 2px 8px rgba(220,53,69,0.07);
        position: relative;
        animation: fadeIn 0.4s;
    }
    .so-luong-error::before {
        content: '\26A0'; /* icon cảnh báo */
        margin-right: 8px;
        font-size: 18px;
        vertical-align: middle;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Thêm CSS cho popup thông báo lỗi số lượng */
    .so-luong-popup-overlay {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.25);
        z-index: 9998;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .so-luong-popup {
        position: fixed;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(220,53,69,0.18);
        border: 1.5px solid #f5c6cb;
        z-index: 9999;
        min-width: 320px;
        max-width: 90vw;
        padding: 28px 28px 18px 28px;
        text-align: center;
        animation: fadeIn 0.3s;
    }
    .so-luong-popup-content {
        color: #d8000c;
        font-size: 17px;
        font-weight: 500;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .so-luong-popup-content::before {
        content: '\26A0';
        font-size: 22px;
        margin-right: 6px;
    }
    .so-luong-popup-close {
        position: absolute;
        top: 8px; right: 12px;
        background: none;
        border: none;
        font-size: 22px;
        color: #d8000c;
        cursor: pointer;
        font-weight: bold;
        transition: color 0.2s;
    }
    .so-luong-popup-close:hover {
        color: #a30000;
    }
</style>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL . '?act=' ?>">Sản Phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <?php foreach ($listAnhSanPham as $key => $anhSanPham) { ?>
                                        <div class="pro-large-img">
                                                <img src="<?= BASE_URL . $anhSanPham['link_hinh_anh'] ?>"alt="product-details" />
                                        </div>
                                    <?php } ?>


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
        </div>
    </div>
    <!-- page main wrapper end -->

    <!-- related products area start -->
    <section class="related-products section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm liên quan</h2>
                        <p class="sub-title"></p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                        <!-- product item start -->
                        <?php foreach ($listSanPhamCungDanhMuc as $key => $sanPham): ?>
                            <!-- product item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                        <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                        <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <?php
                                        $ngayNhap = formatDate($sanPham['ngay_nhap']);
                                        $ngayHienTai = new DateTime();
                                        $tinhNgay = $ngayHienTai->diff(new DateTime($sanPham['ngay_nhap']));
                                        if ($tinhNgay->days <= 7) {
                                        ?>
                                            <div class="product-label new">
                                                <span>Mới </span>
                                            </div>
                                        <?php } ?>

                                        <?php
                                        if ($sanPham['gia_khuyen_mai'])
                                        ?>

                                        <div class="product-label discount">
                                            <span>Giảm giá</span>
                                        </div>

                                    </div>

                                    <div class="cart-hover">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                            <div class="cart-hover"><button class="btn btn-cart">Xem chi tiết</button>
                                        </a>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">

                                    <h6 class="product-name">
                                        <a
                                            href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                    </h6>
                                    <div class="price-box">
                                        <?php if ($sanPham['gia_khuyen_mai']) { ?>

                                            <span
                                                class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ'; ?></span>
                                            <span
                                                class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                        <?php } else {  ?>
                                            <span
                                                class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>

                            <!-- product item end -->

                        <?php endforeach  ?>
                        <!-- product item end -->


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- related products area end -->
</main>

<!-- Popup thông báo lỗi số lượng -->
<div id="soLuongPopupOverlay" class="so-luong-popup-overlay" style="display:none;"></div>
<div id="soLuongPopup" class="so-luong-popup" style="display:none;">
    <button type="button" class="so-luong-popup-close" id="closeSoLuongPopup">&times;</button>
    <div class="so-luong-popup-content" id="soLuongPopupMsg"></div>
</div>

<!-- Thêm jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Thêm ElevateZoom -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-elevatezoom/3.0.8/jquery.elevatezoom.min.js"></script>
<script>
    $(document).ready(function() {
        $('.zoomImg').elevateZoom({
            zoomType: "inner", // Zoom bên trong ảnh
            cursor: "crosshair", // Dùng con trỏ hình chữ thập
            zoomWindowFadeIn: 500, // Hiệu ứng mờ dần khi mở zoom
            zoomWindowFadeOut: 500 // Hiệu ứng mờ dần khi đóng zoom
        });
    });
</script>
<script>
    document.querySelectorAll('.pro-large-img').forEach(function(imgContainer) {
        imgContainer.addEventListener('mousemove', function(e) {
            const img = imgContainer.querySelector('img');
            const rect = imgContainer.getBoundingClientRect();
            const x = e.clientX - rect.left; // Vị trí X chuột
            const y = e.clientY - rect.top; // Vị trí Y chuột
            img.style.transformOrigin = `${x}px ${y}px`; // Tùy chỉnh điểm zoom
            img.style.transform = 'scale(1.5)';
        });

        imgContainer.addEventListener('mouseleave', function() {
            const img = imgContainer.querySelector('img');
            img.style.transformOrigin = 'center center';
            img.style.transform = 'scale(1)';
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        var soLuongInput = document.querySelector('input[name="so_luong"]');
        // Ẩn thông báo cũ
        var msg = document.getElementById('soLuongMsg');
        if(msg) msg.style.display = 'none';
        // Popup
        var popup = document.getElementById('soLuongPopup');
        var popupMsg = document.getElementById('soLuongPopupMsg');
        var popupOverlay = document.getElementById('soLuongPopupOverlay');
        var closeBtn = document.getElementById('closeSoLuongPopup');
        var maxQty = parseInt(soLuongInput.getAttribute('max'));
        function showSoLuongPopup(message) {
            popupMsg.textContent = message;
            popup.style.display = 'block';
            popupOverlay.style.display = 'flex';
        }
        function hideSoLuongPopup() {
            popup.style.display = 'none';
            popupOverlay.style.display = 'none';
        }
        closeBtn.onclick = hideSoLuongPopup;
        popupOverlay.onclick = hideSoLuongPopup;
        soLuongInput.addEventListener('input', function() {
            if (parseInt(this.value) > maxQty) {
                showSoLuongPopup('Hiện tại bên shop không đủ sản phẩm (' + maxQty + ' sản phẩm còn lại)');
                this.value = maxQty;
            } else if (parseInt(this.value) < 1) {
                showSoLuongPopup('Số lượng tối thiểu là 1');
                this.value = 1;
            }
        });
    });
</script>

<!-- offcanvas mini cart start -->
<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>
