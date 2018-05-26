<?php
session_start();
include 'config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Админ панель</title>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Rubik:400,700&amp;subset=cyrillic" rel="stylesheet"> 
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="stylesheet" href="../libs/slick/slick.css">
	<link rel="stylesheet" href="../libs/slick/slick-theme.css">
	<link rel="stylesheet" href="../libs/formstyler/jquery.formstyler.css">
	<link rel="stylesheet" href="../libs/fancybox/source/jquery.fancybox.css">
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/media.css">
	<link rel="stylesheet" href="css/style.css?v=14">
	<link rel="stylesheet" href="css/media.css?v=14">
	<script src="../libs/jquery/jquery-3.2.1.min.js"></script>
	<script src="../libs/pageScroll2id/jquery.malihu.PageScroll2id.min.js"></script>
	<script src="../libs/slick/slick.min.js"></script>
	<script src="../libs/formstyler/jquery.formstyler.min.js"></script>
	<script src="../libs/fancybox/source/jquery.fancybox.js"></script>
	<script src="../libs/fancybox/source/jquery.fancybox.pack.js"></script>
	<script src="../js/main_map.js"></script>
	<script src="../js/slick.js"></script>
	<script src="../js/common.js"></script>
	<style type="text/css">
		
	</style>
</head>
<body>
	<?php
		if (!isset($_SESSION['admin'])){ ?>
		<div class="ds_admin ds_auth">
			<h1>Вход в админ панель</h1>
			<form action="config/auth.php" method="POST">
				<div class="ds_input">
					<label>Введите логин</label>
					<input type="text" name="login">
				</div>
				<div class="ds_input">
					<label>Введите пароль</label>
					<input type="password" name="pass">
				</div>
				<div class="ds_input">	
					<input type="submit" value="Вход" name="auth">
				</div>
				<div class="ds_valid"></div>
			</form>
		</div>
			
		<?php }else if (isset($_SESSION['admin'])){
	?>	
		<div class="ds_admin ds_panel">
			<h1>Админ панель</h1>
			<div class="admin_config"> 
			        <span>Добавить фото в галерею</span>
					<form action="config/create.php" enctype="multipart/form-data" method="POST">

					<input type="file" name="picture">
					<input type="submit" value="Сохранить" name="add_picture">
					</form>
				</div>


			<div class="ds_panel__container">
				<div class="admin_images">
					<?php
						$getPictures = mysqli_query($connection, "SELECT * FROM `pictures` ORDER BY `sort`,`id` DESC");


						while ($pic = mysqli_fetch_assoc($getPictures)) {
							?>
							<div class="admin_image-container">
								<div class="admin_main">
									<div class="admin_image__pic">
									<?php
									echo "<img src='".$pic['path_small']."'>" . "<br>";
									?>
									</div>
									<div class="admin_image__config">
										<form action="config/image_config.php?id=<?=$pic['id']?>" style="height: 100%;" check-id="<?=$pic['id']?>" method="post">
											<div class="image_config_container">
												<div class="conf_top">
													<div class="admin_sort">
														<label>Позиция в слайдере:</label>
														<input type="text" value="<?=$pic['sort']?>" placeholder="" name="sort">
													</div>
													<div class="admin_date">
														<label>Дата:</label>
														<input type="text" placeholder="__.__.2018" value="<?=$pic['date']?>" name="date">
													</div>
												</div>
												<div class="conf_middle">
													<div class="admin_desc">
														<label>Описание:</label>
														<input value="<?=$pic['description']?>" type="text" placeholder="" name="desc">
													</div>
												</div>
												<div class="conf_bottom">
													<input value="" type="submit" name="desc_sub">
													<input value="" type="button" class="" name="check" isShow="<?=$pic['isShow']?>">
													<input value="" type="submit" name="del_sub">
												</div>
											</div>	
										</form>
									</div>
								</div>		
							</div>
							<?php
						}
					?>		
				</div>
			</div>	
			<form action="config/logout.php" method="POST">
				<input type="submit" value="Выход" name="logout">
			</form>
		</div>
	<?php
		}
	?>
<script type="text/javascript">
	$(document).ready(function(){
		$("input[name='check']").each(function(){
			if ($(this).attr("isShow") == "1"){
				$(this).addClass("active");
			}else{
				$(this).removeClass("active");
			}
		});
	});
	$("input[name='check']").click(function(e){
		if ($(this).attr("isShow") == "1"){
				$(this).removeClass("active");
				$(this).attr("isShow","0");
			}else{
				$(this).addClass("active");
				$(this).attr("isShow","1");
			}
		var show_check = $(this).attr("isShow");
		var id_check = $(this).parent().parent().parent().attr("check-id"); 
		$.post("config/ajax_show.php",
	        {id: id_check, isShow: show_check},
	        function(response){
	           
	        }
		);
	});
</script>	
</body>
</html>