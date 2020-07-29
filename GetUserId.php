<?php
	$host = 'localhost'; 
	$database = 'NewsBase'; 
	$user = 'mysql'; 
	$password = 'mysql';
	$Name=$_GET['Name'];
	$i=0;
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
	$query ="SELECT `id`
			 FROM Autor
			 WHERE(`NickName`='".$Name."')";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
	while ($row=mysqli_fetch_assoc($result)) {
		echo $row['id'];
	}	
	mysqli_close($link);
?>