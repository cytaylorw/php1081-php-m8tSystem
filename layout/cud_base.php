<?php
    
    include_once "../common/sql.php";
    include_once "../common/dir.php";
    include_once "../common/session.php";
    $action=['c'=>"add",'u'=>"edit",'d'=>"delete"];
    $labels=[$action['c']=>'新增',$action['u']=>'編輯',$action['d']=>'刪除'];
    $bodyJS=["cancel.js","zhJustified.js"];
    $colKey=array_keys($col);
    $colName=array_values($col);
    $sql= new sql($table);

    if(empty($_SESSION['login'])){
        header("location:".getRootR()."index.php");
    }

    if(empty($_GET) || checkSessionExpire($table.'_last_query') || !in_array($_GET['action'],$action) || 
        ($_GET['action'] != $action['c'] && empty($_GET['tableRadio']))){

        header("location:".$table."s.php");
    }
    $submitLabel=$labels[$_GET['action']];
    $postAction=$table.".php?action=".$_GET['action'];
    if(empty($_POST)){
        if($_GET['action'] == $action['c'])unset($_SESSION[$table.'_cud_info']);
        if(!empty($_GET['tableRadio'])){
            $sql->dbconnect();
            $sql->selects = ["*"];
            $sql->wheres = sqlArray(array_values($id)[0],$_GET['tableRadio']);
            $info=$sql->buildSelect()->buildWhere()->query()->fetch(PDO::FETCH_ASSOC);
            if($info){
                $_SESSION[$table.'_cud_info']=$info;
                $postAction=$postAction.'&tableRadio='.$_GET['tableRadio'];
                if($_GET['action'] == $action['d']) $msg="將刪除以下資料。";
            }else{
                header("location:".$table."s.php?error=notFound");
            }
        }
    }else{
        if(isset($_POST['cud'])){
            $sql->dbconnect();
            $status="action=";
            if($_GET['action'] == $action['c']){
                $sql->inserts=sqlArray($col,$_POST);
                print_r($sql->inserts);
                $insert=$sql->buildInsert()->query();
                if($insert){
                    $status=$status.$action['c'];
                }else{
                    $msg=$pgName."資料庫異常，新增失敗。";
                } 
            }else if($_GET['action'] == $action['u']){
                $diff=sqlArray($col,$_POST,$_SESSION[$table.'_cud_info']);
                if(!empty($diff)){
                    $sql->updates=$diff;
                    $sql->wheres = sqlArray(array_values($id)[0],$_SESSION[$table.'_cud_info'][array_values($id)[0]]);
                    $insert=$sql->buildUpdate()->buildWhere()->query();
                    if($insert){
                        $status=$status.$action['u'];
                    }else{
                        $msg=$pgName."資料庫異常，編輯失敗。";
                    }
                }else {
                    $msg=$pgName."資料無異動，編輯失敗。";
                }
            }else if($_GET['action'] == $action['d']){
                $sql->wheres=sqlArray(array_values($id)[0],$_SESSION[$table.'_cud_info'][array_values($id)[0]]);
                $delete=$sql->buildDelete()->buildWhere()->query();
                if($delete){
                    $status=$status.$action['d'];
                }else{
                    $msg=$pgName."資料庫異常，刪除失敗。";
                }
            }
        }else if(isset($_POST['cancel'])){
            $status='cancel';
            
        }
        if(isset($status) && !isset($msg)){
            unset($_SESSION[$table.'_cud_info']);
            header("location:".$table."s.php?".$status);
        }
        
    }
    $pgName=$labels[$_GET['action']].$pgName;
?>

<?php 
include_once "../layout/base.php";
?>