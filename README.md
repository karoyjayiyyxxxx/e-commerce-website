 YISIR 時尚潮流服飾電商平台 (E-Commerce Web Application)

這是一個使用 PHP 與 MySQL 開發的全端電商網站專案。系統名為「YISIR」，旨在提供一個簡潔時尚的線上購物環境。本專案整合了前台商品展示、購物車功能以及後台會員與資料庫管理系統。

 🌟 功能特色 (Features)
 🛍️ 前台使用者功能
 首頁與品牌展示：展示品牌理念與視覺形象。
 商品瀏覽 (新品區)：
     動態從資料庫讀取商品資訊（圖片、名稱、價格）。
     即時顯示庫存狀態（如：存貨 0、存貨 1 等）。
 購物機制：
     支援購物車系統（資料庫 `cart` 資料表）。
     使用者需登入後才能進行購買。

 ⚙️ 後台管理功能
 會員管理系統：
     條列式顯示所有會員資料（帳號、密碼、姓名）。
     提供 修改 (Edit) 與 刪除 (Delete) 功能。
 資料庫管理 (phpMyAdmin)：
     視覺化管理商品、訂單與會員資料。
     支援 SQL 語法查詢與資料匯出。

 🛠️ 技術堆疊 (Tech Stack)

 後端語言：PHP (Native)
 資料庫：MySQL (透過 phpMyAdmin 管理)
 網頁伺服器：Apache (建議使用 XAMPP 或 WAMP 環境)
 前端技術：HTML5, CSS3, JavaScript (Bootstrap 用於表格與排版)
 開發環境：Windows, Visual Studio Code / Sublime Text

 📂 資料庫架構 (Database Schema)
本專案資料庫名稱為 `phpbook`，主要包含以下資料表：
1.  `product` (商品資料表)
     儲存商品圖片路徑 (`img`)、名稱、價格 (`price`) 與庫存量。
2.  `member` (會員資料表)
     `id` (帳號/主鍵), `password` (密碼), `name` (姓名)。
     截圖範例：帳號 `3B132054` / 姓名 `郭xx`。
3.  `cart` (購物車資料表)
     記錄使用者將商品加入購物車的狀態。
     欄位包含：
         `num` (流水號)
         `name` (商品名稱，如：黃色瘦繩針織上衣)
         `price` (單價)
         `quantity` (購買數量)
         `img` (圖片路徑，如 `images/E.jpg`)
         `subtotal` (小計金額)
         `username` (關聯會員)

 🚀 安裝與執行 (Installation)
1.  環境建置：
     下載並安裝 [XAMPP](https://www.apachefriends.org/zh_tw/index.html)。
     啟動 XAMPP Control Panel 中的 Apache 與 MySQL 服務。
2.  部署程式碼：
     將專案資料夾複製到 XAMPP 的 `htdocs` 目錄下（例如 `C:\xampp\htdocs\yisir_shop`）。
3.  匯入資料庫：
     開啟瀏覽器進入 `http://127.0.0.1/phpmyadmin`。
     建立新資料庫命名為 `phpbook`。
     匯入專案附帶的 `.sql` 檔案（或手動建立上述資料表）。
4.  執行網站：
     開啟瀏覽器輸入 `http://127.0.0.1/yisir_shop/home.php` 即可開始瀏覽。

 📸 系統截圖 (Screenshots)
 1. 網站首頁與商品展示
(此處可放入你上傳的 home.php 截圖)
> 展示時尚潮流衣物，即時顯示價格與庫存狀況。
 2. 後台會員管理
(此處可放入你上傳的 member.php 截圖)
> 管理員可檢視並編輯所有註冊會員的資訊。
 3. 資料庫管理介面
(此處可放入你上傳的 phpMyAdmin 截圖)
> 開發階段透過 phpMyAdmin 監控購物車 (`cart`) 與訂單狀態。

 📝 開發心得與未來展望
本專案實作了電子商務網站最核心的「商品展示」與「會員購物」流程。透過 PHP 與 MySQL 的結合，我學習到了動態網頁的資料串接技巧。
未來優化方向：
 安全性提升：目前的會員密碼為明碼儲存，未來預計加入 `password_hash` 進行加密處理。
 支付串接：計畫介接第三方金流 API，實現線上付款功能。
 RWD 響應式設計：優化手機版瀏覽體驗。


