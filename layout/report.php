<div class="wrap">
    <form id="reportFilter" name="reportFilter" action="<?php echo $file;?>" method="post">
        <div class="action tableAction">
            <div class="path floatL">
                <a href="<?php echo getRootR($contentDir,$dir);?>index.php">首頁</a>
                <span>&nbsp;>&nbsp;</span>
                <a href="<?php echo $file;?>" class="active"><?=$pgName?></a>
            </div>
            <div class="floatR borderR-TR">                            
                <div class="floatL">                                
                    <input class='CUD floatL' type='submit' name='submit' value='產生報表'>
                    <input class='CUD floatL' id="clearBtn" type='reset' value='清除'>
                </div>
            </div>
        </div>
        <div class="reportFilter">
                <div class="filterWrap">
                <span class="filterLabel">交易年：</span>
                <span class="filterInput">
                    <select name="year" id="year">
                    <?php
                        foreach($_SESSION['report_filter_years'] as $key => $value){
                            if(!empty($_POST["year"]) && ($_POST["year"] == $value["交易年"])){
                                echo "<option value='".$value["交易年"]."' selected>".$value["交易年"]."</option>";
                            }else{
                                echo "<option value='".$value["交易年"]."' >".$value["交易年"]."</option>";
                            }
                        }
                    ?>
                    </select>
                </div>
                <?php
                    if(in_array("products",$filterOpt)){
                ?>
                </span>
                <div class="filterWrap">
                <span class="filterLabel">產品代號：</span>
                <span class="filterInput">
                    <select name="product" id="product">
                            <option value="all" selected>全部</option>
                    <?php
                        foreach($_SESSION['report_filter_products'] as $key => $value){
                            if(!empty($_POST["product"]) && ($_POST["product"] == $value["產品代號"])){                                
                                echo "<option value='".$value["產品代號"]."' selected>".$value["產品代號"]."</option>";
                            }else{
                                echo "<option value='".$value["產品代號"]."'>".$value["產品代號"]."</option>";
                            }
                        }
                    ?>
                    </select>
                </div>
                <?php
                }
                if(in_array("dept",$filterOpt)){
                ?>
                </span>
                <div class="filterWrap">
                <span class="filterLabel">部門名稱：</span>
                <span class="filterInput">
                    <select name="dept" id="dept">
                            <option value="all">全部</option>
                    <?php
                        foreach($_SESSION['report_filter_depts'] as $key => $value){
                            if(!empty($_POST["dept"]) && ($_POST["dept"] == $value["部門名稱"])){                                
                                echo "<option value='".$value["部門名稱"]."' selected>".$value["部門名稱"]."</option>";
                            }else{
                                echo "<option value='".$value["部門名稱"]."'>".$value["部門名稱"]."</option>";
                            }
                        }
                    ?>
                    </select>
                </div>
                <?php
                }
                
                ?>
                </span>
                <div class="filterWrap">
                <span class="filterLabel">排序：</span>
                <span class="filterInput">
                    <select name="order" id="order">
                        <option value='DESC' <?php if(!empty($_POST["order"]) && $_POST["order"]=="DESC") echo "selected";?>>遞減</option>
                        <option value='ASC'<?php if(!empty($_POST["order"]) && $_POST["order"]=="ASC") echo "selected";?>>遞增</option>
                    </select>
                </div>
                </span>
                <div class="filterWrap">
                <span class="filterLabel">總額<span id="totalDesc"></span>：</span>
                <span class="filterInput">
                    <input type="number" name="stotal" id="stotal" min="0" step="1000000" 
                        <?php if(!empty($_POST["stotal"])) echo "value='".$_POST["stotal"]."'";?>></span>
                </div>
        </div>
    </form>
    <div class="reportResult">
        <?php
            if(isset($rows) && count($rows)){
        ?>
        <div class="resultSection">
            <div class="resultHeader">
                <?php
                    foreach((array_keys($rows[0])) as $value){
                        echo "<div class='tableCell'>$value</div>";
                    }
                ?>
            </div>
            <?php
                $colNum=count(array_keys($rows[0]));
                $groupNum=count($groupCol);
                $group="";
                $groupSum=0;
                $grandSum=0;
                foreach($rows as $r){                    
                    if($r[$groupCol[0]].$r[$groupCol[1]]!=$group){
                        if($groupSum){
                            $resultRow="";
                            for($i=0;$i<($colNum-1);$i++){
                                $resultRow.="<div class='tableCell'></div>";
                            }
                            $resultRow.="<div class='tableCell'>".number_format($groupSum)."</div>";
                        ?>
                        <div class="resultRow groupSum">
                            <?php echo $resultRow ?>                    
                        </div>
                        <?php
                        }
                        $resultRow="";
                        $groupSum=0;
                        $group=$r[$groupCol[0]].$r[$groupCol[1]];
                        for($i=0;$i<$groupNum;$i++){
                            $resultRow.="<div class='tableCell'>".$r[$col[$i]]."</div>";
                        }
                        for($i=0;$i<($colNum-$groupNum);$i++){
                            $resultRow.="<div class='tableCell'></div>";
                        }
                        ?>
                        <div class="resultRow">
                           <?php echo $resultRow ?>                    
                        </div>
                        <?php
                    }
                    $resultRow="";
                    for($i=0;$i<$groupNum;$i++){
                        $resultRow.="<div class='tableCell'></div>";
                    }
                    for($i=0;$i<($colNum-$groupNum);$i++){
                        $resultRow.="<div class='tableCell'>".(($col[($i+$groupNum)]=="總額")?number_format($r[$col[($i+$groupNum)]]):$r[$col[($i+$groupNum)]])."</div>";
                    }
                    $groupSum+=$r['總額'];
                    $grandSum+=$r['總額'];
            ?>
            <div class="resultRow">
               <?php echo $resultRow ?>                    
            </div>
            <?php
                }
                if($groupSum){
                    $resultRow="";
                    for($i=0;$i<($colNum-1);$i++){
                        $resultRow.="<div class='tableCell'></div>";
                    }
                    $resultRow.="<div class='tableCell'>".number_format($groupSum)."</div>";
                ?>
                <div class="resultRow groupSum">
                    <?php echo $resultRow ?>                    
                </div>
                <?php
                }
                $resultRow="";
                for($i=0;$i<($colNum-1);$i++){
                    $resultRow.="<div class='tableCell'>".(($i==0)?"銷售總額":"")."</div>";
                }
                $resultRow.="<div class='tableCell'>".number_format($grandSum)."</div>";
            ?>
            <div class="resultRow grandSum">
               <?php echo $resultRow ?>                    
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</div>