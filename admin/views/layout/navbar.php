         <nav class="main-header navbar navbar-expand navbar-white navbar-light">
             <!-- Left navbar links -->
             <ul class="navbar-nav">
                 <li class="nav-item">
                     <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                 </li>
                 <li class="nav-item d-none d-sm-inline-block">
                     <a href="<?= BASE_URL ?>" class="nav-link">Website</a>
                 </li>
                 <li class="nav-item d-none d-sm-inline-block">
                     <!-- <a href="#" class="nav-link">Contact</a> -->
                 </li>
             </ul>

             <!-- Right navbar links -->
             <ul class="navbar-nav ml-auto">
                 <li class="nav-item">
                     <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                         <i class="fas fa-expand-arrows-alt"></i>
                     </a>
                 </li>
                 <?php
                 // Kiểm tra trạng thái đăng nhập
                 if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
                 ?>
                     <li class="nav-item">
                         <a class="nav-link" href="<?= BASE_URL ?>?act=login">
                             <i class="fas fa-sign-in-alt"></i> Đăng Nhập
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="<?= BASE_URL ?>?act=register">
                             <i class="fas fa-user-plus"></i> Đăng Ký
                         </a>
                     </li>
                 <?php
                 } elseif (isset($_SESSION['admin'])) {
                 ?>
                     <li class="nav-item">
                         <span class="nav-link"><i class="fas fa-user-shield"></i> Admin: <?= $_SESSION['admin']['username'] ?? 'Admin' ?></span>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="<?= BASE_URL ?>?act=logout" onclick="return confirm('Bạn muốn đăng xuất tài khoản admin?')">
                             <i class="fas fa-sign-out-alt"></i> Đăng Xuất
                         </a>
                     </li>
                 <?php
                 } elseif (isset($_SESSION['user'])) {
                 ?>
                     <li class="nav-item">
                         <span class="nav-link"><i class="fas fa-user"></i> <?= $_SESSION['user']['username'] ?? 'User' ?></span>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="<?= BASE_URL ?>?act=logout" onclick="return confirm('Bạn muốn đăng xuất tài khoản?')">
                             <i class="fas fa-sign-out-alt"></i> Đăng Xuất
                         </a>
                     </li>
                 <?php
                 }
                 ?>
             </ul>
         </nav>