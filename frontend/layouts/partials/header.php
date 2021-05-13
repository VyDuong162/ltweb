<?php
    if(session_id()==''){
        session_start();
    }
?>
<div id="top-header" class="container-fluid">
    <div class="row pt-2">
        <div class="col-md-3 col-sm-12 mb-1" style="text-align: center;">
            <a href="/ltweb/frontend/index.php"><img src="/ltweb/assets/shared/logo (1).png" height="" alt="" srcset=""></a>
        </div>
        <div class="col-md-5 col-sm-12 mb-2">
            <form class="d-flex" action="/ltweb/frontend/pages/timkiem.php" method="GET">
                <input class="form-control me-2 custom-control-input" name="search" type="search" placeholder="Bạn cần tìm sản phẩm gì?" aria-label="Search">
                <button class="btn btn-dark" name="btnsearch" type="submit"><i class="fas fa-search fa-l"></i></button>
            </form>
        </div>
        <div class="header-account col-md-4 col-sm-12 mb-2">
            <div class="hotline-content">
                <div class="hotline-icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="/account" style="font-weight: 500; color: #fff">Tài khoản</a>
                <span style="font-weight: 200;">Xin chào</span>
                <div class="dropdown-content">
                    <?php if (isset($_SESSION['tendangnhap'])) : ?>
                        <a href="/ltweb/backend/auth/logout.php">Đăng xuất</a>
                    <?php else : ?>
                        <a href="/ltweb/backend/auth/login.php">Đăng nhập</a>
                    <?php endif; ?>
                    <a href="/ltweb/backend/auth/register.php">Đăng ký</a>

                </div>
            </div>
            <div class="item-cart">
                <a href="/ltweb/frontend/pages/giohang.php"><i class="hotline-icon fas fa-shopping-bag"></i></a>

                <?php
                $cartdata = [];
                if (isset($_SESSION['cartdata'])) {
                    $cartdata = $_SESSION['cartdata'];
                } else {
                    $cartdata = [];
                }
                ?>
                <span class="cart-number-custom"><?= count($cartdata) ?></span>
            </div>
        </div>
    </div>
</div>
<?php
include_once(__DIR__ . '/../../../dbconnect.php');
$sqlSelectLHH = "SElECT * FROM loaihanghoa";
$resultLHH = mysqli_query($conn, $sqlSelectLHH);
$dataLHH = [];
while ($row = mysqli_fetch_array($resultLHH, MYSQLI_ASSOC)) {
    $dataLHH[] = array(
        'MaLoaiHang' => $row['MaLoaiHang'],
        'TenLoaiHang' => $row['TenLoaiHang'],
    );
}
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark custom-nav">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/ltweb/frontend/index.php">Trang chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"aria-expanded="false">
                        Điện thoại
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach ($dataLHH as $lh) : ?>
                            <li><a class="dropdown-item" href="/ltweb/frontend/pages/sp_theoloai.php?MaLoaiHang=<?= $lh['MaLoaiHang'] ?>"><?= $lh['TenLoaiHang'] ?></a></li>
                        <?php endforeach; ?>
                        <li><a class="dropdown-item" href="/ltweb/frontend/pages/sanpham.php">Tất cả</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Phụ kiện</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ltweb/frontend/pages/gioithieu.php">Giới thiệu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ltweb/frontend/pages/lienhe.php">Liên hệ</a>
                </li>
                <?php if(isset($_SESSION['tendangnhap'])) :?>
                    <?php if($_SESSION['vaitro'] == 'quanly'):?>
                        <li class="nav-item">
                            <a class="nav-link" href="/ltweb/backend/dashboard.php">Trang Admin</a>
                        </li>
                    <?php endif;?>
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>