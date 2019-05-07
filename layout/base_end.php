
        </div>
        <?php include getDirR("layout",$contentDir,$dir)."footer.php"; ?>
    </div>
    <?php
        if(!empty($bodyJS)){
            if(is_array($bodyJS)){
                foreach($bodyJS as $js){
                    echo "<script src='".getDirR("js",$contentDir,$dir).$js."'></script>";
                }
            }else{
                echo "<script src='".getDirR("js",$contentDir,$dir).$bodyJS."'></script>";
            }
        }
    ?>
</body>
</html>