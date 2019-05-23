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
        $sql= new sql("user");
        $sql->dbconnect();
        $sql->selects = ["*"];
        $sql->wheres = sqlArray($col,$_POST);
        $user=$sql->buildSelect()->buildWhere()->query()->fetch(PDO::FETCH_ASSOC);
        if($user){
            if($user['eid'] == "0"){
                clearSession();
                $_SESSION['login']['username']=$user['username'];
                $_SESSION['login']['eid']=$user['eid'];
                $_SESSION['login']['ename']="管理者";
                $_SESSION['login']['title']="系統管理者";
            }else{                
                $sql->table="employee";
                $sql->wheres = sqlArray("員工編號",$user['eid']);
                $info=$sql->buildSelect()->buildWhere("equal")->query()->fetch(PDO::FETCH_ASSOC);
                if($info){
                    clearSession();
                    $_SESSION['login']['username']=$user['username'];
                    $_SESSION['login']['eid']=$info['員工編號'];
                    $_SESSION['login']['ename']=$info['姓名'];
                    $_SESSION['login']['title']=$info['現任職稱'];
                }else{
                    $msg="此帳號找不到員工資料，無法登入。";
                }
            }
        }else{
            $msg="帳號或密碼錯誤，請重新登入。";
        }
    }

    if(!empty($_SESSION['login']) ) header("location:".getRootR()."index.php");

?>
<?php 
include_once getDirR("layout")."base.php"; 
?>