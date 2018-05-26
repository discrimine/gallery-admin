<?php
	require_once 'db.php';
	$pic_id = $_POST['id'];
	$isShow = $_POST['isShow'];
	echo $pic_id."<br>";
	echo $isShow."<br>";
	$s=mysqli_query($connection, "UPDATE `pictures` SET `isShow` = '$isShow' WHERE `id` = '$pic_id' ");
	var_dump($s);
?>