<div id="header">
    <div class="nav">
        <div id="logo">產品銷售管理系統</div>
        <?php
            if(!empty($_SESSION['login'])){
        ?>
        <div id="menu" >
            <div class="menu floatL">
                <div class="menuBtn">報告</div>
                <div class="menuList">
                    <a href="<?php echo getDirR("report",$contentDir,$dir); ?>product_report.php">產品銷售狀況</a>
                    <a href="<?php echo getDirR("report",$contentDir,$dir); ?>department_report.php">業務部銷售狀況</a>
                </div>
            </div>
            <div class="menu floatL">
                <div class="menuBtn">管理</div>
                <div class="menuList">
                    <a href="<?php echo getDirR("manage",$contentDir,$dir); ?>products.php">產品管理</a>
                    <a href="<?php echo getDirR("manage",$contentDir,$dir); ?>employees.php">員工管理</a>
                    <a href="<?php echo getDirR("manage",$contentDir,$dir); ?>customers.php">客戶管理</a>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
    <div id="user" class="floatR">
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
                    <a href="<?php echo getDirR("account",$contentDir,$dir);?>login.php">登入</a>
                    <a href="<?php echo getDirR("account",$contentDir,$dir);?>register.php">註冊</a>
                <?php
                    }else{
                ?>
                <a href="<?php echo getDirR("account",$contentDir,$dir);?>logout.php">登出</a>
                <?php
                    }
                ?>
                </div>
            </div>
    </div>
</div>