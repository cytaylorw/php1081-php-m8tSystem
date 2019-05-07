<?php
    include_once "../common/sql.php";
    include_once "../common/dir.php";
    include_once "../common/session.php";

    $col1=['ename'=>"員工編號",'eid'=>"姓名"];
    $col2=["username"=>"username","password"=>"password"];
    $col=array_merge($col1,$col2);;
    $inputLabels=['ename'=>"員工編號",'eid'=>"姓名","username"=>'帳號',"password"=>'密碼'];
    $submitLabel='註冊';
    
    $pgName='註冊帳號';
    if(!empty($_POST)){
        $pdo=dbconnect();
        $sql=sqlSelect("*","employee",whereEqual($col1,$_POST));
        $info=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        if($info){
            
            $value=[$_POST['username'],$_POST['password'],$info['員工編號']];
            $sql=sqlInsert("user",$col2,$value);
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

<?php 
include_once getDirR("layout",$contentDir,$dir)."base_start.php";
include_once getDirR("layout",$contentDir,$dir)."form1.php";
include_once getDirR("layout",$contentDir,$dir)."base_end.php"; 
?>