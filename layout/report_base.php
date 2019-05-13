<?php
    
    include_once "../common/sql.php";
    include_once "../common/dir.php";
    include_once "../common/session.php";
    
    $sql= new sql("sales2");
    $sql->sql="SELECT 交易年 FROM sales2 GROUP BY 交易年 ORDER BY 交易年 DESC";
    $years=$sql->dbconnect()->query()->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($filterOpt)){

        foreach($filterOpt as $value){
            if($value=="products"){
                $sql->table="product";
                $sql->selects=["產品代號"];
                $sql->groups=["產品代號"];
                $products=$sql->buildSelect()->buildGroupBy()->query()->fetchAll(PDO::FETCH_ASSOC);
            }else if($value="dept"){
                $sql->sql="SELECT 部門名稱 FROM dept WHERE 部門代號 LIKE 'D%'";
                $dept=$sql->query()->fetchAll(PDO::FETCH_ASSOC);
            }
        }   
    }
    
    $sql->sql="SELECT 產品代號, 單價, 客戶寶號, 業務姓名, 數量, 總額 FROM customer c, (
        SELECT p.產品代號, 客戶代號, 業務姓名, 數量, 單價, (數量*單價) AS 總額 FROM product p, (
            SELECT 產品代號, 客戶代號, 業務姓名, SUM(數量) AS '數量' FROM sales2 WHERE 交易年='90' GROUP BY 產品代號, 業務姓名, 客戶代號
            ) s WHERE p.產品代號=s.產品代號 && (數量*單價)>0
        ) s1 WHERE s1.客戶代號=c.客戶代號 ORDER BY 產品代號, 總額 DESC";
    $rows=$sql->query()->fetchAll(PDO::FETCH_ASSOC);
    // do{

    // }while(true);
    
    ?>

<?php 
include_once getDirR("layout",$contentDir,$dir)."base.php";
?>