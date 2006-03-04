<?php

//Connecting to DB
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die
('Could not connect to the Krecipes database-server!');
mysql_select_db($dbname);

function unescape_and_decode( $string )
{
     $result = str_replace( ";@", ";", $string );
	$string = utf8_decode($string);
     return $string;
}

//Versions for footer
$query = "SELECT ver,generated_by FROM db_info";
$result = mysql_query( $query );
$row = mysql_fetch_array($result, MYSQL_NUM);
$ver = unescape_and_decode( $row[0] );
$generated_by = unescape_and_decode( $row[1] );


?>