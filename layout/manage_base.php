<?php
    
    include_once "../common/sql.php";
    include_once "../common/dir.php";
    include_once "../common/session.php";

    $bodyJS=["clear.js","search.js","selectRadio.js"];
    $colKey=array_keys($col);
    $colName=array_values($col);
    $pageLimit=18;

    if(empty($_SESSION['login'])){
        header("location:".getRootR($contentDir,$dir)."index.php");
    }    

    if(!empty($_POST)){   
        if(isset($_POST["add"])){
            header("location:".$table.".php?action=".$action['c']);
        }else if(isset($_POST["edit"])){
            if(isset($_POST["tableRadio"])){
                // add cookies
                header("location:".$table.".php?action=".$action['u']."&tableRadio=".$_POST["tableRadio"]);
            }
        }else if(isset($_POST["delete"])){
            if(isset($_POST["tableRadio"])){
                // add cookies
                header("location:".$table.".php?action=".$action['d']."&tableRadio=".$_POST["tableRadio"]);
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

    if(checkSessionExpire($time,$table.'_last_query',$timeout_duration) || isset($_GET['action'])){
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
            }else{
                unset($_SESSION[$table.'_query']);
                $_SESSION[$table.'_query_count']=0;
                $_SESSION[$table.'_query_pages']=0;
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
    if(isset($_GET['action']) && $_GET['action']==$action['c']){
        $_SESSION[$table.'_query_page']=$_SESSION[$table.'_query_pages'];
    }
    $page=$_SESSION[$table.'_query_page'];
    if(isset($_SESSION[$table.'_query'])){
        $list=array_chunk($_SESSION[$table.'_query'],$pageLimit)[($page-1)];
    }
    $lastPg=$_SESSION[$table.'_query_pages'];
?>

<?php 
include_once getDirR("layout",$contentDir,$dir)."base_start.php";
include_once getDirR("layout",$contentDir,$dir)."filter_table.php";
include_once getDirR("layout",$contentDir,$dir)."base_end.php"; 
?>