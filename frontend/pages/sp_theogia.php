<?php
if (session_id() === '') {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ | Sản phẩm </title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
    <link rel="stylesheet" href="/ltweb/assets/frontend/css/style.css" type="text/css">
    <style>
    </style>
</head>

<body id="body-container">
    <?php include_once(__DIR__ . '/../layouts/partials/header.php') ?>
    <main>
        <?php
        include_once(__DIR__ . '/../../dbconnect.php');
        $giatri = $_GET['p'];
        if ($giatri == "Duoi-3-trieu") {
               $price ="Gia < 3000000";
        }else if($giatri == "Duoi-5-trieu"){
                $price = "Gia < 5000000";
        }else if($giatri == "Duoi-10-trieu"){
            $price = "Gia < 10000000";
        }else if($giatri == "Tu-10-20-trieu"){
            $price = "Gia BETWEEN 10000000 AND 20000000";
        }else if($giatri == "Tren-20-trieu"){
            $price = "Gia >= 20000000";
        };
        $sqlSelectHH = "SELECT * FROM hanghoa WHERE $price";
        $resultHH = mysqli_query($conn, $sqlSelectHH);
        $dataHH = [];
        while ($row = mysqli_fetch_array($resultHH, MYSQLI_ASSOC)) {
            $dataHH[] = array(
                'MSHH' => $row['MSHH'],
                'TenHH' => $row['TenHH'],
                'HinhAnh' => $row['HinhAnh'],
                'Gia' => $row['Gia'],
                'MaLoaiHang' => $row['MaLoaiHang'],
            );
        }
        $sqlSelectLH = "SElECT * FROM loaihanghoa";
        $resultLH = mysqli_query($conn, $sqlSelectLH);
        $dataLH = [];
        while ($row = mysqli_fetch_array($resultLH, MYSQLI_ASSOC)) {
            $dataLH[] = array(
                'MaLoaiHang' => $row['MaLoaiHang'],
                'TenLoaiHang' => $row['TenLoaiHang'],
            );
        }
        ?>
        <div class="container card-banner">
            <div class="card-group mt-2">
                <div class="card">
                    <img class="card-img-top" src="/ltweb/assets/uploads/banner/sansale-1200-75-1200x75.png" alt="Card image cap">
                </div>
            </div>
        </div>
        <div class="container product">
            <div class="brand-product">
                <div class="brand-product-title h1">Điện thoại
                    <span style="background-color: #c4191b;">
                        <hr>
                    </span>
                </div>
                <?php foreach ($dataLH as $lh) : ?>
                    <a href="/ltweb/frontend/pages/sp_theoloai.php?MaLoaiHang=<?= $lh['MaLoaiHang'] ?>"><span><?= $lh['TenLoaiHang'] ?></span></a>
                <?php endforeach; ?>
                <a href="/ltweb/frontend/pages/sanpham.php"><span>Tất cả</span></a>
            </div>
            <div class="product mt-3">
                <div class="row" id="product-item">
                    <div class="col-md-12 filter-price mb-3" style="height: 30px; padding-left: 30px;">
                        <label style=" font-size: 16px; text-align: left; float: left; font-weight:500;">Chọn mức giá: </label>
                        <form action="/ltweb/frontend/pages/sp_theogia.php" method="GET">
                            <a href="/ltweb/frontend/pages/sp_theogia.php?p=<?="Duoi-3-trieu"?>">Dưới 3 triệu</a>
                            <a href="/ltweb/frontend/pages/sp_theogia.php?p=<?="Duoi-5-trieu"?>">Dưới 5 triệu</a>
                            <a href="/ltweb/frontend/pages/sp_theogia.php?p=<?="Duoi-10-trieu"?>">Dưới 10 triệu</a>
                            <a href="/ltweb/frontend/pages/sp_theogia.php?p=<?="Tu-10-20-trieu"?>">Từ 10 - 20 triệu</a>
                            <a href="/ltweb/frontend/pages/sp_theogia.php?p=<?="Tren-20-trieu"?>">Trên 20 triệu</a>
                        </form>
                    </div>
                    <?php foreach ($dataHH as $hh) : ?>
                        <?php if (isset($hh['MSHH'])) : ?>
                            <div class="col-md-3 mb-1">
                                <div class="card">
                                    <?php $target_file = "../../assets/uploads/img-product/" . $hh['HinhAnh'] ?>
                                    <?php if (empty($hh['HinhAnh']) || !file_exists($target_file)) : ?>
                                        <img class="card-img-top zoom " src="/ltweb/assets/shared/default.png" width="160px" alt="Ảnh mặc định">
                                    <?php else : ?>
                                        <img class="card-img-top zoom " src="/ltweb/assets/uploads/img-product/<?= $hh['HinhAnh'] ?>" width="160px" alt="Ảnh <?php $hh['HinhAnh'] ?>">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h5 class="card-title pb-1" style="font-size: 14px; text-transform: capitalize;"><?= $hh['TenHH'] ?></h5>
                                        <p class="card-text" style="color: #bf081f; font-weight: bold;"><?= number_format($hh['Gia'], 0, ',', '.') . "đ"; ?></p>
                                        <a href="/ltweb/frontend/pages/chitietsp.php?MSHH=<?= $hh['MSHH'] ?>" class="btn btn-sm btn-info float-right">Xem chi tiết <i class="fas fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <script src="/ltweb/assets/frontend/js/app.js" type="text/javascript"></script>
</body>

</html>