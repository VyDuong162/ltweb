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
    <link rel="stylesheet" href="/ltweb/assets/vendor/bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/ltweb/assets/vendor/font-awesome/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="/ltweb/assets/frontend/css/style.css" type="text/css">
</head>

<body id="body-container">
    <?php include_once(__DIR__ . '/../layouts/partials/header.php') ?>
    <main>
        <?php
        include_once(__DIR__ . '/../../dbconnect.php');
        $id = $_GET['MSHH'];
        $sqlSelectHH = "SELECT * FROM hanghoa WHERE MSHH ='$id'";
        $resultHH = mysqli_query($conn, $sqlSelectHH);
        $dataHH;
        while ($row = mysqli_fetch_array($resultHH, MYSQLI_ASSOC)) {
            $dataHH = array(
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
        <div class="detail-product mt-2 mb-5">
            <div class="container">
                <div class="name-product">
                    <h3><span><?= $dataHH['TenHH'] ?></span></h3>
                </div>
                <hr>
                <div class="row">
                    <div class="ol-xs-12 col-sm-6 col-lg-5 col-md-12 text-center">
                        <?php $target_file = "../../assets/uploads/img-product/" . $dataHH['HinhAnh'] ?>
                        <?php if (empty($dataHH['HinhAnh']) || !file_exists($target_file)) : ?>
                            <img src="/ltweb/assets/shared/default.png" width="350px" alt="Ảnh mặc định">
                        <?php else : ?>
                            <img src="/ltweb/assets/uploads/img-product/<?= $dataHH['HinhAnh'] ?>" width="350px" alt="">
                        <?php endif; ?>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-5 col-md-12 pl-4">
                        <div class="price-product">
                            <?= number_format($dataHH['Gia'], 0, ',', '.') . "đ"  ?>
                        </div>
                        <div class="vat_enable">
                            * <em>Giá sản phẩm chưa bao gồm VAT</em>
                        </div>
                        <div class="status-product">
                            <b>Tình trạng: </b> <span>Còn hàng</span>
                        </div>
                        <hr>
                        <div class="product-summary">
                            <div class="description">
                                <p><label>Màn hình:</label><br>
                                    <span>6.3", Full HD+ (1080 x 2220 Pixels)</span>
                                </p>
                                <p><label>Camera trước:</label><br>
                                    <span>24 MP</span>
                                </p>
                                <p><label>Camera sau:</label><br>
                                    <span>24 MP và 16 MP (2 camera)</span>
                                </p>
                            </div>
                        </div>
                        <div class="form-product">
                            <form enctype="multipart/form-data" id="addcartform" action="/giohang.php" method="post" class="form-inline has-validation-callback">
                                <input type="hidden" name="MSHH" id="MSHH" value="<?= $dataHH['MSHH'] ?>">
                                <input type="hidden" name="TenHH" id="TenHH" value="<?= $dataHH['TenHH'] ?>">
                                <input type="hidden" name="Gia" id="Gia" value="<?= $dataHH['Gia'] ?>">
                                <input type="hidden" name="HinhAnh" id="HinhAnh" value="<?= $dataHH['HinhAnh'] ?>">
                                <div class="form-group ">
                                    <div class="custom custom-btn-number form-control">
                                        <label>Số lượng</label>
                                        <button onclick="var result = document.getElementById('sl'); var sl = result.value; if( !isNaN(sl) && (sl > 1) ) result.value--;return false;" class="btn-minus" type="button">–</button>
                                        <input type="text" class="input-text" id="sl" name="sl" size="4" value="1">
                                        <button onclick="var result = document.getElementById('sl'); var sl = result.value; if( !isNaN(sl)) result.value++;return false;" class="btn-plus " type="button">+</button>
                                    </div>
                                    <div class="clearfix mt-5">
                                        <button type="submit" id="btnCart" class="btn">
                                            <span class="txt-main">MUA NGAY</span>
                                            <span class="txt-sub">Giao hàng tận nơi</span>
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-lg-2 col-md-12">
                        <div class="onlineSupport hidden-sm hidden-xs">
                            <h2 class="supportTitle">CHÚNG TÔI LUÔN SẴN SÀNG<br>ĐỂ GIÚP ĐỠ BẠN</h2>
                            <img src="../../assets/shared/support-online.jpg" alt="Hỗ trợ trực tuyến" class="supportImage img-responsive center-block">
                            <h3 class="supportTitle3">Để được hỗ trợ tốt nhất. Hãy gọi</h3>
                            <div class="phoneNumber">
                                <a href="tel:0123456789">0123 456 789</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <script src="/ltweb/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="/ltweb/assets/frontend/js/app.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#btnCart').click(function(event) {
                event.preventDefault();
                var senddata = {
                    MSHH: $('#MSHH').val(),
                    TenHH: $('#TenHH').val(),
                    Gia: $('#Gia').val(),
                    HinhAnh: $('#HinhAnh').val(),
                    SoLuong: $('#sl').val(),
                }
                console.log((senddata));
                $.ajax({
                    url: '/ltweb/frontend/ajax/cart-themsp.php',
                    method: "POST",
                    dataType: 'json',
                    data: senddata,
                    success: function(data) {
                        console.log((senddata));
                        swal({
                            title: "Đã Thêm vào giỏ hàng",
                            icon: "success",
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal({
                            title: "Lỗi! Không thêm được vào giỏ hàng ",
                            icon: "error",
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>