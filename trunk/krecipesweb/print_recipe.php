<?php

require('config.php');
require('functions.php');
require('lang/'."$site_lang".'/index.php');

$recipe_id = $_GET["id"];

if ( $recipe_id=="" ) die("$no_recipe_chosen");

require('view_recipe_functions.php');
?> 
<head>
<title><?php echo "$site_title" ?> -> <?php echo "$recipe_title"; ?></title>
<?php
require('inc/metatags.php');
?>


</head>
<body onload="window.print();">
<div align="center">
	<table class="ptable" cellspacing="2" cellpadding="2">
  <tbody>
	  <tr><td>
    <tr>
      <td align="center" colspan="2" width="100%"><h1><?php echo "$recipe_title";
?></h1></td>
    </tr>
    <tr>
      <td align="center" valign="middle" width="450">
        <img src="recipe_photo.php?id=<?php echo $recipe_id; ?>" border="0" />
      </td>
      <td>
      <p><? echo "<b>$lng_recipe_author:</b> $authors";?></p>
      <p><? echo "<b>$lng_recipe_yield:</b> $recipe_yield"; ?></p>
      <p><? echo "<b>$lng_recipe_prep:</b> $recipe_preptime"; ?></p>
      <p><? echo "<b>$lng_recipe_cat:</b> $categories"; ?></p>
</tr>
      <tr><td align="left"></td>
      <td align="left"></td></tr>
      
      
      </td>
    </tr>
    <tr>
      <td width="100%" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">
      <h3><?php echo "$lng_cat_ingred"; ?></h3>
      <ol>
      <?php
// Read and write the ingredients
$command = "SELECT il.id,il.ingredient_id,il.group_id,i.name,il.amount,il.amount_offset,u.id,u.name FROM ingredients i,
ingredient_list il, units u "
	."WHERE il.recipe_id=$recipe_id "
	."AND i.id=il.ingredient_id "
	."AND u.id=il.unit_id ORDER BY il.order_index";

$result = mysql_query($command);
$number = mysql_num_rows($result); 
$i = 0; 
if ($number == 0) : 
   echo "No listings"; 
elseif ($number > 0) :
while ($i < $number):
        $ingredient_id = mysql_result($result,$i,"il.ingredient_id");
	$ingredient_name = mysql_result($result,$i,"i.name");

	$ingredient_group_id = mysql_result($result,$i,"il.group_id");
	if ( $ingredient_group_id != -1 ) {
		$command = "SELECT name FROM ingredient_groups WHERE id=$ingredient_group_id";
		$g_result = mysql_query($command);
		$ingredient_group = mysql_result($g_result,0,"name");
	}

	$ingredient_amount = mysql_result($result,$i,"il.amount");
	$ingredient_amount_offset = mysql_result($result,$i,"il.amount_offset");
	$ingredient_amount_display = $ingredient_amount;
	if ( $ingredient_amount_offset > 0 ) {
		$ingredient_amount_display .= "-" . ($ingredient_amount_offset+$ingredient_amount);
	}

	$ingredient_list_id = mysql_result($result,$i,"il.id");
	$ingredient_unit_id = mysql_result($result,$i,"u.id");
	$ingredient_units = mysql_result($result,$i,"u.name");
	$ingredient_name = unescape_and_decode( $ingredient_name );
	$ingredient_units = unescape_and_decode( $ingredient_units );

	$command = "SELECT pl.prep_method_id,p.name FROM prep_methods p, prep_method_list pl WHERE pl.ingredient_list_id=$ingredient_list_id AND p.id=pl.prep_method_id ORDER BY pl.order_index";
	$prep_method = "";
	$p_result = mysql_query($command);
	$p_number = mysql_num_rows($p_result); 
	$j = 0; 
	while ($j < $p_number) {
		if ( $j != 0 ) $prep_method .= ", ";
		$prep_method .= mysql_result($p_result,$j,"p.name");
		$j++;
	}
	if ( $prep_method != "" ) $prep_method = "; " . $prep_method;

	if ( $last_ing_group != $ingredient_group ) {
		if ( $last_ing_group != "" ) {
			echo "</ul>";
		}
		echo "<li>$ingredient_group:</li><ul>";
	}

	echo "<li>$ingredient_name $ingredient_amount_display $ingredient_units$prep_method</li>";

	$last_ing_group = $ingredient_group;

             $i++;
       endwhile;
endif; 
	
?>
</ol>
      </td>
      <td valign="top">
<h3><?php echo "$lng_cat_instr"; ?></h3>
      <?php //Write instructions
echo "$recipe_instructions";


?>
      </td>
    </tr>
  
<tr align="center">
  <td class="bcopy" width="100%" colspan="2" align="center">
<p><br /><br /><br /><br />  <?php echo " $print_copy  "; ?><br />
<?php
//$url = $_SERVER[''HTTP_REFERER''];
echo "$lng_pfrom<br />";
echo
"http://".$HTTP_SERVER_VARS['HTTP_HOST']."".dirname($HTTP_SERVER_VARS['PHP_SELF'])."/";
?>
</p>  </td>
</tr>


</td></tr>


<tr align="center">
<td colspan="2" class="footer">
<p><br /></p>

</td>
</tr>


<?php
require('inc/bottom_table.php');
?>

<?php
mysql_close($conn);
?>
</body>
</html>