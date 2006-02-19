<?php

require('config.php');
require('functions.php');
require('lang/'."$site_lang".'.php');

function template($content) {
       global $main;
        $filename = 'templ/theme.htm';

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


function index() {
global $main;
include ("test.php");
template("$data");
}

function cat() {
global $main;
include ("");
template("$data");
}

switch($paget) {
        default:  // default switch
        index();
        break;
}
?>