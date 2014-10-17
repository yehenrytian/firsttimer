<?php
session_start();
require_once ('../include/dbc.php');
require_once '../include/common.funcs.php';

if (isset($_SESSION['user']))
   {
   header("Location: ../htmltemplates/useraccount2.php?msg=You have alredy logged in!");
   exit();	
   }

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
		} 
	   else
		{
		header("Location: ../htmltemplates/useraccount2.php?msg=Welcome: $user_name");
		}
		//echo "Logged in...";
		exit();
    } 
	
if (isset($_GET['ret']) && !empty($_GET['ret']))
   {
   header("Location: $_GET[ret]?msg=errorlogin");
   exit();
   } 	

header("Location: login2.php?msg=Error: Invalid username or password!");
//echo "Error:";
exit();
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="First Time, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="login to firsttimer.ca" name="Description" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<title>FirstTimer - Login</title>
<meta name="Distribution" content="Global" />
<meta name="Author" content="Ye Henry Tian" />
<meta name="Robots" content="index,follow" />
<link rel="stylesheet" href="../images/ftstyle2.0.css" type="text/css" />
<link href="../firsttimer-ico.png" rel="shortcut icon" />
</head>

<body>
<!-- wrap starts here -->
<div id="wrap">
	<?php echo (emitpageheader()); ?>
				
<!-- content-wrap starts here -->
	<div id="content-wrap">
       <div id="content">
       	<div id="sidebar">            
            <div class="sidebox">						
			   <?php echo (emitsearchbox(true)); ?>
	        </div>
            
            <div class="sidebox">
				<?php echo(emitgooglefriend()) ?>
			</div>
            
            <div class="sidebox">			
				<?php echo (emitstartnow()); ?> 						
		    </div>			
			
            <?php echo(emitusericonlist()) ?>
            
			<div class="sidebox">			
				<h1>Advertisements</h1>
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
			
			<div class="sidebox">
			 <h1>Visitor Statistic</h1>
             <div align="center"> 
			  <a href="http://s03.flagcounter.com/more/3lNE">
             <img src="http://s03.flagcounter.com/count/3lNE/bg=FFFFFF/txt=0066FF/border=CCCCCC/columns=2/maxflags=20/viewers=0/labels=1/pageviews=1/" 
             alt="free counters" border="0"></a></div>
			</div>
					
		</div>
		<div id="main">			
				<a name="MessageInfo"></a>	
				<?php if (isset($_GET['msg'])) { echo "<h1 style=\"color: red\" align=\"center\"> $_GET[msg] </h1>"; } ?>
            
				<a name="SampleTags"></a>
				<?php echo emitrecbrowsers(); ?>

			    <div align="center">
			    <script type="text/javascript" src="../include/verifyform.js"></script>
                <div style="border: 1px solid #999999; background-color:#CCCCCC; width: 425px; -moz-border-radius: 20px">
                <form onSubmit="return(verify(this));" method="post" action="login2.php" enctype="multipart/form-data" name="login" id="login" style="margin:0; width:90%">
                <table border="0" align="center" cellpadding="0" cellspacing="3" style="background-color:#CCCCCC; margin:0">
                <tr> 
                <th colspan="3"><div align="center" class="style2" style="border-bottom: 1px solid #999999"><font size="4">Login Members</font></div></th>
                </tr>
                <tr> 
                <td style="border:0; margin:0; width:100px">
                 <p align="center"><strong>User name:</strong><br /><img src="../images/icons/user_single.png" alt="user" style="width:24px; height:24px; border:0; padding:0px; background-color:#CCCCCC"/></p>
                </td>
                <td style="border:0; margin:0">
                 <p align="center"><input name="username" type="text" id="username" size="30"></p>
                </td>
                <td style="border:0; margin:0; width:125px">
                  (case sensitive)
                </td>
                </tr>
                <tr>
                <td style="border:0; margin:0">
                 <p align="center"><strong> Password:  </strong><br /><img src="../images/icons/lock.png" alt="lock" style="width:24px; height:24px; border:0; padding:0px; background-color:#CCCCCC"/></p>
                </td>
                <td style="border:0; margin:0">
                 <p align="center"><input name="password" type="password" id="password" size="30"></p>
                </td>
                <td style="border:0; margin:0"></td>
                </tr>
                <tr>
                 <td colspan="3">
                 <div align="center" class="style2" style="border-top: 1px solid #999999">
                 <p align="center"> 
                  <input class="button" type="submit" name="Submit" value="Login">  <input class="button" type="reset" />
                 </p>
                 <p align="center"><a id="ftlink" href="register2.php" title="Go to register">Register</a> | <a id="ftlink" href="mailto:firsttimer.ca@gmail.com" title="Send us an email to retrieve your password"><span class="style2">Forgot</span></a></p>
                 </div>
                 </td>
                </tr>
                </table>
                </form>
                </div>
                </div>
			    
                <h3>Google Ads</h3>       
		        <div align="center">
                <script type="text/javascript">
                google_ad_client = "pub-6635598879568444";
                /* 728x90footer, created 1/15/09 */
                google_ad_slot = "7642261806";
                google_ad_width = 728;
                google_ad_height = 90;
                </script>
                <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
                </div>		
			<br />										
		</div>					
		
	<!-- content-wrap ends here -->		
	</div></div>

   <?php echo (emitpagefooter()); ?>
	
<!-- wrap ends here -->
</div>

</body>
</html>
