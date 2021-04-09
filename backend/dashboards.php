<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboards</title>
    <?php include_once(__DIR__.'/layouts/styles.php'); ?><br>
    <link rel="stylesheet" href="/ltweb/assets/backend/css/style.css" type="text/css">
</head>
<body>
    <div class="dash">
    <?php include_once(__DIR__.'/layouts/partials/header.php'); ?>
        <div class="container-fluid">
            <div class="col-md-3">
            <?php include_once(__DIR__.'/layouts/partials/sidebar.php'); ?>
            </div>
            <div class="col-md-7">
                
            </div>
        </div>
    </div>
    <?php include_once(__DIR__.'/layouts/scripts.php');?>
</body>
</html>