<p>&nbsp;</p>
<?php

if ($e == 1)
 switch ($serror)
{
case "1":
 echo "<p class='errorbox' align='middle'><b>$lng_error:</b><br />
$lng_error_friend_name</p>";
break;

case "2":
 echo "<p class='errorbox' align='middle'><b>$lng_error:</b><br />
$lng_error_friend_smail</p>";
break;

case "3":
 echo "<p class='errorbox' align='middle'><b>$lng_error:</b><br />
$lng_error_friend_fmail</p>";
break;

default:
break;
}
?>
<?php
if ($sendrec == "ok")
	echo "<p class='okbox' align='middle'><b>$lng_ok:</b><br
/>$lng_send_friend_ok</p>";

?>
<table width="100%" class="bbox_border">
<tbody>
    <tr>
      <td width="50%" class="bbox1" align="middle">
<DIV class="bbox_head"><?php echo $lng_sendfriend;
?></DIV>
<FORM action="send_friend.php" method="POST" name='friendform' onSubmit="return validate()">
<INPUT type="hidden" name="send_id" value="<?php echo $recipe_id; ?>">
<INPUT type="text" name='sendername' size="20" value="<?php echo $lng_yourn ?>" onFocus="if (this.value=='<?php echo $lng_yourn ?>') this.value='';" onBlur="if (this.value=='') this.value='<?php echo $lng_yourn ?>';">&nbsp;&nbsp;
<INPUT type="text" name="sendermail" size="20" value="<?php echo $lng_yourm ?>" onFocus="if (this.value=='<?php echo $lng_yourm ?>') this.value='';" onBlur="if (this.value=='') this.value='<?php echo $lng_yourm ?>';"><br />
<INPUT type="text" name="friendname" size="20" value="<?php echo $lng_yourfn ?>" onFocus="if (this.value=='<?php echo $lng_yourfn ?>') this.value='';" onBlur="if (this.value=='') this.value='<?php echo $lng_yourfn ?>';">&nbsp;&nbsp;
<INPUT type="text" name="friendmail" size="20" value="<?php echo $lng_yourfm ?>" onFocus="if (this.value=='<?php echo $lng_yourfm ?>') this.value='';" onBlur="if (this.value=='') this.value='<?php echo $lng_yourfm ?>';"><br />
<INPUT type="submit" name="submit" value="  <?php echo  $lng_submit   ?>  ">
<INPUT type="reset" name="reset" value="  <?php echo   $lng_reset  ?>  ">
</FORM>
</td>
      <td width="50%" class="bbox2" align="left" valign="top">
<DIV class="bbox_head"><?php echo   $lng_pfunctions  ?></DIV>

<?php echo "
  <a href=\"print_recipe.php?id=$recipe_id\" class=\"printrecipe\">
  <img src=\"img/print.gif\" width=\"15\" height=\"14\" align=\"bottom\" border=\"0\" />
  $lng_print</a>";
?><br>
<A href="search.php"><IMG src="img/search.png" alt="Search" width="16" height="16" align="bottom" border="0">
<?php echo   $lng_rec_search  ?></A>
</td>
    </tr>
  </tbody>
</table>

  
