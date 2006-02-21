
<div class="nav">
<u><strong>Menu:</strong></u> 
  <?php if ( basename($_SERVER["PHP_SELF"]) != "index.php" ){print '<a
href="index.php">';} else { print ''; } ?>
<?php echo "$lng_menu_catlist"; ?>
  <?php if ( basename($_SERVER["PHP_SELF"]) != "index.php" ){print '</a>';} else { print
''; } ?>

-
 
  <?php if ( basename($_SERVER["PHP_SELF"]) != "search.php" ){print '<a
href="search.php">';} else { print ''; } ?>
  <?php echo "$lng_menu_search"; ?>

  <?php if ( basename($_SERVER["PHP_SELF"]) != "search.php" ){print '</a>';} else { print
''; } ?>

</div>
