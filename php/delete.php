<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>刪除頁面</title>
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

        form {
            border: 2px solid #333;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 20%;
            box-sizing: border-box;
            margin-bottom: 20px;
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
            width: 50%;
            box-sizing: border-box;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h1>刪除</h1>

<?php
if (isset($_GET["num"])) {
    include "connsql.php";
    $sql_query = "SELECT * FROM `cart` WHERE num='" . $_GET["num"] . "'";
    $result = $seldb->query($sql_query);
    while ($row_result = $result->fetch_assoc()) {
        echo "
        <form method='POST' action='delete.php'>
            <label>品項：</label>
            <input type='text' name='name' value='" . $row_result["name"] . "' readonly><br>
            <label>價格：</label>
            <input type='text' name='price' value='" . $row_result["price"] . "' readonly><br>
            <label>小計：</label>
            <input type='text' name='subtotal' value='" . $row_result["subtotal"] . "' readonly><br>
            <label>存貨：</label>
            <input type='text' name='state' value='" . $row_result["state"] . "' readonly><br>
            <label>購買數量：</label>
            <input type='text' name='quantity' value='" . $row_result["quantity"] . "' readonly><br>
            <input type='hidden' name='num' value='" . $row_result["num"] . "'>
            <input type='submit' value='確定'>
            <input type='button' value='取消' onclick='cancelAction()'>
        </form>
        ";
    }
}

if (isset($_POST["num"])) {
    include "connsql.php";
    $sql_delete = "DELETE FROM `cart` WHERE num='" . $_POST['num'] . "'";
    echo $sql_delete . "<br>";
    $result = $seldb->query($sql_delete);
    if ($result) {
        echo "<script>alert('商品已成功刪除');location.href='shopping_cart.php';</script>";
    } else {
        echo "<script>alert('商品刪除失敗：" . mysqli_error($seldb) . "');location.href='shopping_cart.php';</script>";
    }
    $seldb->close();
}
?>
<script>
    function cancelAction() {
        location.href = 'shopping_cart.php';
    }
</script>
</body>
</html>
