
<?php
	require_once("../../methods/Main.class.php");
	$main = new Main;
	
?>
		<h2>Create a user</h2>
		<div><?php $main->b("user.php"); ?></div>
		<div>Enter your name</div>
		<div><input type="text" name="name" class="form-control" placeholder="Like  - Sachitha Hirushan" id="name"></div>
		<div>Enter your telephone number</div>
		<div><input type="text" name="tp" class="form-control" id="tp" placeholder="Like - 0715591137"></div>
		<div>Enter your birthday</div>
		<div><input type="date" name="dob" style="width: 200px;" class="form-control" id="dob" placeholder="yy-mm-dd"></div>
		<div>Enter your nic</div>
		<div><input type="text" name="nic" class="form-control"  id="nic" placeholder="Like - 983142044v"></div>
		<div>Enter the user type</div>
		<div>
			<select class="form-control" id="type" name="type">
				<option value="1">Admin</option>
				<option value="2">Agent</option>
			
			</select>
		</div>
		
		<div>Enter the username</div>
		<div><input class="form-control" type="text" name="username" id="userName" placeholder="username"></div>
		
		<div>Enter the password</div>
		<div><input class="form-control" type="password" name="password" id="password" placeholder="password"></div>
		<div>Enter the password again</div>
		<div><input class="form-control" type="password" id="pass" name="pass" placeholder="your password again" onKeyPress="enterAddUser(event)"></div>
		<div id="passMatching"></div>
		<div id="msg"></div>
		<div><button type="text"  class="btn btn-primary btn-lg" onclick="addUser()">Create the account</button></div>


