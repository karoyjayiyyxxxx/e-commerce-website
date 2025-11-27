<?php
session_start();
include "connsql.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $password = $_POST["pwd"];

    $sql = "SELECT * FROM member WHERE id ='" . $id . "'";
    $result = mysqli_query($seldb, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row["pwd"]) {
            // 將數據存儲在 session 變數中
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["name"] = $row["name"];

            // 重定向到 home.php 或任何其他頁面
            header("location: home.php");
            exit();
        } else {
            function_alert("帳號或密碼錯誤");
        }
    } else {
        function_alert("帳號或密碼錯誤");
    }
} else {
    function_alert("發生了一些錯誤");
}

// 關閉連接
mysqli_close($link);

function function_alert($message)
{
    echo "<script>alert('$message'); window.location.href='login.php';</script>";
    exit(); // 顯示警告後停止腳本執行
}
?>