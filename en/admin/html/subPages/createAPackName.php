<?php 
require_once("../../methods/Main.class.php");
$main = new Main;
$main->b("pack.php");
?>


<input type="text" placeholder="Pack name" id="packName" class="form-control" onKeyPress="enterAddPack(event)">
<div id="msg"></div>
<input type="button" value="Create" onClick="createPackName()"  class="btn btn-primary btn-lg" >