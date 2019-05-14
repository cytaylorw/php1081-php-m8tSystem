<?php
    
    include_once "../common/sql.php";
    include_once "../common/dir.php";
    include_once "../common/session.php";

    $bodyJS=["report.js"];
    
    $sql= new sql("sales2");
    if(checkSessionExpire('report_filter_years_query')){
        $sql->sql="SELECT 交易年 FROM sales2 GROUP BY 交易年 ORDER BY 交易年 DESC";
        $years=$sql->dbconnect()->query()->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['report_filter_years']=$years;
    }
    if(!empty($filterOpt)){
        $sql->dbconnect();
        foreach($filterOpt as $value){
            if($value=="products" && checkSessionExpire('report_filter_products_query')){
                $sql->table="product";
                $sql->selects=["產品代號"];
                $sql->groups=["產品代號"];
                $products=$sql->buildSelect()->buildGroupBy()->query()->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION['report_filter_products']=$products;
            }else if($value=="dept" && checkSessionExpire('report_filter_depts_query')){
                $sql->sql="SELECT 部門名稱 FROM dept WHERE 部門代號 LIKE 'D%'";
                $depts=$sql->query()->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION['report_filter_depts']=$depts;
            }
        }   
    }
    if(!empty($_POST)){
        $year = (!isset($_POST["year"]) || empty($_POST["year"]))?"":$_POST["year"];
        $report_sql=str_replace("{year}",$year,$report_sql);

        $product = (!isset($_POST["product"]) || $_POST["product"]=="all")?"":("&& 產品代號='".$_POST["product"]."'");
        $report_sql=str_replace("{product}",$product,$report_sql);

        $dept = (!isset($_POST["dept"]) || $_POST["dept"]=="all")?"部門名稱 LIKE '業務%'":("部門名稱='".$_POST["dept"]."'");
        $report_sql=str_replace("{dept}",$dept,$report_sql);

        $order=(!isset($_POST["order"]))?"":$_POST["order"];
        $report_sql=str_replace("{order}",$order,$report_sql);
        
        $sum=(isset($_POST["stotal"])&&!empty($_POST["stotal"]))?
            (($_POST["order"] == "DESC")?(">'".$_POST["stotal"]."'"):
            (($_POST["order"] == "ASC")?("<'".$_POST["stotal"]."'"):">'0'")):">'0'";
        $report_sql=str_replace("{stotal}",$sum,$report_sql);
        $sql->sql=$report_sql;
        $rows=$sql->dbconnect()->query()->fetchAll(PDO::FETCH_ASSOC);
    }
    
    ?>

<?php 
include_once getDirR("layout")."base.php";
?>