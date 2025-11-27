<?php
session_start();
if (isset($_POST["name"])) {
    include "connsql.php";

    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $price = isset($_POST["price"]) ? $_POST["price"] : '';
    $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : '';
    $img = isset($_POST["img"]) ? $_POST["img"] : '';
    $state = isset($_POST["state"]) ? $_POST["state"] : '';
    $subtotal = $price*$quantity;
    $id = $_SESSION['id'];
    $username = $_SESSION['name'];

    // 檢查購物車中是否已經存在相同的商品
    $sql_check = "SELECT * FROM `cart` WHERE `name` = '$name' AND `id` = '$id'";
    $result_check = mysqli_query($seldb, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // 商品已存在，提醒使用者
        echo "<script>alert('此商品已在購物車中，如果需要，請至購物車修改數量');location.href='home.php';</script>";
    } else  {
        // 商品不存在，進行存貨檢查
        if ($state < $quantity) {
            // 存貨不足，提示使用者
            echo "<script>alert('此商品存貨不足');location.href='home.php';</script>";
        } else {
            // 存貨足夠，插入到購物車表中
            $sql_insert = "INSERT INTO `cart`(`name`, `price`, `quantity`, `img`, `state`, `subtotal`, `id`, `username`) VALUES ('$name', '$price', '$quantity', '$img', '$state', '$subtotal', '$id', '$username')";
            $result = mysqli_query($seldb, $sql_insert);

            if ($result) {
                echo "<script>alert('商品已成功加入購物車');location.href='home.php';</script>";
            } else {
                echo "<script>alert('加入購物車失敗：" . mysqli_error($seldb) . "');location.href='home.php';</script>";
            }
        }
    }
    $seldb->close();
} 
else{
    echo "<script>alert('未提交必要的表單數據');location.href='home.php';</script>";
    }
    

?>