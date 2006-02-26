<?php

require('config.php');
require('functions.php');
require('lang/'."$site_lang".'/index.php');


?>

<head>
  <title><?php echo "$site_title"; ?></title>
<?php
require('inc/metatags.php');
?>
</head>
<body>
<?php
require('inc/top_table.php');
?>
<h1><?php echo "$site_title"; ?></h1>

<?php require('inc/menu.php'); ?>

<h2><?php echo "$lng_index_catlist"; ?></h2>

<?php

// Get recipes listed by category
$query = "SELECT id,name FROM categories WHERE parent_id=-1 ORDER BY name"; 
$result = mysql_query($query); 
$number = mysql_num_rows($result);
$i = 0;
if ($number == 0) :
print "$no_db_listings";
elseif ($number > 0) :

while ($i < $number):
	    $id = mysql_result($result,$i,"id");
	    $name = mysql_result($result,$i,"name");
	    $name = unescape_and_decode( $name );

            $uppercase_begin = strtoupper($name[0]);
            if ( $uppercase_begin != $at ) {
               $cat_list .= "<hr />\n";
               $cat_list .= "<a name=\"$uppercase_begin\">\n";
               $cat_list .= "<p class=\"index_header\">$uppercase_begin</p>\n";
               $cat_index .= " [ <a href=\"#$uppercase_begin\">$uppercase_begin</a> ] ";
            }
            $at = $uppercase_begin;

	    $cat_list .= "<a href=\"view_cat.php?id=$id&cat_name=".urlencode($name)."\">$name</a><p></p>";
	    $i++;
	    endwhile;
	    endif;

print $cat_index;
print $cat_list;

?>
<!-- include footer -->
<?
require ('footer.php');
?>