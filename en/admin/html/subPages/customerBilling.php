<?php
require_once("../db.php");
require_once("../../methods/DB.class.php");
require_once("../../methods/Main.class.php");
$DB = new DB;
$main = new Main;
$DB->conn = $conn;


?>
					<center>
						<div class="card mb-4 shadow-sm" style="width: 80%">
      						<div class="card-header">
        						<h2 class="my-0 font-weight-normal text-primary">Deal 100</h2>
        					</div>
		      				<div class="card-body">
      							<ul class="list-group" style="width: 100%;align-content: center" id="todayList"><li style="width:100%" class="list-group-item d-flex justify-content-between align-items-center">A <span class="badge badge-primary badge-pill">0</span></li><li style="width:100%" class="list-group-item d-flex justify-content-between align-items-center">B <span class="badge badge-primary badge-pill">0</span></li><li style="width:100%" class="list-group-item d-flex justify-content-between align-items-center">C <span class="badge badge-primary badge-pill">0</span></li></ul>
      						</div>
      						<div class="card-header">
        						<h2 class="my-0 font-weight-normal text-primary" id="totalToday">0 / 250</h2>
        					</div>
						</div>
						
						
						<div class="card mb-4 shadow-sm" style="width: 80%">
      						<div class="card-header">
        						<h2 class="my-0 font-weight-normal text-primary">Deal 100</h2>
        					</div>
		      				<div class="card-body">
      							<ul class="list-group" style="width: 100%;align-content: center" id="todayList"><li style="width:100%" class="list-group-item d-flex justify-content-between align-items-center">A <span class="badge badge-primary badge-pill">0</span></li><li style="width:100%" class="list-group-item d-flex justify-content-between align-items-center">B <span class="badge badge-primary badge-pill">0</span></li><li style="width:100%" class="list-group-item d-flex justify-content-between align-items-center">C <span class="badge badge-primary badge-pill">0</span></li></ul>
      						</div>
      						<div class="card-header">
        						<h2 class="my-0 font-weight-normal text-primary" id="totalToday">0 / 250</h2>
        					</div>
						</div>
					</center>

						