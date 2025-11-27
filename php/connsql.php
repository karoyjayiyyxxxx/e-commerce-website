<?php
    $hn="127.0.0.1";
    $db="phpbook";
    $un="root";
    $pw="";
    $seldb=@mysqli_connect("127.0.0.1","root","","phpbook");
    if(!$seldb)
            die("連線失敗");
        else
            //echo("連線成功");
            echo "<br>";
?>