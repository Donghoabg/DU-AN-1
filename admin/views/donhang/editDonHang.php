<!-- header -->
<?php
include "./views/layout/header.php"
?>
<!-- end header -->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php
        include "./views/layout/navbar.php"
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        include "./views/layout/sidebar.php"
        ?>
        <?php
            $trangThaiThanhToanText = [
                1 => 'Chưa thanh toán',
                2 => 'Đã thanh toán',   
            ];

            $trangThai = $donHang['trang_thai_thanh_toan_id'] ?? null;
            $tenTrangThai = $trangThaiThanhToanText[$trangThai] ?? 'Không xác định';
            ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Chỉnh sửa thông tin đơn hàng: <?= $donHang['id']; ?></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card-header">
                                <h3 class="card-title">Sửa thông tin đơn hàng:</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="<?= BASE_URL_ADMIN . '?act=sua-don-hang' ?>" method="POST">

                                <input type="text" name="don_hang_id" value="<?= $donHang['id'] ?>" hidden>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Tên người nhận</label>
                                        <input type="text" class="form-control" value="<?= $donHang['ten_nguoi_nhan']; ?>" name="ten_nguoi_nhan" placeholder="Nhập tên người nhận">
                                        <?php if (isset($error['ten_nguoi_nhan'])) { ?>
                                            <p class="text-danger"><?= $error['ten_nguoi_nhan'] ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input type="text" class="form-control" value="<?= $donHang['sdt_nguoi_nhan']; ?>" name="sdt_nguoi_nhan" placeholder="Nhập số điện thoại người nhận">
                                        <?php if (isset($error['sdt_nguoi_nhan'])) { ?>
                                            <p class="text-danger"><?= $error['sdt_nguoi_nhan'] ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" value="<?= $donHang['email_nguoi_nhan']; ?>" name="email_nguoi_nhan" placeholder="Nhập email người nhận">
                                        <?php if (isset($error['email_nguoi_nhan'])) { ?>
                                            <p class="text-danger"><?= $error['email_nguoi_nhan'] ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" class="form-control" value="<?= $donHang['dia_chi_nguoi_nhan']; ?>" name="dia_chi_nguoi_nhan" placeholder="Nhập địa chỉ người nhận">
                                        <?php if (isset($error['dia_chi_nguoi_nhan'])) { ?>
                                            <p class="text-danger"><?= $error['dia_chi_nguoi_nhan']; ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Ghi chú</label>
                                        <textarea name="mo_ta" class="form-control" placeholder="Nhập ghi chú"><?= $donHang['ghi_chu']; ?></textarea>
                                    </div>
                                    <!-- /.card-body -->
                                    <hr>
                                  <div class="form-group">
                                    <label for="">Trạng thái thanh toán</label>
                                    <input type="text" class="form-control" 
                                        value="<?= htmlspecialchars($tenTrangThai) ?>" 
                                        readonly disabled>
                                </div>
                                    <div class="form-group">
                                        <label for="inputStatus">Trạng thái đơn hàng</label>
                                        <select id="inputStatus" name="trang_thai_id" class="form-control custom-select">
                                            <?php foreach ($listTrangThaiDonHang as $trangThai): ?>
                                                <option
                                                    <?php
                                                    // Logic kiểm tra trạng thái để cho phép hoặc vô hiệu hóa
                                                    if (
                                                        ($donHang['trang_thai_id'] >= 12) || // Đơn hàng "Thành Công" hoặc trạng thái sau đó
                                                        ($donHang['trang_thai_id'] == 15) || // Đơn hàng "Đã Hủy"
                                                        ($donHang['trang_thai_id'] > $trangThai['id']) || // Chỉ cho phép nâng cấp trạng thái
                                                        ($trangThai['id'] == 1 && $donHang['trang_thai_id'] > 1) // Không cho phép quay lại "Chưa Xác Nhận"
                                                    ) {
                                                        echo 'disabled'; // Không cho phép thay đổi đến các trạng thái không hợp lệ
                                                    }
                                                    ?>
                                                    <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : '' ?>
                                                    value="<?= htmlspecialchars($trangThai['id']) ?>"><?= htmlspecialchars($trangThai['ten_trang_thai']) ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                        <?php if (isset($_SESSION['error']['danh_muc_id'])): ?>
                                            <p class="text-danger"><?= htmlspecialchars($_SESSION['error']['danh_muc_id']) ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </form>

                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- footer -->
        <?php include './views/layout/footer.php' ?>
        <!-- end footer -->

</body>

</html>