<?php
if (session_id() === '') {
    session_start();
}
    include_once(__DIR__ . '/../../dbconnect.php');
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ | Tìm kiếm</title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
    <link rel="stylesheet" href="/ltweb/assets/frontend/css/style.css" type="text/css">
    <style>
        .about-name{
            text-align: center;
            background:#3eded7;
        }
        .about-content ol li span{
            font-size: large;
            font-weight: 600;
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>
<body id="body-container">
    <?php include_once(__DIR__ . '/../layouts/partials/header.php') ?>
    <main>
       <div class="container">
            <div class="about-name" style="text-transform: uppercase; margin-top: 2rem;">
                <h2>Giới thiệu về Anttech</h2>
            </div>
            <div class="about-content">
                <ol>
                    <li><span>Lịch sử hình thành</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga accusamus, assumenda et, nemo officiis hic expedita voluptatem dignissimos rem adipisci delectus laboriosam blanditiis neque temporibus aut quae cupiditate beatae rerum.</p>
                    </li>
                    <li><span>Tầm nhìn - sứ mệnh</span>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magni repellendus quasi suscipit delectus adipisci tempore, fuga accusantium a minima sapiente sunt impedit at itaque! Assumenda quos vitae velit magni numquam.</p>
                    </li>
                    <li><span>Giá trị cốt lỗi</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta exercitationem cumque minus praesentium tempora. Doloribus quidem accusamus quis pariatur id explicabo, quod corrupti aliquam facere quae cupiditate vitae at voluptatum.</p>
                    </li>
                </ol>
            </div>
       </div>
    </main>
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <script src="/ltweb/assets/frontend/js/app.js" type="text/javascript"></script>

</body>

</html>