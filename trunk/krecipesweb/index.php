<?php

function template($content) {
       global $main;
        $filename = "templ/default/theme.htm";

       if(!$fd = fopen($filename, "r")) {
                $error = 1;
        }
        else {
                $template = fread ($fd, filesize ($filename));
                fclose ($fd);
                $template = stripslashes($template);
                $template = eregi_replace("<% main %>", "$main", $template);
                $template = eregi_replace("<% content %>", "$content", $template);
                echo "$template";
        } }


function home() {
global $main;
include ("test.php");
template("$data");
}


switch($action) {
        default:  // default switch
        home();
        break;
}
?>