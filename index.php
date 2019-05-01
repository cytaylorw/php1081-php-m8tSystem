<?php
    include_once "./common/sql.php";
    include_once "./common/dir.php";
    $subDir = false;
    session_start();
    if(empty($_SESSION['login']) && !empty($_POST)){
        //登入驗證
        $pdo=dbconnect();
        $sql="SELECT * FROM user u WHERE u.username='".$_POST['username']."' && u.password='". $_POST['password'] . "';";
        $user=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        if($user){
            $sql="SELECT * FROM employee WHERE 員工編號='". $user['eid'] . "';";
            $info=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
            if($info){
                $_SESSION['login']=true;
                $_SESSION['username']=$user['username'];
                $_SESSION['eid']=$info['員工編號'];
                $_SESSION['ename']=$info['姓名'];
                $_SESSION['title']=$info['現任職稱'];
            }else{
                $msg="此帳號找不到員工資料，無法登入。";
            }
        }else{
            $msg="帳號或密碼錯誤，請重新登入。";
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
            <?php 
                if(empty($_SESSION['login'])){
                    // 未登入顯示登入畫面
            ?>
            <form action="index.php" method="post">
                <div id="login" class="inputBox">
                    <div class="msg">
                        <?php
                            if(isset($msg)) echo $msg;
                        ?>
                    </div>
                    <div id="username" class="inputRow">
                        <div class="label">帳號：</div>
                        <input type="text" name="username" value="<?php if(!empty($_POST['username'])) echo $_POST['username']; ?>" required>
                    </div>
                    <div id="password" class="inputRow">
                        <div class="label">密碼：</div>
                        <input type="password" name="password" required>
                    </div>
                    <div class="action"><input type="submit" value="登入"></div>
                </div>
            </form>
            <?php
                }else{
                    // 登入後首頁
            ?>
            <div class="wrap">
                <div class="welcome">
                    <ul>
                        <li>歡迎使用「產品銷售管理系」。</li>
                        <li><span class="label">員工編號：</span><?=$_SESSION['eid']?></li>
                        <li><span class="label">姓名：</span><?=$_SESSION['ename']?></li>
                        <li><span class="label">職稱：</span><?=$_SESSION['title']?></li>
                    </ul>
                </div>
                <div class="introWrap">
                    <div class="introBox"></div>
                    <div class="introBox"></div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
        <?php include "./common/footer.php"; ?>
    </div>
    
</body>
</html>