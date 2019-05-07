<?php
    include_once "./common/sql.php";
    include_once "./common/dir.php";
    include_once "./common/session.php";
    

    if(empty($_SESSION['login'])){
        header("location:".getDirR("account",$contentDir,$dir)."login.php");
    }

?>
<?php 
include_once "./layout/base_start.php"; 
include_once "./layout/welcome.php";
include_once "./layout/base_end.php"; 
?>