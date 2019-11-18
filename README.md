# 資料庫程式設計 課程作業

## 作業要求
請根據提供的資料表，設計一個公司的產品銷售管理系統；

|資料檔名稱|資料表名稱|
|---------|---------|
|部門主檔	|DEPT|
|人事主檔	|EMPLOYEE|
|銷售主檔一	|SALES2|
|產品主檔	|PRODUCT|
|客戶主檔	|CUSTOMER|
1.	自行設計前後台的版面呈現方式
2.	需有登入及註冊功能
3.	後台有產品管理功能（新增／刪除／修改）
4.	後台有員工管理功能（新增／修改）
5.	後台有客戶管理功能，可以管理客戶資料(新增/修改)
6.	前台有選單功能可以切換至各功能的頁面，至少有以下的項目：
•	歷年產品銷售狀況（可依年度顯示不同年份的產品銷售狀況）
•	業務部銷售狀況（可依年度顯示不同年份的部門銷售狀況）

## 內容描述
這次作業主要以練習PHP為主，功能都盡量使用PHP完成，前端有需要再使用JavsScript。

* 版型設計以舒適度為主要考量。
* 共用版型，版型主要分成： 頁頭及頁尾、登入及註冊、 管理 、報表。
* 前台功能應該也需要有權限控管才能使用，功能不多，所以直接將前後台合併。
* 後台所有功能都有 新增／刪除／修改。
* 為登入及註冊功能新增資料表。
* 管理者帳號(admin)後台有帳號管理功能(部分英文)。
* 增加隱藏功能：DB暫存設定(部分英文)，使用cookie，時間24小時。
* 錯誤驗證只做到不會讓系統出現無法復原的問題。
* 使用Javascript的功能有：
    - 註冊／新增／刪除／修改的中文標籤依最大字數調整字距。
    - 調整表單按Enter會點擊的按鈕。
    - 依單選按鈕狀態啟用／禁用表單上的刪除／修改按鈕。
    - 清空／還原表單輸入。
    - 依報表頁面捲動距離調整表頭和選單按鈕。

<div style="page-break-after: always;"></div>

## 成品
系統架設在自己的NAS，使用的是NAS的Web Server，DB是NAS上docker版本。
- 連結：<https://demo.taylorw.tw:60000>

## 使用說明
- 預設帳號(密碼相同)： test(無效員工)、admin(管理者)、test1~test4(一般帳號)
- 使用者必須是有效的員工註冊及登入。
- DB暫存設定隱藏在頁面左上角。
- 關閉線上的帳號刪除／修改。