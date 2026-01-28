<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ฟอร์มรับข้อมูล - สุภัสสร ปาปะโน(แพท)</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    /* เพิ่ม CSS เล็กน้อยเพื่อให้ div แสดงสีที่ชอบได้ชัดเจน */
    .color-display {
        width: 100px;
        height: 25px;
        border: 1px solid #ccc;
        display: inline-block;
        vertical-align: middle;
        margin-left: 10px;
    }
</style>
</head>

<body>
<div class="container my-5">
    <div class="card shadow-lg p-3">
        <div class="card-body">
            <h1 class="card-title text-center mb-4">ฟอร์มรับข้อมูล - สุภัสสร ปาปะโน(แพท)  </h1>

            <form method="post" action="">

                <div class="mb-3">
                    <label for="fullname" class="form-label">ชื่อ - สกุล <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="fullname" name="fullname" autofocus required placeholder="กรุณากรอกชื่อ-สกุล">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">เบอร์โทร <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" id="phone" name="phone" required placeholder="เช่น 08x-xxxxxxx" pattern="[0-9]{10}">
                    <div class="form-text">ต้องเป็นตัวเลข 10 หลัก</div>
                </div>

                <div class="mb-3">
                    <label for="height" class="form-label">ส่วนสูง <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="height" name="height" min="100" max="200" required placeholder="100-200">
                        <span class="input-group-text">ซม.</span>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">ที่อยู่</label>
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="บ้านเลขที่ ถนน ตำบล อำเภอ จังหวัด"></textarea>
                </div>

                <div class="mb-3">
                    <label for="birthday" class="form-label">วัน / เดือน / ปีเกิด</label>
                    <input type="date" class="form-control" id="birthday" name="birthday">
                </div>

                <div class="mb-3">
                    <label for="color" class="form-label">สีที่ชอบ</label>
                    <div class="d-flex align-items-center">
                        <input type="color" class="form-control form-control-color me-2" id="color" name="color" value="#563d7c" title="เลือกสี">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="major" class="form-label">สาขาวิชา</label>
                    <select class="form-select" id="major" name="major">
                        <option value="การบัญชี">การบัญชี</option>
                        <option value="การตลาด">การตลาด</option>
                        <option value="คอมพิวเตอร์ธุรกิจ">คอมพิวเตอร์ธุรกิจ</option>
                        <option value="การจัดการ">การจัดการ</option>
                        <option value="การเงิน">การเงิน</option>
                    </select>
                </div>

                <div class="d-grid gap-2 d-md-block mt-4">
                    <button type="submit" name="Submit" class="btn btn-primary me-2">
                        <i class="bi bi-person-plus-fill"></i> สมัครสมาชิก
                    </button>
                    <button type="reset" class="btn btn-secondary me-2">
                        <i class="bi bi-x-circle-fill"></i> ยกเลิก
                    </button>
                    <button type="button" class="btn btn-info me-2 text-white" onClick="window.location='https://www.msu.ac.th/';">
                        Go to MSU
                    </button>
                    <button type="button" class="btn btn-warning me-2" onclick="alert('จ๊ะเอ๋ตัวเอง!!!');">
                        Hello
                    </button>
                    <button type="button" class="btn btn-success" onClick="window.print();">
                        <i class="bi bi-printer-fill"></i> พิมพ์
                    </button>
                </div>

            </form>
        </div>
    </div>
    
    <hr class="my-5">

    <?php
if (isset($_POST['Submit'])) {

    include_once("connectdb.php");

    $fullname = $_POST['fullname'];
    $phone    = $_POST['phone'];
    $height   = (int)$_POST['height'];
    $address  = $_POST['address'];
    $birthday = $_POST['birthday'];
    $color    = $_POST['color'];
    $major    = $_POST['major'];

    // ใช้ Prepared Statement (ปลอดภัย + ไม่ error ง่าย)
    $stmt = $conn->prepare(
        "INSERT INTO register 
        (r_name, r_phone, r_height, r_address, r_birthday, r_color, r_major)
        VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(
        "ssissss",
        $fullname,
        $phone,
        $height,
        $address,
        $birthday,
        $color,
        $major
    );

    if ($stmt->execute()) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
    } else {
        echo "<script>alert('บันทึกไม่สำเร็จ: {$stmt->error}');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</body>
</html>