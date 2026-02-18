<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>งาน K สุภัสสร ปาปะโน (แพท)</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            margin-top: 50px;
        }
        h1 {
            color: #333;
        }
        button {
            padding: 15px 30px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            margin: 10px;
            border-radius: 8px;
        }
        .btn-green {
            background-color: green;
            color: white;
        }
        .btn-orange {
            background-color: orange;
            color: white;
        }
        img {
            margin-top: 20px;
            width: 300px;
            display: none;
        }
    </style>
</head>
<body>

    <h1>งาน K  สุภัสสร ปาปะโน</h1>
    

    <br>

    <button class="btn-green" onclick="showMyImage()">รูปของฉัน</button>
    <button class="btn-orange" onclick="showTeacherImage()">รูปอาจารย์</button>

    <br>

    <img id="myImage" src="myphoto.jpg">
    <img id="teacherImage" src="teacher.jpg">

    <script>
        function showMyImage() {
            document.getElementById("myImage").style.display = "block";
            document.getElementById("teacherImage").style.display = "none";
        }

        function showTeacherImage() {
            document.getElementById("teacherImage").style.display = "block";
            document.getElementById("myImage").style.display = "none";
        }
    </script>

</body>
</html>