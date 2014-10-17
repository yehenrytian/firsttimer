<?php
//session_start();
// testing Zend framework
$path = '/www/110mb.com/t/i/a/n/y/e/_/_/tianye/htdocs/include/'; set_include_path(get_include_path() .PATH_SEPARATOR. $path);

require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->setFallbackAutoloader(true);

// load the application configuration
$config = new Zend_Config_Ini('../zend/settings.ini', 'development');
Zend_Registry::set('config', $config);

// create the application logger
$logger = new Zend_Log(new Zend_Log_Writer_Stream($config->logging->file));
Zend_Registry::set('logger', $logger);


// connect to the database
$params = array('host'     => $config->database->hostname,
                'username' => $config->database->username,
                'password' => $config->database->password,
                'dbname'   => $config->database->database);

$db = Zend_Db::factory($config->database->type, $params);
Zend_Registry::set('ftdb', $db);

// setup application authentication
$auth = Zend_Auth::getInstance();
$auth->setStorage(new Zend_Auth_Storage_Session());

$adapter = new Zend_Auth_Adapter_DbTable($db, 'ft_users', 'username', 'password', 'md5(?)');


if (isset($_SESSION['user']))
   {
   header("Location: ../htmltemplates/useraccount2.php?msg=You have alredy logged in!");
   exit();	
   }

//$user_name = mysql_real_escape_string($_POST['username']);

if ($_POST['Submit'] == 'Login')
{
// try and login with user input id and password
$adapter->setIdentity($_POST['username']);
$adapter->setCredential($_POST['password']);
$result = $auth->authenticate($adapter);

if ($result->isValid())
	   {
       // A matching row was found - the user is authenticated. 
      // session_start(); 
	   // this sets variables in the session 
	   //$_SESSION['user']= $user_name;
	   
	   if (isset($_GET['ret']) && !empty($_GET['ret']))
		  {
		  header("Location: $_GET[ret]");
		  } 
	   else
		  {
		  header("Location: ../htmltemplates/useraccount2.php?msg=Welcome: $user_name");
		  }
       exit();
       } 
	
if (isset($_GET['ret']) && !empty($_GET['ret']))
   {
   header("Location: $_GET[ret]?msg=errorlogin");
   exit();
   } 	

header("Location: login3.php?msg=Error: Invalid username or password!");
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
				<h1>Start Now</h1>				
				<p align="center"><a href="../uploadvideos/upload2.php" title="Start uploading your videos">
                <img src="../images/start-now.gif" alt="StartNow" width="183" height="49"/></a></p> 						
		    </div>			
			
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
				<h1>We recommand the following browsers:</h1>
                <p>
                <a href="http://www.mozilla.com/en-US/" title="Get FireFox3.5">
                <img src="../images/fflogosmall.jpg" alt="firefox3.5" style="width:191px; height:30px;"/></a>
                <a href="http://www.google.com/chrome" title="Get Google Chrome">
                <img src="../images/logo_sm.jpg" alt="chrome" style="width:191px; height:30px;"/></a>
                <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx" title="Get IE8">
                <img src="../images/ie8_logo.gif" alt="ie8" style="width:191px; height:30px;"/></a>
                </p>

			    <div align="center">
			    <script type="text/javascript" src="../include/verifyform.js"></script>
                <div style="border: 1px solid #999999; background-color:#CCCCCC; width: 415px; -moz-border-radius: 20px">
                <form onSubmit="return(verify(this));" method="post" action="login2.php" enctype="multipart/form-data" name="login" id="login" style="margin:0; width:90%">
                <table border="0" align="center" cellpadding="0" cellspacing="3" style="background-color:#CCCCCC; margin:0">
                <tr> 
                <th colspan="3"><div align="center" class="style2" style="border-bottom: 1px solid #999999"><font size="4">Login Members</font></div></th>
                </tr>
                <tr> 
                <td style="border:0; margin:0">
                 <p align="center"><strong>User name:</strong><br /><img src="../images/icons/user_single.png" alt="user" style="width:24px; height:24px; border:0; padding:0px; background-color:#CCCCCC"/></p>
                </td>
                <td style="border:0; margin:0">
                 <p align="center"><input name="username" type="text" id="username" size="30"></p>
                </td>
                <td style="border:0; margin:0">
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
