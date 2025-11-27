<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <title>購物車</title>
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
    <div class="login-register">
    </div>
</header>

    <h1>購物車</h1>
    
    <?php
        session_start();
        $id = $_SESSION['id'];
        $username = $_SESSION['name'];
        include "connsql.php";
        
        $sql_cart_items = "SELECT * FROM `cart` WHERE `id` = '$id' AND `username` = '$username'";
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



        $sql_query = "SELECT * FROM `cart` WHERE `id` = '$id' AND `username` = '$username'";
        $result = $seldb->query($sql_query);
        $total_records = $result->num_rows;

        echo "商品樣式(".$total_records.")<br>";
        $total_amount = 0;
        if($total_records > 0) {
            echo "<table border='1'>";
            echo "<tr><td></td><td>品項</td><td>價格</td><td>小計</td><td>存貨</td><td>購買數量</td><td>修改數量</td><td>刪除</td></tr>";
            while($row_result = $result->fetch_assoc()) {
                echo "<tr>";
                // 在這裡加入圖片的顯示
                echo "<td><img src='" . $row_result["img"] . "' alt='product image' style='max-width: 90px; max-height: 90px;'></td>";
                echo "<td>".$row_result["name"]."</td>";
                echo "<td>NT$".$row_result["price"]."</td>";
                echo "<td>NT$".$row_result["subtotal"]."</td>";

                echo "<td>".$row_result["state"]."</td>";
                echo "<td>".$row_result["quantity"]."</td>";
                echo "<td><a href='update.php?num=".$row_result["num"]."&f=u'>修改</a></td>";
                echo "<td><a href='delete.php?num=".$row_result["num"]."&f=d'>刪除</a></td>";
                $total_amount += $row_result["subtotal"];
                echo "</tr>";
            }
            echo "<tr><td colspan='8'><b>總金額：</b> NT$".$total_amount."</td></tr>";
            echo "</table>";
            // 添加結清商品的表單和按鈕
            echo "<form method='post' action=''>";
            echo "<input type='submit' name='clear_cart' value='結清商品'>";
            echo "</form>";

         // 檢查是否按下結清商品按鈕
        if (isset($_POST['clear_cart'])) {
            $result->data_seek(0);
            // 遍歷購物車中的每個商品
            while ($row_result = $result->fetch_assoc()) {
                $product_name = $row_result['name'];
                $quantity = $row_result['quantity'];

                // 從 product 表中獲取存貨
                $sql_product_query = "SELECT `state` FROM `product` WHERE `name` = '$product_name'";
                $product_result = $seldb->query($sql_product_query);

                if ($product_result) {
                    $row_product_result = $product_result->fetch_assoc();
                    $current_stock = $row_product_result['state'];

                    // 轉換庫存為整數
                    $current_stock = intval($current_stock);
                    $quantity = intval($quantity);

                    // 確保庫存不會變成負數
                    $new_stock = max(0, $current_stock - $quantity);

                     // 如果庫存不足，顯示錯誤信息
                    if ($new_stock <= 0) {
                        echo "<script>alert('商品庫存不足，请调整购买数量或删除相关商品。');location.href='shopping_cart.php';</script>";
                        exit(); // 終止代碼執行
                    }

                    // 更新 product 表中的存貨，這裡不需要再轉換為字串
                    $sql_update_stock = "UPDATE `product` SET `state` = $new_stock WHERE `name` = '$product_name'";
                    $update_result = $seldb->query($sql_update_stock);


                    if (!$update_result) {
                        echo "更新庫存時發生錯誤：" . $seldb->error;
                    }
                } else {
                    echo "查詢產品庫存時發生錯誤：" . $seldb->error;
                }
            }

            // 重置結果集的指針到開始位置
            $result->data_seek(0);

            $sql_check_state_type = "DESCRIBE `product` state";
            $result_check_state_type = $seldb->query($sql_check_state_type);
            $row_state_type = $result_check_state_type->fetch_assoc();

            // 遍歷購物車中的每個商品，將相關資料插入 buy 表
            $result->data_seek(0); // 重置結果集的指針到開始位置
            while ($row_result = $result->fetch_assoc()) {
                $product_name = $row_result['name'];
                $quantity = $row_result['quantity'];
                $price = $row_result['price'];
                $subtotal = $row_result['subtotal'];
                $img = $row_result['img'];

                try {
                        // 插入數據到 buy 表，包括 rstate 字段
                        $sql_insert_buy = "INSERT INTO `buy` (`id`, `username`, `name`, `quantity`,`price`, `subtotal`, `rstate`, `img`)
                        VALUES ('$id', '$username', '$product_name', '$quantity', '$price', '$subtotal', '未出貨', '$img')";
                        $insert_result = $seldb->query($sql_insert_buy);

                        if (!$insert_result) {
                            throw new Exception("插入 buy 表時發生錯誤：" . $seldb->error);
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
           }

            // 清空購物車的 SQL 操作
            $sql_clear_cart = "DELETE FROM `cart` WHERE `id` = '$id' AND `username` = '$username'";
            $result_clear_cart = $seldb->query($sql_clear_cart);

            // 檢查是否成功清空購物車
            if ($result_clear_cart) {
                echo "<script>alert('商品已成功結清，感謝您的購買!');location.href='shopping_cart.php';</script>";
            } else {
                echo "清空購物車時發生錯誤：" . $seldb->error;
            }
        }

    $seldb->close();
    }
    ?>
</body>
</html>