<?php
	$host = 'localhost'; 
	$database = 'NewsBase'; 
	$user = 'mysql'; 
	$password = 'mysql';
	$L=$_GET['L'];
	$P=$_GET['P'];
	$i=0;
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
	$query ="SELECT News.`id`,News.`src`,News.`title`,News.`Text`,Autor.`NickName`,Autor.`id`
		FROM News 
		INNER JOIN Autor on(Autor.id=News.a_id)
		order by 1 DESC";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
	$myarray = array();
	while ($row = mysqli_fetch_assoc($result)) {
    	$myarray[] = $row;
	}   
	$jsonData = json_encode(array('data' => $myarray));
	echo $jsonData;
	mysqli_close($link);
?>