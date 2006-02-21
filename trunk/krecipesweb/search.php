<?php

require "config.php";
require "functions.php";
require('lang/'."$site_lang".'.php');
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
<h1><?php echo "$lng_rec_search"; ?></h1>

<? require('inc/menu.php'); ?>
<p>&nbsp;</p>
<FORM METHOD="GET" ACTION="search_results.php">

<?php echo "<INPUT type=\"submit\" value=\"$lng_submit\"></INPUT>"; ?>
&nbsp;
<?php echo "<INPUT type=\"reset\" value=\"$lng_reset\"></INPUT>"; ?>
<br><br>

<?php echo "$lng_title"; ?>: <INPUT name="title" type="text" size="50"></INPUT>

<?php echo "$lng_yields "; ?>
<SELECT NAME="yields_option">
<OPTION VALUE="=" SELECTED><?php echo "$lng_exactly"; ?></OPTION>
<OPTION VALUE=">="><?php echo "$lng_atleast"; ?></OPTION>
<OPTION VALUE="<="><?php echo "$lng_atmost"; ?></OPTION>
</SELECT>:
<INPUT name="yields" size="3"></INPUT><br /><br />

<?php echo "$lng_anycat"; ?>: <INPUT name="cat_or_list" type="text" size="50"></INPUT><br
/><br />

<?php echo "$lng_intext"; ?>:<br>
<TEXTAREA name="instructions" cols="75" rows="5"></TEXTAREA><br>
<?php echo "<INPUT type=\"submit\" value=\"$lng_submit\"></INPUT>"; ?>
&nbsp;
<?php echo "<INPUT type=\"reset\" value=\"$lng_reset\"></INPUT>"; ?>

</FORM>
<br><br>
</td></tr>
<? //Include footer
require ('footer.php');
?>