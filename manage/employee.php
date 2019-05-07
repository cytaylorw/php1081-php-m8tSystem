<?php
    
    $pgName='員工';
    $id=["eid"=>"員工編號"];
    $col=["ename"=>"姓名","title"=>"現任職稱","dept"=>"部門代號","tel"=>"電話",
        "postcode"=>"郵遞區號","city"=>"縣市","address"=>"地址","salary"=>"目前月薪資","aleave"=>"年假天數"];
    $types=["ename"=>"text","title"=>"text","dept"=>"text","tel"=>"text",
        "postcode"=>"text","city"=>"text","address"=>"text","salary"=>"number","aleave"=>"number"];
    $table="employee";

    include_once "../layout/cud_base.php";

    
?>