

<head>
  <title>Krecipes Web Frontend setup</title>
  <meta name="GENERATOR" content="Quanta Plus" />
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="inc/main.css" />
</head>
<?php
if(is_file("config.php")) die('<p align=center class=errorbox>The config.php file already exists.<br />
If you want to run the setup again, you need to delete or move the config.php file.</p>');
?>
<body>
<div align="center">
<h1>Krecipes Web Frontend setup</h1>
<?php
if (!isset($_GET["setupstep"])) $setupstep=""; else $setupstep = $_GET["setupstep"];

switch ($setupstep) {
//checking for requirements
case 'check';
echo '<h3>Step 2/4</h3>';
$dbhostname = $_POST["dbhostname"];
$dbusername = $_POST["dbusername"];
$dbpassword = $_POST["dbpassword"];
$dbname = $_POST["dbname"];
//Writing debuginfo
//echo "DEBUGINFO: host: $dbhostname, user: $dbusername, pass: $dbpassword, db: $dbname";
$link = mysql_connect($dbhostname, $dbusername, $dbpassword)
   or die('Could not connect to the database server. Hit back in your browser and check your settings.');
$sqlconn = 'Ok';
mysql_select_db($dbname) or die('Connection to the server is ok, but I could not select the database.<br> Hit back in your browser and check your settings.');
$query = "SELECT ver,generated_by FROM db_info";
$result = mysql_query( $query );
$row = mysql_fetch_array($result, MYSQL_NUM);
$ver = $row[0];
$generated_by = $row[1];
//Writing result of syschk
echo '<br><br><h1>Result of system check:</h1>';
echo '<table class=bbox_border width=400 cellspacing=2 cellpadding=2>';
echo '<tr><td width=300></td><td width=100></td></tr>';

echo '<tr><td>MySQL connection</td>';
if($sqlconn == 'Ok') {
echo '<td align=center class=okbox>OK</td>';
} else {
echo '<td align=center class=errorbox>NOT OK</td>';
}
echo '</tr>';

echo '<tr><td>Found Krecipes database</td>';
if($ver != "") {
echo '<td align=center class=okbox>OK</td>';
} else {
echo '<td align=center class=errorbox>NOT OK</td>';
}
echo '</tr>';

echo '<tr><td>Krecipes database version >=0.9</td>';
if($ver >= 0.9) {
echo '<td align=center class=okbox>OK</td>';
} else {
echo '<td align=center class=errorbox>NOT OK</td>';
}
echo '</tr>';

echo '<tr><td>Install folder writable</td>';
if(is_writable('.')) {
echo '<td align=center class=okbox>OK</td>';
} else {
echo '<td align=center class=errorbox>NOT OK</td>';
}
echo '</tr>';

echo '<tr>';
if(($dbpassword != "") and ($dbusername = "root") ) {
echo '<td colspan=2>';
} else {
echo '<td class=errorbox colspan=2><b>WARNING:</b><br />It is NOT recommended to run a database on the WWW with a root account with no password. You should change this at once!<br /><b>If you decide to continue you do so at your own risk!</b>';
}
echo '</td></tr>';
$dbusername = $_POST["dbusername"];

echo '</table><br />';

echo '<FORM action="setup.php?setupstep=addinfo" method="POST">
<INPUT type="hidden" name="dbhostname" value="'."$dbhostname".'">
<INPUT type="hidden" name="dbusername" value="'."$dbusername".'">
<INPUT type="hidden" name="dbpassword" value="'."$dbpassword".'">
<INPUT type="hidden" name="dbname" value="'."$dbname".'">
<INPUT type="submit" name="submit" value="Continue ->">
</FORM>';




break;
//end check for requirements

case 'addinfo';
$dbhostname = $_POST["dbhostname"];
$dbusername = $_POST["dbusername"];
$dbpassword = $_POST["dbpassword"];
$dbname = $_POST["dbname"];
echo '<h1>Final setup</h1>';
echo '<h3>Step 3/4</h3>'; ?><br />
<p><h3>Database settings</h3>
A summary of the data you gave in step one.<br />
In order to change these you need to go back to setp one.<br /><br />
<table width="300" class="bbox_border">
  <tbody>

    <tr>
      <td width="200">Hostname</td>
      <td width="100"><INPUT type="text" value="<?php echo $dbhostname ; ?>" size="25" disabled="true"></td>
    </tr>
    <tr>
      <td>Username</td>
      <td><INPUT type="text" value="<?php echo $dbusername ; ?>" size="25" disabled="true"></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><INPUT type="password" value="<?php echo $dbpassword ; ?>" size="25" disabled="true"></td>
    </tr>
    <tr>
      <td>Database name</td>
      <td><INPUT type="text" value="<?php echo $dbname ; ?>" size="25" disabled="true"></td>
    </tr>
  </tbody>
</table>

<FORM action="setup.php?setupstep=final" method="POST">
<INPUT type="hidden" name="dbhostname" value="<?php echo $dbhostname ;?>">
<INPUT type="hidden" name="dbusername" value="<?php echo $dbusername ;?>">
<INPUT type="hidden" name="dbpassword" value="<?php echo $dbpassword ;?>">
<INPUT type="hidden" name="dbname" value="<?php echo $dbname ;?>"></p>
<p>
<br />
<h3>Language settings</h3>
Select the language you want this frontend to use.<br /><br />
<?php 
         if ($dir = @opendir("lang"))
           {
               while (($file = readdir($dir)) !== false)
               {
                   if($file != ".." && $file != ".")
                   {
                       $filelist[] = $file;
                   }
               }
               closedir($dir);
           }
?>
           <select name="language" >
           <?php
           asort($filelist);
           while (list ($key, $val) = each ($filelist))
           {
               echo '<option value='."$val".'>'."$val".'</option>';
           }
           ?>
            </select>
</p>

<p>
<br />
<h3>Additional settings</h3>
Site and path variables.<br /><br />

<table width="400" class="bbox_border">
  <tbody>
    <tr>
      <td>Administrators email address:</td>
      <td><INPUT type="text" name="adminmail" size="30"></td>
    </tr>
<tr><TD colspan="2" bgcolor="Black" height="1" width="100%"></TD></tr>
    <tr>
      <td>The site title:</td>
      <td><INPUT type="text" name="sitetitle" size="30"></td>
    </tr>
<tr><TD colspan="2" bgcolor="Black" height="1" width="100%"></TD></tr>

    <tr>
      <td>Copyright notice shown at the bottom of the page:</td>
      <td><INPUT type="text" name="copynote" size="30" value="&#169; 2006 - yoursite.net"></td>
    </tr>
<tr><TD colspan="2" bgcolor="Black" height="1" width="100%"></TD></tr>

    <tr>
      <td colspan="2">Full url to script location:</td>
    </tr>
    <tr>
      <td colspan="2">
<?php
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$scriptloc = 'http://'."$host".''."$uri".'/'
?>
<INPUT type="text" name="scriptloc" value="<?php echo $scriptloc; ?>" size="50">
</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>

</p>
<INPUT type="submit" name="submit" value="Finalize and write config file =>">

</FORM>

<?php
break;

case 'final';
$dbhostname = $_POST["dbhostname"];
$dbusername = $_POST["dbusername"];
$dbpassword = $_POST["dbpassword"];
$dbname = $_POST["dbname"];
$language = $_POST["language"];
$adminmail = $_POST["adminmail"];
$sitetitle = $_POST["sitetitle"];
$copynote = $_POST["copynote"];
$scriptloc = $_POST["scriptloc"];

//echo "DEBUGINFO:<br>";
//echo "host: $dbhostname<br>user: $dbusername<br>pass: $dbpassword<br>db: $dbname<br>lang: $language<br>amail: $adminmail<br>title: $sitetitle<br>copy: $copynote<br>loc: $scriptloc";

if(empty($adminmail) || empty($sitetitle) || empty($copynote) || empty($scriptloc)) {
	echo '
<table>
  <tbody>
    <tr>
      <td class=errorbox>
<b>ERROR:</b><p>
You need to fill in all fields on the previous page.<br />
Hit the back button in your browser and fill in all fields <br /><br />
</p>
</td>
    </tr>
  </tbody>
</table>';
}
else
{

$filename = "config.php";
$content="<?php\n\n";
$content.="//Krecipes Web Frontend configuration file";
$content.="\n\n//Database host:\n";
$content.='$dbhost = "';
$content.=$dbhostname;
$content.='"';
$content.=";\n//Database username:\n";
$content.='$dbuser = "';
$content.=$dbusername;
$content.='"';
$content.=";\n//Database password:\n";
$content.='$dbpass = "';
$content.=$dbpassword;
$content.='"';
$content.=";\n//Database name:\n";
$content.='$dbname = "';
$content.=$dbname;
$content.='"';
$content.=";\n\n\n";
$content.='$site_title = "';
$content.=$sitetitle;
$content.='"';
$content.=";\n";
$content.='$site_lang = "';
$content.=$language;
$content.='"';
$content.=";\n";
$content.='$url = "';
$content.=$scriptloc;
$content.='"';
$content.=";\n";
$content.='$admin_mail = "';
$content.=$adminmail;
$content.='"';
$content.=";\n";
$content.='$print_copy = "';
$content.=$copynote;
$content.='"';
$content.=";\n\n";
$content.="include 'settings.php'";
$content.=";\n\n\n";
$content.="?>";

//Write to file
$fp = fopen ("config.php", "a");
fputs ($fp,$content);
fclose ($fp);

echo "
<table class='okbox'>
  <thead>
    <tr align='center'>
<h2>Setup finished
</h2>    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
The setup of Krecipes Web Frontend finished successfully!<br />
You should delete, rename or move the setup.php file from the base directory.<br /><br />
Please dorp us a line or two at http://krecipesweb.berlios.de if you have any<br />
problems or suggestions<p align='center'>
<a href='index.php'>Click here to go to the mainpage.</a></p><br />
Enjoy cooking!<br />
The Krecipes Web Frontend Team

</td>
    </tr>
  </tbody>
</table>

";


}
break;
default;
if(is_writable('.')) {
echo "
<h3>Step 1/4</h3>

<h3>Database settings:</h3>
<p>Here you need to enter the information this frontend need<br>
to connect to the database where the Krecipes database is located.</p>
<FORM method=\"POST\" name=\"dbform\" action=\"setup.php?setupstep=check\">

<table cellspacing=\"3\" cellpadding=\"3\">
  <tbody>
    <tr>
      <td>Server hostname</td>
      <td><INPUT type=\"text\" name=\"dbhostname\" size=\"25\"></td>
    </tr>
    <tr>
      <td>Username</td>
      <td><INPUT type=\"text\" name=\"dbusername\" size=\"25\"></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><INPUT type=\"text\" name=\"dbpassword\" size=\"25\"></td>
    </tr>
    <tr>
      <td>Database name</td>
      <td><INPUT type=\"text\" name=\"dbname\" value=\"Krecipes\" size=\"25\"></td>
    </tr>
  </tbody>
</table>
<INPUT type=\"submit\" name=\"submit\" value=\"Submit\">&nbsp;<INPUT type=\"reset\" name=\"reset\" value=\"Reset\">


</FORM>
";
} else {
   echo "
<table class=\"errorbox\">
    <tr>
      <td>
<h4>Error:  Folder not writable</h4>
You need to make this folder writable for this script (chmod 777),<br />
in order to create the configuration file.<br /><br />
Hit the reload button when it's done.
</td>
    </tr>
</table>
";
}

//end switch
}
?>

</div>
</body>
</html>
