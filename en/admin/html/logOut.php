<?php
			session_start();

			$logOutUrl = "../../../L";
			$_SESSION['login']['pass'] = 1000;
			$_SESSION['login']['status'] = 0;
			$_SESSION['login']['user'] = "";
			print_r($_SESSION['login']);
			header("location:$logOutUrl");
?>
