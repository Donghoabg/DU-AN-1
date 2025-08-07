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
        <!-- end sidebar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Danh mục bị ẩn</h1>
                        </div>
                    </div>
                    <div class="card-header">
                        <a href="?act=danh-muc-mi-pham">
                            <button class="btn btn-success">Quay lại trang list danh mục</button>
                        </a>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listDanhMucBiAn as $dm) : ?>
                                <tr>
                                    <td><?= $dm['id'] ?></td>
                                    <td><?= $dm['ten_danh_muc'] ?></td>
                                    <td>
                                        <a href="?act=hien-danh-muc&id_danh_muc=<?= $dm['id'] ?>" class="btn btn-success btn-sm">Hiện lại</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</body>
