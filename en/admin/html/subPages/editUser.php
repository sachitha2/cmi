<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$DB->conn = $conn;
$main = new Main;
session_start();
$id = $_GET['id'];
$user = $DB->select("user","WHERE id = $id");
$userData = $DB->select("userdata","WHERE id = $id");
//print_r($user);
//print_r($userData);
$main->b("user.STE.php");
include("../../workers/readSesson.worker.php");
?>
	<h2>Edit User</h2>
	
     
      <div class="form-group" id="editArea">
        <div>Enter your name</div>
		<div><input type="text" name="name" class="form-control" placeholder="Like  - Sachitha Hirushan" value="<?php echo($userData[0]['name'])  ?>" id="name"></div>
		<div>Enter your telephone number</div>
		<div><input type="text" name="tp" class="form-control" id="tp" placeholder="Like - 0715591137" value="<?php echo($userData[0]['tp'])  ?>"></div>
		<div>Enter your birthday</div>
		<div><input type="date" name="dob" style="width: 200px;" class="form-control" id="dob" placeholder="yy-mm-dd" value="<?php echo($userData[0]['dob'])  ?>"></div>
		<div>Enter your nic</div>
		<div><input type="text" name="nic" class="form-control"  id="nic" placeholder="Like - 983142044v" value="<?php echo($userData[0]['nic'])  ?>"></div>
		<div>Enter the user type</div>
		<div>
			<select class="form-control" id="type" name="type">
				<option value="1">Admin</option>
				<option value="2" selected>Agent</option>
			
			</select>
		</div>
		
		<div>Enter the username</div>
		<div><input class="form-control" type="text" name="username" id="userName" placeholder="username" value="<?php echo($user[0]['username'])  ?>"></div>
		
		<div>Enter the Old password</div>
		<div><input class="form-control" type="password" name="password" id="oldPass" placeholder="old password"></div>
		
		<div>Enter the password</div>
		<div><input class="form-control" type="password" name="password" id="newPass" placeholder="new password"></div>
		
		<div>Enter the password again</div>
		<div><input class="form-control" type="password" id="newPassAgain" name="pass" placeholder="new password again" onKeyPress="enterAddUser(event)"></div>
		<div id="passMatching"></div>
		<div id="msg"></div>
		<div><button type="text"  class="btn btn-primary btn-lg" onclick="editSaveUser()">Save</button></div>
      </div>
      
   