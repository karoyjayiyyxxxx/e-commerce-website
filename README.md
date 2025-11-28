 C 電商會員管理與購物系統 (E-Commerce Management System)

這是一個使用 C Windows Forms (WinForms) 開發的桌面應用程式專案，結合 Microsoft SQL Server (LocalDB) 進行資料存取。本系統整合了會員註冊登入、商品瀏覽、訂單處理以及庫存管理功能，並包含特定日期的行銷優惠邏輯。

 🌟 功能特色 (Features)
 1. 會員管理系統 (Member Management)
 會員註冊/新增：將使用者資料寫入資料庫。
 會員登入：驗證帳號與密碼，登入後解鎖購物功能。
 資料修改：允許會員更新密碼與姓名。
 會員刪除：從資料庫中移除會員紀錄。

 2. 購物與訂單系統 (Shopping & Orders)
 商品瀏覽：即時從資料庫讀取商品資訊（如 A款、B款）及其庫存量。
 動態計價：根據輸入的購買數量自動計算總金額。
 週三免運優惠：系統會自動偵測系統時間，若為星期三，則自動扣除運費 ($60 -> $0)。
 亂數訂單編號：使用演算法生成 9 碼不重複的英數混合訂單編號。

 3. 資料庫互動與交易 (Database & Transaction)
 庫存扣除：下單成功後，自動更新資料庫中的庫存數量 (Inventory) 並增加銷售量 (Sales)。
 訂單紀錄：將詳細訂單資訊（含物流、付款方式、狀態）寫入歷史紀錄資料庫。
 歷史查詢：會員可透過帳號與姓名查詢過往的訂單詳情。

 🛠️ 技術堆疊 (Tech Stack)
 程式語言：C (.NET Framework)
 開發框架：Windows Forms
 資料庫：Microsoft SQL Server (LocalDB)
 資料存取技術：ADO.NET (`System.Data.SqlClient`)
 核心觀念：
     SQL 語法應用 (Select, Insert, Update, Delete)
     `Timer` 控制項應用 (即時時間顯示)
     邏輯控制 (免運判斷、字串處理)
     亂數產生 (`Random` 類別應用)

 📂 資料庫架構 (Database Schema)
本專案使用三個主要的資料表：
1.  Member (會員資料)
     `Id` (帳號), `password` (密碼), `name` (姓名)
2.  goods (商品資料)
     `Id` (商品名稱), `Price` (價格), `Inventory` (庫存), `Sales` (銷量)
3.  data (訂單資料)
     `number` (訂單編號), `Id` (會員帳號), `name`, `goods`, `quantity`, `total`, `transport`, `retail`, `payment`, `state`

 🚀 安裝與執行 (Installation)

1.  環境需求：
     Visual Studio (支援 .NET 桌面開發)
     SQL Server LocalDB
2.  設定資料庫連接：
     打開 `Form2.cs` 程式碼。
     找到 `connect()` 方法中的連線字串 (Connection String)：
        ```csharp
        string strCon = @"Data Source=(LocalDB)\MSSQLLocalDB;AttachDbFilename=C:\Your\Path\To\Database1.mdf;Integrated Security=True;Connect Timeout=30;";
        ```
     重要：請將 `AttachDbFilename` 修改為你電腦中 `Database1.mdf` 的實際路徑。
3.  執行專案：
     按下 `F5` 或點擊「啟動」即可運行。
 📸 系統截圖 (Screenshots)
📝 學習心得
透過此專案，我學習了如何使用 ADO.NET 直接操作 SQL Server，並理解了 CRUD（增刪改查）在實際應用程式中的運作流程。此外，在處理「庫存扣除」與「訂單生成」的過程中，我也深入了解了保持資料一致性的重要性，並練習了 C 中 `Timer` 與 `DateTime` 的實務應用。

