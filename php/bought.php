<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <title>購買資訊</title>
    <style>
        body {
            background-color: #E3E1DE;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        table {
            border-collapse: collapse;
            width: 55%;
            box-sizing: border-box;
            margin-top: 20px; /* Add margin to space it from the h1 */
        }

        th:first-child,
        td:first-child {
            width: 11%; /* 調整第一欄的寬度為原來的 20% */
        }

        table, th, td {
            border: 1px solid #333;
        }

        tr:first-child td {
        font-weight: bold; /* 設定文字粗體 */
        font-size: 18px;
        }

        th, td {
            padding: 10px;
            text-align: center; /* Center align the text in cells */
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
        }

        header {
        text-align: right;
        background-color: transparent;
        padding: 0px; 
        display: flex;
        justify-content: space-between;
        align-items: center;
        }

        .login-register a {
            border: 3px solid #ccc; /* Existing border style */
            padding: 10px;
            margin: 0 10px;
            color: #333; /* Existing text color */
            text-decoration: none;
        }

        .cart-link,
        .login-register a {
            position: absolute;
            top: 10px;
            right: 20px; /* 調整 right 的值以達到您想要的位置 */
            border: 3px solid #ccc; /* Existing border style */
            padding: 10px;
            margin: 0 10px;
            color: #333; /* Existing text color */
            text-decoration: none;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 7px;
            text-align: center;
        }

        header img {
            max-width: 100%;
            height: auto;
            width: 30px; /* 設定圖片寬度 */
            margin-right: auto;
        }
    </style>
        
</head>
<body>
<header>
    <a href="home.php" class="cart-link">主頁</a>
    </div>
</header>

    <h1>購買資訊</h1>
    
    <?php
    session_start();
    $id = $_SESSION['id'];
    $username = $_SESSION['name'];
    include "connsql.php";

    $sql_query = "SELECT * FROM `buy` WHERE `id` = '$id' AND `username` = '$username'";
    $result = $seldb->query($sql_query);
    $total_records = $result->num_rows;

    echo "商品樣式(".$total_records.")<br>";
    if($total_records > 0) {
        echo "<table border='1'>";
        echo "<tr><td></td><td>品項</td><td>價格</td><td>小計</td><td>購買數量</td><td>出貨狀態</td></tr>";
        while($row_result = $result->fetch_assoc()) {
            echo "<tr>";
            // 在這裡加入圖片的顯示
            echo "<td><img src='" . $row_result["img"] . "' alt='product image' style='max-width: 90px; max-height: 90px;'></td>";
            echo "<td>".$row_result["name"]."</td>";
            echo "<td>NT$".$row_result["price"]."</td>";
            echo "<td>NT$".$row_result["subtotal"]."</td>";
            echo "<td>".$row_result["quantity"]."</td>";
            echo "<td>".$row_result["rstate"]."</td>";
            echo "</tr>";
            }
        echo "</table>";
        echo "</form>";
    }

    $seldb->close();
    ?>
</body>
</html>