<!DOCTYPE html>
<html lang="en">
  <head>
  <title>編輯會員資料</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="image/pudding.png">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <title>管理者介面</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <!--<link rel="stylesheet" href="assets/css/style.css">-->
    <link rel="stylesheet" href="assets/css/owl.css">
  </head>
  <body> 
    <!--<div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div> --> 
    <header class="">
      <nav class="navbar navbar-expand-lg" style="background-color:#ffdab7;">
        <div class="container">
          <img src= "image/3.png" href="index.html">
          &nbsp;&nbsp;&nbsp;<a class="navbar-brand" href="index.html" style="color: black"><h2>管理者介面</h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="seller.php" style="color: black">首頁
                      <span class="sr-only">(current)</span>
                    </a>
                </li> 
                <li class="nav-item"><a class="nav-link" href="product.php" style="color: black">商品管理</a></li>
                <li class="nav-item"><a class="nav-link" href="member.php" style="color: black">會員管理</a></li>
                <li class="nav-item"><a class="nav-link" href="list.php" style="color: black">訂單管理</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) 
{
    $member_id = $_GET['id'];

    $db_link = mysqli_connect($hn, $un, $pw, $db);

    $sql = "SELECT * FROM member WHERE num = $member_id";
    $result = mysqli_query($db_link, $sql);

    if (mysqli_num_rows($result) == 1) 
    {
        $row = mysqli_fetch_assoc($result);
        $member_id = $row['num'];
        $username = $row['id'];
        $password = $row['pwd'];
        $name = $row['name'];
        $phone = $row['phone'];
        $email = $row['email'];
        $address = $row['address'];
    }
    mysqli_close($db_link);
}
?>

<html>
<form method="GET" action="editor.php" align="center" style="font-size:45px;padding:2%;" >
</form>
<body>
    <center><h1 style="color:skyblue;font-weight:bold;">編輯會員資料</h1>
    <form method="POST" action="editor.php" style="font-size:20px;">
        <input type="hidden" name="id" value="<?php echo $member_id; ?>">
        <br>帳號：<input type="text" name="username" value="<?php echo $username; ?>"><br>
        密碼：<input type="password" name="password" value="<?php echo $password; ?>"><br>
        名字：<input type="text" name="name" value="<?php echo $name; ?>"><br>
        電話：<input type="text" name="phone" value="<?php echo $phone; ?>"><br>
        信箱：<input type="text" name="email" value="<?php echo $email; ?>"><br>
        地址：<input type="text" name="address" value="<?php echo $address; ?>"><br>
        <input type="submit" value="更新"></center>
    </form>
</body>
<?php
  include "connect.php";
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
      $member_id = $_POST['id'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $db_link = mysqli_connect($hn, $un, $pw, $db);
      $sql = "UPDATE member SET id='$username', pwd='$password', name='$name', phone='$phone', email='$email', address='$address' WHERE num=$member_id";
      
      if (mysqli_query($db_link, $sql)) 
      {
          header("Location: member.php"); 
          exit();
      } else 
      {
          echo "更新失敗: " . mysqli_error($db_link);
      }
      mysqli_close($db_link);
  }
?>
</html>