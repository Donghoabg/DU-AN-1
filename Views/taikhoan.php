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
                                                    
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div> 
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'layout/miniCart.php' ?>

<?php require_once 'layout/footer.php' ?>