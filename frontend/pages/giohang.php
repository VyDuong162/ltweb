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

        <div class="container">
            <?php if (!empty($cartdata)) : ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <?php
                    $stt = 0;
                    $tongtien = 0;
                    ?>

                    <div class="shopping-cart-item">
                        <div class="name-cart mb-5">
                            <h1>Giỏ hàng<span style="font-size: 14px;">(<?= count($cartdata) ?> sản phẩm)</span></h1>
                        </div>

                        <div class="table-product">
                            <div class="row">
                                <div class="col-lg-9">
                                    <?php foreach ($cartdata as $sp) :  ?>
                                        <div class="row mb-5">
                                            <div class="col-sm-1 col-lg-1 col-md-1 text-center">
                                                <?= ++$stt ?>
                                            </div>
                                            <div class="col-xs-3 col-sm-3 col-lg-3 col-md-2 img-product text-center">
                                                <?php $target_file = "../../assets/uploads/img-product/" . $sp['HinhAnh'] ?>
                                                <?php if (empty($sp['HinhAnh']) || !file_exists($target_file)) : ?>
                                                    <img src="/ltweb/assets/shared/default.png" height="120px" alt="Ảnh mặc định">
                                                <?php else : ?>
                                                    <img src="/ltweb/assets/uploads/img-product/<?= $sp['HinhAnh'] ?>" width="120px" alt="Ảnh <?php $sp['HinhAnh'] ?>">
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-lg-3 col-md-2 name-btndelete">
                                                <a href="" target="_blank"><?= $sp['TenHH']; ?></a>
                                                <p><button type="button" class="btn btn-danger btn-sm btndelete" id="delete_<?= $stt ?>" data-mshh="<?=$sp['MSHH']?>">Xóa</button></p>
                                            </div>
                                            <div class="col-xs-4 col-sm-2 col-lg-2 col-md-3 price-product">
                                                <span><?= number_format($sp['Gia'], 0, ",", ".") . "đ" ?></span>
                                            </div>
                                            <div class="col-xs-4 col-sm-2 col-lg-3 col-md-2 price-product">
                                                <!-- <input type="hidden" name="MSHH" id="MSHH" value="<?=$sp['MSHH']?>"> -->
                                                <button class="btn-capnhat-sl" data-mshh="<?=$sp['MSHH']?>" onclick="  var result= document.getElementById('sl_<?=$sp['MSHH']?>'); var giatri=result.value; if( !isNaN(giatri) && (giatri > 1)) result.value--; return false;"  type="button">-</button>
                                                <input type="text" class="input-text input-sl"  maxlength="12" minlength="0" name="sl_<?=$sp['MSHH']?>" id="sl_<?=$sp['MSHH']?>" size="4" value="<?= $sp['SoLuong'] ?>">
                                                <button class="btn-capnhat-sl" data-mshh="<?=$sp['MSHH'] ?>" onclick=" var result= document.getElementById('sl_<?=$sp['MSHH']?>');var giatri=result.value; if( !isNaN(giatri)) result.value++; return false;"  type="button">+</button>
                                            </div> 
                                            <?php $tongtien += $sp['ThanhTien']; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-12 col-md-3 header-cart-price">
                                            <div class="title-cart">
                                                <h5 class="text-name-price">Tổng tiền:</h5>
                                                <a class="text-price"><?= number_format($tongtien, 0, ",", ".") . "đ" ?></a>
                                            </div>
                                            <div class="checkout">
                                                <button class="btn-checkout" title="Thanh toán" type="button" onclick="window.location.href='thanhtoan.php'">
                                                    Thanh toán
                                                </button>
                                                <button class="btn btn-continues" title="Tiếp tục mua hàng" type="button" onclick="window.location.href='../index.php'">
                                                    Tiếp tục mua hàng
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            <?php else : ?>
                <h3>Giỏ hàng rỗng!</h3>
            <?php endif; ?>
        </div>    
    </main>
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
        <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
        <script src="/ltweb/assets/vendor/sweetalert/sweetalert.min.js"></script>
        <script src="/ltweb/assets/frontend/js/app.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            function XoaSPGioHang(id) {
                var senddata = {
                    MSHH: id
                };
                console.log((senddata));
                $.ajax({
                    url: '/ltweb/frontend/ajax/cart-xoasp.php',
                    method: "POST",
                    dataType: 'json',
                    data: senddata,
                    success: function(data) {
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal({
                            title: "Lỗi! Không xóa được sản phẩm giỏ hàng ",
                            icon: "error",
                        });
                    }
                });
            }
            $('.btndelete').click(function(event) {
                //debugger;
                event.preventDefault();
                var id = $(this).data('mshh');
                XoaSPGioHang(id);
            });

            function CapNhatSPGioHang(idHH, SoLuong) {
                var senddata = {
                    MSHH: idHH,
                    SoLuong: SoLuong
                };
                debugger;
                console.log((senddata));
                $.ajax({
                    url: '/ltweb/frontend/ajax/cart-capnhatsp.php',
                    method: "POST",
                    dataType: 'json',
                    data: senddata,
                    success: function(data) {
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal({
                            title: "Lỗi! Không cập nhật được số lượng sản phẩm giỏ hàng ",
                            icon: "error",
                        });
                    }
                });
            }
            $('.btn-capnhat-sl').click(function(event) {
                debugger;
                event.preventDefault();
                var idHH = $(this).data('mshh');
                var updateSL = $('#sl_' + idHH).val();
                CapNhatSPGioHang(idHH, updateSL);
            });
        });
    </script>
</body>

</html>