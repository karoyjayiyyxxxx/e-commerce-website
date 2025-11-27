<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>會員管理</title>
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
        <a href="customer.php">顧客管理</a>
    </div>
    <h1>會員管理</h1>

    <?php
    
    include "connsql.php";
    $sql_query = "SELECT * FROM member";
    $result = mysqli_query($seldb, $sql_query);

    echo "<table>";
    echo "<tr><td>帳號</td><td>密碼</td><td>名稱</td><td>修改</td><td>刪除</td></tr>";

    while ($assoc_result = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $assoc_result["id"] . "</td>";
        echo "<td>" . $assoc_result["pwd"] . "</td>";
        echo "<td>" . $assoc_result["name"] . "</td>";
        echo "<td><a href='update-2.php?num=".$assoc_result["num"]."&f=u'>修改</a></td>";
        echo "<td><a href='delete-2.php?num=".$assoc_result["num"]."&f=b'>刪除</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    $seldb->close();
    ?>

</body>
</html>
