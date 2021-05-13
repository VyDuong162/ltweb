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
    <title>Smartphone | Khách hàng</title>
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
                    $id_update = $_GET['MSKH'];
                    $sql = "SELECT * FROM `khachhang` WHERE MSKH=$id_update";
                    $result = mysqli_query($conn, $sql);
                    $dataKhachHang = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $dataKhachHang = array(
                            'MSKH' => $row['MSKH'],
                            'HoTenKH' => $row['HoTenKH'],
                            'TenCongTy' => $row['TenCongTy'],
                            'SoDienThoai' => $row['SoDienThoai'],
                            'Email' => $row['Email'],
                        );
                    }
                    ?>
                    <div class="container">
                        <div class="row p-1 m-1">
                            <div class="col-xl-12">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-icon">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                        <div class="card-title"> Chỉnh sửa khách hàng </div>
                                    </div>
                                    <div class="card-body ">
                                        <form name="frmedit" id="frmedit" method="POST" action="" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="hoTenKH">Họ tên khách hàng</label>
                                                    <input type="text" class="form-control" name="hoTenKH" id="hoTenKH" value="<?php echo $dataKhachHang['HoTenKH'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="tenCongTy">Tên công ty</label>
                                                    <input type="text" class="form-control" name="tenCongTy" id="tenCongTy" value="<?php echo $dataKhachHang['TenCongTy'] ?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="soDienThoai">Số điện thoại</label>
                                                    <input type="tel" class="form-control" name="soDienThoai" id="soDienThoai" value="<?php echo $dataKhachHang['SoDienThoai'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="email">Email</label>
                                                    <input type="Email" class="form-control" name="email" id="email" value="<?php echo $dataKhachHang['Email'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <a href="index.php"><button type="button" class="btn btn-primary" style="margin-right: 10px; margin-left:10px">Trở về</button></a>
                                                <button type="submit" name="btnSave" id="btnSave" class="btn btn-primary">Lưu dữ liệu</button>
                                            </div>
                                        </form>
                                        <?php
                                            if (isset($_POST['btnSave'])) {
                                                $hoTenKH = $_POST['hoTenKH'];
                                                $tenCongTy = $_POST['tenCongTy'];
                                                $soDienThoai = $_POST['soDienThoai'];
                                                $email = $_POST['email'];

                                                $sqlSuaKH = <<<EOT
                                                        UPDATE `khachhang`
                                                        SET
                                                            HoTenKH = '$hoTenKH',                                            
                                                            TenCongTy = '$tenCongTy',                                              
                                                            SoDienThoai = '$soDienThoai',                                               
                                                            Email = '$email'
                                                        WHERE
                                                            MSKH = '$id_update';                                              
    EOT;
                                                mysqli_query($conn, $sqlSuaKH);
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
          $(document).ready(function(){
            $('#frmcreate').validate({
                rules: {
                    hoTenKH: {
                        required: true,
                        maxlength: 50,
                    },
                    tenCongTy: {
                        required: true,
                        maxlength: 50,
                    },
                    soDienThoai: {
                        required: true,
                        minlength:10,
                        maxlength: 10,
                    },
                    email: {
                        required: true,
                        maxlength: 100,
                    },
                },
                messages: {
                    hoTenKH: {
                        required: "Bạn phải nhập họ tên khách hàng",
                        maxlength: "Bạn đã nhập quá 50 ký tự cho phép",
                    },
                    tenCongTy: {
                        required: "Bạn phải nhập tên công ty ",
                        maxlength: "Bạn đã nhập quá 50 ký tự cho phép",
                    },
                    soDienThoai: {
                        required: "Bạn phải nhập số điện thoại ",
                        minlength:"Bạn đã nhập ít hơn 10 ký tự cho phép",
                        maxlength: "Bạn đã nhập quá 10 ký tự cho phép",
                    },
                    email: {
                        required:  "Bạn phải nhập email ",
                        maxlength: "Bạn đã nhập quá 100 ký tự cho phép",
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