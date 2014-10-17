<?php
session_start();

require_once ('../include/dbc.php'); 
require_once ('../include/common.funcs.php');

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

// populate user info method
populateuserinfo($accountname);	

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
<meta content="First Time, about, profile, history, introduction, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="User profile of firsttimer.ca!" name="Description" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<link href="../firsttimer-ico.png" rel="shortcut icon" />
<link rel="stylesheet" href="../images/ftstyle2.0.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Ye Henry Tian" />
<meta name="Robots" content="index,follow" />
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
				<h1>User Info</h1>				
				<div align="left" class="img<?php echo $icon_id; ?>">Icon</div>
                <p>User name: <a href="../htmltemplates/useraccount2.php?accountname=<?php echo $accountname; ?>" target="_parent" title="Go to user's account">
				<?php echo $accountname; ?></a><br />
                <?php if (isset($_SESSION['user'])) { echo ('Email: <a href="mailto:' . $email . '" title="Send an email to this user">' . $email . '</a>'); }?><br />
                Gender: <?php echo $sex; ?><br />
                <?php if ($showdob == '1') { echo ('Date of birth: ' . $dob); }?><br />
                Country: <?php echo $country; ?><br />
                About me: <?php echo $aboutme; ?><br />
                Join date: <?php echo $join_date; ?><br />
                Total uploaded videos: <?php echo $totalvideos; ?><br />
                Total posted comments: <?php echo $totalcomments; ?><br />
                </p> 				
			</div>
            
            <?php
            if (isset($_SESSION['user']) && $_SESSION['user'] == $accountname)
            {
            ?>
            <div class="sidebox" style="height:140px; overflow:auto; overflow-x: hidden;">			
				<h1>Personal Management</h1>
                <div align="center" style="width:60px; float:left; margin-left:10px"><a href="./usersettings2.php" title="Go to set your profile">
                <img src="../images/icons/User.png" alt="user" width="50" height="50"/></a>
                <br/><a href="./usersettings2.php" title="Go to set your profile">user settings</a></div>			
                <div align="center" style="width:60px; float:left; margin-left:10px"><a href="./managevideos2.php" title="Go to manage your uploaded videos">
                <img src="../images/icons/My Videos.png" alt="my videos" width="50" height="50"/></a>
                <br/><a href="./managevideos2.php" title="Go to manage your uploaded videos">my videos</a></div>
				<div align="center" style="width:60px; float:left; margin-left:10px"><a href="./managecomments2.php" title="Go to manage your added video comments">
                <img src="../images/icons/My Documents.png" alt="my comments" width="50" height="50"/></a>
                <br/><a href="./managecomments2.php" title="Go to manage your added video comments">my comments</a></div>
		    </div>
            
            <?php } ?>

           
           <div class="sidebox">
           <script type="text/javascript" src="../include/ajax.js"></script>
				<h1 class="clear">User Activity Menu</h1>
				<ul class="sidemenu">
                    <?php 
					$useruploadvideotitle = $accountname . ' uploaded video list:';
					$useraddcommenttitle = $accountname . ' added comments:';					
					echo '<li><a href="#" onclick="getAjaxList(\'populateuservideolist\', \'' . $accountname . ', 4\', \'userlist\'); getAjaxTitle(\'' . $useruploadvideotitle . '\', \'userlisttitle\')"><img src="../images/icon2.0/database-32.png" width="24" height="24" style="margin:0;padding:0"/>User Uploaded Videos</a></li>';
					echo '<li><a href="#" onclick="getAjaxList(\'populateusercommentlist\', \'' . $accountname . '\', \'userlist\'); getAjaxTitle(\'' . $useraddcommenttitle . '\', \'userlisttitle\')"><img src="../images/icon2.0/schedule-32.png" width="24" height="24" style="margin:0;padding:0"/>User Added Comments</a></li>'; 
					?>			
				</ul>				
			</div>	
            
            <div class="sidebox" style="height:300px; overflow:auto; overflow-x: hidden;">
				<?php echo(emitusericonlist()) ?>
			</div>

			<!--<div class="sidebox">			
				<h1 class="clear">Sidebar Menu</h1>
				<ul class="sidemenu">
					<li><a href="#UserVideos">User Videos</a></li>
					<li><a href="#UserComments">User Comments</a></li>					
				</ul>				
			</div>-->	
		</div>
        
        
        
        <div id="sidebarleft">            
            <div class="sidebox">
			  <?php echo (emituseraccountbox($_SESSION['user'])); ?>
			</div>
            
            <div class="sidebox">
              <?php echo (emitsearchbox(true)); ?>
	        </div>
            
            <div class="sidebox">			
				<?php echo (emitstartnow(163)); ?>			
		    </div>
            
            <div class="sidebox">			
				<?php echo(emitcategories()) ?>
			</div>
            
            <div class="sidebox">
				<h1>Recommanded browsers:</h1>
	            <div align="center">
                <a href="http://www.mozilla.com/en-US/" title="Get FireFox 3.6">
                <img src="../images/fflogosmall.jpg" alt="firefox 3.6" style="width:171px; height:30px;"/></a>
                <a href="http://www.google.com/chrome" title="Get Google Chrome">
                <img src="../images/logo_sm.jpg" alt="chrome" style="width:171px; height:30px;"/></a>
                <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx" title="Get IE8">
                <img src="../images/ie8_logo.gif" alt="ie8" style="width:171px; height:30px;"/></a>
                </div>              
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
                        
        </div>
        
       
        
		<div id="main2">			
			    <?php if (isset($_GET['msg'])) { echo "<h1 style=\"color: red\" align=\"center\"> $_GET[msg] </h1>"; }?>               
			    <a name="UserActivitesAjax"></a>
                <h1 id="userlisttitle">Test for AJAX page: </h1>
                <div id="userlist" style="overflow:auto; overflow-x: hidden; height:400px; width:auto">
                <b>User's activities will be listed here.</b>            
                </div><br/>
                
                <a name="UserVideos"></a>
                <h1><?php echo $accountname; ?> uploaded video list: </h1>
                <div style="overflow:auto; overflow-x: hidden; height:400px; width:auto">
                <?php echo (populateuservideolist($accountname, 4)); ?>               
                </div><br/>

			    
                <h3>Google Ads</h3>
                <div>
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
