<?php 
session_start();
if (isset($_SESSION['user']))
   {
   header("Location: ../htmltemplates/useraccount.php?msg=You have alredy logged in!");
   exit();	
   }   

include ('../include/dbc.php'); 

$user_name = mysql_real_escape_string($_POST['username']);

if ($_POST['Submit'] == 'Login')
{
$md5pass = md5($_POST['password']);
$sql = "SELECT userid, username FROM ft_users WHERE 
            username = '$user_name' AND 
            password = '$md5pass'"; 
			
$result = mysql_query($sql) or die (mysql_error()); 
$num = mysql_num_rows($result);

    if ( $num != 0 ) { 

       // A matching row was found - the user is authenticated. 
       session_start(); 
	   list($user_id,$user_name) = mysql_fetch_row($result);
	   // this sets variables in the session 
	   $_SESSION['user']= $user_name;
	   
	   if (isset($_GET['ret']) && !empty($_GET['ret']))
		{
		header("Location: $_GET[ret]");
		//header("Location: ../htmltemplates/ftheader.php");
		} 
	   else
		{
		header("Location: ../htmltemplates/useraccount.php?msg=Welcome: $user_name");
		}
		//echo "Logged in...";
		exit();
    } 
	
if (isset($_GET['ret']) && !empty($_GET['ret']))
   {
   header("Location: $_GET[ret]?msg=errorlogin");
   exit();
   } 	

header("Location: login.php?msg=Error: Invalid username or password!");
//echo "Error:";
exit();		
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="First Time, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="login to firsttimer.ca" name="Description" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<link href="../firsttimer-ico.png" rel="shortcut icon" />
<title>FirstTimer - Login</title>
<link href="../ftstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style2 {
	color: #0066FF;
	font-weight: bold;
	font-size:12px;
}
-->
</style>
</head>
<!--<link href="styles.css" rel="stylesheet" type="text/css"> -->
<body>
<div id="page">
<script type="text/javascript">
document.write("<iframe src=\"../htmltemplates/ftheader.php\" name=\"ftheader\" scrolling=\"no\" frameborder=\"no\" align=\"center\" height = \"200px\" width = \"970px\" ></iframe>")
</script>

<div id="content2">
<?php if (isset($_GET['msg'])) { echo "<h2 style=\"color: red\" align=\"center\"> $_GET[msg] </h2>"; } ?>

<script type="text/javascript" src="../include/verifyform.js"></script>
<div align="center">
<div style="border: 1px solid #999999; background-color:#CCCCCC; width: 400px; -moz-border-radius: 20px">
<form onSubmit="return(verify(this));" method="post" action="login.php" enctype="multipart/form-data" name="login" id="login" style="padding:5px;" >
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="3" style="background-image:url(../images/css-images/table_background.gif); background-repeat:repeat-x; background-color:#CCCCCC">
<tbody>
  <tr> 
<th colspan="3"><div align="center" class="style2" style="border-bottom: 1px solid #999999"><font size="4">Login Members</font></div></th>
  </tr>
  <tr> 
    <td>
        <p align="center"><strong>User name:</strong><br /><img src="../images/icons/user_single.png" alt="user" width="24" height="24" border="0" /></p>
    </td>
     <td>
        <p align="center"><input name="username" type="text" id="username"></p>
     </td>
     <td>
     (case sensitive)
     </td>
   </tr>
   <tr>
      <td>
        <p align="center"><strong> Password:  </strong><br /><img src="../images/icons/lock.png" alt="lock" width="24" height="24" border="0" /></p>
      </td>
      <td>
        <p align="center"><input name="password" type="password" id="password"></p>
      </td>
    </tr>
    <tr>
       <td colspan="3">
       <div align="center" class="style2" style="border-top: 1px solid #999999">
        <p align="center"> 
          <input type="submit" name="Submit" value="Login">  <input type="reset" />
        </p>
        <p align="center"><a id="ftlink" href="register.php" title="Go to register">Register</a> | <a id="ftlink" href="mailto:firsttimer.ca@gmail.com" title="Send us an email to retrieve your password"><span class="style2">Forgot</span></a></p>
        </div>
      </td>
  </tr>
  </tbody>
</table><BR>
</form>
</div>
</div>
<br />
</div>

<div align="left" id="sidebar">
<h2>Advertisements:</h2>
<br />
<div align="center">
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
</div>

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

<div align="center">
<script type="text/javascript">
document.write("<iframe src=\"../htmltemplates/ftfooter.html\" name=\"ftfooter\" scrolling=\"no\" frameborder=\"no\" height = \"auto\" width = \"100%\" ></iframe>")
</script>
</div>
</div>
</body>
</html>
