<?php
			session_start();
			$_SESSION['login']['pass'] = 1000;
			$_SESSION['login']['status'] = 0;
			$_SESSION['login']['user'] = "";
			print_r($_SESSION['login']);
?>
