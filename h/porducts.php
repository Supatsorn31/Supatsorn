<?php
    session_start();
    include_once("../../h/check_login.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>จัดการสินค้า - สุภัสสร</title>
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