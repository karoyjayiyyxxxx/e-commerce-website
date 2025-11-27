<?php
session_start();
include "connsql.php";

// Fetch products from the database
$sql_query = "SELECT * FROM product";
$result = mysqli_query($seldb, $sql_query);

$products = [];
while ($assoc_result = mysqli_fetch_assoc($result)) {
    $products[] = $assoc_result;
}

$newArrivalsSectionIDs = [];
$bestSellersSectionIDs = [];
$inStockSectionIDs = [];

foreach ($products as $product) {
    $productId = $product['id'];

    // 根据您的后台逻辑将产品ID分配到不同的部分
    if ($product['id'] == '1') {
        $newArrivalsSectionIDs[] = $productId;
    } elseif ($product['id'] == '2') {
        $bestSellersSectionIDs[] = $productId;
    } elseif ($product['id'] == '3') {
        $inStockSectionIDs[] = $productId;
    }
}

$newArrivalsSection = array_filter($products, function ($product) use ($newArrivalsSectionIDs) {
    return in_array($product['id'], $newArrivalsSectionIDs);
});

$bestSellersSection = array_filter($products, function ($product) use ($bestSellersSectionIDs) {
    return in_array($product['id'], $bestSellersSectionIDs);
});

$inStockSection = array_filter($products, function ($product) use ($inStockSectionIDs) {
    return in_array($product['id'], $inStockSectionIDs);
});


$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$username = isset($_SESSION['name']) ? $_SESSION['name'] : null;

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

if(isset($_GET['logout']) && $_GET['logout'] == 1) {
    // 清除所有 session 變數
    session_unset();
    // 刪除 session 數據
    session_destroy();
    // 導向到登入頁面
    header("location:home.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YISIR - 時尚潮流、生活如秀</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #E3E1DE; /* 米色 */
            color: #333; /* 深灰色 */
        }

        header {
            text-align: right;
            background-color: transparent;
            padding: 10px;
            display: flex;
            
            justify-content: flex-end; /* 更改這裡 */
            align-items: center;
        }

        header img {
            max-width: 100%;
            height: auto;
            width: 70%; /* 設定圖片寬度 */
            margin-right: auto;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .brand-info {
            background-color: #E3E1DE; /* 米色 */
            color: #333; /* 深灰色 */
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        .brand-info h2 {
            color: #555; /* 中灰色 */
            margin-bottom: 10px;
        }

        .brand-info p {
            margin-bottom: 15px;
        }

        .brand-info strong {
            color: #555; /* 中灰色 */
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .product {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            width: calc(33.3333% - 20px);
            box-sizing: border-box;
            background-color: white;
            transition: transform 0.3s ease-in-out;
        }

        .product:nth-child(3n + 1) {
            clear: both;
        }

        .product:hover {
            transform: scale(1.05);
        }

        .product img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            padding: 5px;
            background-color: #fff;
            display: block;
            margin: 0 auto;
        }

        .product-info {
            text-align: center;
            margin-top: 10px;
        }

        .section-heading {
            font-size: 2em; /* Increased font size */
            font-weight: bold;
            margin-bottom: 10px;
            width: 100%;
            text-align: center;
        }

        .login-register {
            display: flex;
            align-items: center;
        }

        .cart-link,
        .login-register a {
            border: 3px solid #ccc; /* Existing border style */
            padding: 10px;
            margin: 0 10px;
            color: #333; /* Existing text color */
            text-decoration: none;
        }

        .cart-link:hover,
        .login-register a:hover {
            border: 2px solid #825B47; /* Coffee color on hover */
            background-color: #825B47; /* Coffee color on hover */
            color: #fff; /* White text on hover */
        }

        .contact-info {
            background-color: #825B47; /* Coffee color */
            color: #fff; /* White text color */
            padding: 20px;
            margin: 20px 0;
            text-align: center;
            border: 2px solid #825B47; /* Coffee color border */
        }

        .contact-info h2 
        {
            margin-bottom: 10px;
        }

        .contact-info p {
            margin: 10px 0;
        }
    </style>
</head>
<body>

<header>
    <div class="user-info">
    <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            // 登入成功處理
            $_SESSION['loggedin'] = true;
            echo '<div class="user-info"><p><strong>會員：' . $_SESSION['name'] . '</strong></p></div>';
        }
        ?>
    </div>

    <div class="login-register">

        <?php
        //var_dump($_SESSION); // 這將輸出 $_SESSION 中的內容，檢查是否包含 "name"。
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            // 登入成功處理
            $_SESSION['loggedin'] = true;
            //echo '<p>使用者：' . $_SESSION['name'] . '</p>';
            echo '<a href="shopping_cart.php" class="cart-link">購物車</a>';
            echo '<a href="bought.php">購買資訊</a>';
            echo '<a href="home.php?logout=1">登出</a>';
            echo '<a href="register.php">註冊</a>';
        } else {
            echo '<a href="login.php">登入</a>';
            echo '<a href="register.php">註冊</a>';
        }
        
        ?>
    </div>
</header>

<h1>YISIR - 時尚潮流、生活如秀</h1>

<div class="brand-info">
    <h2>品牌理念</h2>
    <p>本公司跟隨現代年親人社交潮流，於各大網路平台以及社群軟體，和社交程式如IG’FB’TikTOK等，經營潮流衣物及飾品販售，能讓廣大的年輕團體透過穿著我們發售的衣物及飾品，在路上在各地大放異彩，是本公司最大的目標。</p>
</div>

<div class="product-container">
    <?php
    // Display new arrivals
    echo '<div class="section-heading">新品區</div>';
    displayProducts($newArrivalsSection);

    // Display best sellers
    echo '<div class="section-heading">熱銷商品區</div>';
    displayProducts($bestSellersSection);

    // Display in stock
    echo '<div class="section-heading">現貨區</div>';
    displayProducts($inStockSection);

    function displayProducts($products) 
    {
        foreach ($products as $product) 
        {
            echo '<div class="product">';
            echo '<form method="post" action="insert.php">';
            echo '<form method="post" action="shopping_cart.php">';
            echo '<img src="' . $product['img'] . '" alt="' . $product['name'] . '" width="300" height="300">';
            echo '<div class="product-info">';
            echo '<h3>' . $product['name'] . '</h3>';
            echo '<p><strong>NT$' . $product['price'] . '</strong></p>';
            echo '<p><strong>存貨：' . $product['state'] . '</strong></p>';
            echo '<input type="hidden" name="name" value="' . $product['name'] . '">';
            echo '<input type="hidden" name="price" value="' . $product['price'] . '">';
            echo '<input type="hidden" name="img" value="' . $product['img'] . '">';
            echo '<input type="hidden" name="state" value="' . $product['state'] . '">';
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '購買件數：<input type="text" name="quantity" value="1" style="width: 30px;">';
                echo '<br><br><button type="submit">加入購物車</button>';
            } else {
                echo '<p>請先登入以進行購買</p>';
            }
            echo '</form>';
            echo '</div>';
            echo '</div>';

        } 
        
    }
    ?>
</div>

<!-- Contact Information Section -->
<div class="contact-info">
    <h2>聯絡資訊</h2>
    <p>Email: info@yisir.com</p>
    <p>電話: 123-456-7890</p>
    <p>地址: 台北市中正區忠孝東路一段1號</p>
</div>


</body>
</html>
