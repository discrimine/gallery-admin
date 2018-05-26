<?php
	session_start();
	header("Location: ../");
	if (isset($_POST['logout'])){
		unset($_SESSION['admin']);
	}
?>