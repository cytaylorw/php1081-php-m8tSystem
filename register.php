<?php
    include_once "./common/sql.php";
    include_once "./common/dir.php";
    include_once "./common/session.php";
    
    $pgName='註冊帳號';
    if(!empty($_POST)){
        $pdo=dbconnect();
        $col=["員工編號","姓名"];
        $value=[$_POST['eid'],$_POST['ename']];
        $sql=sqlSelect("*","employee",whereEqual($col,$value));
        $info=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        if($info){
            $col=["username","password","eid"];
            $value=[$_POST['username'],$_POST['password'],$info['員工編號']];
            $sql=sqlInsert("user",$col,$value);
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

<?php include_once "./layout/base_start.php"; ?>

            <form action="register.php" method="post">
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
            
<?php include_once "./layout/base_end.php"; ?>