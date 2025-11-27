<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>出貨管理</title>
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
    <a href="member.php">會員管理</a>
    <a href="customer.php">顧客管理</a>
    </div>
    <h1>出貨管理</h1>

    <?php
     include "connsql.php";
 $sql_query = "SELECT * FROM `buy`";
 $result = $seldb->query($sql_query);
 $total_records = $result->num_rows;

 if ($total_records > 0) {
     echo "<table border='1'>";
     echo "<tr><td>ID</td><td>姓名</td><td>品項</td><td>價格</td><td>小計</td><td>購買數量</td><td>出貨狀態</td><td>狀態調整</td></tr>";
 
     while ($row_result = $result->fetch_assoc()) {
         echo "<tr>";
         echo "<td>".$row_result["id"]."</td>";
         echo "<td>".$row_result["username"]."</td>";
         echo "<td>".$row_result["name"]."</td>";
         echo "<td>NT$".$row_result["price"]."</td>";
         echo "<td>NT$".$row_result["subtotal"]."</td>";
         echo "<td>".$row_result["quantity"]."</td>";
         echo "<td>".$row_result["rstate"]."</td>";
 
         echo "<td><a href='update-4.php?num=".$row_result["num"]."&f=o'>調整</a></td>";
         echo "</tr>";
     }
 
     echo "</table>";
     $seldb->close();
 }

    ?>

   
</body>
</html>
