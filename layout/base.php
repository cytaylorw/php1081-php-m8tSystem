<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo getRootR();?>style.css">
    <?php
        if(!empty($headJS)){
            if(is_array($headJS)){
                foreach($headJS as $js){
                    echo "<script src='".getDirR("js").$js."'></script>";
                }
            }else{
                echo "<script src='".getDirR("js").$headJS."'></script>";
            }
        }
    ?>
    <title><?=$pgName?></title>
</head>
<body>
    <div class="wrap">
        <?php include getDirR("layout")."header.php"; ?>
        <div id="content">

        <?php
            $accountPg=['login.php','register.php'];
            $manageSearch=['employees.php','products.php','customers.php','users.php'];
            $manageCUD=['employee.php','product.php','customer.php','user.php'];
            $reportPg=['department_report.php','product_report.php'];
            
            if($file == "index.php"){
                include_once getDirR("layout")."welcome.php";
            }else if(in_array($file,$manageSearch)){
                include_once getDirR("layout")."filter_table.php";
            }else if(in_array($file,$manageCUD)){
                include_once getDirR("layout")."form_cud.php";
            }else if(in_array($file,$accountPg)){
                include_once getDirR("layout")."form1.php";
            }else if(in_array($file,$reportPg)){
                include_once getDirR("layout")."report.php";
            }
        ?>

        </div>
        <?php include getDirR("layout")."footer.php"; ?>
    </div>
    <?php
        if(!empty($bodyJS)){
            if(is_array($bodyJS)){
                foreach($bodyJS as $js){
                    echo "<script src='".getDirR("js").$js."'></script>";
                }
            }else{
                echo "<script src='".getDirR("js").$bodyJS."'></script>";
            }
        }
    ?>
</body>
</html>