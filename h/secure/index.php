<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>สุภัสสร ปาปะโน(แพท)</title>
</head>

<body>
<h1>เข้าสู่ระบบหลังบ้าน-สุภัสสร  </h1>

<form method="post"action="">
Username <input type="text" name="auser" autofocus required> <br>
Password <input type="password" name="apwd" required> <br>
<button type="submit" name="Submit">LOGIN</button>
</form>

<?php
if(isset($_POST['Submit'])){
    include_once ("connectdb.php");
    
    $u = $_POST['auser'];
    $p = $_POST['apwd'];

    // 1. ค้นหาเฉพาะ Username ก่อน
    $sql = "SELECT * FROM admin WHERE a_username='$u' LIMIT 1";
    $rs = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($rs);

    // 2. ใช้ฟังก์ชัน password_verify ตรวจสอบรหัสผ่านที่พิมพ์มา กับตัวที่เข้ารหัสใน DB
    if($data && password_verify($p, $data['a_password'])){
        $_SESSION['aid'] = $data['a_id'];
        $_SESSION['aname'] = $data['a_name'];
        echo "<script>";
        echo "window.location='index2.php';";
        echo "</script>";
    } else {
        echo "<script>";
        echo "alert('Username หรือ Password ไม่ถูกต้อง');";
        echo "</script>";
    }
}
?>	
</body>
</html>