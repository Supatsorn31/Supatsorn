<?php
include_once("connectdb.php"); // เชื่อมต่อฐานข้อมูล
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>สุภัสสร ปาปะโน (แพท)</title>
    <style>
        body { font-family: Tahoma, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { padding: 10px; text-align: center; border: 1px solid #ccc; }
        tr:nth-child(even) { background-color: #f9f9f9; }
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
            // ดึงข้อมูลภาคมาใส่ Dropdown: แก้ไขตัวแปร $rs3 และ $data3
            $sql3 = "SELECT * FROM regions";
            $rs3 = mysqli_query($conn, $sql3);
            while($data3 = mysqli_fetch_array($rs3)){
                echo "<option value='{$data3['r_id']}'>{$data3['r_name']}</option>";
            }
            ?>      
        </select>
        <br><br>
        <button type="submit" name="Submit"> บันทึกข้อมูล </button>
    </form>

    <br><hr><br>

    <?php
    // ส่วนของการบันทึกข้อมูล
    if(isset($_POST['Submit'])){
        $pname = $_POST['pname'];
        $rid = $_POST['rid'];
        
        // รับนามสกุลไฟล์: แก้ไขชื่อ pimage ให้ตรงกับ input
        $ext = pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION);
        
        // บันทึกข้อมูล (แก้ไขชื่อตารางเป็น provinces และนำเครื่องหมาย ' ออก)
        $sql2 = "INSERT INTO provinces (p_name, p_ext, r_id) VALUES ('{$pname}', '{$ext}', '{$rid}')";
        
        if(mysqli_query($conn, $sql2)){
            // ดึง ID ล่าสุดมาตั้งชื่อไฟล์
            $pid = mysqli_insert_id($conn);
            $filename = $pid . "." . $ext;
            
            // อัปโหลดไฟล์ไปที่โฟลเดอร์ images
            if(move_uploaded_file($_FILES['pimage']['tmp_name'], "images/".$filename)){
                echo "<script>alert('บันทึกสำเร็จ'); window.location='b.php';</script>";
            } else {
                echo "<p style='color:red;'>อัปโหลดรูปไม่สำเร็จ (ตรวจสอบโฟลเดอร์ images)</p>";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>

    <table>
        <tr bgcolor="#eeeeee">
            <th>รหัสจังหวัด</th>
            <th>ชื่อจังหวัด</th>
            <th>ภาค</th>
            <th>รูปภาพ</th>
            <th>จัดการ</th>
        </tr>
        <?php
        // Query แบบ Join (แก้ไขชื่อตาราง provinces และ regions)
        $sql = "SELECT p.*, r.r_name 
                FROM provinces AS p 
                INNER JOIN regions AS r ON p.r_id = r.r_id 
                ORDER BY p.p_id DESC";
        $rs = mysqli_query($conn, $sql);
        
        if($rs){
            while($data = mysqli_fetch_array($rs)){
        ?>
        <tr>
            <td><?php echo $data['p_id']; ?></td>
            <td><?php echo $data['p_name']; ?></td>
            <td><?php echo $data['r_name']; ?></td>
            <td>
                <?php 
                $img_name = "images/" . $data['p_id'] . "." . $data['p_ext'];
                if(file_exists($img_name)){
                    echo "<img src='$img_name' width='100'>";
                } else {
                    echo "ไม่มีรูป";
                }
                ?>
            </td>
            <td>
                <a href="delete_province.php?id=<?php echo $data['p_id']; ?>&ext=<?php echo $data['p_ext']; ?>" 
                   onClick="return confirm('ยืนยันการลบ?');">ลบ</a>
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