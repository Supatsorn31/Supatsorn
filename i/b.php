<?php
include_once("connectdb.php"); // นำไว้บนสุดเพื่อให้เรียกใช้ $conn ได้ทุกจุด
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>สุภัสสร ปาปะโน (แพท)</title>
    <style>
        body { font-family: Tahoma, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { padding: 10px; text-align: center; }
        img { border-radius: 5px; }
    </style>
</head>

<body>
    <h1>งาน i --สุภัสสร ปาปะโน (แพท)</h1>

    <form method="post" action="" enctype="multipart/form-data">
        ชื่อจังหวัด: <input type="text" name="pname" autofocus required> <br><br>
        รูปภาพ: <input type="file" name="pimage" required> <br><br>
        
        ภาค:
        <select name="rid" required>
            <option value="">-- เลือกภาค --</option>
            <?php
            // ดึงข้อมูลภาคมาใส่ Dropdown
            $sql_reg = "SELECT * FROM regions";
            $rs_reg = mysqli_query($conn, $sql_reg);
            while($row_reg = mysqli_fetch_array($rs_reg)){
                echo "<option value='{$row_reg['r_id']}'>{$row_reg['r_name']}</option>";
            }
            ?>      
        </select>
        <br><br>
        <button type="submit" name="Submit"> บันทึกข้อมูล </button>
    </form>

    <br><hr><br>

    <?php
    // ส่วนของการบันทึกข้อมูลเมื่อกดปุ่ม Submit
    if(isset($_POST['Submit'])){
        $pname = $_POST['pname'];
        $rid = $_POST['rid'];
        
        // จัดการเรื่องนามสกุลไฟล์
        $temp_file = $_FILES['pimage']['name'];
        $ext = pathinfo($temp_file, PATHINFO_EXTENSION);
        
        // 1. เพิ่มข้อมูลลงฐานข้อมูลก่อน (เว้น ID ไว้เป็น NULL เพื่อให้ Auto Increment ทำงาน)
        // หมายเหตุ: ตรวจสอบชื่อตาราง provices หรือ provinces ให้ดี
        $sql_insert = "INSERT INTO provices (p_name, p_ext, r_id) VALUES ('{$pname}', '{$ext}', '{$rid}')";
        
        if(mysqli_query($conn, $sql_insert)){
            // 2. ดึง ID ล่าสุดที่เพิ่ง Insert ไป เพื่อเอามาตั้งชื่อไฟล์รูป
            $last_id = mysqli_insert_id($conn);
            $filename = $last_id . "." . $ext;
            
            // 3. ย้ายไฟล์ไปที่โฟลเดอร์ images
            if(move_uploaded_file($_FILES['pimage']['tmp_name'], "images/".$filename)){
                echo "<script>alert('บันทึกข้อมูลและอัปโหลดรูปสำเร็จ'); window.location='b.php';</script>";
            } else {
                echo "อัปโหลดรูปภาพไม่สำเร็จ (ตรวจสอบโฟลเดอร์ images)";
            }
        } else {
            echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
        }
    }
    ?>

    <table border="1">
        <tr bgcolor="#eeeeee">
            <th>รหัสจังหวัด</th>
            <th>ชื่อจังหวัด</th>
            <th>ภาค</th>
            <th>รูปภาพ</th>
            <th>จัดการ</th>
        </tr>
        <?php
        // Query แบบ Join เพื่อดึงชื่อภาคออกมาด้วย
        $sql_show = "SELECT p.*, r.r_name 
                     FROM provices AS p 
                     INNER JOIN regions AS r ON p.r_id = r.r_id 
                     ORDER BY p.p_id DESC";
        $rs_show = mysqli_query($conn, $sql_show);
        
        if($rs_show){
            while($data = mysqli_fetch_array($rs_show)){
        ?>
        <tr>
            <td><?php echo $data['p_id']; ?></td>
            <td><?php echo $data['p_name']; ?></td>
            <td><?php echo $data['r_name']; ?></td>
            <td>
                <?php 
                $img_path = "images/" . $data['p_id'] . "." . $data['p_ext'];
                if(file_exists($img_path)){
                    echo "<img src='$img_path' width='100'>";
                } else {
                    echo "ไม่มีรูป";
                }
                ?>
            </td>
            <td>
                <a href="delete_provice.php?id=<?php echo $data['p_id']; ?>&ext=<?php echo $data['p_ext'] ; ?>" 
                   onClick="return confirm('ยืนยันการลบข้อมูลนี้?');">
                   ลบข้อมูล
                </a>
            </td>
        </tr>
        <?php 
            } 
        } 
        ?>
    </table>

    <?php mysqli_close($conn); ?>
</body>
</html>