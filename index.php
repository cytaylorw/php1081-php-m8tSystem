<?php
    include_once "./common/sql.php";
    include_once "./common/dir.php";
    include_once "./common/session.php";
    
    $pgName='產品銷售管理系統';
    if(empty($_SESSION['login'])){
        header("location:".getDirR("account",$contentDir,$dir)."login.php");
    }

?>
<?php 
include_once "./layout/base.php";
?>