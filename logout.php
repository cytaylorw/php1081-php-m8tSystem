<?php
    include_once "./common/dir.php";
    include_once "./common/session.php";
    clearSession();
    header("location:".getRootR($contentDir,$dir)."index.php");
?>