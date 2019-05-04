<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo getRootR($contentDir,$dir);?>style.css">
    <?php
        if(!empty($headJS)){
            if(is_array($headJS)){
                foreach($headJS as $js){
                    echo "<script src='".getDirR("js",$contentDir,$dir).$js."'></script>";
                }
            }else{
                echo "<script src='".getDirR("js",$contentDir,$dir).$headJS."'></script>";
            }
        }
    ?>
    <title><?=$pgName?></title>
</head>
<body>
    <div class="wrap">
        <?php include getDirR("common",$contentDir,$dir)."header.php"; ?>
        <div id="content">



        <!-- </div>
        <?php include getDirR("common",$contentDir,$dir)."footer.php"; ?>
    </div>
    <?php
        if(!empty($bodyJS)){
            if(is_array($bodyJS)){
                foreach($bodyJS as $js){
                    echo "<script src='".getDirR("js",$contentDir,$dir).$js."'></script>";
                }
            }else{
                echo "<script src='".getDirR("js",$contentDir,$dir).$bodyJS."'></script>";
            }
        }
    ?>
</body>
</html> -->