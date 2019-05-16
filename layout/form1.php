<form action="<?=$file?>" method="post">
    <div class="inputBox">
        <div class="msg">
            <?php
                if(isset($msg)) echo $msg;
            ?>
        </div>
        <?php
            foreach($col as $key => $c){
        ?>
        <div class="inputRow">
            <div class="label"><?=$inputLabels[$key]?>：</div>
            <input type="<?php echo ($key != 'password')?"text":"password";?>" name="<?=$key?>" value="<?php if(($key != 'password') && !empty($_POST[$key])) echo $_POST[$key]; ?>" required>
        </div>
        <?php
            }
        ?>
        <div class="action"><input type="submit" value="<?=$submitLabel?>"></div>
    </div>
</form>