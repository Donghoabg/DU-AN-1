<!-- header -->
<?php include "./views/layout/header.php"; ?>
<!-- end header -->

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <?php include "./views/layout/navbar.php"; ?>
    <!-- Sidebar -->
    <?php include "./views/layout/sidebar.php"; ?>
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-9">
                        <h1>Chi tiết bình luận</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin bình luận</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width:30%">Sản phẩm</th>
                                        <td><?= htmlspecialchars($binhLuan['ten_san_pham'] ?? '') ?></td>
                                    </tr>
                                    <tr>
                                        <th>Người bình luận</th>
                                        <td><?= htmlspecialchars($binhLuan['ho_ten'] ?? '') ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nội dung</th>
                                        <!-- nl2br giúp hiển thị nội dung bình luận có xuống dòng đúng như khi nhập. -->
                                        <td><?= nl2br(htmlspecialchars($binhLuan['noi_dung'] ?? '')) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Ngày bình luận</th>
                                        <td><?= htmlspecialchars($binhLuan['ngay_dang'] ?? '') ?></td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái</th>
                                        <td>
                                            <?php
                                            $badge = $binhLuan['trang_thai'] ? 'badge-success' : 'badge-secondary';
                                            $text = $binhLuan['trang_thai'] ? 'Đã duyệt' : 'Chờ duyệt';
                                            ?>
                                            <span class="badge <?= $badge ?>"> <?= $text ?> </span>
                                        </td>
                                    </tr>
                                </table>
                                <div class="mt-3">
                                    <a href="index.php?act=list-binh-luan" class="btn btn-secondary">Quay lại danh sách</a>
                                    <a href="index.php?act=xoa-binh-luan&id=<?= $binhLuan['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa bình luận</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Footer -->
    <?php include './views/layout/footer.php'; ?>
    <!-- End Footer -->
</div>
<!-- /.wrapper -->
</body>
</html>
