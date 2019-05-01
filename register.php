<?php
    include_once "./common/sql.php";
    include_once "./common/dir.php";
    $subDir = false;
    session_start();
    if(!empty($_POST)){
        //登入驗證
        $pdo=dbconnect();
        $sql="SELECT * FROM employee WHERE 員工編號='". $_POST['eid'] . "' && 姓名='". $_POST['ename'] . "';";
        $info=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        if($info){
            $sql="INSERT INTO user(username,password,eid) VALUES ('" 
            . $_POST['username'] . "', '" . $_POST['password'] . "', '" . $info['員工編號'] . "');";
            echo $sql;
            $insert=$pdo->query($sql);
            if($insert){
                $msg="註冊成功";
            }else{
                $msg="帳號或密碼異常，請重新註冊。";
            }
        }else{
            $msg="此帳號找不到員工資料，無法註冊。";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>產品銷售管理系統</title>
</head>
<body>
    <div class="wrap">
        <?php include "./common/header.php"; ?>
        <div id="content">
            <form action="register.php".php" method="post">
                <div id="register" class="inputBox">
                    <div class="msg">
                        <?php
                            if(isset($msg)) echo $msg;
                        ?>
                    </div>
                    <div id="eid" class="inputRow">
                        <div class="label">員工編號：</div>
                        <input type="text" name="eid" <?php if(!empty($_POST['eid'])) echo "value='".$_POST['eid']."'"; ?> required>
                    </div>
                    <div id="ename" class="inputRow">
                        <div class="label">員工姓名：</div>
                        <input type="text" name="ename" <?php if(!empty($_POST['ename'])) echo "value='".$_POST['ename']."'"; ?> required>
                    </div>
                    <div id="ename" class="inputRow">
                        <div class="label">帳號：</div>
                        <input type="text" name="username" <?php if(!empty($_POST['username'])) echo "value='".$_POST['username']."'"; ?> required>
                    </div>
                    <div id="ename" class="inputRow">
                        <div class="label">密碼：</div>
                        <input type="text" name="password" value="" required>
                    </div>
                    <div class="action"><input type="submit" value="註冊"></div>
                </div>
            </form>
            
        </div>
        <?php include "./common/footer.php"; ?>
    </div>
    
</body>
</html>