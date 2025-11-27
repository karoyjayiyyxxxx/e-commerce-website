<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <title>會員資料</title>
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
            padding: 10px;
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
            padding: 2px;
            text-align: left;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h1>會員資料</h1>
    <?php
    if(isset($_FILES["file"]))
    {
        echo "上傳檔案資訊:<hr>";
        echo "檔案名稱:".$_FILES["file"]["name"]."<br>";
        echo "暫存檔名:".$_FILES["file"]["tmp_name"]."<br>";
        echo "檔案尺寸:".$_FILES["file"]["size"]."<br>";
        echo "檔案種類:".$_FILES["file"]["type"]."<br>";
        if($_FILES['file']['type']=='image/png'|| $_FILES['file']['type']=='image/jpeg')
        {
            if(file_exists('images/'.$_FILES['file']['name']))
                echo "檔案已存在";
            else
            {

                if(copy($_FILES["file"]["tmp_name"],"images/" .$_FILES["file"]["name"]))
                {
                    echo "上傳成功<br>";
                    echo '<p><img src="images/',$_FILES["file"]["name"],'"></p>';
                    unlink($_FILES["file"]["tmp_name"]);
        
                }
                else
                    echo "上傳失敗";
            }
        }
        else
        {
            echo "檔案上傳格式不符，請重新上傳png/jpeg";
        }
    }
    
    include "connsql.php";
    $sql_query = "SELECT * FROM member";
    $result = mysqli_query($seldb, $sql_query);

    echo "<table>";
    echo "<tr><td>帳號</td><td>密碼</td><td>名稱</td><td>修改</td><td>刪除</td></tr>";

    while ($assoc_result = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $assoc_result["id"] . "</td>";
        echo "<td>" . $assoc_result["pwd"] . "</td>";
        echo "<td>" . $assoc_result["name"] . "</td>";
        echo "<td><a href=update-2.php?u=" . $assoc_result['num'] . "&f=u'>修改</a></td>";
        echo "<td><a href=delete-2.php?b=" . $assoc_result['num'] . "&f=b'>刪除</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    $seldb->close();
    ?>

</body>
</html>
