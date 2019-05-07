<?php
    
    include_once "../common/sql.php";
    include_once "../common/dir.php";
    include_once "../common/session.php";
    $action=['c'=>"add",'u'=>"edit",'d'=>"delete"];
    $labels=[$action['c']=>'新增',$action['u']=>'編輯',$action['d']=>'刪除'];
    $bodyJS=["cancel.js"];
    $colKey=array_keys($col);
    $colName=array_values($col);

    if(empty($_SESSION['login'])){
        header("location:".getRootR($contentDir,$dir)."index.php");
    }

    if(empty($_GET) || checkSessionExpire($time,$table.'_last_query',$timeout_duration) || !in_array($_GET['action'],$action) || 
        ($_GET['action'] != $action['c'] && empty($_GET['tableRadio']))){

        header("location:".$table."s.php");
    }
    $submitLabel=$labels[$_GET['action']];
    $postAction=$table.".php?action=".$_GET['action'];
    if(empty($_POST)){
        if($_GET['action'] == $action['c'])unset($_SESSION[$table.'_cud_info']);
        if(!empty($_GET['tableRadio'])){
            $pdo=dbconnect();
            $sql=sqlSelect("*", $table, array_values($id)[0]."='".$_GET['tableRadio']."'");
            $info=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
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
            $pdo=dbconnect();
            $status="action=";
            if($_GET['action'] == $action['c']){
                $sql=sqlInsert($table,$col,getPostValues($colKey));
                $insert=$pdo->query($sql);
                if($insert){
                    $status=$status.$action['c'];
                }else{
                    $msg=$pgName."資料庫異常，新增失敗。";
                } 
            }else if($_GET['action'] == $action['u']){
                $diff=getPostDiffValues($col,$_SESSION[$table.'_cud_info']);
                print_r($diff);
                if(!empty($diff)){
                    $sql=sqlUpdate($table,$diff,array_values($id)[0]."='".$_SESSION[$table.'_cud_info'][array_values($id)[0]]."'");
                    $insert=$pdo->query($sql);
                    if($insert){
                        $status=$status.$action['u'];
                    }else{
                        $msg=$pgName."資料庫異常，編輯失敗。";
                    }
                }else {
                    $msg=$pgName."資料無異動，編輯失敗。";
                }
            }else if($_GET['action'] == $action['d']){
                $sql=sqlDelete($table,array_values($id)[0]."='".$_SESSION[$table.'_cud_info'][array_values($id)[0]]."'");
                $insert=$pdo->query($sql);
                if($insert){
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

<?php include_once "../layout/base_start.php"; ?>

            <form name="cud" action="<?=$postAction?>" method="post">
                <div id="cud" class="inputBox">
                    <div class="msg">
                        <?php
                            if(isset($msg)) echo $msg;
                        ?>
                    </div>
                    <?php
                        foreach($colKey as $ck){

                    ?>

                    <div id="<?=$ck?>" class="inputRow">
                        <div class="label"><?php echo $col[$ck]?>：</div>
                        <input type="<?=$types[$ck]?>" name="<?=$ck?>" 
                            <?php 
                                if(!empty($_SESSION[$table.'_cud_info'][$col[$ck]]))
                                    echo " value='".$_SESSION[$table.'_cud_info'][$col[$ck]]."'"; 
                                if($types[$ck] == "number") echo " min='0'";
                                if($_GET['action'] == $action['d']) echo " disabled ";
                            ?> 
                        required>
                    </div>
                    <?php
                        }
                    ?>
                    
                    <div class="action">
                            <input name="cud" type="submit" value="<?php if(!empty($submitLabel)) echo $submitLabel;?>">
                        <input name="cancel" type="submit" value="取消" onClick="this.required=false;">
                    </div>
                </div>
            </form>
            
<?php include_once "../layout/base_end.php"; ?>