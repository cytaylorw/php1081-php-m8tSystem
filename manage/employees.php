<?php
    include_once "../common/sql.php";
    include_once "../common/dir.php";
    include_once "../common/session.php";

    $col=["eid"=>"員工編號","ename"=>"姓名","title"=>"現任職稱","dept"=>"部門代號","tel"=>"電話"];
    $table="employee";
    $pgName='員工管理';
    $cud=['c'=>true,'u'=>true,'d'=>true];

    $bodyJS=["clear.js","search.js"];
    $colKey=array_keys($col);
    $colName=array_values($col);
    $pageLimit=18;

    if(empty($_SESSION['login'])){
        header("location:".getRootR($contentDir,$dir)."index.php");
    }    

    if(!empty($_POST)){   
        if(isset($_POST["add"])){
            header("location:".$table.".php?action=add");
        }else if(isset($_POST["edit"])){
            if(isset($_POST["tableRadio"])){
                // add cookies
                header("location:".$table.".php?action=edit&tableRadio=".$_POST["tableRadio"]);
            }
        }else if(isset($_POST["delete"])){
            if(isset($_POST["tableRadio"])){
                // add cookies
                header("location:".$table.".php?action=delete&tableRadio=".$_POST["tableRadio"]);
            }
        }else if(isset($_POST["search"])){
            $where=[];
            $query=[];
            foreach($colKey as $ck){
                if(!empty($_POST[$ck])){
                    array_push($where, ($col[$ck]." LIKE '%".$_POST[$ck]."%'"));
                    $query[$ck]=$_POST[$ck];
                } 
            }
            $where=implode(" && ",$where);
            if(!empty($query)){
                $_SESSION['employee_query_values']=$query;
            }else{
                unset($_SESSION['employee_query_values']);
            }
        }
    }

    if(checkEmployeeExpire($time)){
        $sql=sqlSelect($colName, $table);
    }
    if(isset($where)){
        $sql=sqlSelect($colName, $table, $where);
    }
    
    if(isset($sql)){
        $pdo=dbconnect();
        $query=$pdo->query($sql);
        if($query){
            $listNum=$query->rowCount();
            if($listNum != 0) {
                $pageTotal=ceil($listNum/$pageLimit);
                $_SESSION[$table.'_query']=$query->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION[$table.'_query_count']=$listNum;
                $_SESSION[$table.'_query_pages']=ceil($listNum/$pageLimit);
            }
        }
    }
    
    if(empty($_GET) || !isset($_GET['page'])){
        $_SESSION[$table.'_query_page']=1;
        
    }else{
        if($_GET['page']>0 && $_GET['page']<=$_SESSION[$table.'_query_pages']){
            $_SESSION[$table.'_query_page']=$_GET['page'];
        }        
    }

    $page=$_SESSION[$table.'_query_page'];
    $list=array_chunk($_SESSION[$table.'_query'],$pageLimit)[($page-1)];
    $lastPg=$_SESSION[$table.'_query_pages'];
?>

<?php include_once getDirR("common",$contentDir,$dir)."base_start.php"; ?>

            <div class="wrap">
                <div class="filterTable">
                <form id="cud" action="<?php echo $file;?>" method="post">
                    <div class="action tableAction">
                        <div class="path floatL">
                            <a href="<?php echo getRootR($contentDir,$dir);?>index.php">首頁</a>
                            <span>&nbsp;>&nbsp;</span>
                            <a href="<?php echo $file;?>" class="active"><?=$pgName?></a>
                        </div>
                        <div class="floatR borderR-TR">                            
                            <div class="floatL">                                
                                <input class="CUD floatL<?php if(!$cud['c']) echo " hidden";?>" type="submit" name="add" value="新增">
                                <input class="CUD floatL<?php if(!$cud['u']) echo " hidden";?>" type="submit" name="edit" value="編輯">
                                <input class="CUD floatL<?php if(!$cud['d']) echo " hidden";?>" type="submit" name="delete" value="刪除">
                            </div>
                        </div>
                        
                    </div>
                    <div class="tableWrap">
                        <div class="tableContent">
                                <div class="filterRow">
                                    <?php
                                        foreach($colKey as $key => $ck){
                                            if($key==0){
                                    ?>
                                    <div class='tableCell noPadding'><input type='submit' name='search' value='搜尋'></div>
                                    <?php
                                            }else{
                                                if(empty($_SESSION[$table.'_query_values'][$ck])){
                                                    echo "<div class='tableCell'><input type='text' name='".$ck."'></div>";
                                                }else{
                                                    echo "<div class='tableCell'><input type='text' name='".$ck."' value='"
                                                    .$_SESSION[$table.'_query_values'][$ck]."'></div>";
                                                }
                                                
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="thRow">
                                    <?php
                                        foreach($colName as $key => $cn){
                                            if($key==0){
                                    ?>
                                    <div class='tableCell noPadding'><input id="clearBtn" type='button' value='清除'></div>
                                    <?php
                                            }else{
                                                echo "<div class='tableCell'>".$cn."</div>";
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="tableList">
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
                        
                    </div>
                </form>    
                    <div class="tableNav">
                        <div class="totalNum">總數：<?php echo $_SESSION['employee_query_count'];?></div>
                        <div class="pgNav">
                            <form id="nav" action="<?php echo $file;?>" method="get">
                                <div class="centerWrap">   
                                
                                    <?php 
                                        if($page != 1){   
                                            echo "<div class='pgLink'><a href='".$file."?page=".($page-1)."'>上一頁</a></div>";
                                        }else{
                                            echo "<div class='pgLink' style='visibility: hidden'>上一頁</div>";
                                        }
                                    ?>                         
                                    <input type="number" name="page" min="1" max="<?php echo $_SESSION['employee_query_pages'];?>" value="<?php echo $page;?>" <?php if($_SESSION['employee_query_pages']==1) echo "disabled";?>>
                                    <input type="submit" style="display: none">
                                    <?php 
                                        if($page != $lastPg){   
                                            echo "<div class='pgLink'><a href='".$file."?page=".($page+1)."'>下一頁</a></div>";
                                        }else{
                                            echo "<div class='pgLink' style='visibility: hidden'>下一頁</div>";
                                        }  
                                    ?>
                                
                                </div>
                            </form>
                        </div>
                        <div class="totalPg">頁數：<?php echo $_SESSION['employee_query_pages'];?></div>
                    </div>
                    
                </div>
            </div>

<?php include_once getDirR("common",$contentDir,$dir)."base_end.php"; ?>