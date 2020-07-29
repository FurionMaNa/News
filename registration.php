<?php
	$host = 'localhost'; 
	$database = 'NewsBase'; 
	$user = 'mysql'; 
	$password = 'mysql';
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
	$query ="SELECT `NickName` FROM `Autor` WHERE(`NickName`='".$_GET['N']."')";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
	$num_rows = mysqli_num_rows($result);
	if($num_rows==0){
		$query ="SELECT `Login` FROM `Autor` WHERE(`Login`='".$_GET['L']."')";
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
		$num_rows = mysqli_num_rows($result);
		if($num_rows==0){
			$query ="INSERT INTO `Autor`(`id`, `NickName`, `Login`, `Pass`) VALUES (null,'".$_GET['N']."','".$_GET['L']."','".$_GET['P']."')";
			$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
		}else{
			echo "LogError";
		}
	}else{
		echo "NameError";
	}
	mysqli_close($link);
?>