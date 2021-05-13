<div class="nav-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow ">
        <a href="#!" class="menu-toggle">
            <i class="fas fa-bars"></i>
        </a>
        <a href="#!" class="searchbox-toggle">
            <i class="fas fa-search"></i>
        </a>
        <div class="tools">
            <a href="#" target="_blank" class="tools-item">
                <i class="fab fa-github"></i>
            </a>
            <a href="#" class="tools-item" onclick="clickbell()">
                <?php $dem =0;?>
                <input type="hidden" name="item-count" id="item-count" value="<?=$dem?>">
                <i class="fas fa-bell" ></i>
                <?php if(isset($_SESSION['checkdonhang']) && $_SESSION['checkdonhang']==true) :?>
                <?php ++$dem;?>
                <?php $_SESSION['demdonhangmoi'] = $dem?>
                <i class="tools-item-count"><?=$dem?></i>
                <?php endif;?>
            </a>
            <script>
                function clickbell(){
                    <?php unset($_SESSION['checkdonhang'])?>
                    window.location.reload(true);
                }
            </script>
            <div class="dropdown tools-item">
                <a href="#" class="dropdown-toggle" id="dropdownMenu1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu1">
                    <a class="dropdown-item" href="#!">Profile</a>
                   <?php if(isset($_SESSION['tendangnhap'])): ?>
                        <a class="dropdown-item" href="/ltweb/backend/auth/logout.php">Logout</a>
                        <?php else: ?>
                        <a class="dropdown-item" href="/ltweb/backend/auth/login.php">Login</a>
                    <?php endif;?>
                    
                </div>
            </div>
        </div> 
    </nav>
</div>

