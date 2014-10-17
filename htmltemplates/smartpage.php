<?php
session_start();

require_once ('../include/dbc.php'); 
require_once ('../include/common.funcs.php');


?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>FirstTimer - SmartPage test</title>
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

            
            <div class="sidebox" style="height:300px; overflow:auto; overflow-x: hidden;">
				<?php echo(emitusericonlist()) ?>
			</div>


		</div>
        
        
        
        <div id="sidebarleft">
            
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
                <div id="userlist" style="overflow:auto; overflow-x: hidden; height:auto; width:auto">
                <b>User's activities will be listed here.</b>
                <script src="http://www.gmodules.com/ig/ifr?url=http://www.twittergadget.com/gadget.xml&amp;synd=open&amp;w=320&amp;h=400&amp;title=TwitterGadget&amp;border=http%3A%2F%2Fwww.gmodules.com%2Fig%2Fimages%2F&amp;output=js"></script>           
                </div><br/>
                
                <script src="http://www.gmodules.com/ig/ifr?url=http://hosting.gmodules.com/ig/gadgets/file/100080069921643878012/facebook.xml&amp;up_useNewFB_p=1&amp;up_showPopUp1_p=true&amp;synd=open&amp;w=320&amp;h=500&amp;title=Facebook&amp;border=%23ffffff%7C0px%2C1px+solid+%23004488%7C0px%2C1px+solid+%23005599%7C0px%2C1px+solid+%230077BB%7C0px%2C1px+solid+%230088CC&amp;output=js"></script>


			    
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
