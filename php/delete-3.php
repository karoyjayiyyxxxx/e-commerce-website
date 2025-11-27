<?php
include "connsql.php";

if (isset($_GET['num']) && isset($_GET['f']) && $_GET['f'] === 'x') {
    $num = $_GET['num'];

    // 删除product表中对应num的行
    $sql_delete_product = "DELETE FROM `product` WHERE `num` = '$num'";
    $result_delete_product = $seldb->query($sql_delete_product);

    if ($result_delete_product) {
        echo "<script>alert('商品删除成功！'); location.href='product.php'</script>";

        $sql_delete_cart_items = "
        DELETE c
        FROM `cart` c
        LEFT JOIN `product` p ON c.`name` = p.`name`
        WHERE  p.`name` IS NULL
        ";

        $seldb->query($sql_delete_cart_items);

    } else {
        echo "<font color='red'>商品删除失败！</font>";
    }
} else {
    echo "<font color='red'>非法请求！</font>";
}

$seldb->close();
?>
