<?php
session_start();

require_once ('include/dbc.php');
require_once 'include/common.funcs.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="First Time, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="Here's is the place to  share your experience and lessons with other firsttimers from all over world to get things done by oneself!" name="Description" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Ye Henry Tian" />
<meta name="Robots" content="index,follow" />
<link rel="stylesheet" href="../images/ftstyle2.0.css" type="text/css" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<link href="../firsttimer-ico.png" rel="shortcut icon" />
<title>FirstTimer.ca - Get things done yourself!</title>	
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
			  <?php echo (emituseraccountbox($_SESSION['user'])); ?>
			</div>
            
            <div class="sidebox">						
			   <?php echo (emitsearchbox(true)); ?>
	        </div>
            
            <div class="sidebox">			
				<h1>Start Now</h1>				
				<p align="center"><a href="../uploadvideos/upload2.php" title="Start uploading your videos">
                <img src="../images/start-now.gif" alt="StartNow" width="183" height="49"/></a></p> 						
		    </div>
       
             <div class="sidebox" style="height:300px; overflow:auto; overflow-x: hidden;">
				<?php echo(emitusericonlist()) ?>
			 </div>
                  
            <div class="sidebox">
             <script src="http://www.gmodules.com/ig/ifr?url=http://padmanijain.googlepages.com/1YTP_6.xml&amp;up_mychoice=1&amp;up_searchkey=first%20time&amp;up_searchkeyUser=youtube&amp;up_initVideo=no&amp;synd=open&amp;w=220&amp;h=330&amp;title=Search YouTube Videos&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js"></script>
            </div> 
  
			<div class="sidebox">			
				<?php echo(emitcategories()) ?>
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
			<div class="post">			
				<a name="FTInfo"></a>	
				<!--
                <h1>Firsttimer.ca Info</h1>				
				<p>Posted by <a href="index.html">Ye Henry Tian</a></p>
				<p>FirstTimer.ca is a video sharing website to  share your experience and lessons in video format to help other <strong>FirstTimers </strong>
                to get things done by themselves! Like Obama said:&quot;<strong> Yes We Can!!</strong>&quot;. The video can be about &quot;very simple&quot; 
                things that you do often but still may be a &quot;difficulty&quot; for a <strong>FirstTimer</strong> ...</p>  

				<p>Note: we are still under construction now! For more info click <a href="./about/index.php" title="Go to FirstTimer - About">here</a>
                <img src="images/icons/info.png" alt="info" style="width:20px; height:20px; border:0; padding:0px; background-color:#FFF"/></p>
				<p>Let's start helping each other!</p>
				
				<p class="post-footer align-right">					
					<a href="index.html" class="readmore">Read more</a>
					<a href="index.html" class="comments">Comments (7)</a>
					<span class="date">Jul 22, 2009</span>
				</p> -->				
			</div>
                <a name="AllVideo"></a>
                
                <p style="visibility:visible;"><iframe frameborder="0" width="588" height="408" src="http://wpcomwidgets.com/?src=http%3A%2F%2Fwww.firsttimer.ca%2Fjwflvplayer%2Fplayer-viral.swf&amp;height=400&amp;width=580&amp;bgcolor=000000&amp;allowfullscreen=true&amp;flashvars=%26autostart%3Dtrue%26backcolor%3D000000%26bandwidth%3D4803%26controlbar%3Dover%26controlbar.position%3Dover%26dock%3Dtrue%26file%3Dhttp%3A%2F%2Fwww.firsttimer.ca%2Fftvideos%2FccHalloween.flv%26frontcolor%3DCCCCCC%26level%3D0%26logo%3Dhttp%253A%252F%252Fwww.firsttimer.ca%252Fimages%252Ffirsttimer-logo2cropsmall.jpg%26plugins%3Dviral%252Csharing-1%26screencolor%3D000000&amp;_tag=gigya&amp;_hash=2f4c51c7c9841778319aad4e03b08f7d" id="2f4c51c7c9841778319aad4e03b08f7d"></iframe></p>
                
                <div style="width: 690px; height: auto; background-color: #CCCCCC; -moz-border-radius: 15px">     
                <h1>
                <img src="images/icons/Windows Restart.png" style="background-color:#CCC; width:25px; height:25px; border:0; margin:0" alt="restart" />
                <a href="../jwflvplayer/">All video samples</a> (total video count: <?php $video_list = populatevideolist("date_added", 4, ""); echo $video_count; ?>)</h1>
                </div>
                <div style="overflow:auto; overflow-x: hidden; height:350px; width:auto">
                <?php echo ($video_list); ?>               
                </div><br />
                
                <a name="FirstTimeVideo"></a>
                <div style="width: 690px; height: auto; background-color: #CCCCCC; -moz-border-radius: 15px">
                <h1>
                <img src="images/icons/Windows Stand By.png" style="background-color:#CCC; width:25px; height:25px; border:0; margin:0" alt="standby" />
                <a href="./category/category.php?cat=FTV">Firsttime video samples</a> (total video count: 
																					   <?php $video_list = populatevideolist("date_added", 4, "FTV"); echo $video_count; ?>)</h1>
                </div>
                <div style="overflow:auto; overflow-x: hidden; height:350px; width:auto">
                <?php echo ($video_list); ?>               
                </div><br />
                
                <a name="MusicVideo"></a>
                <div style="width: 690px; height: auto; background-color: #CCCCCC; -moz-border-radius: 15px">
                <h1>
                <img src="images/icons/Windows Turn Off.png" style="background-color:#CCC; width:25px; height:25px; border:0; margin:0" alt="turnoff" />
                <a href="./category/category.php?cat=MTV">Music video samples</a> (total video count: 
																			   <?php $video_list = populatevideolist("date_added", 4, "MTV"); echo $video_count; ?>)</h1>
                </div>
                <div style="overflow:auto; overflow-x: hidden; height:350px; width:auto">
                <?php echo ($video_list); ?>               
                </div>
                
                <a name="TravelVideo"></a>
                <div style="width: 690px; height: auto; background-color: #CCCCCC; -moz-border-radius: 15px">
                <h1>
                <img src="images/icons/3D Studio Max 7.png" style="background-color:#CCC; width:25px; height:25px; border:0; margin:0" alt="3DStudio" />
                <a href="./category/category.php?cat=TRL">Travel video samples</a> (total video count: 
																					<?php $video_list = populatevideolist("date_added", 4, "TRL"); echo $video_count; ?>)</h1>
                </div>
                <div style="overflow:auto; overflow-x: hidden; height:350px; width:auto">
                <?php echo ($video_list); ?>               
                </div>
            
				<a name="SampleTags"></a>
                <?php echo emitrecbrowsers(); ?>                
                
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
