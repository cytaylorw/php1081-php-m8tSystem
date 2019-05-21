<div id="header">
    <div class="nav">
        <div id="logo"><a href="<?php echo getRootR($contentDir,$dir);?>index.php">產品銷售管理系統</a></div>
        <?php
            if(!empty($_SESSION['login'])){
        ?>
        <div id="menu" >
            <div class="menu floatL">
                <div class="menuBtn">銷售狀況</div>
                <div class="menuList">
                    <a href="<?php echo getDirR("report"); ?>product_report.php">產品銷售狀況</a>
                    <a href="<?php echo getDirR("report"); ?>department_report.php">業務部銷售狀況</a>
                </div>
            </div>
            <div class="menu floatL">
                <div class="menuBtn">管理</div>
                <div class="menuList">
                    <a href="<?php echo getDirR("manage"); ?>products.php">產品管理</a>
                    <a href="<?php echo getDirR("manage"); ?>employees.php">員工管理</a>
                    <a href="<?php echo getDirR("manage"); ?>customers.php">客戶管理</a>
                    <?php
                        if($_SESSION['login']['eid']=="0"){                            
                    ?>
                    <a href="<?php echo getDirR("manage"); ?>users.php">帳號管理</a>
                    <?php                           
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
    <div id="user" class="floatR">
        <div class="menu floatL">
            <div class="menuBtn topBtn">
                <a href="#content">頁首</a>
            </div>
        </div>
            <div class="menu floatL">
                <div class="menuBtn">
                    <?php
                        if(empty($_SESSION['login'])){
                            echo "未登入";
                        }else{
                            echo $_SESSION['login']['ename'];
                        }
                    ?>
                </div>
                <div class="menuList">
                <?php
                    if(empty($_SESSION['login'])){
                ?>
                    <a href="<?php echo getDirR("account");?>login.php">登入</a>
                    <a href="<?php echo getDirR("account");?>register.php">註冊</a>
                <?php
                    }else{
                ?>
                <a href="<?php echo getDirR("account");?>logout.php">登出</a>
                <?php
                    }
                ?>
                </div>
            </div>
    </div>
</div>