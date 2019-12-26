<?php

getURL();

function getURL(){
	$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

	$escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
	echo '<a href="' . $escaped_url . '">' . $escaped_url . '</a>';

}

?>