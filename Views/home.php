<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>




<main>
    <!-- hero slider area start -->
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="./views/assets/img/slider/4.jpg">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>

            </div>
            <!-- single slider item start -->
            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="./views/assets/img/slider/2.jpg">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>

            </div>
            <!-- single slider item start -->
            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="./views/assets/img/slider/5.jpg">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>

            </div>
            <!-- single slider item start -->


        </div>
    </section>
    <!-- hero slider area end -->




    <!-- service policy area start -->
    <div class="service-policy section-padding">
        <div class="container">
            <div class="row mtn-30">
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-plane"></i>
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
                            <i class="pe-7s-help2"></i>
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
                            <i class="pe-7s-back"></i>
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
                            <i class="pe-7s-credit"></i>
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
    <!-- service policy area end -->



    <!-- product area start -->
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm bán chạy</h2>
                        <p class="sub-title"> sản phẩm được cập nhật liên tục</p>
                    </div>
                    <!-- section title start -->
                </div>


                        <?php foreach ($sanPhamBanChay as $sanPham): ?>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <figure class="product-item">
                                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                                    <img src="path/to/image.jpg" alt="<?= $sanPham['ten_san_pham'] ?>" />
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
                                                   
                                                <?php } ?>

                                            </div>
                                        </div>
                                </div>

                                <!-- product item end -->

                            <?php endforeach; ?>
</div> <!-- Đóng product-carousel-4 slick-row-10 slick-arrow-style -->
                        </div>

                    </div>
                    <!-- product tab content end -->
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- product area end -->

    <!-- product banner statistics area start -->
    
    <!-- product banner statistics area end -->

    <!-- featured product area start -->
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
                            <figure class="product-img">
                                <img src="<?= $sanPham['hinh_anh'] ?>" alt="<?= $sanPham['ten_san_pham'] ?>">
                                
                                <?php if (isset($sanPham['moi']) && $sanPham['moi']) : ?>
                                    <div class="product-label new">
                                        <span>Mới</span>
                                    </div>
                                <?php endif; ?><?php
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