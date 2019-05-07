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