<!--This is log checker
created 2019/01/23
By sachitha hirushan
--->
<?php 
	//Connecting Database
	include("db.php");
	// End

	$UserName =htmlspecialchars($_POST['username']);
	$Password =htmlspecialchars($_POST['pass']);
    echo($UserName . $Password);
	$sql = "SELECT *
			FROM user
			WHERE username = '$UserName'";

	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	
	if ($resultCheck<1){
		//errorMessage = Invalid User Name
		echo "Invalid User Name";
		
	}else{
		$row = mysqli_fetch_assoc($result);
		$hashed= md5($Password);
		//echo($hashed);
			/*$hashedPwdCheck = password_verify($Password, $row['password']);
			if($hashedPwdCheck==false){
				//errorMessage = Invalid Password
				echo "Invalid Password";
			}elseif($hashedPwdCheck==true){
				//Loged in
				echo "Loged in";
			}*/
		if ($hashed==$row['password']){
			//echo "Logged in";
			$cookie_name = "user";
			$cookie_value = $UserName;
			setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day
			//echo($_COOKIE['user']);
			//session_id($_COOKIE['PHPSESSID']); 
			/*session_start();
			$_SESSION['user']['username']= $UserName; 
			if($_SESSION['user']['username']== $UserName ){
				echo "done";
			}else{
				echo("login error");
			}
			*/
			//echo("pw ok");
			header("location:dashboard.php");
			/*if (isset($_COOKIE["user"])){
				echo "done";
			}*/
		
			///redirect to the user
			   ///write in here
			
			/////redirect user ending
		}else{
			echo "Invalid Password";
		}
		
	}

mysqli_close($conn);
//header("location:Check.php");
?>
