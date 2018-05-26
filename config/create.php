<?php 
include 'image.inc.php';
include 'db.php';
header("location: ../");

if ( is_uploaded_file($_FILES['picture']['tmp_name']) ){
	$new_path = "img/native/".$_FILES['picture']['name'];
	$new_path_small = "img/small/".$_FILES['picture']['name'];
	move_uploaded_file($_FILES['picture']['tmp_name'], "../".$new_path);
	$today = date("m.d.Y");
	mysqli_query($connection, "INSERT INTO `pictures` (`path`,`path_small`,`isShow`,`date`) values ('$new_path','$new_path_small','1','$today') ");
	img_resize("../".$new_path, "../".$new_path_small, 340, 460); 
}

