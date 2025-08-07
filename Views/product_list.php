<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<div class="container mt-4">
    <h2 class="mb-4">Áo PoLo</h2>

    <!-- Bộ lọc + Sắp xếp -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <!-- Bộ lọc -->
        <form method="GET" action="" class="d-flex flex-wrap gap-2">
            <input type="hidden" name="act" value="products">

            <!-- Màu sắc -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Màu sắc
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="?act=products">Tất cả</a></li>
                    <?php foreach (['Đỏ', 'Vàng', 'Đen', 'Xám', 'Xanh', 'Nâu'] as $color): ?>
                        <li>
                            <button class="dropdown-item" type="submit" name="color" value="<?= $color ?>"><?= $color ?></button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Kích cỡ -->
            <div class="dropdown">
                
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Kích cỡ
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="?act=products">Tất cả</a></li>
                    <?php foreach (['M', 'L', 'XL', 'XXL', '3XL'] as $size): ?>
                        <li>
                            <button class="dropdown-item" type="submit" name="size" value="<?= $size ?>"><?= $size ?></button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Khoảng giá -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Khoảng giá
                </button>
                <ul class="dropdown-menu">
                    <li><button class="dropdown-item" type="submit" name="price" value="">Tất cả</button></li>
                    <li><button class="dropdown-item" type="submit" name="price" value="1">Dưới 500k</button></li>
                    <li><button class="dropdown-item" type="submit" name="price" value="2">500k - 1tr</button></li>
                    <li><button class="dropdown-item" type="submit" name="price" value="3">Trên 1tr</button></li>
                </ul>
            </div>
        </form>

        <!-- Sắp xếp -->
        <form method="GET" action="" class="d-flex align-items-center gap-2">
            <input type="hidden" name="act" value="products">
            <?php
                // giữ lại tham số filter
                foreach (['color', 'size', 'price', 'category', 'keyword'] as $param) {
                    if (!empty($_GET[$param])) {
                        echo '<input type="hidden" name="'.$param.'" value="'.htmlspecialchars($_GET[$param]).'">';
                    }
                }
            ?>
            <label class="mb-0">Sắp xếp theo:</label>
            <select name="sort" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                <option value="">Mặc định</option>
                <option value="date" <?= isset($_GET['sort']) && $_GET['sort'] == 'date' ? 'selected' : '' ?>>Mới nhất</option>
                <option value="price_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_asc' ? 'selected' : '' ?>>Giá tăng</option>
                <option value="price_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_desc' ? 'selected' : '' ?>>Giá giảm</option>
            </select>
        </form>
    </div>

    <!-- Lưới sản phẩm -->
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 mb-4">
        <?php foreach ($products as $p): ?>
            <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $p['id'] ?>">
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 position-relative">
                        <?php if ($p['gia_khuyen_mai'] > 0): ?>
                            <span class="position-absolute top-0 start-0 badge bg-danger">SALE</span>
                        <?php endif; ?>
                        <div class="ratio ratio-1x1">
                            <img src="<?= htmlspecialchars($p['hinh_anh']) ?>" class="card-img-top object-fit-cover" alt="<?= htmlspecialchars($p['ten_san_pham']) ?>">
                        </div>
                        <div class="card-body text-center">
                            <h6 class="card-title mb-2" style="min-height: 3em;"><?= htmlspecialchars($p['ten_san_pham']) ?></h6>
                            <?php if ($p['gia_khuyen_mai'] > 0): ?>
                                <p class="card-text mb-0">
                                    <span class="text-muted text-decoration-line-through"><?= number_format($p['gia_san_pham']) ?>đ</span><br>
                                    <span class="fw-bold text-danger"><?= number_format($p['gia_khuyen_mai']) ?>đ</span>
                                </p>
                            <?php else: ?>
                                <p class="card-text fw-bold"><?= number_format($p['gia_san_pham']) ?>đ</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Phân trang -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?act=products&page_num=<?= $i ?>
                        <?= !empty($_GET['keyword']) ? '&keyword=' . urlencode($_GET['keyword']) : '' ?>
                        <?= !empty($_GET['color']) ? '&color=' . urlencode($_GET['color']) : '' ?>
                        <?= !empty($_GET['size']) ? '&size=' . urlencode($_GET['size']) : '' ?>
                        <?= !empty($_GET['price']) ? '&price=' . urlencode($_GET['price']) : '' ?>
                        <?= !empty($_GET['category']) ? '&category=' . urlencode($_GET['category']) : '' ?>
                        <?= !empty($_GET['sort']) ? '&sort=' . urlencode($_GET['sort']) : '' ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

    
</div>


<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>

