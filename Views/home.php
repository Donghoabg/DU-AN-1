<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>




<main>
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="./views/assets/img/slider/banner4.png">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>

            </div>
            
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="./views/assets/img/slider/banner2.png">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>

            </div>
            
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="./views/assets/img/slider/banner3.png">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>

            </div>


        </div>
    </section>




    <div class="service-policy section-padding">
        <div class="container">
            <div class="row mtn-30">
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Giao hàng</h6>
                            <p>Miễn phí giao hàng</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="fa fa-headphones"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Hộ trợ</h6>
                            <p>Hộ trợ 24/7</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="fa fa-undo"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Hoàn tiền</h6>
                            <p>Hoàn tiền trong 30 ngày khi lỗi</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Thanh toán</h6>
                            <p>Bảo mật thanh toán</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm bán chạy</h2>
                        <p class="sub-title"> sản phẩm được cập nhật liên tục</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">


                       
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <?php foreach ($listSanPham as $key => $sanPham): ?>
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a
                                                    href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                                    <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>"
                                                        alt="product" style="width: 300px; height:250px;">
                                                    <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>"
                                                        alt="product">
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
                                                    if ($sanPham['gia_khuyen_mai']) { ?>
                                                    <div class="product-label discount">
                                                        <span>Giảm giá</span>
                                                    </div>

                                                    <?php
                                                }
                                                    ?>



                                                </div>
                                                <a
                                                    href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                                    <div class="cart-hover"><button class="btn btn-cart">Xem chi
                                                            tiết</button>
                                                </a>
                                        </div>
                                        </figure>
                                        <div class="product-caption text-center">

                                            <h6 class="product-name">
                                                <a
                                                    href="<?= BASE_URL . '?act=chi-tiet-san-pham&id-san-pham=' . $sanPham['id']; ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                            </h6>
                                            <div class="price-box">
                                                <?php if ($sanPham['gia_khuyen_mai']) { ?>

                                                    <span
                                                        class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ'; ?></span>
                                                    <span
                                                        class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                                <?php } else {  ?>
                                                    <span class="price-old"
                                                        style="color: #CDAB75;"><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></span>

                                                <?php } ?>

                                            </div>
                                        </div>
                                </div>

                                

                            <?php endforeach; ?>
</div> <!-- Đóng product-carousel-4 slick-row-10 slick-arrow-style -->
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="feature-product section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm của chúng tôi </h2>
                        <p class="sub-title"></p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                    <?php foreach ($listSanPham as $key => $sanPham): ?>
                        <!-- product item start -->
                        <div class="product-item">
                            <figure class="product-thumb">
                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                    <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product" style="width: 300px; height:250px;">
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
                                    <?php }
                                    if ($sanPham['gia_khuyen_mai']) { ?>
                                        <div class="product-label discount">
                                            <span>Giảm giá</span>
                                        </div>
                                    <?php } ?>
                                </div>
                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                    <div class="cart-hover"><button class="btn btn-cart">Xem chi tiết</button></div>
                                </a>
                            </figure>
                            <div class="product-caption text-center">
                                <h6 class="product-name">
                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id-san-pham=' . $sanPham['id']; ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                </h6>
                                <div class="price-box">
                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                        <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ'; ?></span>
                                        <span class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                    <?php } else {  ?>
                                        <span class="price-old" style="color: #CDAB75;">
                                            <?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?>
                                        </span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- product item end -->
                    <?php endforeach; ?>
                    </div> <!-- Đóng product-carousel-4_2 slick-row-10 slick-arrow-style -->
                </div>
            </div>
        </div>
    </section>
    <!-- featured product area end -->

    <!-- testimonial area start -->
   
    <!-- testimonial area end -->

    <!-- group product start -->
    
    <!-- group product end -->

  

    <!-- brand logo area start -->
    
    <!-- brand logo area end -->
</main>





<!-- offcanvas mini cart start -->
<?php require_once 'layout/miniCart.php'; ?>

<?php require_once 'layout/footer.php'; ?>