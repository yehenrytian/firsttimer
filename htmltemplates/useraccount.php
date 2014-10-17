<?php
session_start();
if (!isset($_SESSION['user']))
{
//header("Location: ../login&register/login.php?msg=Error: Please login first!");
//exit();	
}

require_once ('../include/dbc.php'); 
require_once ('../include/common.inc.php');

$user = "";
if (isset($_SESSION['user']))
   {
   $user = $_SESSION['user'];
   }

$accountname = "";
if (isset($_GET['accountname']))
   {
   $accountname = $_GET['accountname'];
   }
else
   $accountname = $user;   


$email = "";
$aboutme = "";
$sex = "";
$dob = "";
$showdob = "";
$country = "";
$icon_id = 0;
$join_date = "";
$totalvideos = 0;
$totalcomments = 0;

?>	
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
if (isset($_SESSION['user']) && $_SESSION['user'] == $accountname)
{
?>
<title>FirstTimer - Welcome to your account: <?php echo $accountname; ?></title>
<?php
}
else
{
?>
<title>FirstTimer - User Profile: <?php echo $accountname; ?></title>
<?php
}
?>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="First Time, about, profile, history, introduction, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="User profile of firsttimer.ca!" name="Description" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<link href="../firsttimer-ico.png" rel="shortcut icon" />
<link href="../ftstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
   color: #0066FF;
   font-weight: bold;
   font-size:14px;
}
-->
</style>
</head>

<body>
<div align="center" id="page">
<script type="text/javascript">
document.write("<iframe src=\"./ftheader.php\" name=\"ftheader\" scrolling=\"no\" frameborder=\"no\" align=\"center\" height = \"200px\" width = \"970px\" ></iframe>")
</script>

<?php if (isset($_GET['msg'])) { echo "<h2 style=\"color: red\" align=\"center\"> $_GET[msg] </h2>"; }
// populate user info method
populateuserinfo($accountname);	
?>
<br /><br />
<div align="center" style="width: auto; height: 905px; background-color: #999999; border: 1px solid #CCCCCC; -moz-border-radius: 20px">
<p></p>
<table cellspacing="3" cellpadding="0" border="0" style="background-image:url(../images/css-images/table_background.gif); background-repeat:repeat-x; background-color:#CCCCCC" width="auto">
<tbody>
<tr>
<td valign="top">

<table cellspacing="3" cellpadding="0" border="0" style="background-image:url(../images/css-images/table_background.gif); background-repeat:repeat-x; background-color:#CCCCCC" width="auto">
<tbody>
<tr>
<th colspan="2"><span class="style1">User profile: <?php echo $accountname; ?></span></th>
</tr>
<tr>
<td><div id="selImg" align="left" class="img<?php echo $icon_id; ?>"><span class="style1">Icon</span></div></td>
<td style="font-size: 14px; font-weight: bold; color: #333333;">User name:<br /> <?php echo $accountname; ?></td>
</tr>
<tr><td>&nbsp;&nbsp;</td></tr>

<?php
if (isset($_SESSION['user']))
{
?>
<tr>
<td><span style="font-size: 12px; font-weight: bold; color: #333333;">Email:</span></td>
<td valign="top" style="font-size: 12px; font-weight: bold; color: #333333;"><a id="ftlink" href="mailto:<?php echo $email; ?>" title="Send an email to this user"><?php echo $email; ?></a></td>
</tr>
<?php
}
?>

<tr>
<td><span style="font-size: 12px; font-weight: bold; color: #333333;">Gender:</span></td>
<td valign="top" style="font-size: 12px; font-weight: bold; color: #333333;"><?php echo $sex; ?></td>
</tr>

<?php 
if ($showdob == '1') 
{
?>
<tr>
<td><span style="font-size: 12px; font-weight: bold; color: #333333;">Date of birth:</span></td>
<td valign="top" style="font-size: 12px; font-weight: bold; color: #333333;"><?php echo $dob; ?></td>
</tr>
<?php } ?> 
<tr>
<td><span style="font-size: 12px; font-weight: bold; color: #333333;">Country:</span></td>
<td valign="top" style="font-size: 12px; font-weight: bold; color: #333333;"><?php echo $country; ?></td>
</tr>
<tr>
<td><span style="font-size: 12px; font-weight: bold; color: #333333;">About me:</span></td>
<td valign="top" style="font-size: 12px; font-weight: bold; color: #333333;"><?php echo $aboutme; ?></td>
</tr>
<tr>
<td><span style="font-size: 12px; font-weight: bold; color: #333333;">Join date:</span></td>
<td valign="top" style="font-size: 12px; font-weight: bold; color: #333333;"><?php echo $join_date; ?></td>
</tr>
<tr>
<td><span style="font-size: 12px; font-weight: bold; color: #333333;">Total uploaded videos:</span></td>
<td valign="top" style="font-size: 12px; font-weight: bold; color: #333333;"><?php echo $totalvideos; ?></td>
</tr>
<tr>
<td><span style="font-size: 12px; font-weight: bold; color: #333333;">Total posted comments:</span></td>
<td valign="top" style="font-size: 12px; font-weight: bold; color: #333333;"><?php echo $totalcomments; ?></td>
</tr>
<tr><td>&nbsp;&nbsp;</td></tr>

<?php
if (isset($_SESSION['user']) && $_SESSION['user'] == $accountname)
{
?>
<tr>
<td colspan="2">
<span style="font-size: 12px; font-weight: bold; color: #0066FF;">Personal Management:</span></td>
</tr>
<tr>
<td colspan="2">
<div style="border: 1px solid #0066FF; width: 300px; -moz-border-radius: 20px">
<table align="center" cellspacing="3" cellpadding="0" border="0" style="background-image:url(../images/css-images/table_background.gif); background-repeat:repeat-x; background-color:#CCCCCC" width="auto">
<tbody>
<tr>
<td>
  <div align="center"><a href="./usersettings.php" title="Go to set your profile"><img src="../images/icons/User.png" alt="user" width="80" height="80" border="0" /></a></div></td>
<td>
  <div align="center"><a href="./managevideos.php" title="Go to manage your uploaded videos"><img src="../images/icons/My Videos.png" alt="my videos" width="80" height="80" border="0" /></a></div></td>
<td>
  <div align="center"><a href="./managecomments.php" title="Go to manage your added video comments"><img src="../images/icons/My Documents.png" alt="my docs" width="80" height="80" border="0" /></a></div></td>
</tr>
<tr>
<td align="center" style="font-size: 10px; font-weight: bold; color: #0066FF;">user settings</td>
<td align="center" style="font-size: 10px; font-weight: bold; color: #0066FF;">my videos</td>
<td align="center" style="font-size: 10px; font-weight: bold; color: #0066FF;">my comments</td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
<?php
}
?>

<tr><td>&nbsp;&nbsp;</td></tr>

<tr>
<td colspan="2">
<div align="center">
<span style="color: #0066CC; font-size: 14px; font-weight:bold;">Advertisements:</span>
<br />
<script type="text/javascript"><!--
google_ad_client = "pub-6635598879568444";
/* 200x200firsttimer, created 1/17/09 */
google_ad_slot = "1941255369";
google_ad_width = 200;
google_ad_height = 200;
//-->
</script> 
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
</td>
</tr>
</tbody>
</table>
</td>

<td>
<table cellspacing="3" cellpadding="0" border="0" style="background-image:url(../images/css-images/table_background.gif); background-repeat:repeat-x; background-color:#CCCCCC" width="auto">
<tbody>
<tr>
<td>
<div style="width: 580px; height: 500px; background-color: #999999; border: 1px solid #CCCCCC; -moz-border-radius: 20px">
<h2 align="center" class="style1">User uploaded videos: <?php echo $accountname; ?></h2>
<div style="width: auto; height: 460px; overflow: auto">
<?php echo (populateuservideolist($accountname, 4)); ?>
</div>
</div>
</td>
</tr>
<tr>
<td align="center">
<div style="width: 580px; height: 360px; background-color: #999999; border: 1px solid #CCCCCC; -moz-border-radius: 20px">
<h2 align="center" class="style1">User added comments: <?php echo $accountname; ?></h2>
<div align="center" style="width: auto; height: 320px; overflow: auto">
<?php echo (populateusercommentlist($accountname)); ?>
</div>
</div>
</td>
</tr>

</tbody>
</table>
</td>

</tr>
</tbody>
</table>
</div>

<br></br>
<div align="center">
<script type="text/javascript">
google_ad_client = "pub-6635598879568444";
/* 728x90footer, created 1/15/09 */
google_ad_slot = "7642261806";
google_ad_width = 728;
google_ad_height = 90;
</script> 
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>

<script type="text/javascript">
document.write("<iframe src=\"../htmltemplates/ftfooter.html\" name=\"ftfooter\" scrolling=\"no\" frameborder=\"no\" height = \"auto\" width = \"100%\" ></iframe>")
</script>

</div>
</body>
</html>
