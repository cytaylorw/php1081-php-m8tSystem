<?php
    include_once "../common/sql.php";
    include_once "../common/dir.php";
    include_once "../common/session.php";

    if(empty($_SESSION['login'])){
        header("location:".getRootR($contentDir,$dir)."index.php");
    }
    $col=["eid"=>"員工編號","ename"=>"姓名","title"=>"現任職稱","dept"=>"部門代號","tel"=>"電話"];
    $colKey=array_keys($col);
    $colName=array_values($col);
    $pageLimit=20;

    if(!empty($_POST)){ 
        print_r($_POST);       
        if(isset($_POST["add"])){
            header("location:employee.php?action=add");
        }else if(isset($_POST["edit"])){
            if(isset($_POST["eid"])){
                // add cookies
                header("location:employee.php?action=edit");
            }
        }else if(isset($_POST["delete"])){
            if(isset($_POST["eid"])){
                // add cookies
                header("location:employee.php?action=delete");
            }
        }else if(isset($_POST["search"])){
            $where=[];
            foreach($colKey as $ck){
                if(!empty($_POST[$ck])) array_push($where, ($col[$ck]."='".$_POST[$ck]."'"));
            }
            if(!empty($where)) {
                $where=implode(" && ",$where);
            }else{
                $where=null;
            }
            echo $where;
        }
    }
    
    $table="employee";
    if(checkEmployeeExpire($time)){
        $sql=filterTableSelect($colName, $table);
    }
    if(isset($where)){
        $sql=filterTableSelect($colName, $table, $where);
    }

    if(isset($sql)){
        $pdo=dbconnect();
        $query=$pdo->query($sql);
        if($query){
            $listNum=$query->rowCount();
            if($listNum != 0) {
                $pageTotal=ceil($listNum/$pageLimit);
                $_SESSION['employee_query']=$query->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION['employee_query_count']=$listNum;
                $_SESSION['employee_query_pages']=ceil($listNum/$pageLimit);
            }
        }
    }
    
    if(empty($_GET) || empty($_GET['page'])){
        $_SESSION['employee_query_page']=$page=1;
    }else{
        if($_GET['page']>0 && $_GET['page']<=$_SESSION['employee_query_pages']){
            $_SESSION['employee_query_page']=$page=$_GET['page'];
        }else{
            $page=$_SESSION['employee_query_page'];
        }
        
    }  
    $list=array_chunk($_SESSION['employee_query'],$pageLimit)[($page-1)];
    $lastPg=$_SESSION['employee_query_pages'];
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
                <div class="filterTable">
                    <div class="action tableAction">
                        <div class="path floatL">
                            <a href="../index.php">首頁</a>
                            <span>&nbsp;>&nbsp;</span>
                            <a href="<?php echo $file;?>" class="active">員工管理</a>
                        </div>
                        <div class="floatR">                            
                            <div class="floatL">
                                <input class="CUD floatL" type="submit" name="add" value="新增">
                                <input class="CUD floatL" type="submit" name="edit" value="編輯">
                                <input class="CUD floatL borderR-TR" type="submit" name="delete" value="刪除">
                            </div>
                        </div>
                        
                    </div>
                    <div class="tableWrap">
                    <form id="search" action="<?php echo $file;?>" method="post">
                    <div class="tableContent">
                        <div class="filterRow">
                            <?php
                                foreach($colKey as $key => $ck){
                                    if($key==0){
                            ?>
                            <div class='tableCell noPadding'><input type='submit' name='search' value='搜尋'></div>
                            <?php
                                    }else{
                                        echo "<div class='tableCell'><input type='text' name='".$ck."'></div>";
                                    }
                                }
                            ?>
                        </div>
                        <div class="thRow">
                            <?php
                                foreach($colName as $key => $cn){
                                    if($key==0){
                            ?>
                            <div class='tableCell noPadding'><input type='reset' value='清除'></div>
                            <?php
                                    }else{
                                        echo "<div class='tableCell'>".$cn."</div>";
                                    }
                                }
                            ?>
                        </div>
                        <?php
                            foreach($list as $row){
                        ?>
                        <div class="listRow">
                            <?php

                                    foreach($row as $key => $value){
                                    if($key==$colName[0]){
                                        echo "<div class='tableCell'><input type='radio' name='tableRadio' value='".$value."'></div>";
                                    }else{
                                        echo "<div class='tableCell'>".$value."</div>";
                                    }
                                    }
                                ?>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    </div>
                    <div class="tableNav">
                        <div class="totalNum">總數：<?php echo $_SESSION['employee_query_count'];?></div>
                        <div class="pgNav">
                            <div class="centerWrap">   
                                <form id="nav" action="<?php echo $file;?>" method="get"></form>
                                    <?php 
                                        if($page != 1){   
                                            echo "<div class='pgLink'><a href='".$file."?page=".($page-1)."'>上一頁</a></div>";
                                        }else{
                                            echo "<div class='pgLink' style='visibility: hidden'>上一頁</div>";
                                        }
                                    ?>                         
                                    <input type="text" name="page" size="3" value="<?php echo $page;?>">
                                    <input type="submit" style="display: none">
                                    <?php 
                                        if($page != $lastPg){   
                                            echo "<div class='pgLink'><a href='".$file."?page=".($page+1)."'>下一頁</a></div>";
                                        }else{
                                            echo "<div class='pgLink' style='visibility: hidden'>下一頁</div>";
                                        }  
                                    ?>
                                </form>
                            </div>
                        </div>
                        <div class="totalPg">頁數：<?php echo $_SESSION['employee_query_pages'];?></div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include "../common/footer.php"; ?>
    </div>
    
</body>
</html>