<?php
    session_start();
    if (empty($_SESSION['aid'])) {
        echo "Access Denied" ;
        echo "<meta http-equiv='content='4; url=index.php'>";
        exit;
    }
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>หน้าหลักเเอดมิน - สุภัสสร</title>
</head>

<body>

<h1>หน้าหลักเเอดมิน - สุภัสสร</h1>

<?php echo "เเอดมิน: " . $_SESSION['aname']; ?> <br>

</ul>
    <a href="../../h/products.php"><li>จัดการสินค้า</li></a>
    <a href="../../h/orders.php"><li>จัดการออเดอร์</li></a>
    <a href="../../h/customers.php"><li>จัดการลูกค้า</li></a>
    <a href="../../h/logout.php"><li>ออกจากระบบ</li></a>
</ul>
</body>
</html>
