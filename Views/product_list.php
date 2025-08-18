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
            <div class="dropdown-toggle">Màu sắc</div>
            <div class="dropdown-menu">
                <button class="dropdown-item" type="submit" name="color" value="">Tất cả</button>
                <?php foreach (['Đỏ', 'Vàng', 'Đen', 'Xám', 'Xanh', 'Nâu'] as $color): ?>
                    <button class="dropdown-item" type="submit" name="color" value="<?= $color ?>"><?= $color ?></button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Kích cỡ -->
        <div class="dropdown">
            <div class="dropdown-toggle">Kích cỡ</div>
            <div class="dropdown-menu">
                <button class="dropdown-item" type="submit" name="size" value="">Tất cả</button>
                <?php foreach (['M', 'L', 'XL', 'XXL', '3XL'] as $size): ?>
                    <button class="dropdown-item" type="submit" name="size" value="<?= $size ?>"><?= $size ?></button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Khoảng giá -->
        <div class="dropdown">
            <div class="dropdown-toggle">Khoảng giá</div>
            <div class="dropdown-menu">
                <button class="dropdown-item" type="submit" name="price" value="">Tất cả</button>
                <button class="dropdown-item" type="submit" name="price" value="1">Dưới 100k</button>
                <button class="dropdown-item" type="submit" name="price" value="2">100k - 500k</button>
                <button class="dropdown-item" type="submit" name="price" value="3">Trên 500k</button>
            </div>
        </div>
    </form>

    <!-- Sắp xếp -->
    <form method="GET" action="" class="sort-form">
        <input type="hidden" name="act" value="products">
        <?php
        foreach (['color', 'size', 'price', 'category', 'keyword'] as $param) {
            if (!empty($_GET[$param])) {
                echo '<input type="hidden" name="'.$param.'" value="'.htmlspecialchars($_GET[$param]).'">';
            }
        }
        ?>
        <label for="sort">Sắp xếp:</label>
        <select name="sort" onchange="this.form.submit()">
            <option value="">Mặc định</option>
            <option value="date" <?= isset($_GET['sort']) && $_GET['sort'] == 'date' ? 'selected' : '' ?>>Mới nhất</option>
            <option value="price_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_asc' ? 'selected' : '' ?>>Giá Thấp - Cao</option>
            <option value="price_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_desc' ? 'selected' : '' ?>>Giá Cao - Thấp</option>
        </select>
    </form>
</div>

<!-- Lưới sản phẩm -->
<div class="product-grid">
    <?php foreach ($products as $p): ?>
        <div class="product-card">
            <?php if ($p['gia_khuyen_mai'] > 0): ?>
                <span class="badge-sale">SALE</span>
            <?php endif; ?>
            
            <!-- Ảnh click được -->
            <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $p['id'] ?>">
                <img src="<?= htmlspecialchars($p['hinh_anh']) ?>" alt="<?= htmlspecialchars($p['ten_san_pham']) ?>">
            </a>

            <div class="info">
                <h6><?= htmlspecialchars($p['ten_san_pham']) ?></h6>
                <?php if ($p['gia_khuyen_mai'] > 0): ?>
                    <div class="old-price"><?= number_format($p['gia_san_pham']) ?>đ</div>
                    <div class="price"><?= number_format($p['gia_khuyen_mai']) ?>đ</div>
                <?php else: ?>
                    <div class="price"><?= number_format($p['gia_san_pham']) ?>đ</div>
                <?php endif; ?>
            </div>

            <!-- Hover để hiện link "xem chi tiết" -->
            <div class="a">
                <a href="">Thêm Giỏ Hàng</a>
                
            </div>
            
            <div class="a"><a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $p['id'] ?>"> Xem chi tiết </a></div>
        </div>
    <?php endforeach; ?>
</div>


<!-- PHÂN TRANG -->
<ul class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="<?= $i == $page ? 'active' : '' ?>">
            <a href="?act=products&page_num=<?= $i ?>
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

<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>
