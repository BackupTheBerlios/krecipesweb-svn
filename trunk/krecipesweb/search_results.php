<html>
<?php

require "config.php";
require "functions.php";
require('lang/'."$site_lang".'/index.php');

function quotesplit($s, $splitter=' ')
{
//First step is to split it up into the bits that are surrounded by quotes and the bits that aren't. Adding the delimiter to the ends simplifies the logic further down

   $getstrings = split('\"', $splitter.$s.$splitter);

//$instring toggles so we know if we are in a quoted string or not
   $delimlen = strlen($splitter);
   $instring = 0;

   while (list($arg, $val) = each($getstrings))
   {
       if ($instring==1)
       {
//Add the whole string, untouched to the result array.
           $result[] = $val;
           $instring = 0;
       }
       else
       {
//Break up the string according to the delimiter character
//Each string has extraneous delimiters around it (inc the ones we added above), so they need to be stripped off
           $temparray = split($splitter, substr($val, $delimlen, strlen($val)-$delimlen-$delimlen ) );

           while(list($iarg, $ival) = each($temparray))
           {
               $result[] = trim($ival);
           }
           $instring = 1;
       }
   }

/* 
$search = array("%","_","*","?");
$replace = array("\\%","\\_","%","_");
foreach ($result as &$value) {
	$value = str_replace($search,$replace,$value);
}
*/

   return $result;
}

if ( $_GET )
{
	$command = "SELECT DISTINCT recipes.id,recipes.title FROM recipes @category_lists@ WHERE ";

	//==============title================//
	$query_title = $_GET["title"];
	$command .= "recipes.title LIKE \"%$query_title%\" ";

	//==============title================//
	$query_instructions = $_GET["instructions"];
	$command .= "AND recipes.instructions LIKE \"%$query_instructions%\" ";

	//=============yields============//
	$yields_comparison = $_GET["yields_option"];
	$query_yields = $_GET["yields"];
	if ( $query_yields != "" )
		$command .= "AND (recipes.yield_amount $yields_comparison $query_yields) ";

	//=============categories============//
	$cat_or_list = quotesplit(stripslashes($_GET["cat_or_list"]));
	$category_lists = "";
	if ( count($cat_or_list) > 0 && $_GET["cat_or_list"] != "" ) {
		$category_lists .= ",category_list AS cl, categories c";

		$first = false;
		$command .= "AND (";
		while (list ($key,$val) = each($cat_or_list))
		{
			if ( $val == "" ) continue;

			if ( $first == true ) { $command .= "OR ";}
			$command .= "c.name LIKE '%$val%' ";
			$first = true;
		}

		$command .= ") ";
		$command .= "AND cl.category_id=c.id AND cl.recipe_id=recipes.id ";
	}
	$command = str_replace( "@category_lists@", $category_lists, $command );
/*
	$categoriesOr = split(" ",$_GET["categories_or_list"];
	if ( catsOr.count() != 0 ) {
		tableList << "category_list cl" << "categories c";
		conditionList << "cl.category_id=c.id" << "cl.recipe_id=r.id";

		QString condition = "(";
		for ( QStringList::const_iterator it = catsOr.begin(); it != catsOr.end();) {
			condition += "c.name LIKE '%"+escapeAndEncode(*it)+"%' ";
			if ( ++it != catsOr.end() ) {
				condition += "OR ";
			}
		}
		condition += ")";

		conditionList << condition;
	}
*/

	//run query
	//echo "(DEBUG) Running query: $command<br><br>";
	$result = mysql_query($command) or die(mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_NUM))
	{
		$result_recipes["id"][count($result_recipes["id"])] = $row[0];
		$result_recipes["title"][count($result_recipes["title"])] = $row[1];
	}
}
?>

<head>
  <title><?php echo "$site_title - $lng_sres"; ?></title>
<?php
require('inc/metatags.php');
?>
</head>
<body>
<?php
require('inc/top_table.php');
?>
<h1><?php echo "$lng_rsres"; ?></h1>

<?php
require ('inc/menu.php');
?>
<p>&nbsp;</p>
<?php
if ( $result_recipes )
	echo "<h2>$lng_res:</h2>";
else if ( $_GET )
	echo "<h2>$lng_nores</h2>";

echo "<ul>";
for ( $i = 0; $i < count( $result_recipes["id"] ); $i++ )
{
	$id = $result_recipes["id"][$i];
	$title = $result_recipes["title"][$i];
	echo "<li><a href=\"view_recipe?id=$id\">$title</a></li>";
}
echo "</ul>";
?>
<? //Include footer
require ('footer.php');
?>
