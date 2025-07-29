<?php require_once 'layout/header.php'; ?>
<link rel="stylesheet" href="views/assets/lichSuMuaHang.css">
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
                                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bills</li>
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
            <div class="container lsmh-center-wrapper">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered lsmh-table">
                                    <thead>
                                        <tr>
                                            <th >Mã Đơn Hàng</th>
                                            <th >Ngày Đặt</th>
                                            <th >Tổng tiền</th>
                                            <th >Phương thức thanh toán</th>
                                            <th >Trạng thái đơn hàng</th>
                                            <th >Trạng thái thanh toán</th>
                                            <th >Thao tác</th>
                                        </tr>
                                    </thead>
                                  <tbody>
                                    <?php 
                                      foreach($donHangs as $donHang) : 
                                    ?>
                                         <tr>
                                            <th class="text-center" ><?=$donHang['ma_don_hang'] ?></th>
                                            <td><?=$donHang['ngay_dat'] ?></td>
                                            <td><?= formatPrice($donHang['tong_tien'])  ?> đ</td>
                                            <td><?= $PhuongThucThanhToan[$donHang['phuong_thuc_thanh_toan_id']] ?></td>
                                            <td>
                                                <?php
                                                    $trangThai = $trangThaiDonHang[$donHang['trang_thai_id']];
                                                    $badgeClass = 'lsmh-status-badge';
                                                    switch (mb_strtolower($trangThai)) {
                                                        case 'chờ xác nhận':
                                                            $badgeClass .= ' processing'; break;
                                                        case 'đang chuẩn bị hàng':
                                                            $badgeClass .= ' processing'; break;
                                                        case 'đang giao hàng':
                                                            $badgeClass .= ' shipping'; break;
                                                        case 'đã giao':
                                                            $badgeClass .= ' success'; break;
                                                        case 'thành công':
                                                            $badgeClass .= ' success'; break;
                                                        case 'đã hủy':
                                                            $badgeClass .= ' cancel'; break;
                                                        default:
                                                            $badgeClass .= ' other'; break;
                                                    }
                                                ?>
                                                <span class="<?= $badgeClass ?>"><?= $trangThai ?></span>
                                            </td>
                                            <td>
                                                <?php
                                                    $trangThaiDaThanhToan = [10, 12, 11]; // Đã Giao, Thành Công, Đã Nhận
                                                    $tttt_id = isset($donHang['trang_thai_thanh_toan_id']) ? $donHang['trang_thai_thanh_toan_id'] : null;
                                                    $class = 'lsmh-status-badge';
                                                    $text = '';
                                                    if (isset($donHang['trang_thai_id']) && in_array($donHang['trang_thai_id'], $trangThaiDaThanhToan)) {
                                                        $class .= ' paid';
                                                        $text = isset($trangThaiThanhToan[2]) ? $trangThaiThanhToan[2] : 'Đã Thanh toán';
                                                    } else if ($tttt_id === null) {
                                                        $class .= ' unpaid';
                                                        $text = 'Chưa thanh toán';
                                                    } else {
                                                        $text = isset($trangThaiThanhToan[$tttt_id]) ? $trangThaiThanhToan[$tttt_id] : 'Chưa thanh toán';
                                                        if ($tttt_id == 2) $class .= ' paid';
                                                        else if ($tttt_id == 1) $class .= ' unpaid';
                                                    }
                                                ?>
                                                <span class="<?= $class ?>"><?= $text ?></span>
                                            </td>
                                            <td>
                                                <div class="lsmh-action-group">
                                                    <a href="<?= BASE_URL?>?act=chi-tiet-mua-hang&id=<?=$donHang['id'] ?>" class="lsmh-action-btn">
                                                        Chi tiết đơn hàng
                                                    </a>
                                                    <?php if($donHang['trang_thai_id']== 1) : ?>
                                                        <a href="<?= BASE_URL?>?act=huy-don-hang&id=<?=$donHang['id'] ?>" class="lsmh-action-btn cancel"
                                                            onclick="return confirm('Xác nhận hủy đơn hàng') ">
                                                            Hủy
                                                        </a>
                                                    <?php endif ; ?>
                                                </div>
                                            </td>
                                         </tr>                          
                                    <?php 
                                      endforeach;
                                    ?>
                                  </tbody>
                                </table>
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


