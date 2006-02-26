<?php
####################################################################################
#
#  project           	: Krecipes WebFrontend
#  filename          	: config.php
#  last modified by  	: Nils Kristian Tomren
#  e-mail            	: project@nilsk.net
#  purpose           	: Configuration File
#  last modified     	: 03.12.2005
#
####################################################################################
# DATABASE SETTINGS
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'KrecipesWeb';

#SITE SETTINGS
//Site title
$site_title = 'Krecipes Cookbook';
//Site language (see the 'lang' subdir for more languages)
$site_lang = 'english';
//URL to where the Frontend is located
$url="http://localhost/krecipes/cvs/krecipesweb/";
//URL to the view_recipe.php file
$urlm="http://localhost/krecipes/cvs/krecipesweb/view_recipe.php?id=";

//Webmasters e-mail
$admin_mail="webmaster@yoursite.org";

//Your copyright notice at bottom of print page
$print_copy = "&copy; 2005 recipe.com";




include 'settings.php';
?>
