<?php
	require('config.php');
	require('functions.php');
	
	$recipe_id = $_GET["id"];

	if ( $recipe_id=="" ) die("No recipe chosen");

	// Read photo
	$result = mysql_query("SELECT photo FROM recipes WHERE id=$recipe_id");
	$row = mysql_fetch_row($result);

	if ( $row[0] == "" ) {
		Header( "Content-type: image/png");
		imagepng(imagecreatefrompng( "img/default_photo.png" ));
	} else {
		Header( "Content-type: image/jpeg");
		imagejpeg(imagecreatefromstring( base64_decode($row[0]) ));
	}
	
	mysql_free_result($result);
?>
