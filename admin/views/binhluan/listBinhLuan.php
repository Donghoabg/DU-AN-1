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
                            <h1>Quản lý bình luận</h1>
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
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Sản phẩm</th>
                                                    <th>Người bình luận</th>
                                                    <th>Ảnh đại diện</th>
                                                    <th>Nội dung</th>
                                                    <th>Ngày bình luận</th>
                                                    <th>Trạng thái</th>
                                                    <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- 
                                                    Hiển thị danh sách bình luận
                                                    $key dùng để đánh số thứ tự bình luận và thứ tự bình luận
                                                 -->
                                                <?php if (!empty($listBinhLuan) && is_array($listBinhLuan)) foreach ($listBinhLuan as $key => $bl) { ?>
                                                    <tr>
                                                        <td><?= $key + 1 ?></td>
                                                        <td><?= htmlentities($bl['ten_san_pham'] ?? '') ?></td>
                                                        <td><?= htmlentities($bl['ho_ten'] ?? '') ?></td>
                                                        <td>
                                                            <?php if (!empty($bl['anh_dai_dien'])): ?>
                                                                <img src="<?= BASE_URL . $bl['anh_dai_dien'] ?>" alt="avatar" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                                                            <?php else: ?>
                                                                <img src="<?= BASE_URL . 'uploads/default-avatar.png' ?>" alt="avatar" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= htmlentities($bl['noi_dung'] ?? '') ?></td>
                                                        <td><?= htmlentities($bl['ngay_dang'] ?? '') ?></td>
                                                        <td>
                                                            <?php
                                                            $badge = $bl['trang_thai'] ? 'badge-success' : 'badge-secondary';
                                                            $text = $bl['trang_thai'] ? 'Đã duyệt' : 'Chờ duyệt';
                                                            ?>
                                                            <span class="badge <?= $badge ?>"> <?= $text ?> </span>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-binh-luan&id=' . $bl['id'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                                                <a href="<?= BASE_URL_ADMIN . '?act=xoa-binh-luan&id=' . $bl['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')"><i class="fas fa-trash"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
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