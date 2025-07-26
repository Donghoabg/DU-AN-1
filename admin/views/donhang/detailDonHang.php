<!-- header -->
<?php include "./views/layout/header.php"; ?>
<!-- end header -->

<?php
function formatVND($number) {
    $number = preg_replace('/[^\d\.\-]/', '', $number);
    return number_format((float)$number, 0, ',', '.') . ' đ';
}
?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <?php include "./views/layout/navbar.php"; ?>
    <!-- /.navbar -->

    <!-- Sidebar -->
    <?php include "./views/layout/sidebar.php"; ?>
    <!-- /.sidebar -->

    <!-- Content Wrapper -->
    <div class="content-wrapper">

        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-9">
                        <h1>Quản lý đơn hàng: <?= $donHang['ma_don_hang'] ?? 'Không xác định' ?></h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <?php
                        $trangThaiID = $donHang['trang_thai_id'] ?? 0;
                        if ($trangThaiID == 1) {
                            $colorAlerts = 'primary';
                        } elseif ($trangThaiID >= 2 && $trangThaiID <= 9) {
                            $colorAlerts = 'warning';
                        } elseif ($trangThaiID == 10) {
                            $colorAlerts = 'success';
                        } else {
                            $colorAlerts = 'danger';
                        }
                        ?>

                        <div class="alert alert-<?= $colorAlerts ?>" role="alert">
                            Trạng thái đơn hàng: <?= $donHang['ten_trang_thai'] ?? 'Không xác định' ?>
                        </div>

                        <!-- Invoice -->
                        <div class="invoice p-3 mb-3">
                            <!-- Title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-store"></i> Shop Thời Trang MĐ
                                        <small class="float-right">Ngày đặt: <?= formatDate($donHang['ngay_dat']) ?></small>
                                    </h4>
                                </div>
                            </div>

                            <!-- Info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    Thông tin người đặt
                                    <address>
                                        <strong><?= $donHang['ho_ten'] ?></strong><br>
                                        Email: <?= $donHang['email'] ?><br>
                                        SĐT: <?= $donHang['so_dien_thoai'] ?>
                                    </address>
                                </div>

                                <div class="col-sm-4 invoice-col">
                                    Người nhận
                                    <address>
                                        <strong><?= $donHang['ten_nguoi_nhan'] ?></strong><br>
                                        Email: <?= $donHang['email_nguoi_nhan'] ?><br>
                                        SĐT: <?= $donHang['sdt_nguoi_nhan'] ?><br>
                                        Địa chỉ: <?= $donHang['dia_chi_nguoi_nhan'] ?>
                                    </address>
                                </div>

                                <div class="col-sm-4 invoice-col">
                                    Thông tin đơn
                                    <address>
                                        Mã đơn hàng: <strong><?= $donHang['ma_don_hang'] ?></strong><br>
                                        Tổng tiền: <?= formatVND((float)str_replace('.', '', preg_replace('/[^\d\.]/', '', $donHang['tong_tien']))) ?><br>                                        Ghi chú: <?= $donHang['ghi_chu'] ?><br>
                                        Phương thức Thanh toán: <?= $donHang['ten_phuong_thuc'] ?>
                                    </address>
                                </div>
                            </div>

                            <!-- Table row -->
                            <div class="mt-3">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $tong_tien = 0; ?>
                                        <?php foreach ($sanPhamDonHang as $key => $sp): ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= $sp['ten_san_pham'] ?></td>
                                                <td><?= formatVND($sp['don_gia']) ?></td>
                                                <td><?= $sp['so_luong'] ?></td>
                                                <td><?= formatVND($sp['thanh_tien']) ?></td>
                                            </tr>
                                            <?php $tong_tien += $sp['thanh_tien']; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Total -->
                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Thành tiền:</th>
                                                <td><?= formatVND($tong_tien) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Vận chuyển:</th>
                                                <td><?= formatVND(30000) ?></td>
                                            </tr>
                                            <tr>
                                                <th>
                                                Phương thức Thanh toán: 
                                            
                                                </th>
                                                <td><?= $donHang['ten_phuong_thuc'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tổng thanh toán:</th>
                                                <td><?= formatVND($tong_tien + 30000) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /.invoice -->

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    <?php include './views/layout/footer.php'; ?>
    <!-- End Footer -->

</div><!-- /.wrapper -->
</body>
</html>
