<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>會員資料刪除</title>
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

        h1 {
            color: #333;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h1>會員資料刪除</h1>

    <?php
    session_start();
    $id = $_SESSION['id'];
    $username = $_SESSION['name'];
    if (isset($_GET["num"])) {
        include "connsql.php";
        $sql_query = "SELECT * FROM `member` WHERE num='" . $_GET["num"] . "'";
        $result = $seldb->query($sql_query);
        $row_result = $result->fetch_assoc();

        echo "<form method='POST' action='" . $_SERVER["PHP_SELF"] . "'>
        <label>帳號：</label>
        <input type='text' name='id' value='" . $row_result["id"] . "' readonly><br>
        <label>密碼：</label>
        <input type='text' name='pwd' value='" . $row_result["pwd"] . "' readonly><br>
        <label>姓名：</label>
        <input type='text' name='name' value='" . $row_result["name"] . "' readonly><br>
        <input type='hidden' name='num' value='" . $row_result["num"] . "'>
        <input type='submit' value='確定'>
        <input type='button' value='取消' onclick='cancelAction()'>
        </form>";
    }

    if (isset($_POST["num"])) {
        include "connsql.php";
        $sql_delete = "DELETE FROM `member` WHERE num=" . $_POST["num"];
        $sql_clear_cart = "DELETE FROM `cart` WHERE `id` = '$id'";
        $result_clear_cart = $seldb->query($sql_clear_cart);
        $result = $seldb->query($sql_delete);
        if ($result) {
            echo "<script>alert('會員資料已成功刪除');location.href='member.php';</script>";
        } else {
            echo "<script>alert('會員資料刪除失敗：" . mysqli_error($seldb) . "');location.href='delete-2.php';</script>";
        }

        $seldb->close();
    }
    ?>
    <script>
        function cancelAction() {
            location.href = 'member.php';
        }
    </script>
</body>
</html>
