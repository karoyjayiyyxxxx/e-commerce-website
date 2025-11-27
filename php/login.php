<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <title>登入頁面</title>
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

    <h1>登入</h1>

    <form method="POST" action="login2.php" 
    name="loginn" onsubmit="return validateForm()">

        <label>帳號:</label>
        <input type="text" id="username" name="id">
        <label>密碼:</label>
        <input type="password" id="password" name="pwd">
        <!--<label>姓名:</label>
        <input type="text"  name="name">-->
        <input type="submit" value="登入">
        <input type='button' value='進行註冊' onclick='cancelAction()'>
    </form>

    <!--防全空的JS-->
<script>
    function cancelAction() {
        location.href = 'register.php';
    }

    function validateForm() 
    { 
    var x = document.forms["loginn"]["username"].value;
    var y = document.forms["loginn"]["password"].value;

        if (x == "") 
        {
            alert("帳號不可為空");      
            return false; 
        }
        else if (y == "") 
        {
            alert("密碼不可為空");      
            return false; 
        }
     } 
</script>