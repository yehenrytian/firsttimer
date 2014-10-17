<?php
session_start();

require_once ('../include/dbc.php');
require_once '../include/common.funcs.php';

$category = $_GET['cat'];
$category_name = "";
$category_intro = "";
$video_count = 0;
$video_list = "";

if ($category == NULL)
   header("Location: ../404.html");	   

switch ($category) {
   case 'MTV':
      $category_name = 'Music Video';
	  $category_intro = 'Here are the music video samples users uploaded to our site. These are just for demonstration purpose. Note: please do not broadcast the source. All copyrights belongs to the original album company!';
      break;
   case 'FTV':
      {
      $category_name = 'How to';
	  $category_intro = 'Here are the firsttime video samples users uploaded to our site. You can learn from the video of how to get thinds done by yourself. Note: please do not broadcast the source. All copyrights belongs to the original author!';
      break;
	  }
   case 'FAF':
      $category_name = 'Friends&Family';
	  $category_intro = 'Share your story and memory videos with your friends and family here!';
      break;
   case 'FUN':
      $category_name = 'For Fun';
	  $category_intro = 'Share your fun videos to make everyone laugh here!';
      break;
   case 'ADS':
      $category_name = 'Advertisement';
	  $category_intro = 'Share the advertisement videos you like with everyone here!';
      break;
   case 'TRL':
      $category_name = 'Travel';
	  $category_intro = 'Share your travel videos with everyone here!';
      break;
   case 'SPT':
      $category_name = 'Sports';
	  $category_intro = 'Share your favourite sports videos with everyone here!';
      break;
   case 'ENT':
      $category_name = 'Entertainment';
	  $category_intro = 'Share your favourite entertainment videos with everyone here!';
      break;
   case 'PET':
      $category_name = 'Pets&Animals';
	  $category_intro = 'Share your favourite pets or animal videos with everyone here!';
      break;
  default:
      $category_name = 'Other';
	  $category_intro = 'Other un-categorized videos!';
	 break;
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="First Time, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="Here's is the place to  share your experience and lessons with other firsttimers from all over world to get things done by oneself!" name="Description" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Ye Henry Tian" />
<meta name="Robots" content="index, follow" />
<link rel="stylesheet" href="../images/ftstyle2.0.css" type="text/css" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<link href="../firsttimer-ico.png" rel="shortcut icon" />
<title>FirstTimer - <?php echo $category_name; ?> Video Samples</title>
</head>

<body>
<!-- wrap starts here -->
<div id="wrap">
	<?php echo (emitpageheader()); ?>
    
    <div id="content-wrap">
       <div id="content">
       <div id="sidebar">
			 <div class="sidebox">
               <?php echo (emituseraccountbox($_SESSION['user'])); ?>
			</div>
            
            <div class="sidebox">			
				<?php echo(emitcategories()) ?>
			</div>	
			
			<div class="sidebox">			
		      <h1>Start Now</h1>				
		      <p align="center"><a href="../uploadvideos/upload2.php" title="Start uploading your videos">
              <img src="../images/start-now.gif" alt="StartNow" width="183" height="49"/></a></p> 						
	        </div>
            
             <div class="sidebox">
                <?php echo (emitsearchbox(true)); ?>
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
      
       
       <div id="main">	
         <div class="post">			
		   <a name="TemplateInfo"></a>	
		   <h1>Firsttimer Video Info</h1>				
	       <p>Posted by <a href="index.html">Ye Henry Tian</a></p>
	       <p><?php echo $category_intro; ?></p> 
     	  <p class="post-footer align-right">					
			<a href="index.html" class="readmore">Read more</a>
			<a href="index.html" class="comments">Comments (7)</a>
			<span class="date">Jul 22, 2009</span>
		  </p>
         </div>
         
         <div style="width: 690px; height: auto; background-color: #CCCCCC; -moz-border-radius: 15px">
         <h1><?php echo $category_name; ?> Video Samples (total video count: <?php $video_list = populatevideolist("date_added", 5, $category); echo $video_count ?>)</h1>
         </div>
         <div style="overflow:auto; overflow-x: hidden; height:550px; width:auto">
           <?php echo ($video_list); ?>
         </div>
         
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
