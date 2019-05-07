<?php
    include_once "./common/sql.php";
    include_once "./common/dir.php";
    include_once "./common/session.php";

    $pgName='產品銷售管理系統';
    $col=["username"=>"username","password"=>"password"];
    $inputLabels=["username"=>'帳號',"password"=>'密碼'];
    $submitLabel='登入';
    

    if(empty($_SESSION['login']) && !empty($_POST)){
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

?>
<?php 
include_once "./layout/base_start.php"; 

if(empty($_SESSION['login'])){
    // 未登入顯示登入畫面
    include_once "./layout/form1.php";
}else{
    // 登入後首頁
    include_once "./layout/welcome.php";
}
include_once "./layout/base_end.php"; 
?>