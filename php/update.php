<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改數量</title>
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

    <h1>修改數量</h1>

<?php
if (isset($_GET["num"])) {
    include "connsql.php";
    $sql_query = "SELECT * FROM `cart` WHERE num='" . $_GET["num"] . "'";
    $result = $seldb->query($sql_query);
    while ($row_result = $result->fetch_assoc()) {
        echo "
        <form method='POST' action='update.php'>
            <label>品項：</label>
            <input type='text' name='name' value='" . $row_result["name"] . "' readonly><br>
            <label>價格：</label>
            <input type='text' name='price' value='" . $row_result["price"] . "' readonly><br>
            <label>小計：</label>
            <input type='text' name='subtotal' value='" . $row_result["subtotal"] . "' readonly><br>
            <label>存貨：</label>
            <input type='text' name='state' value='" . $row_result["state"] . "' readonly><br>
            <label>購買數量(請輸入)：</label>
            <input type='text' name='quantity' value='" . $row_result["quantity"] . "'><br>
            <input type='hidden' name='num' value='" . $row_result["num"] . "'>
            <input type='submit' value='確定'>
            <input type='button' value='取消' onclick='cancelAction()'>
        </form>
        ";
    }
}

if (isset($_POST["num"])) {
    include "connsql.php";

    // 獲取購物車項目的數量和存貨
    $quantity = $_POST['quantity'];
    $num = $_POST['num'];

    $sql_query = "SELECT `state` FROM `cart` WHERE num='$num'";
    $result = $seldb->query($sql_query);

    if ($result->num_rows > 0) {
        $row_result = $result->fetch_assoc();
        $state = $row_result["state"];

        // 檢查存貨是否足夠
        if ($state < $quantity) {
            // 存貨不足，提示使用者
            echo "<script>alert('此商品存貨不足，請更改其他數量');location.href='shopping_cart.php';</script>";
        } else {
            // 存貨足夠，計算小計，並更新購物車數量
            $price = $_POST['price'];
            $subtotal = $price * $quantity;

            $sql_update = "UPDATE `cart` SET `quantity`='$quantity', `subtotal`='$subtotal' WHERE num='$num'";
            $result_update = $seldb->query($sql_update);

            if ($result_update) {
                echo "<script>alert('數量已成功修改');location.href='shopping_cart.php';</script>";
            } else {
                echo "<script>alert('數量修改失敗：" . mysqli_error($seldb) . "');location.href='shopping_cart.php';</script>";
            }
        }
    } else {
        echo "<script>alert('找不到對應的購物車項目');location.href='shopping_cart.php';</script>";
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
