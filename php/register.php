<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>註冊頁面</title>
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

        form input, select {
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

<h1>註冊</h1>

<form method="POST" action="register.php">
    <label>帳號:</label>
    <input type="text" name="id">
    
    <label>密碼:</label>
    <input type="password" name="pwd">
    
    <label>姓名:</label>
    <input type="text" name="name">
    
    <label>年齡:</label>
    <input type="number" name="age" min="1" max="120">
    
    <label>性別:</label>
    <select name="gender">
        <option value="male">男性</option>
        <option value="female">女性</option>
    </select>
    
    <input type="submit" value="註冊">
    <input type='button' value='已註冊過' onclick='cancelAction()'>
</form>

<?php
if (isset($_POST["id"])) {
    include "connsql.php";
    $id = $_POST['id'];
    $pwd = $_POST['pwd'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    // 檢查使用者是否已經存在
    $sql_check = "SELECT * FROM `member` WHERE `id` = '$id'";
    $result_check = mysqli_query($seldb, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        echo "<script>alert('帳號已存在，請選擇其他帳號');location.href='register.php';</script>";
    } else {
        // 如果使用者不存在，則插入新紀錄
        $sql_insert = "INSERT INTO `member` (`id`, `pwd`, `name`, `age`, `gender`) VALUES ('$id', '$pwd', '$name', '$age', '$gender')";
        $result = mysqli_query($seldb, $sql_insert);
        if ($result) {
            echo "<script>alert('註冊成功');location.href='register.php';</script>";
        } else {
            echo "<script>alert('註冊失敗：" . mysqli_error($seldb) . "');location.href='register.php';</script>";
        }
    }
    $seldb->close();
}
?>

<script>
    function cancelAction() {
        location.href = 'login.php';
    }
</script>

</body>
</html>
