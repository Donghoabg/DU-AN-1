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
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-8">
                            <h1>Báo cáo thống kê đơn hàng</h1>
                        </div>
                    </div><!-- /.container-fluid -->
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered table-striped table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Trạng thái đơn hàng</th>
                                                    <th>Ngày đặt</th> <!-- Cột ngày đặt -->
                                                    <th>Tổng số đơn hàng</th>
                                                    <th>Tổng doanh thu</th>
                                                    <th>Giá trị trung bình</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($listThongKe as $thongKe) { ?>
                                                <tr>
                                                    <td><?= $thongKe['ten_trang_thai'] ?></td>
                                                    <td><?= date('d-m-Y', strtotime($thongKe['ngay_dat'])) ?></td> <!-- Hiển thị ngày đặt -->
                                                    <td><?= $thongKe['totalOrders'] ?></td>
                                                    <td><?= $thongKe['totalRevenue'] ?></td>
                                                    <td><?= $thongKe['avgOrderValue'] ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Trạng thái đơn hàng</th>
                                                    <th>Ngày đặt</th> <!-- Cột ngày đặt -->
                                                    <th>Tổng số đơn hàng</th>
                                                    <th>Tổng doanh thu</th>
                                                    <th>Giá trị trung bình</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <a href="<?= BASE_URL_ADMIN . '?act=bieu-do' ?>"> 
                                            <button type="button" class="btn btn-primary">Xem biểu đồ</button>
                                        </a>
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
        <!-- footer -->
        <?php
        include "./views/layout/footer.php"
        ?>
        <!-- end footer -->
</body>

</html>
