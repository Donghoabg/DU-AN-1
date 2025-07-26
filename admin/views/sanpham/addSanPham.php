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


                            <a href="index.php?act=form-them-san-pham">
                                <h1>Quản Lý Sản Phẩm</h1>
                            </a>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thêm Sản Phẩm</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="index.php?act=them-san-pham" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Tên Sản Phẩm</label>
                                <input type="text" class="form-control" name="ten_san_pham" placeholder="Nhập Sản Phẩm">
                                <?php if (isset($_SESSION['error']['ten_san_pham'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['ten_san_pham']; ?></p>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Giá Sản Phẩm</label>
                                <input type="number" class="form-control" name="gia_san_pham" placeholder="Nhập Giá Sản Phẩm">
                                <?php if (isset($_SESSION['error']['gia_san_pham'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['gia_san_pham']; ?></p>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Giá Khuyến Mãi</label>
                                <input type="number" class="form-control" name="gia_khuyen_mai" placeholder="Nhập Giá Khuyến Mãi Sản Phẩm">
                                <?php if (isset($_SESSION['error']['gia_khuyen_mai'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['gia_khuyen_mai']; ?></p>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Hình Ảnh</label>
                                <input type="file" class="form-control" name="hinh_anh" placeholder="Nhập Hình Ảnh Sản Phẩm">
                                <?php if (isset($_SESSION['error']['hinh_anh'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['hinh_anh']; ?></p>
                                <?php } ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Album Ảnh</label>
                                <input type="file" class="form-control" name="img_array[]" multiple placeholder="Nhập Album Sản Phẩm">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Số Lượng</label>
                                <input type="number" class="form-control" name="so_luong" placeholder="Nhập Số Lượng Sản Phẩm">
                                <?php if (isset($_SESSION['error']['so_luong'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['so_luong']; ?></p>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Ngày Nhập</label>
                                <input type="date" class="form-control" name="ngay_nhap" placeholder="Nhập Ngày Nhập Sản Phẩm">
                                <?php if (isset($_SESSION['error']['ngay_nhap'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['ngay_nhap']; ?></p>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Danh Mục</label>
                                <select class="form-control" name='danh_muc_id' id="exampleFormControlSelect1">
                                    <option selected disabled>Chọn Danh Mục Sản Phẩm</option>
                                    <?php
                                    foreach ($listDanhMuc as $danhmuc) {  ?>
                                        <option value="<?= $danhmuc['id'] ?>"><?= $danhmuc['ten_danh_muc'] ?></option>
                                    <?php     } ?>
                                </select>
                                <?php if (isset($_SESSION['error']['danh_muc'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['danh_muc']; ?></p>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Trạng Thái</label>
                                <select class="form-control" name='trang_thai' id="exampleFormControlSelect1">
                                    <option selected disabled>Chọn Danh Mục Sản Phẩm</option>
                                    <option value="1">Còn Bán</option>
                                    <option value="2">Dừng Bán</option>
                                </select>
                                <?php if (isset($_SESSION['error']['trang_thai'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['trang_thai']; ?></p>
                                <?php } ?>
                            </div>
                            <div class="form-group col-12">
                                <label>Mô tả</label>
                                <textarea name='mo_ta' class="form-control" placeholder="Nhập Mô Tả"></textarea>
                            </div>
                        </div>
                    </div>
                

                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
                </form>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <!-- /.card -->


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

        <!-- Page specific script -->

        <!-- Code injected by live-server -->
        <!-- footer -->
        <?php
        include "./views/layout/footer.php"
        ?>

        <!-- end footer -->
</body>

</html>