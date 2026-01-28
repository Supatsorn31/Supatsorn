<?php

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // กำหนดชื่อบริษัท
    $company_name = "บริษัท สยามเทคโนโลยี จำกัด (SiamTech Co., Ltd.)";

    // ฟังก์ชันช่วยในการทำความสะอาดข้อมูลเพื่อป้องกัน XSS (Cross-Site Scripting)
    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // ดึงและทำความสะอาดข้อมูลตำแหน่งงาน
    $position = isset($_POST['position']) ? clean_input($_POST['position']) : "ไม่ระบุ";

    // ดึงและทำความสะอาดข้อมูลส่วนตัว
    $title = isset($_POST['title']) ? clean_input($_POST['title']) : "ไม่ระบุ";
    $firstname = isset($_POST['firstname']) ? clean_input($_POST['firstname']) : "ไม่ระบุ";
    $lastname = isset($_POST['lastname']) ? clean_input($_POST['lastname']) : "ไม่ระบุ";
    $birthdate = isset($_POST['birthdate']) ? clean_input($_POST['birthdate']) : "ไม่ระบุ";

    // ดึงและทำความสะอาดข้อมูลการศึกษา
    $education_level = isset($_POST['education_level']) ? clean_input($_POST['education_level']) : "ไม่ระบุ";
    $major = isset($_POST['major']) ? clean_input($_POST['major']) : "ไม่ระบุ";

    // ดึงและทำความสะอาดข้อมูลความสามารถและประสบการณ์
    $special_skills = isset($_POST['special_skills']) ? clean_input($_POST['special_skills']) : "- ไม่มีข้อมูล -";
    $work_experience = isset($_POST['work_experience']) ? clean_input($_POST['work_experience']) : "- ไม่มีข้อมูล -";

    // ข้อมูลเกี่ยวกับไฟล์ (การจัดการไฟล์อัปโหลดจริงจะซับซ้อนกว่านี้ แต่จะแสดงชื่อไฟล์ที่ส่งมา)
    $resume_file_name = isset($_FILES['resume_file']['name']) ? clean_input($_FILES['resume_file']['name']) : "ไม่ได้แนบไฟล์";
    $portfolio_file_name = isset($_FILES['portfolio_file']['name']) ? clean_input($_FILES['portfolio_file']['name']) : "ไม่ได้แนบไฟล์";

    // --- ส่วนแสดงผลข้อมูลที่รับมา ---
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปข้อมูลใบสมัครงาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center text-success">✅ ข้อมูลใบสมัครถูกส่งสำเร็จ</h1>
        <p class="text-center lead">ต่อไปนี้คือข้อมูลที่คุณได้กรอกในแบบฟอร์มเพื่อสมัครงานกับ **<?php echo $company_name; ?>**</p>
        <hr>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm border-success">
                    <div class="card-header bg-success text-white">
                        <h5>💼 ข้อมูลตำแหน่งงานและส่วนตัว</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>ตำแหน่งที่สมัคร:</strong> <?php echo $position; ?></p>
                        <hr>
                        <p><strong>คำนำหน้าชื่อ:</strong> <?php echo $title; ?></p>
                        <p><strong>ชื่อ:</strong> <?php echo $firstname; ?></p>
                        <p><strong>นามสกุล:</strong> <?php echo $lastname; ?></p>
                        <p><strong>วัน/เดือน/ปีเกิด:</strong> <?php echo $birthdate; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4 shadow-sm border-info">
                    <div class="card-header bg-info text-white">
                        <h5>📚 ประวัติการศึกษาและทักษะ</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>ระดับการศึกษาสูงสุด:</strong> <?php echo $education_level; ?></p>
                        <p><strong>สาขาวิชา/คณะ:</strong> <?php echo $major; ?></p>
                        <hr>
                        <h6><strong>ความสามารถพิเศษ:</strong></h6>
                        <p class="text-muted border p-2 bg-light"><?php echo nl2br($special_skills); ?></p>
                        <h6><strong>ประสบการณ์ทำงาน:</strong></h6>
                        <p class="text-muted border p-2 bg-light"><?php echo nl2br($work_experience); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5 shadow-sm border-danger">
            <div class="card-header bg-danger text-white">
                <h5>📎 สถานะไฟล์แนบ</h5>
            </div>
            <div class="card-body">
                <p><strong>ไฟล์เรซูเม่:</strong> <span class="badge bg-primary"><?php echo $resume_file_name; ?></span></p>
                <p><strong>ไฟล์ผลงาน (Portfolio):</strong> <span class="badge bg-secondary"><?php echo $portfolio_file_name; ?></span></p>
            </div>
        </div>

        <div class="text-center mb-5">
             <a href="index.html" class="btn btn-outline-secondary">กลับสู่หน้าหลัก</a>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php

} else {
    // ถ้าไม่มีการส่งข้อมูลแบบ POST มาโดยตรง
    echo "<div class='container mt-5'><h1 class='text-danger'>🚫 ข้อผิดพลาด: ไม่สามารถเข้าถึงหน้านี้โดยตรง</h1><p>โปรดส่งใบสมัครผ่านแบบฟอร์มที่กำหนด</p></div>";
}
?>