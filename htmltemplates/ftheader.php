<?php
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="First Time, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="upload your firsttime video!" name="Description" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<link href="http://www.firsttimer.ca/firsttimer-ico.png" rel="shortcut icon" />
<title>FirstTimer common page header</title>
<link rel="stylesheet" href="../ftstyle.css" type="text/css" />
<style type="text/css">
<!--
.style2 {
	color: #6AA2FD;
	font-weight: bold;
	font-size: 1em;
}
-->
</style>
</head>

<body>
<table cellspacing="0" cellpadding="0" border="0" align="center" width="917" style="border-bottom: 4px solid rgb(255, 255, 255);">
  <tbody>
    <tr>
      <td width="auto"><a href="http://www.firsttimer.ca" target="_parent" title="Go to FirstTimer.ca"><img src="../images/FirstTimerSmall.jpg" alt="FirstTimer" width="283" height="124" border="0" longdesc="Get things done yourself!" /></a></td>
      <td width="auto"><img src="../images/ytb.png" alt="Better than YouTube" width="100" height="100" border="0" longdesc="Better than YouTube!" /></td>
      <td width="auto">
<style type="text/css">
@import url(http://www.google.com/cse/api/branding.css);
</style>
<div class="cse-branding-right" style="background-color:#FFFFFF;color:#000000">
  <div class="cse-branding-form">
    <form action="http://www.google.ca/cse" id="cse-search-box" target="_blank">
      <div>
        <input type="hidden" name="cx" value="partner-pub-6635598879568444:b791s-8mgpo" />
        <input type="hidden" name="ie" value="UTF-8" />
        <input type="text" name="q" size="31" />
        <input type="submit" name="sa" value="Search" />
      </div>
    </form>
  </div>
  <div class="cse-branding-logo">
    <img src="http://www.google.com/images/poweredby_transparent/poweredby_FFFFFF.gif" alt="Google" />
  </div>
  <div class="cse-branding-text">
    Custom Search
  </div>
</div>
      
<?php
if (isset($_SESSION['user']))
{
?>
<script language="javascript" type="text/javascript">
if (parent.document.getElementById("submitvideo").attributes["disabled"].value == "disabled")
    parent.location.href=parent.location.href;
</script>
<script language="javascript" type="text/javascript">
if (parent.document.getElementById("postcomment").attributes["disabled"].value == "disabled")
   window.parent.document.getElementById("addcomment").contentWindow.location.reload();
</script>

<script language="javascript" type="text/javascript">
if (parent.document.title == "FirstTimer - Register" || parent.document.title == "FirstTimer - Login")
   parent.location.href="http://www.firsttimer.ca/htmltemplates/useraccount.php";
</script>

<div style="background-color:#FFFFFF; border: 1px solid #CCCCCC; width: 320px; height: 60px; -moz-border-radius: 18px">
<p></p>
<span class="style2">My Account</span><br />
Logged In as <img src="../images/icons/user_suit.png" alt="user" width="16" height="16" /><a id="ftlink" href="useraccount.php?accountname=<?php echo $_SESSION['user']; ?>" target="_parent" title="Go to your account"><?php echo $_SESSION['user']; ?></a> | <img src="../images/icons/vcard_edit.png" alt="useredit" width="16" height="16" /><a id="ftlink" href="usersettings.php" target="_parent" title="Go to edit your profile">Settings</a> | <img src="../images/icons/lock_go.png" alt="logout" width="16" height="16" /><a id="ftlink" href="../login&register/logout.php" target="_parent" title="Logout of FirstTimer">Logout</a>
</div>
<?php
} 
else
{
if (isset($_GET['msg']) && $_GET['msg'] == "errorlogin")
{
?>
<script language="javascript" type="text/javascript">
parent.location.href="http://www.firsttimer.ca/login&register/login.php?msg=Error: Invalid username or password!";
</script>
<?php
}
?>


<div align="left">
<script type="text/javascript" src="../include/verifyform.js"></script>
<div align="left" style="border: 1px solid #999999; background-color:#CCCCCC; width: 240px; height: 84px; -moz-border-radius: 20px">
<p></p>
<form onSubmit="return(verify(this));" id="login_form" name="login_form" action="../login&register/login.php?ret=../htmltemplates/ftheader.php" method="post">
<table cellspacing="1" cellpadding="0" border="0.5" align="left" width="auto" style="background-image:url(../images/css-images/table_background.gif);">
<tbody> 
<tr>
<td><img src="../images/icons/user_suit.png" alt="user" width="16" height="16" /></td>
<td><input size="20" name="username"></td>
</tr>
<tr>
<td><img src="../images/icons/key_add.png" alt="key" width="16" height="16" /></td>
<td><input size="20" name="password" type="password"></td>
<td><input name="Submit" value="Login" type="submit"></td>
</tr>
<tr>
<td></td>
<td><font style="font-size: 11px;"><a id="ftlink" href="../login&register/register.php" rel="nofollow" target="_parent" title="Go to register">Register</a> | <a id="ftlink" href="mailto:firsttimer.ca@gmail.com" title="Send us an email to retrieve your password"><span style="color:#0066FF;">Forgot</span></a></font>
</td>
</tr>
</tbody>
</table>
</form>
</div>
</div>
<?php 
}
?>

</div>
</td>
</tr>
</tbody>
</table>
<div id="menu">
  <ul>
    <li><a href="../" target="_parent" rel="nofollow" title="Go to Firsttimer.ca's homepage"><img src="../images/icons/Computer On.png" alt="Home" width="32" height="32" border="0" />Home</a></li>
    <li><a href="../uploadvideos/upload.php" target="_parent" rel="nofollow" title="Upload your FirstTimer videos"><img src="../images/icons/remove.png" alt="Upload Videos" width="32" height="32" border="0" />Upload Videos</a></li>
    <li><a href="../jwflvplayer/" target="_parent" rel="nofollow" title="See FirstTimer videos"><img src="../images/icons/movies.png" alt="FirstTime Videos" width="32" height="32" border="0" />FirstTime Videos</a></li>
    <li><a href="../bbs7/" target="_parent" rel="nofollow" title="Go to FirstTimer community"><img src="../images/icons/users.png" alt="BBS" width="32" height="32" border="0" />Forum BBS</a></li>
    <li><a href="../about/" target="_parent" rel="nofollow" title="About FirstTimer.ca"><img src="../images/icons/help.png" alt="About" width="32" height="32" border="0" />About</a></li>
  </ul>
</div>
</body>
</html>
