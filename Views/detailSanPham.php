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
.main-image-wrapper {width:100%;border:1px solid #eee;overflow:hidden;border-radius:8px;}
.main-image-wrapper img {width:100%;transition:transform 0.3s ease-in-out;}
.main-image-wrapper:hover img {transform:scale(1.5);cursor:zoom-in;}
.thumb-list {margin-top:15px;display:flex;flex-direction:column;gap:10px;}
.thumb-item img {width:80px;height:80px;border:1px solid #ddd;border-radius:4px;cursor:pointer;transition:all 0.2s;}
.thumb-item img:hover {border-color:#000;}

/* =================== THÔNG TIN SẢN PHẨM =================== */
.detail-right {flex:1 1 50%;}
.product-name {font-size:26px;font-weight:bold;margin-bottom:15px;}
.product-price {font-size:22px;font-weight:bold;color:#e53935;margin-bottom:10px;}
.product-old-price {font-size:18px;color:#999;text-decoration:line-through;margin-left:10px;}
.availability {font-size:15px;color:#28a745;margin-bottom:15px;}
.product-desc {font-size:16px;line-height:1.5;margin-bottom:25px;}
.option-title {font-weight:600;font-size:15px;margin-right:10px;}
.size-list button {border:1px solid #ddd;padding:6px 12px;margin-right:8px;background:#fff;cursor:pointer;border-radius:4px;}
.size-list button.active {border-color:#000;background:#000;color:#fff;}
.quantity-box {display:flex;align-items:center;margin:20px 0;}
.quantity-box input[type="number"] {width:60px;height:38px;text-align:center;border:1px solid #ccc;border-radius:4px;margin:0 10px;}
.btn-buy,.btn-cart {background:#000;color:#fff;border:none;padding:12px 28px;font-size:15px;cursor:pointer;border-radius:6px;transition:0.3s;margin-right:15px;}
.btn-buy:hover,.btn-cart:hover {background:#333;}

/* =================== BÌNH LUẬN =================== */
.review-section {margin-top:50px;}
.review-section h3 {font-size:22px;margin-bottom:20px;}
.review-item {border-bottom:1px solid #eee;padding:15px 0;}
.review-item:last-child{border-bottom:none;}
.review-item .avatar {width:40px;height:40px;border-radius:50%;margin-right:10px;}
.review-item .info {display:flex;align-items:center;margin-bottom:5px;}
.review-item .info strong{margin-right:10px;}
.review-form textarea {width:100%;border:1px solid #ccc;border-radius:6px;padding:10px;resize:none;}
.review-form button {margin-top:10px;}

/* =================== SẢN PHẨM LIÊN QUAN =================== */
.related-products {margin-top:60px;}
.related-products h3 {font-size:24px;margin-bottom:20px;text-align:center;}
.related-list {display:flex;flex-wrap:wrap;gap:20px;justify-content:center;}
.related-item {width:200px;text-align:center;border:1px solid #eee;border-radius:8px;overflow:hidden;transition:transform 0.3s;}
.related-item:hover{transform:translateY(-5px);}
.related-item img{width:100%;height:auto;}
.related-item h4{font-size:16px;margin:10px 0;}
.related-item .price{color:#e53935;font-weight:bold;}
</style>

<div class="container-detail">
    <div class="detail-left">
        <div class="main-image-wrapper">
            <img src="<?= BASE_URL . $listAnhSanPham[0]['link_hinh_anh'] ?>" alt="product-main">
        </div>
        <div class="thumb-list">
            <?php foreach ($listAnhSanPham as $anh): ?>
            <div class="thumb-item">
                <img src="<?= BASE_URL . $anh['link_hinh_anh'] ?>" onclick="document.querySelector('.main-image-wrapper img').src=this.src;">
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="detail-right">
        <nav class="breadcrumb">
            <a href="<?= BASE_URL ?>"><i class="fa fa-home"></i> Trang chủ</a> / 
            <a href="<?= BASE_URL . '?act=' ?>">Sản phẩm</a> / 
            <span><?= htmlspecialchars($sanPham['ten_san_pham']) ?></span>
        </nav>
        <h1 class="product-name"><?= htmlspecialchars($sanPham['ten_san_pham']) ?></h1>
        <div class="product-price">
            <?= formatPrice($sanPham['gia_khuyen_mai'] ?: $sanPham['gia_san_pham']) ?>đ
            <?php if($sanPham['gia_khuyen_mai']){ ?>
                <span class="product-old-price"><?= formatPrice($sanPham['gia_san_pham']) ?>đ</span>
            <?php } ?>
        </div>
        <div class="availability">Còn hàng: <?= htmlspecialchars($sanPham['so_luong']) ?> sản phẩm</div>
        <div class="product-desc"><?= htmlspecialchars($sanPham['mo_ta']) ?></div>

        <form onsubmit="return themVaoGioHangAjax(this, event)">
            <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
            <div class="quantity-box">
                <span class="option-title">Số lượng:</span>
                <input type="number" name="so_luong" value="1" min="1" max="<?= $sanPham['so_luong'] ?>">
            </div>
            <button type="submit" class="btn-cart">Thêm vào giỏ hàng</button>
            <a href="<?= BASE_URL . '?act=thanh-toan' ?>" class="btn-buy">Mua ngay</a>
        </form>
    </div>
</div>

<div class="container-detail review-section">
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

<script>
function themVaoGioHangAjax(form, event){
    event.preventDefault();
    let formData=new FormData(form);
    fetch('<?= BASE_URL . '?act=them-gio-hang' ?>',{method:'POST',body:formData})
    .then(res=>res.text())
    .then(data=>alert('Đã thêm vào giỏ hàng!'))
    .catch(()=>alert('Có lỗi xảy ra!'));
    return false;
}
</script>

<?php require_once 'layout/footer.php'; ?>
