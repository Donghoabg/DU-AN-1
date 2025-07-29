<?php require_once 'layout/header.php' ?>
<?php require_once 'layout/menu.php' ?>
<div class="my-account-wrapper section-padding">
    <div class="container">
        <div class="section-bg-color">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?= htmlspecialchars($_SESSION['success']); ?>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['successTt'])): ?>
                        <div class="alert alert-success">
                            <?= htmlspecialchars($_SESSION['successTt']); ?>
                        </div>
                        <?php unset($_SESSION['successTt']); ?>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="myaccount-tab-menu nav" role="tablist">

                                    <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Thông Tin
                                        Tài Khoản</a>
                                    <a href="#" id="goToOrderHistory"><i class="fa fa-cart-arrow-down"></i> Đơn Hàng</a>
                                    <a href="<?= BASE_URL . '?act=logout' ?>"><i class="fa fa-sign-out"></i> Đăng
                                        Xuất</a>
                                </div>
                            </div>
                            <script>
                                document.getElementById('goToOrderHistory').addEventListener('click', function(e) {
                                e.preventDefault();
                                window.location.href = '?act=lich-su-mua-hang';
                            });
                            </script>
                            <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">

                                    <div class="tab-pane fade show active" id="account-info" role="tabpanel">

                                        <div class="myaccount-content">
                                            <h5>Chi Tiết Tài Khoản</h5>
                                            <div class="account-details-form">
                                                <form action="<?= BASE_URL . '?act=sua-thong-tin-ca-nhan' ?>"
                                                    method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="tai_khoan_id"
                                                        value="<?= $thongTin['id'] ?>">
                                                    <input type="hidden" name="trang_thai" value="1">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="first-name" class="required">Họ Tên</label>
                                                                <input type="text" id="first-name" name="ho_ten"
                                                                    placeholder="Nhập họ"
                                                                    value="<?= htmlspecialchars(explode(' ', $thongTin['ho_ten'])[0]) ?>">
                                                                <?php if (isset($_SESSION['errors']['ho_ten'])) { ?>
                                                                <p class="text-danger">
                                                                    <?= $_SESSION['errors']['ho_ten'] ?></p>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="last-name" class="required">Số Điện
                                                                    Thoại</label>
                                                                <input class="form-control" type="text"
                                                                    value="<?= htmlspecialchars($thongTin['so_dien_thoai']) ?>"
                                                                    name="so_dien_thoai">
                                                                <?php if (isset($_SESSION['errors']['so_dien_thoai'])) { ?>
                                                                <p class="text-danger">
                                                                    <?= $_SESSION['errors']['so_dien_thoai'] ?></p>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="ngay_sinh" class="required">Ngày
                                                                    Sinh</label>
                                                                <input type="date" id="ngay_sinh" name="ngay_sinh"
                                                                    value="<?= htmlspecialchars($thongTin['ngay_sinh']) ?>">
                                                                <?php if (isset($_SESSION['errors']['ngay_sinh'])) { ?>
                                                                <p class="text-danger">
                                                                    <?= $_SESSION['errors']['ngay_sinh'] ?></p>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="gioi_tinh" class="required">Giới
                                                                    Tính</label>
                                                                <select class="form-control" name="gioi_tinh"
                                                                    id="gioi_tinh">
                                                                    <option value="1"
                                                                        <?= $thongTin['gioi_tinh'] == 1 ? 'selected' : '' ?>>
                                                                        Nam</option>
                                                                    <option value="0"
                                                                        <?= $thongTin['gioi_tinh'] == 0 ? 'selected' : '' ?>>
                                                                        Nữ</option>
                                                                </select>
                                                                <?php if (isset($_SESSION['errors']['gioi_tinh'])) { ?>
                                                                <p class="text-danger">
                                                                    <?= $_SESSION['errors']['gioi_tinh'] ?></p>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="display-name" class="required">Địa Chỉ</label>
                                                        <input class="form-control" type="text"
                                                            value="<?= htmlspecialchars($thongTin['dia_chi']) ?>"
                                                            name="dia_chi">
                                                        <?php if (isset($_SESSION['errors']['dia_chi'])) { ?>
                                                        <p class="text-danger"><?= $_SESSION['errors']['dia_chi'] ?></p>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="email" class="required">Email</label>
                                                        <input type="email" id="email" name="email" placeholder="Email"
                                                            value="<?= htmlspecialchars($thongTin['email']) ?>">
                                                        <?php if (isset($_SESSION['errors']['email'])) { ?>
                                                        <p class="text-danger"><?= $_SESSION['errors']['email'] ?></p>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="anh_dai_dien">Ảnh đại diện hiện tại:</label><br>
                                                        <img src="<?= !empty($thongTin['anh_dai_dien']) ? BASE_URL . $thongTin['anh_dai_dien'] : BASE_URL . 'uploads/default-avatar.png' ?>" style="width:80px;height:80px;border-radius:50%;object-fit:cover;">
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="anh_dai_dien">Chọn ảnh đại diện mới</label>
                                                        <input type="file" name="anh_dai_dien" id="anh_dai_dien" class="form-control">
                                                    </div>
                                                    <div class="single-input-item">
                                                        <button class="btn btn-sqr" type="submit">Lưu thay đổi </button>
                                                    </div>



                                                </form>

                                                <form action="<?= BASE_URL . '?act=doi-mat-khau' ?>" method="POST">
                                                    <fieldset>
                                                        <legend>Đổi mật khẩu</legend>
                                                        <div class="single-input-item">
                                                            <label for="current-pwd" class="required">Mật khẩu hiện
                                                                tại</label>
                                                            <input type="password" id="current-pwd" name="old_pass"
                                                                placeholder="Mật khẩu hiện tại">
                                                            <?php if (isset($_SESSION['errors']['old_pass'])) { ?>
                                                            <p class="text-danger">
                                                                <?= $_SESSION['errors']['old_pass'] ?></p>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="new-pwd" class="required">Mật khẩu
                                                                        mới</label>
                                                                    <input type="password" id="new-pwd" name="new_pass"
                                                                        placeholder="Mật khẩu mới">
                                                                    <?php if (isset($_SESSION['errors']['new_pass'])) { ?>
                                                                    <p class="text-danger">
                                                                        <?= $_SESSION['errors']['new_pass'] ?></p>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="confirm-pwd" class="required">Xác nhận
                                                                        mật khẩu</label>
                                                                    <input type="password" id="confirm-pwd"
                                                                        name="confirm_pass"
                                                                        placeholder="Nhập lại mật khẩu mới">
                                                                    <?php if (isset($_SESSION['errors']['confirm_pass'])) { ?>
                                                                    <p class="text-danger">
                                                                        <?= $_SESSION['errors']['confirm_pass'] ?></p>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="single-input-item">
                                                        <button class="btn btn-sqr" type="submit">Đổi Mật Khẩu</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div> <!-- Single Tab Content End -->
                                    <!-- Single Tab Content Start -->

                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Orders</h5>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Order</th>
                                                        
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><a href="?act=lich-su-mua-hang" class="btn btn-sqr">View</a>
                                                            </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->

                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->

                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->

                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'layout/miniCart.php' ?>

<?php require_once 'layout/footer.php' ?>