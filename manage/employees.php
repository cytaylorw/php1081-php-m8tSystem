<?php
    include_once "../common/sql.php";
    include_once "../common/dir.php";
    $subDir = true;
    session_start();
    if(empty($_SESSION['login'])){
        // header("location:".getRootR($contentDir,$dir)."index.php");
    }
    if(empty($_POST)){
   
        $pdo=dbconnect();
        $sql="SELECT * FROM employee;";
        $list=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

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
                        <input type="button" name="add" value="新增">
                        <input type="button" value="編輯">
                        <input type="button" value="刪除">
                        <input type="button" value="搜尋">
                    </div>
                </div>
            </div>
        </div>
        <?php include "../common/footer.php"; ?>
    </div>
    
</body>
</html>