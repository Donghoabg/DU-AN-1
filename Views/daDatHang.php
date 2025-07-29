<?php require_once 'layout/header.php' ?>

<?php require_once 'layout/menu.php' ?>
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Thông báo</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- checkout main wrapper start -->
    <div class="checkout-page-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php if (isset($_SESSION['dat_hang_thanh_cong'])) { ?>
                        <div class="alert alert-info alert-dismissable">
                            <a href="" class="panel-close close" data-dismiss="alert"></a>
                            <i class="fa fa-coffee"></i>
                            <?= $_SESSION['dat_hang_thanh_cong']?>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <p class="text-success">Ngày đặt: <?=$thongTinDonHang[0]['ngay_dat'] ?></p>
            <p class="text-success">Mã đơn hàng: <?=$thongTinDonHang[0]['ma_don_hang']?></p>
            <p class="text-success">Trạng thái đơn hàng: <?=$thongTinDonHang[0]['ten_trang_thai']?></p>

            <div class="row">
                <!-- Checkout Billing Details -->
                <div class="col-lg-6">
                    <div class="checkout-billing-details-wrap">
                        <h5 class="checkout-title">Thông tin người nhận</h5>
                        <div class="billing-form-wrap">


                            <div class="row">
                                <div class="single-input-item">
                                    <label for="ten_nguoi_nhan" class="required">Tên người nhận</label>
                                    <input type="text" id="ten_nguoi_nhan" name="ten_nguoi_nhan" value="<?= $thongTinDonHang[0]['ten_nguoi_nhan'] ?>" placeholder="Tên người nhận" disabled />
                                </div>

                                <div class="single-input-item">
                                    <label for="email_nguoi_nhan" class="required">Địa chỉ email</label>
                                    <input type="email" id="email_nguoi_nhan" name="email_nguoi_nhan" value="<?= $thongTinDonHang[0]['email_nguoi_nhan'] ?>" placeholder="Email" disabled />
                                </div>

                                <div class="single-input-item">
                                    <label for="sdt_nguoi_nhan" class="required">Số điện thoại</label>
                                    <input type="text" id="sdt_nguoi_nhan" name="sdt_nguoi_nhan" value="<?= $thongTinDonHang[0]['sdt_nguoi_nhan'] ?>" placeholder="Sdt" disabled />
                                </div>

                                <div class="single-input-item">
                                    <label for="dia_chi_nguoi_nhan" class="required">Địa chỉ người nhận</label>
                                    <input type="text" id="dia_chi_nguoi_nhan" name="dia_chi_nguoi_nhan" value="<?= $thongTinDonHang[0]['dia_chi_nguoi_nhan'] ?>" placeholder="Địa chỉ" disabled />
                                </div>


                                <div class="single-input-item">
                                    <label for="ghi_chu">Ghi chú</label>
                                    <textarea name="ghi_chu" id="ghi_chu" cols="30" rows="3" disabled><?= $thongTinDonHang[0]['ghi_chu'] ?></textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Details -->
                <div class="col-lg-6">
                    <div class="order-summary-details">
                        <h5 class="checkout-title">Thông tin sản phẩm</h5>
                        <div class="order-summary-content">
                            <!-- Order Summary Table -->
                            <div class="order-summary-table table-responsive text-center">
                                <table class="table table-bordered">



                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php
                                        $tongGioHang = 0;

                                        foreach ($chiTietGioHang as $key => $sanPham) {

                                        ?>
                                            <tr>
                                                <td><a href="product-details.html"><?= $sanPham['ten_san_pham'] ?><strong> × <?= $sanPham['so_luong'] ?></strong></a>
                                                </td>
                                                <td>
                                                    <?php
                                                    $tongTien = 0;
                                                    if ($sanPham['gia_khuyen_mai'] > 0) {
                                                        $tongTien = $sanPham['gia_khuyen_mai'] * $sanPham['so_luong'];
                                                    } else {
                                                        $tongTien = $sanPham['gia_san_pham'] * $sanPham['so_luong'];
                                                    }
                                                    $tongGioHang += $tongTien;
                                                    echo formatPrice( $tongTien ). ' đ';
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Tổng tiền sản phẩm</td>
                                            <td><strong><?= formatPrice( $tongGioHang) . ' đ' ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td class="d-flex justify-content-center">
                                                <strong>30.000 đ</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tổng đơn hàng</td>
                                            <input type="hidden" name="tong_tien" value="<?= $tongGioHang + 30000 ?>">
                                            <td><strong><?= formatPrice( $tongGioHang + 30000) . ' đ' ?></strong></td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                            <!-- Order Payment Method -->
                            <div class="order-payment-method">
                                <div class="single-payment-method show">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <?php
                                            $phuongThucThanhToan = $thongTinDonHang[0]['phuong_thuc_thanh_toan_id'];
                                            if ($phuongThucThanhToan === 1) {
                                                $PTTT = 'Thanh toán khi nhận hàng';
                                            } else {
                                                $PTTT = 'Thanh toán qua banking (ONLINE)';
                                            }

                                            ?>
                                            <p class="text-success">Phương thức thanh toán: <?= $PTTT?></label></p>

                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

    <!-- checkout main wrapper end -->
</main>

<?php require_once 'layout/miniCart.php' ?>

<?php require_once 'layout/footer.php' ?>