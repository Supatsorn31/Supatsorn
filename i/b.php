<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>สุภัสสร ปาปะโน (แพท)</title>
</head>

<body>

<h1> งาน i--สุภัสสร ปาปะโน (แพท)</h1>

<form method=" post" action="">
    ชื่อภาค <input type="text" name="pname" autofocus required><br>
    รูป <input type="file" name="pimage" required> <br>
     <button type="submit" name="Submit"> บันทึก </button>
</form> <br><br>    

<?php
if(isset($_POST['Submit'])){
    include_once("connectdb.php");
    $rname = $_POST['rname'];
    $sql2 = "INSERT INTO regions`(r_id`,`r_name`)   VALUES (NULL,'{$rname}')";
    mysqli_query($conn,$sql2) or die("เพิ่มข้อมูลไม่ได้");
}
?>


<table border ="1">
 <tr>
   <th>รหัสจังหวัด </th>
   <th>ชื่อจังหวัด </th>
    <th> รูป </th>
    <th> ลบ </th>
  </tr>
 <?php
 <?php
 include_once("connectdb.php");
 $sql = "SELECT* FROM provinces AS p
 INNER JOIN 'regions' AS r ON p.r_id=r.r_id ";
 $rs = mysqli_ query(Sconn, Ssql);
 while ($data=mysqli_fetch_array($rs)){
 ?>
  <tr>
  <td><?php echo $data['p_id']; ?></td> 
  <td><?php echo Sdatal'p_name']; ?></td>
   <td><?php echo $data['r_name] ; ?></td>
   <td><img src="images/<?php echo $datal['p_id']; ?>.<?php echo $data[
    'p_ext'] ; ?>"width="140"></td> 
    <td width="80" align="center"><a href="delete_region.php?id=<?php echo
    $data['r_id'];?>" OnClick="return confirm('ยืนยันยันการลบ?'),"><img src=
    "images/delete.jpg" width="20"><|a></td2L
    ส่งแล้ว
    เขียนถึง
    
    
    
 <td><?php echo $data['p_id'] ; ?></td> <d><?php echo Sdata['p_name'] ;?></td>
 II
 <d><?php echo $data['r_name']; ?></td>
 <td><img src="images/<?php echo Sdatal'p_id']; ?>.<?php echo $data[ ext] ; ?>" width="140"></td> <id width="80" align="center"><a href="delete_region.php?id=<?php echo
 Sdata['_ id] ; ?›" onClick="return confirm(ยินยันการลบ?");"><img src=
 'images/delete.jpg" width="20"></a></td>
</table>

<?php
mysqli_close($conn);
?>
</body>
</html>