<?php
if (session_id() === '') {
    session_start();
}
include_once(__DIR__ . '/../../dbconnect.php');
if (!isset($_SESSION['tendangnhap']) || empty($_SESSION['tendangnhap'])) {
    echo 'Vui lòng đăng nhập trước khi Thanh toán! <a href="/ltweb/backend/auth/login.php">Click vào đây để đến trang Đăng nhập</a>';
    die;
} else {
    $kh_tendangnhap = $_SESSION['tendangnhap'];
    $sqlkh = "SELECT * FROM khachhang WHERE username='$kh_tendangnhap'";
    $resultkh = mysqli_query($conn, $sqlkh);
    $khrow;
    while ($row = mysqli_fetch_array($resultkh, MYSQLI_ASSOC)) {
        $khrow = array(
            'tendangnhap' => $row['username'],
            'MSKH' => $row['MSKH'],
            'HoTenKH' => $row['HoTenKH'],
            'DiaChi' => $row['DiaChi'],
            'SoDienThoai' => $row['SoDienThoai'],
            'Email' => $row['Email'],
        );
    }
    $sqldc = "SELECT * FROM DiaChiKH";
    $resultdc = mysqli_query($conn, $sqldc);
    $dcrow = [];
    while ($row = mysqli_fetch_array($resultdc, MYSQLI_ASSOC)) {
        $dcrow[] = array(
            'MaDC' => $row['MaDC'],
            'DiaChi' => $row['DiaChi'],
            'MSKH' => $row['MSKH'],
        );
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ | Thanh toán</title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
    <link rel="stylesheet" href="/ltweb/assets/frontend/css/style.css" type="text/css">
</head>

<body id="body-container">
    <?php include_once(__DIR__ . '/../layouts/partials/header.php') ?>
    <main>
        <?php
        include_once(__DIR__ . '/../../dbconnect.php');
        $cartdata = [];
        if (isset($_SESSION['cartdata'])) {
            $cartdata = $_SESSION['cartdata'];
        } else {
            $cartdata = [];
        }
        ?>
        <?php if (!empty($cartdata)) : ?>
            <div class="container mt-3 payment" style="background:#d9d9d9; padding:10px">
                <form action="" id="frmthanhtoan" name="frmthanhtoan" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-8 col-md-8">
                            <h3><span>Thông tin nhận hàng</span></h3>
                            <input type="hidden" name="MSKH" id="MSKH" value="<?= $khrow['MSKH'] ?>">
                            <input class="field_input" type="text" name="TenKH" id="TenKH" placeholder="Họ và tên" value="<?= $khrow['HoTenKH'] ?>">
                            <?php foreach ($dcrow as $dc) : ?>
                                <?php if ($khrow['MSKH'] == $dc['MSKH']) : ?>
                                    <input class="field_input" type="text" name="DiaChiKH" id="DiaChiKH" placeholder="Địa chỉ" value="<?= $dc['DiaChi'] ?>">
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <input class="field_input" type="text" name="SoDienThoaiKH" id="DiaChiKH" placeholder="Số điện thoại" value="<?= $khrow['SoDienThoai'] ?>">
                            <input class="field_input" type="text" name="EmailKH" id="EmailKH" placeholder="Email" value="<?= $khrow['Email'] ?>">
                        </div>

                        <div class="col-xs-12 col-sm-12 col-lg-4 col-md-4">
                            <div class="header-list-product">
                                <h3>Đơn hàng <span style="font-size: large;">(<?= count($cartdata) ?> sản phẩm)</span></h3>
                            </div>
                            <hr>
                            <?php
                            $stt = 0;
                            $tongtamtinh = 0;
                            ?>

                            <div class="list-product">
                                <?php foreach ($cartdata as $sp) :  ?>
                                    <div class="row">
                                        <div class="col-sm-1 col-lg-1 col-md-1 text-center">
                                            <?= ++$stt ?>
                                        </div>
                                        <div class=" col-sm-3 col-lg-3 col-md-3 img-product custom-sl-img text-center">
                                            <?php $target_file = "../../assets/uploads/img-product/" . $sp['HinhAnh'] ?>
                                            <?php if (empty($sp['HinhAnh']) || !file_exists($target_file)) : ?>
                                                <img src="/ltweb/assets/shared/default.png" height="80px" alt="Ảnh mặc định">
                                                <span class="item-soluong"><?= $sp['SoLuong'] ?></span>
                                            <?php else : ?>
                                                <img src="/ltweb/assets/uploads/img-product/<?= $sp['HinhAnh'] ?>" height="80px" alt="Ảnh <?php $sp['HinhAnh'] ?>">
                                                <span class="item-soluong"><?= $sp['SoLuong'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class=" col-sm-3 col-lg-3 col-md-3 name-btndelete">
                                            <a href="" target="_blank"><?= $sp['TenHH']; ?></a>
                                        </div>
                                        <div class="col-sm-5 col-lg-5 col-md-5 price-product text-center">
                                            <span><?= number_format($sp['Gia'], 0, ",", ".") . "đ" ?></span>
                                        </div>
                                        <?php $tongtamtinh += $sp['ThanhTien']; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php $price_struct = 0; ?>
                            <div class="thanhtoan">
                                <div class="total-price notional-price">
                                    <h6>Tạm tính:</h6>
                                    <span><?= number_format($tongtamtinh, 0, ",", ".") . "đ" ?></span>
                                    <div class="total-price">
                                        <h6>Phí vận chuyển:</h6>
                                        <span><?= number_format($price_struct, 0, ",", ".") . "đ" ?></span>
                                    </div>
                                    <hr>
                                    <div class="total-price">
                                        <h5 class="float-left">Tổng cộng:</h5>
                                        <span style="color:#2a9dcc; font-weight: 600;"><?= number_format($tongtamtinh + $price_struct, 0, ",", ".") . "đ" ?></span>
                                    </div>
                                    <div class="checkout-content">
                                        <a href="giohang.php" target="_blank" rel="noopener noreferrer"><i class="fas fa-chevron-left"></i>Quay lại giỏ hàng</a>
                                        <button type="submit" name="btncheckout" id="btncheckout" class="btn btn-primary btn-5x">Đặt hàng</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <?php
            if (isset($_POST['btncheckout'])) {
                $MSNV = mt_rand(1, 10);
                $MSKH = $_POST['MSKH'];
                $dhngaydat = date('Y-m-d');
                $dhngaygiao = strtotime('+2 day', strtotime($dhngaydat));
                $dhngaygiao = date('Y-m-j', $dhngaygiao);
                $TrangThai = 0;
                $sqlThemDH = "INSERT INTO dathang(MSNV,MSKH,NgayDH,NgayGH,TrangThai) values($MSNV,$MSKH,'$dhngaydat','$dhngaygiao',$TrangThai)";
                mysqli_query($conn, $sqlThemDH);
                $SoDonDH = $conn->insert_id;
                foreach ($cartdata as $sp) {
                    $MSHH = $sp['MSHH'];
                    $SoLuong = $sp['SoLuong'];
                    $GiaDatHang = $sp['Gia'];
                    $GiamGia = rand(0, 1);
                    $sqlThemChiTietDatHang = "INSERT INTO chitietdathang(SoDonDH, MSHH, SoLuong, GiaDatHang, GiamGia) values($SoDonDH, $MSHH, $SoLuong, $GiaDatHang, $GiamGia)";
                    mysqli_query($conn,  $sqlThemChiTietDatHang);
                }
                $_SESSION['checkdonhang'] = true;
                unset($_SESSION['cartdata']);
                echo ' <div class="container">
                <div class="alert alert-success" role="alert">
                Đặt hàng thành công!<a href="/ltweb/frontend/">Trang chủ</a>
              </div>
                </div>
                 ';
            }
            ?>
        <?php else : ?>
            <?= '<div class="container mt-5">
                <div class="alert alert-dark" role="alert">
                    Không có sản phẩn thanh toán
                <a href="/ltweb/frontend/">Trang chủ</a></div> 
                </div>';
            die; ?>
        <?php endif; ?>

    </main>
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <script src="/ltweb/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="/ltweb/assets/frontend/js/app.js" type="text/javascript"></script>
</body>

</html>