<?php
    
    $col=["cid"=>"cid", "cno" => "客戶代號", "cname"=>"客戶寶號","taxID"=>"統一編號","contact"=>"聯絡人","ctel"=>"電話"];
    $table="customer";
    $pgName='客戶管理';
    $cud=['c'=>true,'u'=>true,'d'=>true];
    $action=['c'=>"add",'u'=>"edit",'d'=>"delete"];

    include_once "../layout/manage_base.php";
    
?>