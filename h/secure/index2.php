<?php
include_once("check_login.php");
?>

<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>ระบบหลังบ้าน</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body{
        background: linear-gradient(135deg,#ffd1dc,#ffe6f0);
        min-height:100vh;
    }
    .card-pink{
        border-radius:18px;
        box-shadow:0 12px 30px rgba(255,105,180,.35);
    }
    .btn-pink{
        background:#ff69b4;
        color:#fff;
        border:none;
    }
    .btn-pink:hover{
        background:#ff1493;
        color:#fff;
    }
</style>
</head>

<body>

<nav class="navbar navbar-dark" style="background:#ff69b4;">
    <div class="container">
        <span class="navbar-brand">🌸 ระบบหลังบ้าน</span>
        <span class="text-white">
            แอดมิน: <strong><?php echo $_SESSION["aname"]; ?></strong>
        </span>
    </div>
</nav>

<div class="container mt-5">
    <div class="card card-pink p-4">
        <h3 class="text-center text-danger mb-4">
            ยินดีต้อนรับสู่ระบบจัดการ
        </h3>

        <div class="row g-4 text-center">
            <div class="col-md-6">
                <a href="products.php" class="btn btn-pink w-100 p-4">
                    <i class="bi bi-box-seam fs-2"></i><br>
                    จัดการสินค้า
                </a>
            </div>

            <div class="col-md-6">
                <a href="orders.php" class="btn btn-pink w-100 p-4">
                    <i class="bi bi-cart-check fs-2"></i><br>
                    จัดการออเดอร์
                </a>
            </div>

            <div class="col-md-6">
                <a href="customers.php" class="btn btn-pink w-100 p-4">
                    <i class="bi bi-people fs-2"></i><br>
                    จัดการลูกค้า
                </a>
            </div>

            <div class="col-md-6">
                <a href="logout.php" class="btn btn-outline-danger w-100 p-4">
                    <i class="bi bi-box-arrow-right fs-2"></i><br>
                    ออกจากระบบ
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
