<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>顧客管理</title>
    <style>
        body {
            background-color: #E3E1DE;
            font-family: Arial, sans-serif;
            margin: 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            font-size: 32px;
            margin: 20px 0 0;
        }

        form {
            border: 2px solid #333;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 20%;
            box-sizing: border-box;
            margin-bottom: 20px;
            align-self: flex-start;
            margin-left: 20px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        form input {
            margin-bottom: 10px;
            padding: 8px;
            width: calc(100% - 16px);
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            width: 60%;
            box-sizing: border-box;
            text-align: center;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .navbar {
            display: flex;
            background-color: #E3E1DE;
            width: 100%;
            box-sizing: border-box;
            border-radius: 10px;
            justify-content: flex-end;
            padding: 10px;
            margin: 10px;
        }

        .navbar a {
            color: #333;
            text-decoration: none;
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
        }

        .navbar a:hover {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="status.php">首頁</a>
        <a href="product.php">商品管理</a>
        <a href="list.php">訂單管理</a>
        <a href="ship.php">出貨管理</a>
        <a href="member.php">會員管理</a>
    </div>
    <h1>顧客管理</h1>

    <?php
    include "connsql.php";

    // 顯示購物車資料並合併會員年齡和性別
    $sql_query_cart = "SELECT b.id, b.username, b.name, b.price, b.subtotal, b.quantity, m.age, m.gender 
                       FROM `buy` b 
                       LEFT JOIN `member` m ON b.id = m.id";
    $result_cart = $seldb->query($sql_query_cart);
    $total_cart_records = $result_cart->num_rows;

    if ($total_cart_records > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>姓名</th><th>年齡</th><th>性別</th><th>品項</th><th>購買數量</th><th>價格</th><th>小計</th></tr>";

        while ($row_cart = $result_cart->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row_cart["id"] . "</td>";
            echo "<td>" . $row_cart["username"] . "</td>";
            echo "<td>" . $row_cart["age"] . "</td>";
            echo "<td>" . $row_cart["gender"] . "</td>";
            echo "<td>" . $row_cart["name"] . "</td>";
            echo "<td>" . $row_cart["quantity"] . "</td>";
            echo "<td>NT$" . $row_cart["price"] . "</td>";
            echo "<td>NT$" . $row_cart["subtotal"] . "</td>";
            
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>目前無購物車資料。</p>";
    }

    // 關閉連接
    $seldb->close();
    ?>

</body>
</html>
