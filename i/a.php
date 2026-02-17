<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>สุภัสสร ปาปะโน (แพท)</title>
</head>

<body>

<h1> งาน i--สุภัสสร ปาปะโน (แพท)</h1>

<form method=" post" action="">
    ชื่อภาค <input type="text" name="rname" autofocus required>
    <button type="submit" name="Submit"> บันทึก </button>
</form> <br><br>    

<?php
if(isset($_POST['Submit'])){
	include_once("connectdb.php");
	$rname = $_POST['rname'];
	$sql2 = "INSERT INTO  `regions`(`r_id`,`r_name`) VALUES(NULL,'{$rname}')";
	mysqli_query($conn,$sql2) or die ("เพิ่มข้อมูลไม่ได้");
}
?>

<table border ="1">
 <tr>
   <th>รหัสภาค </th>
   <th>ชื่อภาค </th>
    <th> ลบ </th>
  </tr>
 <?php
 while ($data= mysqli_fetch_array($rs)){ 
 ?>
  <tr>
    <td> <?php   echo $data['r_id']."<br>";?></td>
    <td> <?php   echo $data['r_name']."<br>";?></td>
     <td width="80"  align="center"><img src ="images.jpg" width = "20"</td>
    </tr>
<?php } ?>
</table>
</body>
</html>