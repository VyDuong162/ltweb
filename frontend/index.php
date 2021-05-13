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
    <title>Trang chủ</title>
    <?php include_once(__DIR__ . '/layouts/styles.php'); ?>
    <link rel="stylesheet" href="/ltweb/assets/frontend/css/style.css" type="text/css">

</head>

<body id="body-container">
    <?php include_once(__DIR__ . '/layouts/partials/header.php') ?>
    <main>
        <?php
        include_once(__DIR__ . '/../dbconnect.php');
        $sqlSelectHH = "SELECT * FROM hanghoa ORDER BY RAND() LIMIT 10";
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

        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../assets/uploads/banner/banner2.jpg" class="d-block w-100" style="position: relative" height="330px" alt="...">
                </div>
                <div class="carousel-item ">
                    <img src="../assets/uploads/banner/banner3.jpg" class="d-block w-100" style="position: relative; " height="330px" alt="...">
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="container card-banner">
            <div class="card-group mt-2">
                <div class="card">
                    <img class="card-img-top" src="/ltweb/assets/uploads/banner/card-banner1.jpg" alt="Card image cap">

                </div>
                <div class="card">
                    <img class="card-img-top" src="/ltweb/assets/uploads/banner/card-banner-note-4.png" alt="Card image cap">

                </div>
                <div class="card">
                    <img class="card-img-top" src="/ltweb/assets/uploads/banner/card-banner3.png" alt="Card image cap">
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
            </div><br>
            <div class="title-brand" style="text-align: center;background: #e56e1a;padding: 2px;color: white;border-radius: 2px;">
                <h4 style="padding-top: 5px;">Điện thoại nổi bật</h4>
            </div>
            <div class="product mt-3">
                <div class="row" id="product-item">
                    <?php foreach ($dataHH as $hh) : ?>
                        <?php if (isset($hh['MSHH'])) : ?>
                            <div class="col-md-3 mb-1">
                                <div class="card">
                                    <?php $target_file = "../assets/uploads/img-product/" . $hh['HinhAnh'] ?>
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
                    <!-- <nav aria-label="Page navigation example mt-3" >
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav> -->
                </div>
            </div>
        </div>
    </main>
    <?php include_once(__DIR__ . '/layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/layouts/scripts.php'); ?>
    <script src="/ltweb/assets/frontend/js/app.js" type="text/javascript"></script>
    <!-- <script>
        $(document).ready(function() {
            $('#product-item').pagination({
                dataSource: [1, 2, 3, 4, 5, 6, 7, ...15],
                pageSize: 5,
                showNavigator: true,
                formatNavigator: '<span style="color: #f00"><%= currentPage %></span> st/rd/th, <%= totalPage %> pages, <%= totalNumber %> entries',
                position: 'top',
                callback: function(data, pagination) {
                    // template method of yourself
                    var html = template(data);
                    dataContainer.html(html);
                }
            })
        });
    </script> -->
</body>

</html>