  <style>
    .img{
        width: 50px;
        margin-left: 30px;
    }
    
  </style>
  <header class="header-area header-wide">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Pe-icon-7-stroke/1.2.0/css/pe-icon-7-stroke.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

      <div class="main-header d-none d-lg-block">


          <div class="header-main-area sticky">
              <div class="container">
                  <div class="row align-items-center position-relative">

                      <div class="col-lg-2">
                          <div class="logo">
                              <a href="<?= BASE_URL ?>">
                              <div class="logo">
                            <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>" style="cursor:pointer;">
                                <img class="img" src="uploads/logo2.png" alt="">                                
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 220 80" role="img" aria-label="" style="width:220px; height:auto;">
                                
                                
                                <text x="10" y="50"  font-family="'Brush Script MT', cursive, serif" font-size="28" fill="#222" font-weight="bold" style="letter-spacing: 1.5px;">
                                    SENMOOD
                                </text>
                                </svg>
                            </a>
                            </div>
                              </a>
                          </div>
                      </div>

                      <div class="col-lg-6 position-static">
                          <div class="main-menu-area">
                              <div class="main-menu">
                                  <nav class="desktop-menu">
                                      <ul>
                                          <li><a href="<?= BASE_URL ?>">Trang chủ <i></i></a>
                                          </li>

                                          <li class="dropdown">
                                              <a href="#">Sản phẩm <i class="fa fa-angle-down"></i></a>
                                              <ul class="dropdown">
                                                  <?php foreach ($listDanhMuc as $danhMuc) {
                                                      if (!isset($danhMuc['trang_thai']) || $danhMuc['trang_thai'] == 1) { ?>
                                                          <li><a href="<?= BASE_URL . '?act=products&category=' . $danhMuc['id'] ?>"><?= $danhMuc['ten_danh_muc'] ?></a></li>
                                                      <?php }
                                                  } ?>
                                              </ul>
                                          </li>
                                          <li><a href="<?= BASE_URL . '?act=gioi-thieu' ?>">Giới thiệu</a></li>
                                          <li><a href="<?= BASE_URL . '?act=lien-he' ?>">Thông Tin</a></li>
                                      </ul>
                                  </nav>

                              </div>
                          </div>
                      </div>
                     
                      <div class="col-lg-4">
            
                            <div class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                              <div class="header-search-container">
                                  <button class="search-trigger d-xl-none d-lg-block"><i class="pe-7s-search"></i></button>
                                  <form method="get" action="" class="">
                                    <input type="hidden" name="act" value="products">
                                    <input type="hidden" name="color" value="<?= htmlspecialchars($_GET['color'] ?? '') ?>">
                                    <input type="hidden" name="size" value="<?= htmlspecialchars($_GET['size'] ?? '') ?>">
                                    <input type="hidden" name="price" value="<?= htmlspecialchars($_GET['price'] ?? '') ?>">
                                    <input type="hidden" name="category" value="<?= htmlspecialchars($_GET['category'] ?? '') ?>">
                                    <input type="hidden" name="sort" value="<?= htmlspecialchars($_GET['sort'] ?? '') ?>">
                                    <input type="text" name="keyword" class="header-search-field" placeholder="Nhập tên sản phẩm" value="<?= htmlspecialchars($keyword ?? '') ?>">
                                    <button class="header-search-btn" type="submit"><i class="fas fa-search"></i></button>
                                </form>
                              </div>
                              <div class="header-configure-area">

                                  <ul class="nav justify-content-end">

                                      <li class="user-hover">
                                          <a href="#">
                                              <?php if (isset($_SESSION['user_client'])) {
                                                  $user_email = $_SESSION['user_client'];
                                                  $user_info = (new TaiKhoan())->getTaiKhoanFromEmail($user_email);
                                                  $avatar = !empty($user_info['anh_dai_dien']) ? BASE_URL . $user_info['anh_dai_dien'] : BASE_URL . 'uploads/default-avatar.png';
                                              ?>
                                                  <img src="<?= $avatar ?>" alt="avatar" style="width:32px;height:32px;border-radius:50%;object-fit:cover;display:inline-block;margin-right:6px;">
                                              <?php } else { ?>
                                                  <i class="fas fa-user"></i>
                                              <?php } ?>
                                          </a>
                                          <ul class="dropdown-list " style="width: 230px;">

                                                <?php if (isset($_SESSION['user_client'])) { 
                                                    $user_email = $_SESSION['user_client'];
                                                    $user_info = (new TaiKhoan())->getTaiKhoanFromEmail($user_email);
                                                ?>
                                            <li>
                                                <label for="">
                                                    <a href="<?= BASE_URL . '?act=tai-khoan' ?>">
                                                        <?= $user_email; ?>
                                                    </a>
                                                </label>
                                            </li>
                                    <li><a href="<?= BASE_URL . '?act=logout' ?>">Đăng xuất</a></li>
                                    <?php if ($user_info && $user_info['chuc_vu_id'] == 1): ?>
                                        <li><a href="<?= BASE_URL_ADMIN ?>">Đăng Nhập Admin</a></li>
                                    <?php endif; ?>
                                <?php } else { ?>
                                    <li><a href="<?= BASE_URL ?>?act=login">Đăng nhập</a></li>
                                    <li><a href="<?= BASE_URL . '?act=form-dang-ky' ?>">Đăng ký</a></li>
                                <?php } ?>

                                          </ul>
                                      </li>

                                      <li>
                                          <a href="<?= BASE_URL .'?act=gio-hang' ?>" class="minicart-btn">
                                              <i class="fas fa-shopping-cart"></i>
                                              <div class="notification">2</div>
                                          </a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
      </div>


  </header>