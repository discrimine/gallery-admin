<?php
require_once 'db.php';
header("location: ../");
$pic_id = $_GET['id'];
if (isset($_POST['desc_sub'])){
	$desc_pic = $_POST['desc'];
	$desc_pic = htmlspecialchars($desc_pic, ENT_QUOTES);
	mysqli_query($connection, "UPDATE `pictures` SET `description` = '$desc_pic' WHERE `id` = '$pic_id' ");
	$date_pic = $_POST['date'];
	mysqli_query($connection, "UPDATE `pictures` SET `date` = '$date_pic' WHERE `id` = '$pic_id' ");
	$sort_pic = $_POST['sort'];
	mysqli_query($connection, "UPDATE `pictures` SET `sort` = '$sort_pic' WHERE `id` = '$pic_id' ");
}

if (isset($_POST['del_sub'])){
	mysqli_query($connection, "DELETE FROM `pictures` WHERE `id` = '$pic_id'");
}

?>