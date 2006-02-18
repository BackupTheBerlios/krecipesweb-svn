<?php

// Read title, yield, instructions and prep_time
$query = "SELECT instructions,yield_amount,yield_amount_offset,yield_type_id,title,prep_time FROM recipes WHERE
id=$recipe_id"; 
$result = mysql_query($query);
$row = mysql_fetch_array($result, MYSQL_NUM);
$recipe_instructions = str_replace("\n","<br />",unescape_and_decode( $row[0] ));
$recipe_yield_amount = unescape_and_decode( $row[1] );
$recipe_yield_amount_offset = unescape_and_decode( $row[2] );
$recipe_yield_type_id = unescape_and_decode( $row[3] );
$recipe_title = unescape_and_decode( $row[4] );
$recipe_preptime = unescape_and_decode( $row[5] );
mysql_free_result($result);

//Simple check to see if recipe exists
if ( $row==0 ) die("$no_exist_recipe");

// Read yield type
$query = "SELECT name FROM yield_types WHERE id=$recipe_yield_type_id";
$result = mysql_query($query);
$row = mysql_fetch_array($result, MYSQL_NUM);
$recipe_yield_type = $row[0];
$recipe_yield = $recipe_yield_amount;
if ( $recipe_yield_amount_offset > 0 ) {
	$recipe_yield .= "-" . ($recipe_yield_amount_offset+$recipe_yield_amount);
}
$recipe_yield .= " $recipe_yield_type";

mysql_free_result($result);


// Read authors
$command = "SELECT al.author_id,a.name FROM author_list al, authors a WHERE recipe_id=$recipe_id AND al.author_id=a.id";
$result = mysql_query($command);
$number = mysql_num_rows($result); 
$i = 0; 
if ($number == 0) :
   $authors = "$no_author";
elseif ($number > 0) :
while ($i < $number):
        if ( $i != 0 ){ $authors .= ", "; }
        $authors .= mysql_result($result,$i,"a.name");
        $i++;
       endwhile;
endif; 


// Read categories
$command = "SELECT cl.category_id,c.name FROM category_list cl, categories c WHERE recipe_id=$recipe_id AND cl.category_id=c.id";
$result = mysql_query($command);
$number = mysql_num_rows($result); 
$i = 0; 
if ($number == 0) :
   $categories = "$no_cat";
elseif ($number > 0) :
while ($i < $number):
        if ( $i != 0 ){ $categories .= ", "; }
        $categories .= mysql_result($result,$i,"c.name");
        $i++;
       endwhile;
endif; 

// Read added time
//$command = "SELECT ctime,mtime FROM recipes WHERE id=$recipe_id";
//$result = mysql_query($command);
//$ctime = mysql_result($result,"ctime");
//$mtime = mysql_result($result,"mtime");
//$ctime = unescape_and_decode( $ctime );
//$mtime = unescape_and_decode( $mtime );
?>
