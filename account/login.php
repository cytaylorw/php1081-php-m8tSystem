<?php
    include_once "../common/sql.php";
    include_once "../common/dir.php";
    include_once "../common/session.php";

    $pgName='登入';
    $col=["username"=>"username","password"=>"password"];
    $inputLabels=["username"=>'帳號',"password"=>'密碼'];
    $submitLabel='登入';
    

    if(!empty($_POST)){
        //登入驗證
        $pdo=dbconnect();
        $sql=sqlSelect("*","user",whereEqual($col,$_POST));
        $user=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        if($user){
            $sql=sqlSelect("*","employee",whereEqual("員工編號",$user['eid']));
            $info=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
            if($info){
                clearSession();
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

    if(!empty($_SESSION['login']) ) header("location:".getRootR($contentDir,$dir)."index.php");

?>
<?php 
include_once getDirR("layout",$contentDir,$dir)."base.php"; 
?>