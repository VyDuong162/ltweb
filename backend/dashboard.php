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
    <title>Dashboards</title>
    <?php include_once(__DIR__ . '/layouts/styles.php'); ?><br>
    <link rel="stylesheet" href="/ltweb/assets/backend/css/style.css" type="text/css">
</head>

<body>
    <div class="dash" style="margin-bottom: 13.5rem;">
        <div class="container-fluid">
            <?php include_once(__DIR__ . '/layouts/partials/sidebar.php'); ?>
            <div class="row">
                <div class="col">
                    <?php include_once(__DIR__ . '/layouts/partials/header.php'); ?>
                </div>
                <main class="main">
                    <div class="container">
                        <div class="row p-1 m-1">
                            <div class="row d-flex flex-wrap p-1 m-1">
                                <div class="col-xl-4 col-sm-4 col-xs-12">
                                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Tổng sản phẩm</div>
                                        <div class="card-body pb-0 text-center">
                                            <div class="text-value" id="baocaoSanPham_SoLuong">
                                                <h2></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4 col-xs-12">
                                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Tổng khách hàng</div>
                                        <div class="card-body pb-0 text-center">
                                            <div class="text-value" id="baocaoKhachHang_SoLuong">
                                                <h2></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4 col-xs-12">
                                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Tổng đơn hàng</div>
                                        <div class="card-body pb-0 text-center">
                                            <div class="text-value" id="baocaoDonHang_SoLuong">
                                                <h2></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 1rem;">
                            <div class=" col-xl-6 col-sm-6 col-lg-6 col-xs-12">
                                <div class="card text-white mb-3" style="max-width: 18rem;">
                                    <div class="card-header bg-secondary">Thông báo</div>
                                    <div class="card-body pb-0 text-center">
                                    <?php if( isset($_SESSION['demdonhangmoi'])) :?>
                                        <div class="text-value">
                                            <?php if($_SESSION['demdonhangmoi']!=0):?>
                                                <?php $x=$_SESSION['demdonhangmoi']?>
                                            <div class="alert alert-success alert-dismissible" id="thongbao" role="alert">
                                                Có <?=$x?> đơn hàng mới!
                                                <button type="button" class="btn-close btn-outline-light" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <?php else : ?>

                                            <?php endif;?>
                                        </div>
                                    <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <?php include_once(__DIR__ . '/layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/layouts/scripts.php'); ?>
    <script src="../assets/backend/js/app.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            function getTongSoHangHoa(){
                $.ajax('/ltweb/backend/api/baocao-thongke-hanghoa.php',{
                    success: function(data){
                        var obj = JSON.parse(data);
                        var htmlstring = `<h2>${obj.tongsp}<h2>`;
                        $('#baocaoSanPham_SoLuong').html(htmlstring);
                    },
                    error: function(){
                        var htmlstring = `<h2>Lỗi xử lý<h2>`;
                        $('#baocaoSanPham_SoLuong').html(htmlstring);
                    }
                });
            }
            function getTongSoKhachHang(){
                $.ajax('/ltweb/backend/api/baocao-thongke-khachhang.php',{
                    success: function(data){
                        var obj = JSON.parse(data);
                        var htmlstring = `<h2>${obj.tongkh}<h2>`;
                        $('#baocaoKhachHang_SoLuong').html(htmlstring);
                    },
                    error: function(){
                        var htmlstring = `<h2>Lỗi xử lý<h2>`;
                        $('#baocaoKhachHang_SoLuong').html(htmlstring);
                    }
                });
            }
            function getTongSoDatHang(){
                $.ajax('/ltweb/backend/api/baocao-thongke-dathang.php',{
                    success: function(data){
                        var obj = JSON.parse(data);
                        var htmlstring = `<h2>${obj.tongdh}<h2>`;
                        $('#baocaoDonHang_SoLuong').html(htmlstring);
                    },
                    error: function(){
                        var htmlstring = `<h2>Lỗi xử lý<h2>`;
                        $('#baocaoDonHang_SoLuong').html(htmlstring);
                    }
                });
            }
            getTongSoHangHoa();
            getTongSoKhachHang();
            getTongSoDatHang();
        });
    </script>
</body>

</html>