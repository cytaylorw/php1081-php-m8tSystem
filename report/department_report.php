<?php
    
    $col=["部門名稱","業務姓名","客戶寶號","總額"];
    $groupCol=["部門名稱","業務姓名"];
    $table="dept";
    $pgName='業務部銷售狀況';
    $filterOpt=["dept"];

/*     $report_sql="SELECT 部門名稱, 業務姓名, 客戶寶號, 總額 FROM customer c, 
	(SELECT 部門名稱, s1.業務姓名, 客戶代號, 總額 FROM 
		(SELECT 業務姓名, 客戶代號, SUM(數量*單價) AS 總額 FROM product p, (
			SELECT 產品代號, 客戶代號, 業務姓名, SUM(數量) AS '數量' FROM sales2 WHERE 交易年='90' GROUP BY 產品代號, 業務姓名, 客戶代號
			) s WHERE p.產品代號=s.產品代號 GROUP BY 業務姓名, 客戶代號
		) s1 LEFT JOIN 
		(SELECT d.部門代號, 部門名稱, 姓名 FROM employee e, 
			(SELECT 部門名稱, 部門代號 FROM dept WHERE 部門名稱 LIKE '業務%') d WHERE e.部門代號=d.部門代號) e 
		ON e.姓名=s1.業務姓名) s2
	WHERE s2.客戶代號=c.客戶代號"; */

    $report_sql="SELECT 部門名稱, 業務姓名, 客戶寶號, 總額 FROM customer c, 
	(SELECT 部門代號, 部門名稱, s1.業務姓名, 客戶代號, 總額 FROM 
		(SELECT 業務姓名, 客戶代號, SUM(數量*單價) AS 總額 FROM product p, (
			SELECT 產品代號, 客戶代號, 業務姓名, SUM(數量) AS '數量' FROM sales2 WHERE 交易年='{year}' GROUP BY 產品代號, 業務姓名, 客戶代號
			) s WHERE p.產品代號=s.產品代號  && (數量*單價){stotal} GROUP BY 業務姓名, 客戶代號
		) s1 LEFT JOIN 
		(SELECT d.部門代號, 部門名稱, 姓名 FROM employee e, 
			(SELECT 部門名稱, 部門代號 FROM dept WHERE {dept}) d WHERE e.部門代號=d.部門代號) e 
		ON e.姓名=s1.業務姓名 WHERE {dept}) s2
    WHERE s2.客戶代號=c.客戶代號 ORDER BY 部門代號, 業務姓名, 總額 {order}";
    
    include_once "../layout/report_base.php";
    
?>