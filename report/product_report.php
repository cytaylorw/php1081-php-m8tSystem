<?php
    
    $col=["產品代號","單價","客戶寶號","業務姓名","數量","總額"];
    $groupCol=["產品代號","單價"];
    $table="product";
    $pgName='歷年產品銷售狀況';
    $filterOpt=["products"];

/*     $report_sql="SELECT 產品代號, 單價, 客戶寶號, 業務姓名, 數量, 總額 FROM customer c, (
        SELECT p.產品代號, 客戶代號, 業務姓名, 數量, 單價, (數量*單價) AS 總額 FROM product p, (
            SELECT 產品代號, 客戶代號, 業務姓名, SUM(數量) AS '數量' FROM sales2 WHERE 交易年='90' GROUP BY 產品代號, 業務姓名, 客戶代號
            ) s WHERE p.產品代號=s.產品代號 && (數量*單價)>0
        ) s1 WHERE s1.客戶代號=c.客戶代號 ORDER BY 產品代號, 總額 DESC"; */

    $report_sql="SELECT 產品代號, 單價, 客戶寶號, 業務姓名, 數量, 總額 FROM customer c, (
        SELECT p.產品代號, 客戶代號, 業務姓名, 數量, 單價, (數量*單價) AS 總額 FROM product p, (
            SELECT 產品代號, 客戶代號, 業務姓名, SUM(數量) AS '數量' FROM sales2 WHERE 交易年='{year}' {product} GROUP BY 產品代號, 業務姓名, 客戶代號
            ) s WHERE p.產品代號=s.產品代號 && (數量*單價){stotal}
        ) s1 WHERE s1.客戶代號=c.客戶代號 ORDER BY 產品代號, 總額 {order}";

    include_once "../layout/report_base.php";
    
?>
