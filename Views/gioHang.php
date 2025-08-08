<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<div class="cart-main-wrapper section-padding">
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
                                    <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- cart main wrapper start -->
        <div class="cart-main-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <form action="<?= BASE_URL . '?act=cap-nhat-gio-hang' ?>" method="POST">
                                <div class="cart-table table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="pro-thumbnail">Ảnh sản phẩm</th>
                                                <th class="pro-title">Tên sản phẩm</th>
                                                <th class="pro-price">Giá</th>
                                                <th class="pro-quantity">Số lượng</th>
                                                <th class="pro-subtotal">Tổng tiền</th>
                                                <th class="pro-remove">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $tongGioHang = 0;

                                            foreach ($chiTietGioHang as $sanPham) {
                                                $giaSanPham = $sanPham['gia_khuyen_mai'] > 0 ? $sanPham['gia_khuyen_mai'] : $sanPham['gia_san_pham'];
                                                $tongTien = $giaSanPham * $sanPham['so_luong'];
                                                $tongGioHang += $tongTien;
                                            ?>
                                                <tr>
                                                    <td class="pro-thumbnail">
                                                        <img class="img-fluid" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= $sanPham['ten_san_pham'] ?>">
                                                    </td>
                                                    <td class="pro-title"><?= $sanPham['ten_san_pham'] ?></td>
                                                    
                                                    <td class="pro-price">
                                                        <span><?= formatPrice($giaSanPham) . ' đ' ?></span>
                                                    </td>
                                                    <td class="pro-quantity">
                                                        <div class="pro-qty">
                                                            <input type="number" name="so_luong[]" value="<?= $sanPham['so_luong'] ?>" min="1">
                                                            <input type="hidden" name="san_pham_id[]" value="<?= $sanPham['san_pham_id'] ?>" >
                                                        </div>
                                                    </td>
                                                    <?php
                                                    $size = isset($sanPham['size']) && $sanPham['size'] != '' ? $sanPham['size'] : 'L';
                                                    $mau_sac = isset($sanPham['mau_sac']) && $sanPham['mau_sac'] != '' ? $sanPham['mau_sac'] : 'xanh';
                                                    ?>

                                                    <td><?= htmlspecialchars($size) ?></td>
                                                    <td><?= htmlspecialchars($mau_sac) ?></td>


                                                    <td class="pro-subtotal">
                                                        <span><?= formatPrice($tongTien) . ' đ' ?></span>
                                                    </td>
                                                    <td class="pro-remove" style="text-align:center;">
                                                        <a href="<?= BASE_URL . '?act=xoaSanPhamGioHang&id_chi_tiet_gio_hang=' . $sanPham['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');" class="btn btn-danger" style="font-size:18px; padding:6px 16px; border-radius:6px; display:inline-block;">
                                                            <i class="fa fa-trash-o"></i> Xóa
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-sqr btn-primary">Cập Nhật Giỏ Hàng</button>
                            </form>

                    </div>
                    <div class="row">
                        <div class="col-lg-5 ml-auto">
                            <!-- Cart Calculation Area -->
                            <div class="cart-calculator-wrapper">
                                <div class="cart-calculate-items">
                                    <h6>Tổng đơn hàng</h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>Tổng tiền sản phẩm</td>
                                                <td><?= formatPrice($tongGioHang) . 'đ' ?></td>
                                            </tr>
                                           
                                            <tr class="total">
                                                <td>Tổng thanh toán</td>
                                                <td class="total-amount"><?= formatPrice($tongGioHang) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <a href="<?= BASE_URL . '?act=thanh-toan' ?>" class="btn btn-sqr d-block">Tiến hành đặt
                                    hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart main wrapper end -->
    </main>
</div>
<!-- cart main wrapper end -->

<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>
