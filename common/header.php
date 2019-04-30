<div id="header">
    <div class="nav">
        <div id="logo">產品銷售管理系統</div>
        <?php
            if(!empty($_SESSION['login'])){
        ?>
        <div id="menu">
            <div class="menu">
                <div class="menuBtn">報告</div>
                <div class="menuList">
                    <a href="">產品銷售狀況</a>
                    <a href="">業務部銷售狀況</a>
                </div>
            </div>
            <div class="menu">
                <div class="menuBtn">管理</div>
                <div class="menuList">
                    <a href="<?php if(!$subDir) echo "manage/"; ?>products.php">產品管理</a>
                    <a href="<?php if(!$subDir) echo "manage/"; ?>employees.php">員工管理</a>
                    <a href="<?php if(!$subDir) echo "manage/"; ?>customers.php">客戶管理</a>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
    <div id="user">
            <div class="menu">
                <div class="menuBtn">
                    <?php
                        if(empty($_SESSION['login'])){
                            echo "未登入";
                        }else{
                            echo $_SESSION['ename'];
                        }
                    ?>
                </div>
                <div class="menuList">
                <?php
                    if(empty($_SESSION['login'])){
                ?>
                    <a href="<?php if($subDir) echo "../"; ?>index.php">登入</a>
                    <a href="<?php if($subDir) echo "../"; ?>register.php">註冊</a>
                <?php
                    }else{
                ?>
                <a href="logout.php">登出</a>
                <?php
                    }
                ?>
                </div>
            </div>
    </div>
</div>