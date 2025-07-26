<?php require_once './views/layout/header.php'  ?>
<?php require_once './views/layout/menu.php'  ?>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">login-Register</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- login register wrapper start -->
    <div class="login-register-wrapper section-padding">
        <div class="container" style="max-width: 500px;">
            <div class="member-area-from-wrap">
                <div class="row">
                    <?php if (isset($_SESSION['thongBao'])) { ?>
                        <p class="text-success"><?= $_SESSION['thongBao'] ?></p>
                    <?php } ?>

                    <!-- Register Content Start -->
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap sign-up-form">
                            <h5>Đăng ký thành viên</h5>
                            <form action="<?= BASE_URL . '?act=dang-ky' ?>" method="POST" enctype="multipart/form-data">
                                <div class="single-input-item">
                                    <input type="email" class="form-control" id="email" name="email" value="<?= isset($_SESSION['old_data']['email']) ? $_SESSION['old_data']['email'] : '' ?>" placeholder="Email">
                                    <?php if (isset($_SESSION['errors']['email'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['email'] ?></p>
                                    <?php } ?>
                                </div>

                                <div class="single-input-item">
                                    <input type="text" class="form-control" placeholder="Họ tên" id="ho_ten" name="ho_ten" value="<?= isset($_SESSION['old_data']['ho_ten']) ? $_SESSION['old_data']['ho_ten'] : '' ?>">
                                    <?php if (isset($_SESSION['errors']['ho_ten'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['ho_ten'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="single-input-item">
                                    <input type="text" placeholder="Địa chỉ" class="form-control" id="dia_chi" name="dia_chi" value="<?= isset($_SESSION['old_data']['dia_chi']) ? $_SESSION['old_data']['dia_chi'] : '' ?>">
                                    <?php if (isset($_SESSION['errors']['dia_chi'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['dia_chi'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="single-input-item">
                                    <label for="">Ảnh đại diện</label>
                                    <input type="file" class="form-control" id="anh_dai_dien" name="anh_dai_dien">
                                </div>

                                <div class="single-input-item">
                                    <label for="">Ngày sinh</label>
                                    <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" value="<?= isset($_SESSION['old_data']['ngay_sinh']) ? $_SESSION['old_data']['ngay_sinh'] : '' ?>">
                                    <?php if (isset($_SESSION['errors']['ngay_sinh'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['ngay_sinh'] ?></p>
                                    <?php } ?>
                                </div>

                                <div class="single-input-item">
                                    <input type="number" class="form-control" placeholder="Số điện thoại" id="so_dien_thoai" name="so_dien_thoai" value="<?= isset($_SESSION['old_data']['so_dien_thoai']) ? $_SESSION['old_data']['so_dien_thoai'] : '' ?>">
                                    <?php if (isset($_SESSION['errors']['so_dien_thoai'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['so_dien_thoai'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="single-input-item">
                                    <label for="">Giới tính</label>
                                    <select class="form-control" name="gioi_tinh" aria-label="exampleFormControlSelect1">
                                        <option value="1" <?= isset($_SESSION['old_data']['gioi_tinh']) && $_SESSION['old_data']['gioi_tinh'] == 1 ? 'selected' : '' ?>>Nam</option>
                                        <option value="2" <?= isset($_SESSION['old_data']['gioi_tinh']) && $_SESSION['old_data']['gioi_tinh'] == 2 ? 'selected' : '' ?>>Nữ</option>
                                    </select>


                                </div>



                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single-input-item">
                                            <input type="password" name="mat_khau" placeholder="Nhập mật khẩu" />
                                            <?php if (isset($_SESSION['errors']['mat_khau'])) { ?>
                                                <p class="text-danger"><?= $_SESSION['errors']['mat_khau'] ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="single-input-item">
                                    <button class="btn btn-sqr">Đăng ký</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Register Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- login register wrapper end -->
</main>

<!-- Scroll to top start -->
<div class="scroll-top not-visible">
    <i class="fa fa-angle-up"></i>
</div>
<!-- Scroll to Top End -->

<?php require_once './views/layout/footer.php'  ?>