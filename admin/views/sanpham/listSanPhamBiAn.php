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
                            <h1>Sản phẩm bị ẩn</h1>
                        </div>
                    </div>
                    <div class="card-header">
                                    <a href="?act=san-pham">
                                        <button class="btn btn-success">Quay lại trang list sản phẩm</button>
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
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Hình ảnh</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listSanPhamBiAn as $sp) : ?>
                                <tr>
                                    <td><?= $sp['id'] ?></td>
                                    <td><?= $sp['ten_san_pham'] ?></td>
                                    <td><?= $sp['gia_san_pham'] ?></td>
                                    <td><img src="<?= '.' . $sanpham['hinh_anh'] ?>" width=200 alt=""
                                                            onerror="this.onerror=null;this.src='https:/www.droppii.com/wp-content/uploads/2023/04/quang-cao-my-pham-3.jpg'">
                                    </td>
                                    <td>
                                        <a href="?act=hien-san-pham&id_san_pham=<?= $sp['id'] ?>" class="btn btn-success btn-sm">Hiện lại</a>
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
