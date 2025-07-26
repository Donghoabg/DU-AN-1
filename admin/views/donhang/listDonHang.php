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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Quản lý đơn hàng</h1>
                        </div>
                    </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="dt-buttons btn-group flex-wrap">

                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table id="example1" class="table table-bordered table-striped ">
                                                <thead>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Mã đơn hàng</th>
                                                        <th>Tên người nhận</th>
                                                        <th>Số điện thoại</th>
                                                        <th>Ngày đặt</th>
                                                        <th>Tổng tiền</th>
                                                        <th>Trạng thái</th>
                                                        <th>Trạng thái thanh toán</th>
                                                        <th>Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($listDonHang as $key => $donHang) { ?>
                                                        <tr>
                                                            <td><?= $key + 1 ?></td>
                                                            <td><?= $donHang['ma_don_hang'] ?></td>
                                                            <td><?= $donHang['ten_nguoi_nhan'] ?></td>
                                                            <td><?= $donHang['sdt_nguoi_nhan'] ?></td>
                                                            <td><?= $donHang['ngay_dat'] ?></td>
                                                            <td><?= $donHang['tong_tien'] ?></td>
                                                            <td>
                                                                <?php
                                                                $badgeClass = 'badge-secondary';
                                                                switch (strtolower($donHang['ten_trang_thai'])) {
                                                                    case 'chờ xác nhận':
                                                                        $badgeClass = 'badge-warning';
                                                                        break;
                                                                    case 'đã xác nhận':
                                                                        $badgeClass = 'badge-info';
                                                                        break;
                                                                    case 'đang giao hàng':
                                                                        $badgeClass = 'badge-primary';
                                                                        break;
                                                                    case 'đã giao hàng':
                                                                        $badgeClass = 'badge-success';
                                                                        break;
                                                                    case 'đã hủy':
                                                                        $badgeClass = 'badge-danger';
                                                                        break;
                                                                }
                                                                ?>
                                                                <span class="badge <?= $badgeClass ?>">
                                                                    <?= htmlspecialchars($donHang['ten_trang_thai']) ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $payBadge = 'badge-secondary';
                                                                $payText = $donHang['trang_thai_thanh_toan'] ?? 'Chưa Thanh Toán';
                                                                // Nếu trạng thái đơn hàng là 'Đã Giao' hoặc 'Thành Công' thì coi như đã thanh toán
                                                                $trangThai = isset($donHang['ten_trang_thai']) ? mb_strtolower($donHang['ten_trang_thai']) : '';
                                                                if ($trangThai === 'đã giao' || $trangThai === 'thành công') {
                                                                    $payBadge = 'badge-success';
                                                                    $payText = 'Đã thanh toán';
                                                                } else {
                                                                    switch (mb_strtolower($payText)) {
                                                                        case 'chưa thanh toán':
                                                                            $payBadge = 'badge-warning';
                                                                            break;
                                                                        case 'đã thanh toán':
                                                                            $payBadge = 'badge-success';
                                                                            break;
                                                                        case 'hoàn hàng':
                                                                            $payBadge = 'badge-info';
                                                                            break;
                                                                    }
                                                                }
                                                                ?>
                                                                <span class="badge <?= $payBadge ?>">
                                                                    <?= htmlspecialchars($payText) ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-don-hang&id_don_hang=' . $donHang['id'] ?>"><button class="btn btn-primary"><i class="fas fa-eye"></i></button></a>
                                                                    <a href="<?= BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $donHang['id'] ?>"> <button class="btn btn-warning"><i class="fas fa-cogs"></i></button></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Mã đơn hàng</th>
                                                        <th>Tên người nhận</th>
                                                        <th>Số điện thoại</th>
                                                        <th>Ngày đặt</th>
                                                        <th>Tổng tiền</th>
                                                        <th>Trạng thái</th>
                                                        <th>Trạng thái thanh toán</th>
                                                        <th>Thao tác</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-5">
                                                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                                                </div>
                                                <div class="col-sm-12 col-md-7">
                                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                                        <ul class="pagination">
                                                            <li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                                            <li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                                            <li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
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
        <!--footer-->
        <script src="./assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="./assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="./assets/dist/js/adminlte.min.js"></script>
</body>

</html>