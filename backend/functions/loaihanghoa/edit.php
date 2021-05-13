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
                    $id_update = $_GET['MaLoaiHang'];
                    $sqlLoaiHH = "SELECT * FROM `loaihanghoa` where MaLoaiHang = '$id_update' ";
                    $resultHH = mysqli_query($conn, $sqlLoaiHH);
                    $dataLoaiHH = [];
                    while ($rowLoaiHH = mysqli_fetch_array($resultHH, MYSQLI_ASSOC)) {
                        $dataLoaiHH = array(
                            'MaLoaiHang' => $rowLoaiHH['MaLoaiHang'],
                            'TenLoaiHang' => $rowLoaiHH['TenLoaiHang'],
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
                                        <div class="card-title"> Chỉnh sửa loại hàng hóa </div>
                                    </div>
                                    <div class="card-body ">
                                        <form name="frmupdate" id="frmupdate" method="POST" action="#" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="MaLoaiHang">Mã hàng hóa</label>
                                                    <input type="text" class="form-control disabled" disabled name="MaLoaiHang" id="MaLoaiHang" value="<?= $dataLoaiHH['MaLoaiHang'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="TenLoaiHang">Tên hàng hóa</label>
                                                    <input type="text" class="form-control" name="TenLoaiHang" id="TenLoaiHang" value="<?= $dataLoaiHH['TenLoaiHang'] ?>" required>
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
                                            $sqlSuaLoaiHH =<<<EOT
                                            UPDATE `loaihanghoa` 
                                            SET 
                                                TenLoaiHang = N'$TenLoaiHang',
                                            WHERE
                                                MaLoaiHang = $id_update;
EOT;  
                                            //print_r($sqlSuaHH); die();
                                            mysqli_query($conn, $sqlSuaLoaiHH);
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
            $('#frmupdate').validate({
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