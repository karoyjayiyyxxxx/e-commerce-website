<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>出貨狀態修改</title>
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

    <h1>出貨狀態修改</h1>
<?php
    include "connsql.php";
        if (isset($_GET["num"])) 
        {
            $sql_query = "SELECT * FROM `buy` WHERE num='" . $_GET["num"] . "'";
            $result = $seldb->query($sql_query);
            $row_result = $result->fetch_assoc();

            echo "<form method='POST' action='" . $_SERVER["PHP_SELF"] . "'>
            <label>ID：</label>
            <input type='text' name='id' value='" . $row_result["id"] . "' readonly><br>
            <label>品項：</label>
            <input type='text' name='pwd' value='" . $row_result["name"] . "' readonly><br>
            <label>價格：</label>
            <input type='text' name='name' value='" .$row_result["price"]. "' readonly><br>
            <label>小計：</label>
            <input type='text' name='name' value='" .$row_result["subtotal"]. "' readonly><br>
            <label>購買數量：</label>
            <input type='text' name='name' value='" .$row_result["quantity"]. "' readonly><br>
            <label>出貨狀態(輸入)：</label>
            <input type='text' name='rstate' value='" .$row_result["rstate"]. "'><br>
            <input type='hidden' name='num' value='" . $row_result["num"] . "'>
            <input type='submit' value='確定'>
            <input type='button' value='取消' onclick='cancelAction()'>
            </form>";
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["num"])) {
            $num = $_POST["num"];
            $rstate = $_POST["rstate"];
        
            $sql_update = "UPDATE `buy` SET `rstate`='$rstate' WHERE `num`='$num'";
            $result = $seldb->query($sql_update);
        
            if ($result) {
                // 更新buy表
                $sql_update_buy = "UPDATE `buy` p 
                                       INNER JOIN `cart` c ON p.`name` = c.`name` 
                                       SET p.`rstate`='$rstate' 
                                       WHERE c.`num`='$num'";
                $result_buy = $seldb->query($sql_update_buy);
            
                if ($result_buy) {
                    echo "<script>alert('已成功修改');location.href='ship.php';</script>";
                } else {
                    echo "<script>alert('修改失敗：" . $seldb->error . "');location.href='ship.php';</script>";
                }
            } else {
                echo "<script>alert('修改失敗：" . $seldb->error . "');location.href='ship.php';</script>";
            }            
        
            $seldb->close();
        }

      
    ?>
    <script>
        function cancelAction() {
            location.href = 'ship.php';
        }
    </script>
</body>
