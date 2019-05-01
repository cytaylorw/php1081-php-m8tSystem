<?php
    include_once "../common/sql.php";
    include_once "../common/dir.php";
    $subDir = true;
    session_start();
    if(empty($_SESSION['login'])){
        // header("location:".getRootR($contentDir,$dir)."index.php");
    }
    if(empty($_POST)){
   
        // $pdo=dbconnect();
        // $sql="SELECT * FROM employee;";
        // $list=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

    }else{

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style.css">
    <title>員工管理</title>
</head>
<body>
    <div class="wrap">
        <?php include "../common/header.php"; ?>
        <div id="content">
            <div class="wrap">
                <div class="path">
                    <a href="../index.php">首頁</a>
                    <span>&nbsp;>&nbsp;</span>
                    <a href="employees.php" class="disabled">員工管理</a>
                </div>
                <div class="filterTable">
                    <div class="action tableAction">
                        <div class="floatL">
                            <input class="CUD floatL" type="submit" name="add" value="新增">
                            <input class="CUD floatL" type="submit" name="edit" value="編輯">
                            <input class="CUD floatL" type="submit" name="delete" value="刪除">
                        </div>
                        <div class="floatR">
                            <input class="floatL" type="submit" name="filter" value="搜尋">
                            <input class="floatL" type="reset" value="清除">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "../common/footer.php"; ?>
    </div>
    
</body>
</html>