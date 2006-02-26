<?php

     require('config.php');
     require('functions.php');
require('lang/'."$site_lang".'/index.php');

$cat_id = $_GET["id"];
$cat_name= stripslashes(($_GET["cat_name"]));

?>

<head>
	<title><?php echo "$site_title"; ?> -> <?php echo "$lng_cat_cat"; ?>: <?php echo
"$cat_name"; ?></title>
<?php
require('inc/metatags.php');
?>
</head>
<body>
<?php
require('inc/top_table.php');
?>
<h2><?php echo "$site_title"; ?> -> <?php echo "$lng_cat_cat"; ?>: <?php echo "$cat_name";
?></h2>

<? require('inc/menu.php'); ?>

<?php
 $query = "SELECT id,name FROM categories WHERE parent_id='$cat_id' ORDER BY name";
     $result = mysql_query($query); 
     $number = mysql_num_rows($result);
     if ( $number > 0 ) print "<h2>$lng_cat_subc:</h2>\n";

     $i = 0;
while ($i < $number):
	    $id = mysql_result($result,$i,"id");
	    $name = mysql_result($result,$i,"name");
	    $name = unescape_and_decode( $name );

	    print "<a href=\"view_cat.php?id=$id&cat_name=".urlencode($cat_name."->".$name)."\">$name</a><p></p>";
	    $i++;
	    endwhile;
?>

<hr />

<h2><?php echo "$lng_cat_recipes"; ?>:</h2>

<?php
 $query = "SELECT r.id,r.title,cl.category_id,cl.recipe_id FROM recipes r,
     category_list cl WHERE cl.category_id=$cat_id AND cl.recipe_id=r.id";
     $result = mysql_query($query); 
     $number = mysql_num_rows($result);
     $i = 0;

     if ($number == 0) :
     print "$no_cat_listings";
     elseif ($number > 0) :
while ($i < $number):
	    $id = mysql_result($result,$i,"r.id");
	    $title = mysql_result($result,$i,"r.title");
	    $title = unescape_and_decode( $title );

	    print "<a href=\"view_recipe.php?id=$id\">$title</a><p></p>";
	    $i++;
	    endwhile;
	    endif;
?>
<?php
     require('footer.php');
?>