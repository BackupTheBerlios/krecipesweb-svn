<?php
require "config.php";
require('lang/'."$site_lang".'/index.php');


$recipe_id = $_POST["send_id"];
$sendername = $_POST["sendername"];
$sendermail = $_POST["sendermail"];
$friendname = $_POST["friendname"];
$friendmail = $_POST["friendmail"];

$link="$url";
$link.="view_recipe.php?id=";
$link.="$recipe_id";
$subject="$lng_subject";
$subject.="$sendername";

if(empty($sendername) || empty($friendname)) {
	header("Location: view_recipe.php?id=$recipe_id&error=1&e=1");
	}
	elseif(!preg_match('/^[\.0-9a-z_-]{1,}@[\.0-9a-z-]{1,}\.[a-z]{1,}$/si',$sendermail) && $sendermail != "") {
	header("Location: view_recipe.php?id=$recipe_id&error=2&e=1");
	}
	elseif(!preg_match('/^[\.0-9a-z_-]{1,}@[\.0-9a-z-]{1,}\.[a-z]{1,}$/si',$friendmail) && $friendmail != "") {
	header("Location: view_recipe.php?id=$recipe_id&error=3&e=1");
	}
	elseif(empty($recipe_id)) {
	echo "$lng_error55";
	exit;
	}
	else {

$mailbody=$lng_message1_1;
$mailbody.=$sendername;
$mailbody.=$lng_message1_2;
$mailbody.="\n";
$mailbody.=$lng_message2;
$mailbody.=$site_title;
$mailbody.=".\n";
$mailbody.=$lng_message3;
$mailbody.=":\n";
$mailbody.=$link;
$mailbody.="\n\n";
$mailbody.=$lng_wishes;
$mailbody.="\n";
$mailbody.=$sendername;
$mailbody.="\n\n\n";
$mailbody.=$lng_message4;
$mailbody.=":\n";
$mailbody.=$site_title;
$mailbody.=" - ";
$mailbody.=$admin_mail;


$mailheaders="$lng_from: $sendername<$sendermail>\n";

mail($friendmail,$subject,$mailbody,$mailheaders);

header("Location: view_recipe.php?id=$recipe_id&sendrec=ok");

}

?>
