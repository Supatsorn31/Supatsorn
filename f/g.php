<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>สุภัสสร ปาปะโน  (แพท)</title>
</head>

<body>
<h1>สุภัสสร ปาปะโน  (แพท) - โปรแกรมสูตรคูณ</h1>
<form method="post" action="">
แม่สูตรคูณ <input type="number" min="2" max="100" name="a" autofocus required>
 <button type="submit" name="Submit"> OK </button>
</form>
<hr>
<?php
if(isset($_POST['Submit'])){
	 $m= $_POST['a'];
	 for ($i=1; $i<=12; $i++) {
		 $x = $m *$i;
		 echo "{$m} x {$i}={$x}<br>";
	 }
}
?>
 
</body>
</html>