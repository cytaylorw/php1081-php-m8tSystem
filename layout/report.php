<div class="wrap">
    <form id="reportFilter" name="reportFilter" action="" method="post">
        <div class="action tableAction">
            <div class="path floatL">
                <a href="<?php echo getRootR($contentDir,$dir);?>index.php">首頁</a>
                <span>&nbsp;>&nbsp;</span>
                <a href="<?php echo $file;?>" class="active"><?=$pgName?></a>
            </div>
            <div class="floatR borderR-TR">                            
                <div class="floatL">                                
                    <input class='CUD floatL' type='submit' name='submit' value='產生報表'>
                    <input class='CUD floatL' id="clearBtn" type='button' value='清除'>
                </div>
            </div>
        </div>
        <div class="reportForm">
            <div class="floatR">
            <div class="inputRow floatL">
                <div class="label floatL">交易年：</div>
                <div class="floatL">
                    <select name="year" id="year">
                    <?php
                        foreach($years as $key => $value){
                            echo "<option value='".$value["交易年"]."'>".$value["交易年"]."</option>";
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="inputRow floatL">
                <div class="label floatL">產品名稱：</div>
                <div class="floatL">
                    <select name="product" id="product">
                            <option value="">全部</option>
                    <?php
                        foreach($products as $key => $value){
                            echo "<option value='".$value["產品名稱"]."'>".$value["產品名稱"]."</option>";
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="inputRow floatL">
                <div class="label floatL">排序：</div>
                <div class="floatL">
                    <select name="order" id="order">
                        <option value='DESC' selected>遞減</option>
                        <option value='ASC'>遞增</option>
                    </select>
                </div>
            </div>
            <div class="inputRow floatL">
                <div class="label floatL">總額：</div>
                <div class="floatL">
                    <input type="number" name="stotal" id="stotal" min="0" step="1000000">
                </div>
            </div>
            </div>
        
        </div>
    </form>
    <div class="reportResult"></div>
</div>