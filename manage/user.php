<?php
    
    $pgName='帳號';
    $id=["id"=>"id"];
    $col=["username"=>"username","password"=>"password","eid"=>"eid"];
    $types=["username" => "text", "password"=>"password","eid"=>"text"];
    $table="user";
    $bodyJS=["cancel.js"];

    include_once "../layout/cud_base.php";

    
?>