<?php
    if(session_id() === ''){
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smartphone | Loại hàng hóa</title>
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?><br>
    <link rel="stylesheet" href="/ltweb/assets/backend/css/style.css" type="text/css">
</head>

<body>
    <div class="dash">
        <div class="container-fluid">
            <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            <div class="row">
                <div class="col">
                    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
                </div>
                <main class="main">
                    <?php
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    ?>
                    <div class="container" style="margin-bottom: 15rem;">
                        <div class="row p-1 m-1">
                            <div class="col-xl-12">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-icon">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                        <div class="card-title"> Thêm mới loại hàng hóa </div>
                                    </div>
                                    <div class="card-body " >
                                        <form name="frmcreate" id="frmcreate" method="POST" action="#" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="TenLoaiHang">Tên loại hàng hóa</label>
                                                    <input type="text" class="form-control" name="TenLoaiHang" id="TenLoaiHang" placeholder="Tên hàng hóa" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <a href="index.php"><button type="button" class="btn btn-primary" style="margin-right: 10px; margin-left:10px">Trở về</button></a>
                                                <button type="submit" name="btnSave" id="btnSave" class="btn btn-primary">Lưu dữ liệu</button>
                                            </div>
                                        </form>
                                        <?php
                                        if (isset($_POST['btnSave'])) {
                                            $TenLoaiHang = $_POST['TenLoaiHang'];
                        
                            
                                            $sqlThemLoaiHH = "INSERT INTO loaihanghoa (TenLoaiHang) VALUES (N'$TenLoaiHang');";
                                            mysqli_query($conn, $sqlThemLoaiHH);
                                        
                                            mysqli_close($conn);
                                            echo '<script>location.href="index.php"</script>';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
    <script src="/ltweb/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="/ltweb/assets/backend/js/app.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#frmcreate').validate({
                rules: {
                    TenLoaiHang: {
                        required: true,
                        maxlength: 50,
                    },
                },
                messages: {
                    TenLoaiHang: {
                        required: "Bạn phải nhập tên loại hàng hóa",
                        maxlength: "Bạn đã nhập quá 50 ký tự cho phép",
                    },
                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                success: function(label, element) {},
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });
        });
    </script>
</body>

</html>