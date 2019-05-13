<div class="wrap">
                <div class="filterTable">
                <form id="cud" name="cud" action="<?php echo $file;?>" method="post">
                    <div class="action tableAction">
                        <div class="path floatL">
                            <a href="<?php echo getRootR($contentDir,$dir);?>index.php">首頁</a>
                            <span>&nbsp;>&nbsp;</span>
                            <a href="<?php echo $file;?>" class="active"><?=$pgName?></a>
                        </div>
                        <div class="floatR borderR-TR">                            
                            <div class="floatL">                                
                                <input class="CUD floatL<?php if(!$cud['c']) echo " hidden";?>" type="submit" name="add" value="新增">
                                <input class="CUD floatL<?php if(!$cud['u']) echo " hidden";?>" type="submit" name="edit" value="編輯" disabled>
                                <input class="CUD floatL<?php if(!$cud['d']) echo " hidden";?>" type="submit" name="delete" value="刪除" disabled>
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
                                    <div class='tableCell'><input type='submit' name='search' value='搜尋'></div>
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
                                    <div class='tableCell'><input id="clearBtn" type='button' value='清除'></div>
                                    <?php
                                            }else{
                                                echo "<div class='tableCell'>".$cn."</div>";
                                            }
                                        }
                                    ?>
                                </div>
                                <?php
                                if(isset($list)){
                                ?>
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
                                <?php
                                }
                                ?>
                            
                        </div>
                        
                    </div>
                </form>
                    
                    <div class="tableNav">
                        <div class="totalNum">總數：<?php echo $_SESSION[$table.'_query_count'];?></div>
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
                                    <input type="number" name="page" min="1" max="<?php echo $_SESSION[$table.'_query_pages'];?>" 
                                        value="<?php echo $page;?>" <?php if($_SESSION[$table.'_query_pages']<2) echo "disabled";?>>
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
                        <div class="totalPg">頁數：<?php echo $_SESSION[$table.'_query_pages'];?></div>
                    </div>
                    
                </div>
            </div>
            <?php
                        if(!isset($list)){
                            echo "<div class='msg tableMsg'>查無資料</div>";
                        }
                    ?>