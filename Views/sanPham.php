<?php require_once 'layout/header.php'  ?>
<?php require_once 'layout/menu.php'  ?>




<main>

    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- sidebar area start -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="sidebar-wrapper">
                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h5 class="sidebar-title">
                                <a class="sidebar-single text-danger" href="<?= BASE_URL . '?act=san-pham' ?>">Danh Mục
                                    Sản Phẩm</a>
                            </h5>

                            <div class="sidebar-body">
                                <ul class="shop-categories">
                                    <?php foreach ($listDanhMuc as $danhMuc) { 
                                        if (!isset($danhMuc['trang_thai']) || $danhMuc['trang_thai'] == 1) { ?>
                                        <li>
                                            <a
                                                href="<?= BASE_URL . '?act=san-pham-theo-danh-muc&danh_muc_id=' . $danhMuc['id'] ?>">
                                                <div class="text-truncate" style="max-width: 200px;">
                                                    <?= htmlspecialchars($danhMuc['ten_danh_muc']) ?>
                                                </div>
                                            </a>
                                        </li>
                                        <?php } 
                                    } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-single">
                            <h5 class="sidebar-title">
                                <a class="sidebar-single text-danger" href="<?= BASE_URL . '?act=san-pham' ?>">Top 10
                                    Sản Phẩm</a>
                            </h5>

                            <div class="sidebar-body">
                                <ul class="shop-categories">
                                    <?php foreach ($listtop10 as $top10sp) { ?>
                                        <li class="d-flex align-items-center mb-3">
                                            <!-- Hình ảnh sản phẩm -->
                                            <div class="me-3">
                                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $top10sp['id'] ?>">
                                                    <!-- Thêm liên kết tới trang chi tiết sản phẩm -->
                                                    <img src="<?= BASE_URL . '/uploads/' . htmlspecialchars($top10sp['hinh_anh']) ?>"
                                                        alt="<?= htmlspecialchars($top10sp['ten_san_pham']) ?>"
                                                        class="img-fluid"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                </a>
                                            </div>
                                            <!-- Thông tin sản phẩm -->
                                            <div>
                                                <a
                                                    href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $top10sp['id'] ?>">
                                                    <!-- Thêm liên kết tới trang chi tiết sản phẩm -->
                                                    <p class="mb-1 text-truncate" style="max-width: 150px;">
                                                        <?= htmlspecialchars($top10sp['ten_san_pham']) ?>
                                                    </p>
                                                </a>
                                                <?php if (!empty($top10sp['gia_khuyen_mai']) && $top10sp['gia_khuyen_mai'] < $top10sp['gia_san_pham']): ?>
                                                    <!-- Giá khuyến mại -->
                                                    <span
                                                        class="text-danger fw-bold"><?= number_format($top10sp['gia_khuyen_mai']) ?>₫</span>
                                                    <!-- Giá gốc -->
                                                    <span
                                                        class="text-muted text-decoration-line-through ms-2"><?= number_format($top10sp['gia_san_pham']) ?>₫</span>
                                                <?php else: ?>
                                                    <!-- Giá bình thường -->
                                                    <span
                                                        class="text-danger fw-bold"><?= number_format($top10sp['gia_san_pham'], 0, ',', '.') ?>₫</span>
                                                <?php endif; ?>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                        <!-- single sidebar end -->

                        <!-- single sidebar start -->
                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h5 class="sidebar-title text-danger">price</h5>
                            <div class="sidebar-body">
                                <div class="price-range-wrap">
                                    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                        data-min="1" data-max="1000">
                                        <div class="ui-slider-range ui-corner-all ui-widget-header"
                                            style="left: 0%; width: 100%;"></div><span tabindex="0"
                                            class="ui-slider-handle ui-corner-all ui-state-default"
                                            style="left: 0%;"></span><span tabindex="0"
                                            class="ui-slider-handle ui-corner-all ui-state-default"
                                            style="left: 100%;"></span>
                                    </div>
                                    <div class="range-slider">
                                        <form action="#" class="d-flex align-items-center justify-content-between">
                                            <div class="price-input">
                                                <label for="amount">Price: </label>
                                                <input type="text" id="amount">
                                            </div>
                                            <button class="filter-btn">filter</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single sidebar end -->

                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h5 class="sidebar-title text-danger">Brand</h5>
                            <div class="sidebar-body">
                                <ul class="checkbox-container categories-list">
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">Studio (3)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck3">
                                            <label class="custom-control-label" for="customCheck3">Hastech (4)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck4">
                                            <label class="custom-control-label" for="customCheck4">Quickiin (15)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Graphic corner
                                                (10)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck5">
                                            <label class="custom-control-label" for="customCheck5">devItems (12)</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- single sidebar end -->

                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h5 class="sidebar-title text-danger">color</h5>
                            <div class="sidebar-body">
                                <ul class="checkbox-container categories-list">
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck12">
                                            <label class="custom-control-label" for="customCheck12">black (20)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck13">
                                            <label class="custom-control-label" for="customCheck13">red (6)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck14">
                                            <label class="custom-control-label" for="customCheck14">blue (8)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck11">
                                            <label class="custom-control-label" for="customCheck11">green (5)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck15">
                                            <label class="custom-control-label" for="customCheck15">pink (4)</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- single sidebar end -->

                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h5 class="sidebar-title text-danger">size</h5>
                            <div class="sidebar-body">
                                <ul class="checkbox-container categories-list">
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck111">
                                            <label class="custom-control-label" for="customCheck111">S (4)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck222">
                                            <label class="custom-control-label" for="customCheck222">M (5)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck333">
                                            <label class="custom-control-label" for="customCheck333">L (7)</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck444">
                                            <label class="custom-control-label" for="customCheck444">XL (3)</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- single sidebar end -->

                        <!-- single sidebar start -->
                        <div class="sidebar-banner">
                            <div class="img-container">
                                <a href="#">
                                    <img src="assets/img/banner/sidebar-banner.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- single sidebar end -->
                    </aside>
                </div>
                <!-- sidebar area end -->

                <!-- shop main wrapper start -->
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="shop-product-wrapper">
                        <!-- shop product top wrap start -->
                        <div class="shop-top-bar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a class="active" href="#" data-target="grid-view" data-bs-toggle="tooltip"
                                                title="" data-bs-original-title="Grid View" aria-label="Grid View"><i
                                                    class="fa fa-th"></i></a>
                                            <a href="#" data-target="list-view" data-bs-toggle="tooltip" title=""
                                                data-bs-original-title="List View" aria-label="List View"><i
                                                    class="fa fa-list"></i></a>
                                        </div>
                                        <div class="product-amount">
                                            <p>Showing 1–16 of 21 results</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                    <div class="top-bar-right">
                                        <div class="product-short">
                                            <p>Sort By : </p>
                                            <select class="nice-select" name="sortby" style="display: none;">
                                                <option value="trending">Relevance</option>
                                                <option value="sales">Name (A - Z)</option>
                                                <option value="sales">Name (Z - A)</option>
                                                <option value="rating">Price (Low &gt; High)</option>
                                                <option value="date">Rating (Lowest)</option>
                                                <option value="price-asc">Model (A - Z)</option>
                                                <option value="price-asc">Model (Z - A)</option>
                                            </select>
                                            <div class="nice-select" tabindex="0"><span class="current">Relevance</span>
                                                <ul class="list">
                                                    <li data-value="trending" class="option selected">Relevance</li>
                                                    <li data-value="sales" class="option">Name (A - Z)</li>
                                                    <li data-value="sales" class="option">Name (Z - A)</li>
                                                    <li data-value="rating" class="option">Price (Low &gt; High)</li>
                                                    <li data-value="date" class="option">Rating (Lowest)</li>
                                                    <li data-value="price-asc" class="option">Model (A - Z)</li>
                                                    <li data-value="price-asc" class="option">Model (Z - A)</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop product top wrap start -->
                        <div class="shop-product-wrap grid-view row mb-4">
                            <!-- product item list wrapper start -->
                            <?php foreach ($listSanPham as $sanPham): ?>
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <!-- product grid start -->
                                    <div class="product-item shadow-sm p-3 mb-5 bg-white rounded">
                                        <figure class="product-thumb">
                                            <a
                                                href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                                <img class="pri-img img-fluid" src="<?= BASE_URL . '/uploads/' . $sanPham['hinh_anh'] ?>"
                                                    width="500" height="300" alt="product-main">
                                                <img class="sec-img img-fluid" src="<?= BASE_URL . '/uploads/' . $sanPham['hinh_anh'] ?>"
                                                    width="500" height="300" alt="product-secondary">
                                            </a>

                                            <div class="product-badge">
                                                <?php
                                                // Hiển thị nhãn "Mới" nếu sản phẩm mới trong vòng 7 ngày
                                                $ngayNhap = formatDate($sanPham['ngay_nhap']);
                                                $ngayHienTai = new DateTime();
                                                $tinhNgay = $ngayHienTai->diff(new DateTime($sanPham['ngay_nhap']));

                                                if ($tinhNgay->days <= 7): ?>
                                                    <div class="product-label new">
                                                        <span>Mới</span>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($sanPham['gia_khuyen_mai']) && $sanPham['gia_khuyen_mai'] < $sanPham['gia_san_pham']): ?>
                                                    <div class="product-label discount">
                                                        <span>Giảm giá</span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="button-group">
                                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                                    title="Thêm vào yêu thích"><i class="pe-7s-like"></i></a>
                                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                                    title="So sánh"><i class="pe-7s-refresh-2"></i></a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="Xem nhanh"><i class="pe-7s-search"></i></span></a>
                                            </div>
                                        </figure>
                                        <div class="product-caption text-center">
                                            <h6 class="product-name">
                                                <a
                                                    href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                                    <?= htmlspecialchars($sanPham['ten_san_pham']) ?>
                                                </a>
                                            </h6>
                                            <div class="price-box">
                                                <?php if (!empty($sanPham['gia_khuyen_mai']) && $sanPham['gia_khuyen_mai'] < $sanPham['gia_san_pham']): ?>
                                                    <span
                                                        class="price-regular text-success">$<?= number_format($sanPham['gia_khuyen_mai'], 2) ?></span>
                                                    <span
                                                        class="price-old text-muted"><del>$<?= number_format($sanPham['gia_san_pham'], 2) ?></del></span>
                                                <?php else: ?>
                                                    <span
                                                        class="price-regular">$<?= number_format($sanPham['gia_san_pham'], 2) ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product grid end -->
                                </div>
                            <?php endforeach; ?>
                            <!-- product item list wrapper end -->

                            <!-- start pagination area -->
                            <div class="col-12">
                                <div class="pagination-area text-center">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="pe-7s-angle-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="pe-7s-angle-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end pagination area -->
                        </div>

                    </div>
                    <!-- shop main wrapper end -->
                </div>
            </div>
        </div>
    </div>


</main>



<!-- offcanvas mini cart start -->
<?php require_once 'layout/miniCart.php' ?>
<!-- offcanvas mini cart end -->

<?php require_once 'layout/footer.php' ?>