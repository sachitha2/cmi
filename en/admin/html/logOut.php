<?php
			session_start();

			$logOutUrl = "../../../L";
			$_SESSION['login']['pass'] = 1000;
			$_SESSION['login']['status'] = 0;
			$_SESSION['login']['user'] = "";
			$_SESSION['login']['userId'] = 0;
			print_r($_SESSION['login']);
			header("location:$logOutUrl");
?>
