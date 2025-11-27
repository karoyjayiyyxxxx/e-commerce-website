<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>庫存量修改</title>
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

        input[type="submit"], input[type="button"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
            padding: 8px;
            border: none;
            border-radius: 5px;
            margin-right: 5px;
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

        h1 {
            color: #333;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h1>庫存量修改</h1>
<?php
    include "connsql.php";
        if (isset($_GET["num"])) 
        {
            $sql_query = "SELECT * FROM `product` WHERE num='" . $_GET["num"] . "'";
            $result = $seldb->query($sql_query);
            $row_result = $result->fetch_assoc();

            echo "<form method='POST' action='" . $_SERVER["PHP_SELF"] . "'>
            <label>商品名稱：</label>
            <input type='text' name='pwd' value='" . $row_result["name"] . "' readonly><br>
            <label>價格：</label>
            <input type='text' name='name' value='" .$row_result["price"]. "' readonly><br>
            <label>庫存量(修改)：</label>
            <input type='text' name='state' value='" .$row_result["state"]. "'><br>
            <input type='hidden' name='num' value='" . $row_result["num"] . "'>
            <input type='submit' value='確定'>
            <input type='button' value='取消' onclick='cancelAction()'>
            </form>";
        }

        /*if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["num"])) {
            $num = $_POST["num"];
            $state = $_POST["state"];
            $name = $_POST["name"];
            $sql_update = "UPDATE `product` SET `state`='$state' WHERE `num`='$num'";
            $result = $seldb->query($sql_update);
        }

        $sql_cart_items = "SELECT * FROM `cart`";
        $cart_items_result = $seldb->query($sql_cart_items);*/
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["num"])) {
            $num = $_POST["num"];
            $state = $_POST["state"];
            $name = $_POST["name"];
            $sql_update = "UPDATE `product` SET `state`='$state' WHERE `num`='$num'";
            $result = $seldb->query($sql_update);
        
            if ($result) {
                $sql_cart_items = "SELECT * FROM `cart`";
                $cart_items_result = $seldb->query($sql_cart_items);
                while ($cart_item = $cart_items_result->fetch_assoc()) {
                    // 獲取相對應 product 表中的 state 值
                    $product_id = $cart_item["name"];
                    $sql_product_query = "SELECT `state` FROM `product` WHERE `name` = '$product_id'";
                    $product_result = $seldb->query($sql_product_query);
                    $row_product_result = $product_result->fetch_assoc();
                    
                    $new_state = $row_product_result["state"];
                
                    // 更新 cart 表中的 state 值
                    $cart_item_id = $cart_item["num"];
                    $sql_update_state = "UPDATE `cart` SET `state` = '$new_state' WHERE `num` = '$cart_item_id'";
                    $seldb->query($sql_update_state);
                }

                // 加入您想加的代碼段
                //if ($result) {
                    echo "<script>alert('已成功修改');location.href='product.php';</script>";
            } 
            else {
                    echo "<script>alert('修改失敗：" . $seldb->error . "');location.href='product.php';</script>";
            }
        } 
    
        $seldb->close();
        ?>
        <script>
            function cancelAction() {
                location.href = 'product.php';
        }
        </script>
</body>