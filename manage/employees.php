<?php
    
    $col=["eid"=>"員工編號","ename"=>"姓名","title"=>"現任職稱","dept"=>"部門代號","tel"=>"電話"];
    $table="employee";
    $pgName='員工管理';
    $cud=['c'=>true,'u'=>true,'d'=>true];
    $action=['c'=>"add",'u'=>"edit",'d'=>"delete"];

    include_once "../common/manage_base.php";
    
?>
