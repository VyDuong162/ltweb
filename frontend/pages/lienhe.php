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
    <title>Trang chủ | Liên hệ</title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
    <link rel="stylesheet" href="/ltweb/assets/frontend/css/style.css" type="text/css">
    <script> 
        function thongbao(){
            document.getElementById("thongbao").classList.remove('visually-hidden'); 
        };
    </script>
</head>

<body id="body-container">
    <?php include_once(__DIR__ . '/../layouts/partials/header.php') ?>
    <main>
        <?php
        include_once(__DIR__ . '/../../dbconnect.php');
        ?>
        <div class="container mt-3 " >
            <div class="alert alert-success alert-dismissible visually-hidden" id="thongbao" role="alert">
                Gửi thành công!
                <button type="button" class="btn-close btn-outline-light" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="row">
                <div class="name-connect" >
                    <div class="row">
                        <div class="col-md-6">
                            <h1 style="background:#3eded7; border-radius: 2px;">Liên hệ với Anttech</h1>
                        </div>
                    </div>
                    
                </div>
                <div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">
                    <form action="" id="frmlienhe" name="frmlienhe" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-2">
                            <label for="email">Email của bạn</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email của bạn" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="title">Tiêu đề của bạn</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Tiêu đề của bạn" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Nội dung của bạn</label>
                            <textarea class="form-control" name="content" name="content" maxlength="1000" required></textarea>
                        </div>
                        <button class="btn btn-primary mt-3 text-center" name="btnGui">Gửi</button>
                    </form>
                    <?php
                        if(isset($_POST['btnGui']) ){
                            if($_POST['email'] !='' && $_POST['title']!='' && $_POST['content'] != ''){
                            echo '<script>thongbao();</script>';
                            }
                        }
                    ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">
                <iframe
                    width="100%" height="300"
                    style="border:0"
                    loading="lazy"
                    allowfullscreen
                    src="https://maps.google.com/maps?q=kdc%2030%20nguyen%20van%20linh%20can%20tho&t=&z=13&ie=UTF8&iwloc=&output=embed">
                    </iframe>
                </div>
            </div>
        </div>
    </main>
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <script src="/ltweb/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="/ltweb/assets/frontend/js/app.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('#frmlienhe').validate({
                rules:{
                    email:{
                        required: true,
                    },
                    title:{
                        required: true,
                        maxlength:100,
                    },
                    content:{
                        required: true,
                        maxlength: 1000,
                    }
                },
                messages:{
                    email:{
                        required: "Bạn phải nhập email",
                    },
                    title:{
                        required: "Bạn phải nhập tựa đề",
                        maxlength:"Tựa đề tối đa 100 ký tự",
                    },
                    content:{
                        required: "bạn phải nhập nội dung",
                        maxlength: "Nội dung tối đa 1000 ký tự",
                    }
                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                        error.insertAfter(element);
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