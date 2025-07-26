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
                        <div class="col-sm-11">
                            <a href="index.php?act=form-sua-san-pham">
                                <h1>Sửa thông tin sản phẩm <?= $sanpham['ten_san_pham'] ?></h1>
                            </a>
                        </div>
                            <div class="col-sm-1">
                                <a href="index.php?act=san-pham"class="btn btn-secondary">Back</a>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Thông Tin Sản Phẩm</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <form action="index.php?act=sua-san-pham" method="post" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <input type="hidden" name="san_pham_id" value="<?= $sanpham['id'] ?>">

                                            <label for=" ten_san_pham">Tên sản phẩm</label>
                                            <input type="text" id="ten_san_pham" name="ten_san_pham" class="form-control" value="<?= $sanpham['ten_san_pham'] ?>">
                                            <?php if (isset($_SESSION['error']['ten_san_pham'])) { ?>
                                                <p class="text-danger"><?= $_SESSION['error']['ten_san_pham']; ?></p>
                                                <?php unset($_SESSION['error']['ten_san_pham']); ?>
                                            <?php } ?>

                                        </div>

                                        <div class="form-group">
                                            <label for="gia_san_pham">Giá sản phẩm</label>
                                            <input type="number" id="gia_san_pham" name="gia_san_pham" class="form-control" value="<?= $sanpham['gia_san_pham'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="gia_khuyen_mai">Giá Khuyến Mãi</label>
                                            <input type="number" id="gia_khuyen_mai" name="gia_khuyen_mai" class="form-control" value="<?= $sanpham['gia_khuyen_mai'] ?>">
                                        </div>


                                        <div class="form-group">
                                            <label for="so_luong">Số lượng</label>
                                            <input type="number" id="so_luong" name="so_luong" class="form-control" value="<?= $sanpham['so_luong'] ?>">
                                        </div>


                                        <div class="form-group">
                                            <label for="hinh_anh">Hình Ảnh</label>
                                            <div class="mb-2">
                                                <?php if (!empty($sanpham['hinh_anh'])): ?>
                                                    <img src="<?= '../uploads/' . $sanpham['hinh_anh'] ?>" style="width:80px; height:80px; object-fit:cover;" alt="Ảnh đại diện">
                                                <?php endif; ?>
                                            </div>
                                            <input type="file" id="hinh_anh" name="hinh_anh" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="ngay_nhap">Ngày nhập</label>
                                            <input type="date" id="ngay_nhap" name="ngay_nhap" class="form-control" value="<?= $sanpham['ngay_nhap'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputStatus">Danh Mục</label>
                                            <select id="inputStatus" name='danh_muc_id' class="form-control custom-select">
                                                <?php foreach ($listDanhMuc as $danhMuc): ?>
                                                    <option <?= $danhMuc['id'] == $sanpham['danh_muc_id'] ? "selected" : '' ?> value="<?= $danhMuc['id']; ?>">
                                                        <?= $danhMuc['ten_danh_muc']; ?>
                                                    </option>
                                                <?php endforeach ?>


                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="trang_thai">Trạng Thái</label>
                                            <select id="inputStatus" name='trang_thai' class="form-control custom-select">
                                                <option <?= $sanpham['trang_thai'] == 1 ? "selected" : '' ?> value="1">Còn Hàng</option>
                                                <option <?= $sanpham['trang_thai'] == 2 ? "selected" : '' ?> value="2">Hết Hàng</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="mo_ta">Mô Tả sản phẩm</label>
                                            <textarea id="mo_ta" name="mo_ta" class="form-control" rows="4"><?= htmlspecialchars($sanpham['mo_ta']) ?></textarea>

                                        </div>

                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer text-center">
                                        <button class="btn btn-primary">Sửa thông tin</button>
                                    </div>
                                </form>

                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-md-5">

                            <!-- <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Album Ảnh sản phẩm</h3>
                                    <div class="card-body p-0">
                                        <form action="index.php?act=sua-album-anh-san-pham" method="post" enctype="multipart/form-data">
                                            <div class="table-responsive">
                                                <table id="faqs" class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Ảnh </th>
                                                            <th>File</th>
                                                            <th>
                                                                <div class="text-center"><button onclick="addfaqs();" type='button' class="badge badge-success"><i class="fa fa-plus"></i>Thêm</button></div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <input type="hidden" name="san_pham_id" value="<?= $sanpham['id'] ?>">
                                                        <input type="hidden" name="img_delete" id='img_delete'>
                                                        <?php foreach ($listAnhSanPham as $key => $value): ?>
                                                        <tr id="faqs-row<?= $key ?>">
                                                            <input type="hidden" name="current_img_ids[]" value="<?= $value['id'] ?>">
                                                            <td> <img src="<?= '../uploads/' . $value['link_hinh_anh'] ?>" style="width:50px; height:50px; object-fit:cover;" alt=""></td>
                                                            <td><input type="file" class="form-control" name="img_array[]"></td>
                                                            <td class="mt-10">
                                                                <button type="button" class="badge badge-danger" onclick="removeRow(<?= $key ?>, <?= $value['id'] ?>)">
                                                                    <i class="fa fa-trash"></i> Delete
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <form class="card-footer text-center">
                                                <button class="btn btn-primary">Sửa Ảnh</button>
                                            </form>
                                    </div>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div> -->
                                <div class="card-body p-0">

                                </div>


                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                </section>
                <!-- /.content -->
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
<script>
    let faqs_row = <?= count($listAnhSanPham) ?>;

    function addfaqs() {
        let html = `
            <tr id="faqs-row${faqs_row}">
                <td>
                    <img src="https://www.droppii.com/wp-content/uploads/2023/04/quang-cao-my-pham-3.jpg" style="width:50px; height:50px;" alt="">
                </td>
                <td>
                    <input type="file" placeholder="Product name" class="form-control" name="img_array[]">
                </td>
                <td class="mt-10">
                    <button type="button" class="badge badge-danger" onclick="removeRow(${faqs_row}, null)">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </td>
            </tr>
        `;

        $('#faqs tbody').append(html);
        faqs_row++;
    }

    function removeRow(rowId, imgId) {
        // Attempt to remove the row element
        const rowElement = document.getElementById("faqs-row" + rowId);
        if (rowElement) {
            rowElement.remove();
        } else {
            console.warn(`Row with ID faqs-row${rowId} not found.`);
        }

        // If imgId is provided, update the img_delete input value
        if (imgId !== null) {
            const imgDeleteInput = document.getElementById('img_delete');
            if (imgDeleteInput) {
                const currentValue = imgDeleteInput.value;
                imgDeleteInput.value = currentValue ? `${currentValue},${imgId}` : imgId;
            } else {
                console.warn("Element with ID img_delete not found.");
            }
        }
    }
</script>



</html>