<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>會員管理</title>
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

    <h1>會員資料修改</h1>

    <?php

include "connsql.php";

if (isset($_GET["num"])) {
    // 获取要修改的会员信息
    $sql_query = "SELECT * FROM `member` WHERE num='" . $_GET["num"] . "'";
    $result = $seldb->query($sql_query);
    $row_result = $result->fetch_assoc();

    echo "<form method='POST' action='" . $_SERVER["PHP_SELF"] . "'>
    <label>帳號：</label>
    <input type='text' name='id' value='" . $row_result["id"] . "' readonly><br>
    <label>密碼：</label>
    <input type='text' name='pwd' value='" . $row_result["pwd"] . "'><br>
    <label>姓名：</label>
    <input type='text' name='name' value='" . $row_result["name"] . "'><br>
    <input type='hidden' name='num' value='" . $row_result["num"] . "'>
    <input type='submit' value='確定'>
    <input type='button' value='取消' onclick='cancelAction()'>
    </form>";
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["num"])) {
    $num = $_POST["num"];
    $id = $_POST["id"];
    $pwd = $_POST["pwd"];
    $name = $_POST["name"];

    // 开始事务
    $seldb->begin_transaction();

    try {
        // 更新 member 表
        $sql_update_member = "UPDATE `member` SET `id`='$id', `pwd`='$pwd', `name`='$name' WHERE num='$num'";
        $result_member = $seldb->query($sql_update_member);

        // 更新 cart 表
        $sql_update_cart = "UPDATE `cart` SET `username`='$name' WHERE `id`='$id'";
        $result_cart = $seldb->query($sql_update_cart);

        // 更新 buy 表
        $sql_update_buy = "UPDATE `buy` SET `username`='$name' WHERE `id`='$id'";
        $result_buy = $seldb->query($sql_update_buy);

        // 检查两个更新是否都成功
        if ($result_member && $result_cart && $result_buy) {
            // 提交事务
            $seldb->commit();
            echo "<script>alert('會員資料已成功修改');location.href='member.php';</script>";
        } else {
            // 回滚事务
            $seldb->rollback();
            echo "<script>alert('會員資料修改失敗：" . mysqli_error($seldb) . "');location.href='update-2.php';</script>";
        }
    } catch (Exception $e) {
        // 捕获异常，回滚事务
        $seldb->rollback();
        echo "<script>alert('會員資料修改失敗：" . $e->getMessage() . "');location.href='update-2.php';</script>";
    }

    // 关闭数据库连接
    $seldb->close();
}
?>
<script>
    function cancelAction() {
        location.href = 'member.php';
    }
</script>

</body>
