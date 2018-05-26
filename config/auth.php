<?php
	session_start();
	
	if (isset($_POST["auth"])){
		if ($_POST['login'] != 'admin' ){
			echo "<script> $(document).ready(function(){  $('.ds_valid').text('Логин введен не верно');  });  </script>";
		}else if ($_POST['pass'] != '108183' ){
			echo '<script> $(document).ready(function(){  $(".ds_valid").text("Пароль введен не верно");  });  </script>';
		}else{
			$_SESSION['admin'] = '1';
		}
	}
	echo "<script> window.location = '../'; </script>";
?>