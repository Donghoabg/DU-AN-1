<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>
<h2>Danh sách sản phẩm</h2>

<form method="GET" action="">
    <input type="hidden" name="act" value="products">
    Màu:
    <select name="color">
        <option value="">-- Tất cả --</option>
        <?php foreach (['Đỏ', 'Vàng', 'Đen', 'Xám', 'Xanh', 'Nâu'] as $color): ?>
            <option value="<?= $color ?>" <?= isset($_GET['color']) && $_GET['color'] == $color ? 'selected' : '' ?>><?= $color ?></option>
        <?php endforeach; ?>
    </select>

    Size:
    <select name="size">
        <option value="">-- Tất cả --</option>
        <?php foreach (['M', 'L', 'XL', 'XXL', '3XL'] as $size): ?>
            <option value="<?= $size ?>" <?= isset($_GET['size']) && $_GET['size'] == $size ? 'selected' : '' ?>><?= $size ?></option>
        <?php endforeach; ?>
    </select>

    Giá:
    <select name="price">
        <option value="">-- Tất cả --</option>
        <option value="1" <?= isset($_GET['price']) && $_GET['price'] == '1' ? 'selected' : '' ?>>Dưới 500k</option>
        <option value="2" <?= isset($_GET['price']) && $_GET['price'] == '2' ? 'selected' : '' ?>>500k - 1tr</option>
        <option value="3" <?= isset($_GET['price']) && $_GET['price'] == '3' ? 'selected' : '' ?>>Trên 1tr</option>
    </select>

    Danh mục:
    <select name="category">
        <option value="">-- Tất cả --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= isset($_GET['category']) && $_GET['category'] == $cat['id'] ? 'selected' : '' ?>>
                <?= $cat['ten_danh_muc'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    Sắp xếp:
    <select name="sort">
        <option value="">-- Mặc định --</option>
        <option value="price_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_asc' ? 'selected' : '' ?>>Giá tăng</option>
        <option value="price_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_desc' ? 'selected' : '' ?>>Giá giảm</option>
        <option value="date" <?= isset($_GET['sort']) && $_GET['sort'] == 'date' ? 'selected' : '' ?>>Mới nhất</option>
    </select>

    <button type="submit">Lọc</button>
</form>

<table border="1" cellpadding="5">
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ảnh</th>
        <th>Giá gốc</th>
        <th>Giá KM</th>
        <th>Màu</th>
        <th>Size</th>
        <th>Ngày nhập</th>
    </tr>
    <?php foreach ($products as $index => $p): ?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= $p['ten_san_pham'] ?></td>
            <td><img src="<?= $p['hinh_anh'] ?>" width="60"></td>
            <td><?= number_format($p['gia_san_pham']) ?>đ</td>
            <td style="color:red"><?= number_format($p['gia_khuyen_mai']) ?>đ</td>
            <td><?= $p['mau_sac'] ?></td>
            <td><?= $p['kich_co'] ?></td>
            <td><?= $p['ngay_nhap'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- FORM TÌM KIẾM GIỮ LẠI CÁC THAM SỐ -->
<form method="get" action="">
    <input type="hidden" name="act" value="products">
    <input type="hidden" name="color" value="<?= htmlspecialchars($_GET['color'] ?? '') ?>">
    <input type="hidden" name="size" value="<?= htmlspecialchars($_GET['size'] ?? '') ?>">
    <input type="hidden" name="price" value="<?= htmlspecialchars($_GET['price'] ?? '') ?>">
    <input type="hidden" name="category" value="<?= htmlspecialchars($_GET['category'] ?? '') ?>">
    <input type="hidden" name="sort" value="<?= htmlspecialchars($_GET['sort'] ?? '') ?>">
    <input type="text" name="keyword" placeholder="Tìm kiếm..." value="<?= htmlspecialchars($keyword ?? '') ?>">
    <input type="submit" value="Tìm">
</form>
<?php
echo '<pre>';
print_r($filters);
echo '</pre>';

?>
<!-- PHÂN TRANG GIỮ ĐỦ THAM SỐ -->
<div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?act=products&page_num=<?= $i ?>
            &keyword=<?= urlencode($keyword ?? '') ?>
            &color=<?= urlencode($_GET['color'] ?? '') ?>
            &size=<?= urlencode($_GET['size'] ?? '') ?>
            &price=<?= urlencode($_GET['price'] ?? '') ?>
            &category=<?= urlencode($_GET['category'] ?? '') ?>
            &sort=<?= urlencode($_GET['sort'] ?? '') ?>"
            <?= $i == $page ? 'style="font-weight:bold"' : '' ?>>
            <?= $i ?>
        </a>
    <?php endfor; ?>
</div>

<a href="index.php?page=admin_products" class="btn btn-primary">Trang Admin</a>

<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>
