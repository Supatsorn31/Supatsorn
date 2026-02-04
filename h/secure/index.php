<?php
session_start();
include_once("connectdb.php");
?>

<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>เข้าสู่ระบบหลังบ้าน</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body{
        background: linear-gradient(135deg,#ffd1dc,#ffe6f0);
        height:100vh;
    }
    .login-card{
        max-width:420px;
        margin:auto;
        margin-top:10%;
        border-radius:16px;
        box-shadow:0 10px 30px rgba(255,105,180,.35);
    }
    .btn-pink{
        background:#ff69b4;
        color:#fff;
    }
    .btn-pink:hover{
        background:#ff1493;
        color:#fff;
    }
</style>
</head>

<body>

<div class="card login-card p-4">
    <h3 class="text-center text-danger mb-4">
        🌸 เข้าสู่ระบบหลังบ้าน 🌸
    </h3>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="auser" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="apwd" class="form-control" required>
        </div>

        <div class="d-grid">
            <button type="submit" name="Submit" class="btn btn-pink">
                LOGIN
            </button>
        </div>
    </form>
</div>

<?php
if(isset($_POST['Submit'])){
    $u = $_POST['auser'];
    $p = $_POST['apwd'];

    // ✅ Prepared Statement ป้องกัน SQL Injection
    $sql = "SELECT * FROM admin WHERE a_username = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $u);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) == 1){
        $data = mysqli_fetch_assoc($result);

        // ✅ ตรวจสอบรหัสผ่านแบบเข้ารหัส
        if(password_verify($p, $data['a_password'])){
            $_SESSION['aid']   = $data['a_id'];
            $_SESSION['aname'] = $data['a_name'];
            echo "<script>window.location='index2.php';</script>";
        } else {
            echo "<script>alert('Username หรือ Password ไม่ถูกต้อง');</script>";
        }
    } else {
        echo "<script>alert('Username หรือ Password ไม่ถูกต้อง');</script>";
    }
}
?>

</body>
</html>
