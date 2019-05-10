<?php
    
    include_once "../common/sql.php";
    include_once "../common/dir.php";
    include_once "../common/session.php";
    
    $sql= new sql("sales2");
    $sql->sql="SELECT 交易年 FROM sales2 GROUP BY 交易年 ORDER BY 交易年 DESC";
    $years=$sql->dbconnect()->query()->fetchAll(PDO::FETCH_ASSOC);;
    $sql->table="product";
    $sql->selects=["產品名稱"];
    $sql->groups=["產品名稱"];
    $products=$sql->buildSelect()->buildGroupBy()->query()->fetchAll(PDO::FETCH_ASSOC);
    $sql->sql="SELECT 產品名稱, 產品代號, 單價, 客戶寶號, 業務姓名, 數量, 總價 FROM customer c, (
        SELECT 產品名稱, p.產品代號, 客戶代號, 業務姓名, 數量, 單價, (數量*單價) AS 總價 FROM product p, (
            SELECT 產品代號, 客戶代號, 業務姓名, SUM(數量) AS '數量' FROM sales2 WHERE 交易年='90' GROUP BY 產品代號, 業務姓名, 客戶代號
            ) s WHERE p.產品代號=s.產品代號 && (數量*單價)>0
        ) s1 WHERE s1.客戶代號=c.客戶代號 GROUP BY 產品代號 ORDER BY 產品代號";
    ?>

<?php 
include_once getDirR("layout",$contentDir,$dir)."base.php";
?>