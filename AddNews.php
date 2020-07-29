<?php
	function getRandomFileName($path, $extension=''){
        $extension = $extension ? '.' . $extension : '';
        $path = $path ? $path . '/' : '';
        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name . $extension;
        } while (file_exists($file));
        return $name;
    }
	$path = 'img';
	$target='';
	if($_POST['src']!=""){
		echo $_FILES['img']['name'];
		$extension = strtolower(substr(strrchr($_FILES['img']['name'], '.'), 1));
		echo $extension;
		$filename = getRandomFileName($path, $extension);
		$target = $path . '/' . $filename . '.' . $extension;
		move_uploaded_file($_FILES['img']['tmp_name'], $target);

	}
	$host = 'localhost'; 
	$database = 'NewsBase'; 
	$user = 'mysql'; 
	$password = 'mysql';
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
	$query ="INSERT INTO `News`(`id`, `src`, `title`, `Text`, `a_id`) VALUES (null,'".$target."','".$_POST['title']."','".$_POST['text']."',".$_POST['id'].")";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
	mysqli_close($link);
?>