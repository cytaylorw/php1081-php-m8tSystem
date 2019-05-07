<?php
    
    $pgName='客戶';
    $id=["cid"=>"cid"];
    $col=["cno" => "客戶代號", "cname"=>"客戶寶號","taxID"=>"統一編號","industry"=>"行業別",
        "postcode"=>"郵遞區號","city"=>"縣市","address"=>"地址","contact"=>"聯絡人","title"=>"職稱","tel"=>"電話"];
    $types=["cno" => "text", "cname"=>"text","taxID"=>"text","industry"=>"text",
    "postcode"=>"text","city"=>"text","address"=>"text","contact"=>"text","title"=>"text","tel"=>"text"];
    $table="customer";

    include_once "../layout/cud_base.php";

    
?>