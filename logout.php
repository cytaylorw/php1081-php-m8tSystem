<?php
    include_once "./common/dir.php";
    session_start();
    foreach( array_keys($_SESSION) as $key){
        unset($_SESSION[$key]);
    }
    header("location:".getRootR($contentDir,$dir)."index.php");
?>