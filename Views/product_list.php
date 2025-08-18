<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<style>
/* RESET MỘT SỐ MẶC ĐỊNH */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
}

/* FORM LỌC */
.filter-form-wrapper {
    width: 1441px;
    margin: 0 auto;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
    background: #FFFFFF;
    
}

.dropdown {
    position: relative;
}

.dropdown-toggle {
    padding: 8px 16px;
    cursor: pointer;
    border: 1px solid #ccc;
    background-color: white;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 100;
    background: white;
    border: 1px solid #ccc;
    
    width: 150px;
    display: none;
    flex-direction: column;
}

.dropdown:hover .dropdown-menu {
    display: flex;
}

.dropdown-item {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 14px;
    padding: 8px;
    border-bottom: 1px solid #eee;
    background-color: white;
    text-align: left;
}

.dropdown-item:hover {
    background-color: #f0f0f0;
}

/* SẮP XẾP */
.sort-form {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* LƯỚI SẢN PHẨM */
.product-grid {
    margin-left: 85px;
    width: 1360px;
    display: grid;
    grid-template-columns: repeat(4, 300px);
    gap: 50px;
}

.product-card {
    width: 300px;
    height: 452px;
    overflow: hidden;
    position: relative;
    text-align: center;
    background: white;
    text-decoration:     none;
    color: black;
}
.product-card:hover{
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    transform: scale(1.01);
    display: block;
    transition: all 0.5s;
}
.product-card:hover .a {
    display: block;
    transition: all 0.5s;
}

.product-card img {
    width: 100%;
    height: 300px;
    object-fit: cover;
}

.product-card .info {
    padding: 10px;
}

.product-card h6 {
    font-size: 16px;
    min-height: 3em;
}

.product-card .price {
    margin-top: -45PX;
    font-weight: bold;
    color: #333;
}

.product-card .old-price {
    text-decoration: line-through;
    color: #999;
    font-size: 14px;
}

.badge-sale {
    position: absolute;
    top: 10px;
    left: 10px;
    background: red;
    color: white;
    padding: 4px 8px;
    font-size: 12px;
    border-radius: 4px;
}

/* PHÂN TRANG */
.pagination {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin: 30px 0;
    list-style: none;
}

.pagination li a {
    display: block;
    padding: 8px 12px;
    border: 1px solid #ccc;
    text-decoration: none;
    color: #333;
    border-radius: 4px;
}

.pagination .active a {
    background: #333;
    color: white;
}
.home {
    margin: 0 auto;
    width: 100%;
    height: 38px;
    background-color: #FFFFFF;
    border-bottom: 0.05px solid #F5F5F5
;
      /* Bóng đổ phía trên */
    
    color: black;
    line-height: 38px;
}
.iconhome{
    float: left;
    margin-left: 110px;
    margin-right: 10px;
    
}
.iconhome li{
    list-style: none;
}
.gach{
    float: left;
    margin-right: 10px;
}
.iconsanpham a{
    color: #777777;
    
}
.h2 h2{
    font-family: sans-serif;
    font-size: 28px;
    color: #252a2b;
    font-weight: 500;
    margin-left: 40px;
    margin-top: 40px;
}
.a{
    width: 50%;
    float: left;
    height: 40px;
    background-color: black;
    color: white;
    margin-top: 40px;
    line-height: 40px;
    border-left: 1px solid white ;
    display: none;
}

.a a{
    color: white;
}
</style>
<div class="home">
    <div class="iconhome">
    <li class="breadcrumb-item">
        <a href="<?=BASE_URL?>" style="color: #444444		;">
            <i class="fa fa-home" style="color: black;"></i> Trang chủ
        </a>
    </li>
</div>

    <div class="gach">
        |
    </div>
    <div class="iconsanpham">
        <a href="">Sản Phẩm</a>
    </div>
</div>
         <div class="h2">
             <h2>Sản Phẩm</h2>
         </div>   
<div class="filter-form-wrapper">   
    <form method="GET" action="" class="d-flex" style="gap: 20px;">
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
