<?php require_once 'layout/header.php'  ?>
<?php require_once 'layout/menu.php'  ?>
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASE_URL?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Quên mật khẩu</li>
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
                    <!-- Login Content Start -->
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap">
                            <h5 class="text-center">Lấy lại mật khẩu</h5>
                           
                            <form action="<?= BASE_URL . '?act=lay-mat-khau' ?>" method="post">
                            <?php if (isset($_SESSION['layMk'])) { ?>
                                            <div class="alert alert-info alert-dismissable">
                                                <a href="" class="panel-close close" data-dismiss="alert"></a>
                                                <i class="fa fa-coffee"></i>
                                                <?= $_SESSION['layMk'] ?>
                                            </div>
                                        <?php } ?>
                                <div class="single-input-item">
                                    <input type="email"name="email" placeholder="Nhập Email" required />
                                    <?php if (isset($_SESSION['errors']['email'])) { ?>
                                                    <p class="text-danger"><?= $_SESSION['errors']['email'] ?></p>
                                     <?php } ?>
                                </div>
                              
                                <div class="single-input-item">
                                    <button class="btn btn-sqr">Lấy mật khẩu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Login Content End -->

               
                </div>
            </div>
        </div>
    </div>
    <!-- login register wrapper end -->
</main>






<!-- offcanvas mini cart start -->
<?php require_once 'layout/miniCart.php' ?>
<!-- offcanvas mini cart end -->

<?php require_once 'layout/footer.php' ?>