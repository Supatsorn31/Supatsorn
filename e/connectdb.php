<?php
   $host = "localhost";
   $user = "root";
   $pwd = "r660109";
   $db = "4038db";
   $conn = mysqli_connect($host,$user,$pwd,$db) or die ("เชื่อมต่อฐานข้อมูลไม่ได้");
   mysqli_query($conn, "SET NAMES utf8"); //เชื่อมต่อฐานข้อมูลดาต้าเบส

?>