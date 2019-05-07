<?php
    
    $pgName='產品';
    $id=["pid"=>"pid"];
    $col=["pname"=>"產品名稱","pno"=>"產品代號","price"=>"單價","cost"=>"成本"];
    $types=["pname"=>"text","pno"=>"text","price"=>"number","cost"=>"number"];
    $table="product";

    include_once "../layout/cud_base.php";

    
?>