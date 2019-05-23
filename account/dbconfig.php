<?php
    include_once "../common/sql.php";
    include_once "../common/dir.php";

    $pgName='DB暫存設定';
    $col=["dbname","dbhost","dbuser","dbpassword"];
    $inputLabels=["dbname"=>'DB Name',"dbhost"=>'Host',"dbuser"=>'User',"dbpassword"=>'Password'];
    $submitLabel='Submit';
    $clearLabel='Set to Default';
    
    

    if(!empty($_POST)){
        if(isset($_POST["set"])){
            $value=[];
            foreach($col as $c){
                if(!empty($_POST[$c])) $value[$c]=$_POST[$c];
            }
            if(testPDO($value)){
                setcookie("dbconfig",serialize($value),time() + 86400, '/');
                header("location:$file?status=success");
            }else{
                header("location:$file?status=failed");
            }
        }else if(isset($_POST["default"])){
            setcookie("dbconfig","",time() - 3600, '/');
            header("location:$file?status=default");
        }
    }
    
    if(!empty($_GET["status"])){
        if($_GET["status"] ==  "success"){
            $msg="資料庫連線成功。";            
        }else if($_GET["status"] ==  "failed"){
            $msg="資料庫連線失敗，請重新設定。";            
        }else if($_GET["status"] ==  "default"){
            $msg="已刪除設定。";
        }
    }

    if(isset($_COOKIE["dbconfig"])){
        $dbconfig=unserialize($_COOKIE["dbconfig"]);
    }

?>
<?php 
include_once getDirR("layout")."base.php"; 
?>