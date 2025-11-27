<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品管理</title>
    <style>
        body {
            background-color: #E3E1DE;
            font-family: Arial, sans-serif;
            margin: 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            font-size: 32px;
            margin: 20px 0 0;
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
            margin: 0 auto; /* 这一行将表单水平居中 */
           
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
            width: 67%;
            box-sizing: border-box;
            text-align: center;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 10px;
            text-align: center; /* 將文字居中 */
        }

        .navbar {
            display: flex;
            background-color: #E3E1DE;
            width: 100%;
            box-sizing: border-box;
            border-radius: 10px;
            justify-content: flex-end;
            padding: 10px;
            margin: 10px;
        }

        .navbar a {
            color: #333;
            text-decoration: none;
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
        }

        .navbar a:hover {
            background-color: #333;
            color: #fff;
        }

        table td:first-child {
            width: 27%;
        }
        table td:nth-child(2) { /* 第二列（商品編號）的寬度 */
            width: 8%;
        }
        table td:nth-child(3) { /* 第三列（商品名稱）的寬度 */
            width: 20%;
        }
        table td:nth-child(4) {
            width: 10%;
        }
        table td:nth-child(5) { 
            width: 9%;
        }
        table td:nth-child(6) { 
            width: 9%;
        }
        table td:nth-child(7) { 
            width: 8%;
        }
        table td:nth-child(8) { 
            width: 9%;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="status.php">首頁</a>
        <a href="list.php">訂單管理</a>
        <a href="ship.php">出貨管理</a>
        <a href="member.php">會員管理</a>
        <a href="customer.php">顧客管理</a>
        </div>

    <h1>商品管理</h1>

    <br><br><form action="product.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="file">新增商品：</label>
            <input type="file" name="file" id="file"><br>
            <label for="name">品項：</label>
            <input type="text" name="name" id="name"><br>
            <label for="price">價格：</label>
            <input type="text" name="price" id="price">
            <label for="state">庫存：</label>
            <input type="text" name="state" id="state">
            <label for="id">區域：</label>
            <input type="text" name="id" id="id">
            <input type="submit" name="add" value="新增"><hr>
        </div>
    </form>

    <?php
        include "connsql.php";

        if (isset($_POST["add"])) {
            $name = $_POST["name"];
            $price = $_POST["price"];
            $state = $_POST["state"];
            $id = $_POST["id"];
        
            if (isset($_FILES["file"])) {
                $uploadDir = 'images/jpg';
                $uploadFile = $uploadDir . basename($_FILES['file']['name']);
                
                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
                    $imgPath = $uploadFile;
        
                    // Fix the SQL query to use $imgPath
                    $sql_insert = "INSERT INTO product (`img`, `name`, `price`, `state`, `id`) VALUES ('$imgPath', '$name', '$price', '$state', '$id')";
                    $result = $seldb->query($sql_insert);
                    
                    if ($result) {
                        echo "<script>alert('新增商品成功！請從下方查看');location.href='product.php'</script>";
                    } else {
                        echo "<font color='red'>新增商品失敗！</font>";
                    }
                } else {
                    echo "<font color='red'>上傳圖片失敗！</font>";
                }
            }
        }
        include "connsql.php";
        $sql_query = "SELECT * FROM `product`";
        $result = $seldb->query($sql_query);
        $total_records = $result->num_rows;

        if ($total_records > 0) 
        {
            echo "<table border='3' align='center'>";
            echo "<td style='padding:10px;'>商品圖片</td><td style='padding:10px;'>商品編號</td>
            <td style=padding:10px;>商品名稱</td><td style='padding:10px;'>商品價格</td><td style='padding:10px;'>庫存</td><td style='padding:10px;'>id</td><td style='padding:10px;'>庫存修改</td><td style='padding:10px;'>刪除</td>";
            while ($row_result = $result->fetch_assoc()) 
            {
                echo "<tr>";
                echo "<td style='padding:10px;'><img src='" . $row_result["img"] . "' alt='Product Image' width='257' height='300'></td>";
                echo "<td style='padding:10px;text-align:center'>" . $row_result["num"] . "</td>";
                echo "<td style='padding:10px;text-align:center'>" . $row_result["name"] . "</td>";
                echo "<td style='padding:10px;text-align:center'>" . $row_result["price"] . "</td>";
                echo "<td style='padding:10px;text-align:center'>" . $row_result["state"] . "</td>";
                echo "<td style='padding:10px;text-align:center'>" . $row_result["id"] . "</td>";
                echo "<td><a href='update-3.php?num=".$row_result["num"]."&f=y'>修改</a></td>";
                echo "<td><a href='delete-3.php?num=".$row_result["num"]."&f=x'>刪除</a></td>";
                echo "</tr>";
            }
            echo "</table>";   
            $seldb->close();    
        }
    ?>
</body>
</html>