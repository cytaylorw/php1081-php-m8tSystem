<form action="<?=$file?>" method="post">
    <div class="inputBox">
        <div class="msg">
            <?php
                if(isset($msg)) echo $msg;
            ?>
        </div>
        <?php
            foreach($col as $key){
        ?>
        <div class="inputRow">
            <div class="label"><?=$inputLabels[$key]?>: </div>
            <input type="text" name="<?=$key?>" value="<?php if(!empty($dbconfig[$key])) echo $dbconfig[$key]; ?>">
        </div>
        <?php
            }
        ?>
        <div class="action"><input type="submit" value="<?=$submitLabel?>" name="set"><input type="submit" value="<?=$clearLabel?>" name="default"></div>
    </div>
</form>