<?php
    include_once "../common/sql.php";
    include_once "../common/dir.php";
    include_once "../common/session.php";

    $col1=['eid'=>"員工編號",'ename'=>"姓名"];
    $col2=["username"=>"username","password"=>"password"];
    $col=array_merge($col1,$col2);;
    $inputLabels=['eid'=>"員工編號",'ename'=>"姓名","username"=>'帳號',"password"=>'密碼'];
    $submitLabel='註冊';
    $bodyJS=["zhJustified.js"];
    
    $pgName='註冊帳號';
    if(!empty($_POST)){
        $sql= new sql("employee");
        $sql->dbconnect();
        $sql->selects = ["*"];
        $sql->wheres = sqlArray($col1,$_POST);
        $user=$sql->buildSelect()->buildWhere()->query()->fetch(PDO::FETCH_ASSOC);
        if($user){
            $sql->table="user";
            $value=[$_POST['username'],$_POST['password'],$user['員工編號']];
            $col2["eid"]="eid";
            $sql->inserts = sqlArray($col2,$_POST);
            $insert=$sql->buildInsert()->query();
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
include_once getDirR("layout")."base.php";
?>