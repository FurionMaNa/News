<?php
	$host = 'localhost'; 
	$database = 'NewsBase'; 
	$user = 'mysql'; 
	$password = 'mysql';
	$L=$_GET['L'];
	$P=$_GET['P'];
	$i=0;
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
	$query ="SELECT `NickName`
			 FROM Autor
			 WHERE((`Login`='".$L."')and(`Pass`='".$P."'))";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
	while ($row=mysqli_fetch_assoc($result)) {
		echo $row['NickName'];
	}	
	mysqli_close($link);
?>