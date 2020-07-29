<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Новостной блог</title>
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="Bootstrap\js\bootstrap.js"></script>
		<link rel="stylesheet" type="text/css" href="Bootstrap\css\bootstrap.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript">
			var delay_popup = 0;
			setTimeout("document.getElementById('overlay').style.display='block'", delay_popup);
		</script>
	</head>
	<body >
		<header>
			<div class="row">
				<div class="col-2">
					<h3>YouNews</h3>
				</div>
				<div class="col-6">
					<h3 id="NameUser">Вы вошли как гость</h3>
				</div>
				<div class="col-4">
					<h5 id="RefreshUser" name="RefreshUser">Сменить пользователя</h5>
				</div>
			</div>
		</header>
		<div id="overlay">
    		<div class="popup">  
  				<div class="form-group">
    				<label for="exampleInputEmail1">E-Mail:</label>
    				<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-Mail">
  				</div>
  				<div class="form-group">
    				<label for="exampleInputPassword1">Пароль:</label>
    				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль">
  				</div>
  				<button id="btnOpen" name="btnOpen" class="btn btn-primary">Войти</button>
  				<button id="btnRegistration" name="btnRegistration" class="btn btn-primary">Регистрация</button>
        		<button class="close" title="Закрыть" onclick="CloseWindow()"></button>
    		</div>
		</div>
		<div id="overlayRegistration">
    		<div class="popup">  
  				<div class="form-group">
    				<label for="exampleInputNick">Имя:</label>
    				<input type="text" class="form-control" id="exampleInputNick1" placeholder="Имя">
  				</div>
  				<div class="form-group">
    				<label for="exampleInputEmail2">E-Mail:</label>
    				<input type="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="E-Mail">
  				</div>
  				<div class="form-group">
    				<label for="exampleInputPassword2">Пароль:</label>
    				<input type="password" class="form-control" id="exampleInputPassword2" placeholder="Пароль">
  				</div>
  				<button id="btnReg" name="btnReg" class="btn btn-primary">Зарегистрироваться</button>
        		<button class="close" title="Закрыть" onclick="CloseWindowReg()"></button>
    		</div>
		</div>
		<div class="container">
			<br>
			<br>
			<div id="divNewNews" class="row">
				<div class="col-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<form id="NewsForm">
								<input class="col-12 form-control" maxlength="72" type="text" name="title"	id="title">
								<textarea class="col-12 form-control"  onKeyPress="return ( this.value.length < 1000 );"onPaste="return (( this.value.length+window.clipboardData.getData('Text').length) < 1000 );" name="text" id="text"></textarea>
								<div class="row">
  									<div class="col-6">
  										<input type="file" class="form-control-file col-12 btn btn-primary" id="exampleFormControlFile1" name="exampleFormControlFile1" >
  									</div>
									<div class="col-3">
										<input class="col-12 btn btn-primary" type="reset">
									</div>
									<div class="col-3">
										<input class="col-12 btn btn-primary	" type="button" value="Отправить" name="AddNews" id="AddNews">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div id="News" class="row">
			<?php
				LoadNews();
				function LoadNews(){
					$host = 'localhost'; 
					$database = 'NewsBase'; 
					$user = 'mysql'; 
					$password = 'mysql';
					$i=0;
					$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
					$query ="SELECT News.`id`,News.`src`,News.`title`,News.`Text`,Autor.`NickName`,Autor.`id`
							 FROM News 
							 INNER JOIN Autor on(Autor.id=News.a_id)
							 order by 1 DESC";
					$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
					while ($row=mysqli_fetch_assoc($result)) {?>
						<div class = 'row objrow'>
							<div class='col-9'>
								<h3><?php echo $row['title'];?></h3>
 							</div>
 							<div class='col-3'>
 								<h6>Автор: <?php echo $row['NickName'];?></h6>
 							</div>
 							<div class='row'>
 								<?php if((!($row['src']===null))&&($row['src']!="")){?>
 									<div class = 'col-6'>
 										<img src = <?php echo $row['src']; ?> class ='img-responsive' width='100%'>
 									</div>
 									<div class='col-6'>
 										 <p><?php echo $row['Text']; ?></p>
 									</div>
 								<?php }else{?>
 									<div class='col-12'>
 										 <p><?php echo $row['Text']; ?></p>
 									</div>
 								<?php }?>
 							</div>
						</div>	
			<?php 	}
					mysqli_close($link);
				}
			?>
			</div>
		</div>
		<footer>
			
		</footer>
		<script type="text/javascript">
			var Visitor=true;
			var User="";
			var UserId="";

			function getCookie(name) {
 				var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
  				return matches ? decodeURIComponent(matches[1]) : undefined;
			}

			$(document).ready(function(){
				document.getElementById('overlayRegistration').style.display='none';
				if((getCookie("Login")!=undefined)&&(getCookie("Pass")!=undefined)&&(getCookie("Login")!="")&&(getCookie("Pass")!="")){
					document.getElementById('overlay').style.display='none';
					UserUpdate(getCookie("User")+" добро пожаловать");
					User=getCookie("User");
					UserId=getCookie("UserID");
				}
			});

			$("#btnReg").click(function(){
				$.ajax({ 
					url: "registration.php",
					type: "GET",
					data: "L="+$("#exampleInputEmail2").val()+"&P="+$("#exampleInputPassword2").val()+"&N="+$("#exampleInputNick1").val(),
				    success: function(msg){	
				    	if(msg=="NameError"){
				    		alert("Такое имя уже есть!!!");
				    	}else{	
				    		if(msg=="LogError"){
				    			alert("Такой логин уже используется!!!");
				    		}else{
								document.getElementById('overlayRegistration').style.display='none';
								document.getElementById('overlay').style.display='block';
				    		}
				    	}
				    }

				});
			});

			$("#RefreshUser").click(function(){
				document.cookie= "Login=";
				document.cookie= "Pass=";
				document.cookie= "User=";
				document.cookie= "UserID=";
				location.reload();
			});

			$("#btnRegistration").click(function(){
				document.getElementById('overlay').style.display='none';
				document.getElementById('overlayRegistration').style.display='block';
			});

			$("#btnOpen").click(function(){
				$.ajax({ 
					url: "authorization.php",
					type: "GET",
					data: "L="+$("#exampleInputEmail1").val()+"&P="+$("#exampleInputPassword1").val(),
				    success: function(msg){	
				    	if(msg==""){
				    		alert("Неверный логин или пароль");
				    	}else{
							document.getElementById('overlay').style.display='none';
							Visitor=false;
							User=msg;
							UserUpdate(msg+" добро пожаловать");
							$.ajax({ 
								url: "GetUserId.php",
								type: "GET",
								data: "Name="+User,
        						processData: false,
        						contentType: false,
								success: function(msg){	
								   	UserId=msg;
									document.cookie= "Login="+$("#exampleInputEmail1").val();
									document.cookie= "Pass="+$("#exampleInputPassword1").val();
									document.cookie= "User="+User;
									document.cookie= "UserID="+UserId;
								}
							});
				    	}
				    }

				});
				
			});	

			function UserUpdate(s){
				document.getElementById('NameUser').innerHTML=s;
			}

			function CloseWindow(){
				document.getElementById('overlay').style.display='none';
				Visitor=true;
				UserUpdate("Вы вошли как гость");
				$('#divNewNews').hide(); 
				$('#LikeComment').hide(); 
			}

			function CloseWindowReg(){
				document.getElementById('overlayRegistration').style.display='none';
				document.getElementById('overlay').style.display='block';
			}
		
			$("#AddNews").click(function(){
				var title=$("#title").val();
				var text=$("#text").val();
				var $input = $("#exampleFormControlFile1");
    			var fd = new FormData();
    			if (jQuery('#exampleFormControlFile1').val()!="") { 
    				fd.append('img', $input.prop('files')[0]);
    				fd.append('src',jQuery('#exampleFormControlFile1').val())
    			}
    			fd.append('text', text);
    			fd.append('title', title);
    			fd.append('id', UserId);
				if((title=='')||(text=='')){
					alert("Текстовые поля должны быть заполнены!!!")
				}else{
					$.ajax({ 
							url: "AddNews.php",
							type: "POST",
							data: fd,
        					processData: false,
        					contentType: false,
					    	success: function(msg){	
					    		alert(msg);
					    		location.reload();
					    	}
					});
				}
			});

		</script>
	</body>
</html>