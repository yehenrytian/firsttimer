<?php

require_once ('dbc.php');


$func = "";
if (isset($_GET['func']))
   {
   $func = $_GET['func']; 
   }

if (function_exists($func)) 
   {
   if (isset($_GET['parms']))
      {
      $parms = $_GET['parms'];
	  $args = explode(',', $parms);
	  //print_r($args);
	  echo (call_user_func_array($func, $args));
	  }
   else
      echo ($func());
   }

function echo_title($title)
   {
   echo ($title); 
   }
   
// function used to echo video player in ajax mode
function echo_video($video)
   {
   populatevideoinfo(true);	   
	   
   $videoplayer = '';	   
	   
   }
   


// Function for emitting common page header
function emitpageheader()
   {  
	$pageheader = "";
	
	$pageheader .= '
	<div id="header">
     <div id="header-content">
	   <h1 id="logo"><a href="http://www.firsttimer.ca" title="Firsttimer.ca">
       <img src="../images/FirstTimerca.png" alt="Firsttimer.ca" style="width:325px; height:94px; border:0; padding:0px; background-color:#2E2C2C"/></a>
       <img src="../images/ytb.png" alt="Better than YouTube" style="width:94px; height:94px; border:0; padding:0px; background-color:#2E2C2C"/></h1>
       <h2 id="slogan"><span style="color:#FC0">(Beta 2.0)</span><span class="gray"> Get things done yourself!!</span></h2>
                		
		<!-- Menu Tabs -->
	     <ul>    
			<li><a href="../"> <!-- id="current"> -->
            <img src="../images/icons/Computer On.png" alt="Home" style="width:22px; height:22px; border:0; padding:0px; background-color:#333"/>Home</a></li>
			<li><a href="../uploadvideos/">
            <img src="../images/icons/remove.png" alt="Upload videos" style="width:22px; height:22px; border:0; padding:0px; background-color:#333"/>Upload videos</a></li>
			<li><a href="../jwflvplayer/">
            <img src="../images/icons/movies.png" alt="FirstTime videos" style="width:22px; height:22px; border:0; padding:0px; background-color:#333"/>Firsttime videos</a></li>
			<li><a href="../phpBB3/">
            <img src="../images/icons/users.png" alt="Forum" style="width:22px; height:22px; border:0; padding:0px; background-color:#333"/>Forum</a></li>
			<li><a href="../about/">
            <img src="../images/icons/help.png" alt="About" style="width:22px; height:22px; border:0; padding:0px; background-color:#333"/>About</a></li>
		</ul>
      </div>
    </div>	
	';
	   
	return $pageheader;   
	}
	
// Function for emitting common page footer
function emitpagefooter()
   {
	$pagefooter = "";
	
	$pagefooter .= '
	<!-- footer starts here -->	
    <div id="footer"><div id="footer-content">	
		<div class="col float-left">
			<h1>Site Partners</h1>
			<ul>				
				<li><a target="_blank" href="http://www.110mb.com/aff.php?un=tianye"><strong>110mb hosting</strong> - Reliable Free Webhosting</a></li>
				<li><a target="_blank" href="http://www.styleshout.com/"><strong>Styleshout.com</strong> | Free CSS Website Templates</a></li>
				<li><a target="_blank" href="http://www.freemysql.net/v2/"><strong>FreeMySQL.net</strong> - Create Free MySQL Databases</a></li>	
				<li><a target="_blank" href="http://netfirm.ca/"><strong>netFirm.ca</strong> - Domain Names, Web Hosting</a></li>						
				<li><a target="_blank" href="http://www.w3schools.com/"><strong>W3Schools</strong> - Online Web Tutorials</a></li>
				<li><a target="_blank" href="http://www.phpchina.com/"><strong>PHP China</strong> - Chinese php open source website</a></li>
				<li><a target="_blank" href="http://www.ebuddy.com/"><strong>EBuddy</strong> - Web and mobile messaging</a></li>
				<li><a target="_blank" href="http://friendstream.ca"><strong>Friendstream.ca</strong> - Your realtime social network streams</a></li>
			</ul>			
		</div>
		
		<div class="col1 float-left">
			<h1>Links</h1>
			<ul>				
				<li><a target="_blank" href="http://www.youtube.com/">youtube.com</a></li>
				<li><a target="_blank" href="http://www.hulu.com/">hulu.com</a></li>
				<li><a target="_blank" href="http://openvideo.dailymotion.com/ca-en">Dailymotion</a></li>
				<li><a target="_blank" href="http://www.youku.com/">youku.com</a></li>
				<li><a target="_blank" href="http://www.tudou.com">tudou.com</a></li>					
				<li><a target="_blank" href="http://www.56.com">56.com</a></li>				
			</ul>
		</div>   
		
		<div class="col float-left">
			<iframe src="http://www.ebuddy.com/widgets/loginbox/custom_login.html?version=large&language=en-GB" scrolling="no" frameborder="0" style="width: 300px; height: 250px;">
            </iframe>
		</div>
	
		<div class="col2 float-right">
		<p>
		&copy; copyright 2008 - 2011 <strong>Firsttimer.ca</strong><br />
		Developed by: <a target="_blank" href="http://twitter.com/yehenrytian"><strong>Ye Henry Tian</strong></a><br />
		Valid <a href="http://jigsaw.w3.org/css-validator/check/referer"><strong>CSS</strong></a> | 
		      <a href="http://validator.w3.org/check/referer"><strong>XHTML</strong></a>
		</p>
		
		<ul>
			<!-- AddThis Button BEGIN -->
            <li><a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pub=xa-4b28078b55a57eae"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pub=xa-4b28078b55a57eae"></script></li>
            <!-- AddThis Button END -->

			<li><a href="index.html"><strong>RSS Feed </strong></a><img src="../images/rssfeed.gif" alt="RSS" style="width:15px; height:15px; border:0; padding:0px; background-color:#FFF"/>
            </li>								
	        <li></li>
		</ul>
		
	  <p><a href="http://www.mozilla.com/en-US/firefox/" target="_parent" title="Go to FireFox official website">
   <img src="../images/logo-wordmark-version-preview.png" alt="FireFox3.5"    style="width:194px; height:80px; border:0; padding:0px; background-color:#FFF"/></a></p>
   <p>Design downloaded from <a href="http://www.freewebtemplates.com/">Free Templates</a> - your source for free web templates testing</p>	
	  </div>   
   </div>
    
	<!-- wibiya -->
   <script src="http://cdn.wibiya.com/Toolbars/dir_0325/Toolbar_325975/Loader_325975.js" type="text/javascript"></script>
   </div>
   <!-- footer ends here -->
	';
	   
	return $pagefooter;   
	}
	
// function for emitting google friend gadget
function emitgooglefriend()
   {
	$googlefriend = "";
	
	$googlefriend .= '
	<!-- Include the Google Friend Connect javascript library. -->
    <script type="text/javascript" src="http://www.google.com/friendconnect/script/friendconnect.js"></script>
    <!-- Define the div tag where the gadget will be inserted. -->
    <div id="div-675996190852335978" style="width:210px;border:1px solid #cccccc;"></div>
    <!-- Render the gadget into a div. -->
    <script type="text/javascript">
    var skin = {};
    skin[\'BORDER_COLOR\'] = \'#cccccc\';
    skin[\'ENDCAP_BG_COLOR\'] = \'#e0ecff\';
    skin[\'ENDCAP_TEXT_COLOR\'] = \'#333333\';
    skin[\'ENDCAP_LINK_COLOR\'] = \'#0000cc\';
    skin[\'ALTERNATE_BG_COLOR\'] = \'#ffffff\';
    skin[\'CONTENT_BG_COLOR\'] = \'#ffffff\';
    skin[\'CONTENT_LINK_COLOR\'] = \'#0000cc\';
    skin[\'CONTENT_TEXT_COLOR\'] = \'#333333\';
    skin[\'CONTENT_SECONDARY_LINK_COLOR\'] = \'#7777cc\';
    skin[\'CONTENT_SECONDARY_TEXT_COLOR\'] = \'#666666\';
    skin[\'CONTENT_HEADLINE_COLOR\'] = \'#333333\';
    skin[\'NUMBER_ROWS\'] = \'4\';
    google.friendconnect.container.setParentUrl(\'/\' /* location of rpc_relay.html and canvas.html */);
    google.friendconnect.container.renderMembersGadget(
    { id: \'div-675996190852335978\',
      site: \'14971813877164173295\' },
      skin);
    </script>
    ';
	
	return $googlefriend;   
   }

// function for emitting google comments gadget
function emitgooglecomment()
   {
	$googlecomment = "";
	
	$googlecomment .= '
	<!-- Include the Google Friend Connect javascript library. -->
    <script type="text/javascript" src="http://www.google.com/friendconnect/script/friendconnect.js"></script>
    <!-- Define the div tag where the gadget will be inserted. -->
    <div id="div-6692721048506105423" style="width:210px;border:1px solid #cccccc;"></div>
    <!-- Render the gadget into a div. -->
    <script type="text/javascript">
    var skin = {};
    skin[\'BORDER_COLOR\'] = \'#cccccc\';
    skin[\'ENDCAP_BG_COLOR\'] = \'#e0ecff\';
    skin[\'ENDCAP_TEXT_COLOR\'] = \'#333333\';
    skin[\'ENDCAP_LINK_COLOR\'] = \'#0000cc\';
    skin[\'ALTERNATE_BG_COLOR\'] = \'#ffffff\';
    skin[\'CONTENT_BG_COLOR\'] = \'#ffffff\';
    skin[\'CONTENT_LINK_COLOR\'] = \'#0000cc\';
    skin[\'CONTENT_TEXT_COLOR\'] = \'#333333\';
    skin[\'CONTENT_SECONDARY_LINK_COLOR\'] = \'#7777cc\';
    skin[\'CONTENT_SECONDARY_TEXT_COLOR\'] = \'#666666\';
    skin[\'CONTENT_HEADLINE_COLOR\'] = \'#333333\';
    skin[\'DEFAULT_COMMENT_TEXT\'] = \'- add your comment here -\';
    skin[\'HEADER_TEXT\'] = \'Comments\';
    skin[\'POSTS_PER_PAGE\'] = \'5\';
    google.friendconnect.container.setParentUrl(\'/\' /* location of rpc_relay.html and canvas.html */);
    google.friendconnect.container.renderWallGadget(
     { id: \'div-6692721048506105423\',
       site: \'14971813877164173295\',
       \'view-params\':{"disableMinMax":"false","scope":"SITE","features":"video,comment","startMaximized":"true"}
      }, skin);
    </script>
    ';
	
	return $googlecomment;   
   }

// function for emitting google review and ratings gadget
function emitgooglereview($videoid)
   {
	$googlereview = "";
	
	$googlereview .= '
	<!-- Include the Google Friend Connect javascript library. -->
    <script type="text/javascript" src="http://www.google.com/friendconnect/script/friendconnect.js"></script>
    <!-- Define the div tag where the gadget will be inserted. -->
    <div id="div-6513657351493793019" style="width:210px;border:1px solid #cccccc;"></div>
    <!-- Render the gadget into a div. -->
    <script type="text/javascript">
    var skin = {};
    skin[\'BORDER_COLOR\'] = \'#cccccc\';
    skin[\'ENDCAP_BG_COLOR\'] = \'#e0ecff\';
    skin[\'ENDCAP_TEXT_COLOR\'] = \'#333333\';
    skin[\'ENDCAP_LINK_COLOR\'] = \'#0000cc\';
    skin[\'ALTERNATE_BG_COLOR\'] = \'#ffffff\';
    skin[\'CONTENT_BG_COLOR\'] = \'#ffffff\';
    skin[\'CONTENT_LINK_COLOR\'] = \'#0000cc\';
    skin[\'CONTENT_TEXT_COLOR\'] = \'#333333\';
    skin[\'CONTENT_SECONDARY_LINK_COLOR\'] = \'#7777cc\';
    skin[\'CONTENT_SECONDARY_TEXT_COLOR\'] = \'#666666\';
    skin[\'CONTENT_HEADLINE_COLOR\'] = \'#333333\';
    skin[\'DEFAULT_COMMENT_TEXT\'] = \'- add your video review here -\';
    skin[\'HEADER_TEXT\'] = \'Video Ratings\';
    skin[\'POSTS_PER_PAGE\'] = \'5\';
    google.friendconnect.container.setParentUrl(\'/\' /* location of rpc_relay.html and canvas.html */);
    google.friendconnect.container.renderReviewGadget(
     { id: \'div-6513657351493793019\',
       site: \'14971813877164173295\',
       \'view-params\':{"disableMinMax":"false","scope":"ID","docId":"' . $videoid . '","startMaximized":"true"}
     },skin);
    </script>
    ';
	
	return $googlereview;   
   }

// Function for emitting sidebar user list
function emitusericonlist()
   {
   $result = mysql_query("select * from ft_users order by join_date desc") or die(mysql_error());
   $user_count = mysql_num_rows($result);
   
   $usericonlist = '<div class="sidebox" style="height:250px; overflow:auto; overflow-x: hidden;">';
   $usericonlist .= '<h1>New User List (total: ' . $user_count . ')</h1>';  
   $usericonlist .= '<div class="userthumbs">';
        
   if ($myrow = mysql_fetch_array($result))
	  {
	  $counter = 0;
      
	  do{
		$icon_id = $myrow[icon_id];
		$username = $myrow[username];
        
		$usericonlist .= '<div class="usericonfloat" align="center"><a href="../htmltemplates/useraccount2.php?accountname=' . $username .'">
				<img src="' . getusericonimg($icon_id) .'" style="width:30px; height:30px"/></a><br/>
				<span><a href="../htmltemplates/useraccount2.php?accountname=' . $username .'">'. $username . '</a></span></div>';
      
	    $counter++; 
        }while ($counter < 12 && $myrow = mysql_fetch_array($result)) ;
      }
   
    $usericonlist .= '</div></div>';
	
   return $usericonlist;   
   }
   
// function for emitting start register sidebox
function emitstartnow($width = 183)
   {
   $startnow = '<h1>Start Now</h1>';   
   
   $startnow .= '
                <div align="center">
				<a href="../login&register/register2.php" title="start register">
                <img src="../images/start-now.gif" alt="StartNow" width="' . $width .'" height="49"/></a></div>
   ';
   
   return $startnow;
   }
   
// function for emitting recommanded browsers
function emitrecbrowsers()
   {
	$recbrowsers = '<h1>Recommanded browsers:</h1>';
	
	$recbrowsers .= '
	            <p>
                <a href="http://www.mozilla.com/en-US/" title="Get FireFox 3.6">
                <img src="../images/fflogosmall.jpg" alt="firefox 3.6" style="width:191px; height:30px;"/></a>
                <a href="http://www.google.com/chrome" title="Get Google Chrome">
                <img src="../images/logo_sm.jpg" alt="chrome" style="width:191px; height:30px;"/></a>
                <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx" title="Get IE8">
                <img src="../images/ie8_logo.gif" alt="ie8" style="width:191px; height:30px;"/></a>
                </p>';
	   
	return $recbrowsers;	   
   }

// Function for emitting sidebar search box
function emitsearchbox($showtitle)
   {
	$searchbox = "";
	
	if ($showtitle)
	   $searchbox .= '<h1>Search Box</h1>';
	   
	$searchbox .= '	
    <style type="text/css">@import url(http://www.google.com/cse/api/branding.css);</style>
    <div class="cse-branding-right">
       <form action="http://www.google.ca/cse" class="searchform" target="_blank">
          <div>                   
          <input type="hidden" name="cx" value="partner-pub-6635598879568444:b791s-8mgpo" />
          <input type="hidden" name="ie" value="UTF-8" />
          <input type="text" name="q" class="textbox"/>
          <input type="image" style="width:24px; height:24px" name="sa" value="Search" src="../images/search.gif"/>
          <input align="right" type="image" name="googleimage" src="http://www.google.com/images/poweredby_transparent/poweredby_FFFFFF.gif"/>
          <div class="cse-branding-text" align="right">Custom Search</div>
          </div>
       </form>
    </div>
	';
	   
	return $searchbox;   
	}


// Function for emitting user account box
function emituseraccountbox($user)
   {
	$useraccount = "<h1>User Account</h1>";
	
    if (isset($user))
       {
	   $useraccount .= '
       <p><ul class="sidemenu">
	   <li><img src="../images/icons/user_suit.png" alt="user" style="width:16px; height:16px; border:0; padding:0px;"/><a href="../htmltemplates/useraccount2.php?accountname=' . $user . '" target="_parent" title="Go to your account"><span style="color: #0066FF">' . $user . '</span></a></li> 
	   <li><img src="../images/icons/vcard_edit.png" alt="useredit" style="width:16px; height:16px; border:0; padding:0px;"/><a href="../htmltemplates/usersettings2.php" target="_parent" title="Go to edit your profile"><span style="color: #0066FF">Settings</span></a></li>
	   <li><img src="../images/icons/lock_go.png" alt="logout" style="width:16px; height:16px; border:0; padding:0px;"/><a href="../login&register/logout.php" target="_parent" title="Logout of FirstTimer.ca"><span style="color: #0066FF">Logout</span></a></li>
	   </ul>
	   </p>
       ';       
       }
    else
       {		   
       $useraccount .= '
	   <script type="text/javascript" src="../include/verifyform.js"></script>
       <form id="signin" onSubmit="return(verify(this));" method="post" enctype="multipart/form-data" action="../login&register/login2.php">
	   <fieldset>
	   <legend><strong>Sign-In</strong></legend>			   
	   <input id="username" size="23" type="text" name="username" value="User name" onfocus="if (this.value == \'User name\') this.value=\'\';" onblur="if (this.value == \'\') this.value= \'User name\';"/>			   
	   <input id="password" size="23" type="text" name="password" value="Password" onfocus="if (this.value == \'Password\') {this.value=\'\'; this.type=\'password\';}" onblur="if (this.value == \'\') {this.type=\'text\'; this.value=\'Password\';}"/>
	   <input class="button" type="submit" name="Submit" value="Login" /><br />
	   <div align="center"><a href="mailto:firsttimer.ca@gmail.com" title="Send us an email to retrieve your password">Forgot password</a> | <a href="../login&register/register2.php">Sign up</a></div>
	   </fieldset>
	   </form>
	   ';       
       }
	
	return $useraccount;   
	}

// Function for emitting categories
function emitcategories()
   {
	$categories = "";
	
	$categories .= '
	<h1 class="clear">Categories</h1>
	  <ul class="sidemenu">
		  <li><a href="../jwflvplayer/"><img src="../images/icon2.0/Video.png" width="24" height="24" style="margin:0;padding:0;background:#F2F2F2"/>All video samples</a></li>
		  <li><a href="../category/category.php?cat=FTV"><img src="../images/icon2.0/Movie.png" width="24" height="24" style="margin:0;padding:0;background:#F2F2F2"/>FirstTime Videos</a></li>
		  <li><a href="../category/category.php?cat=MTV"><img src="../images/icon2.0/Music.png" width="24" height="24" style="margin:0;padding:0;background:#F2F2F2"/>Music Videos</a></li>
          <li><a href="../category/category.php?cat=FAF"><img src="../images/icon2.0/Users_Group.png" width="24" height="24" style="margin:0;padding:0;background:#F2F2F2"/>Friends & Family</a></li>
		  <li><a href="../category/category.php?cat=FUN"><img src="../images/icon2.0/Smiley_Happy.png" width="24" height="24" style="margin:0;padding:0;background:#F2F2F2"/>For Fun</a></li>
          <li><a href="../category/category.php?cat=ADS"><img src="../images/icon2.0/CreditCard_Visa.png" width="24" height="24" style="margin:0;padding:0;background:#F2F2F2"/>Advertisements</a></li>	
          <li><a href="../category/category.php?cat=TRL"><img src="../images/icon2.0/Camera.png" width="24" height="24" style="margin:0;padding:0;background:#F2F2F2"/>Travel</a></li>
          <li><a href="../category/category.php?cat=SPT"><img src="../images/icon2.0/Soccer-Ball-32.png" width="24" height="24" style="margin:0;padding:0;background:#F2F2F2"/>Sports</a></li>
		  <li><a href="../category/category.php?cat=ENT"><img src="../images/icon2.0/Beer.png" width="24" height="24" style="margin:0;padding:0;background:#F2F2F2"/>Entertainments</a></li>
          <li><a href="../category/category.php?cat=PET"><img src="../images/icon2.0/dog_32.png" width="24" height="24" style="margin:0;padding:0;background:#F2F2F2"/>Pets & Animals</a></li>
          <li><a href="../category/category.php?cat=Other"><img src="../images/icon2.0/PieChart.png" width="24" height="24" style="margin:0;padding:0;background:#F2F2F2"/>Others</a></li>
	  </ul>
	';
	   
	return $categories;   
	}

// Function for remove file extension
function removeextension($strName)
   {
   $ext = strrchr($strName, '.');

   if ($ext !== false)
      {
      $strName = substr($strName, 0, -strlen($ext));
      }

   return $strName;
   }

// populate video list method
function populatevideolist($condition, $col, $category)
   {
   global $videotitle, $videosource, $videothumb, $videoauthor, $videodescription, $videoaddedtime, $video_count;
   // return table html code
   $videolist = '
                <table cellspacing="0" cellpadding="0" style="margin:0; border:0" width=auto height=auto>
				<tr>';

   // query table
   if ($condition != NULL)
      {
	  if ($category != "")
	     $result = mysql_query("select * from ft_ftvideos where category = '$category' order by " . $condition . " desc") or die(mysql_error());
	  else
         $result = mysql_query("select * from ft_ftvideos order by " . $condition . " desc") or die(mysql_error());

      $video_count = mysql_num_rows($result);

	  if ($myrow = mysql_fetch_array($result))
	     {
		 $counter = 0;

	     do{
		   $videotitle = $myrow[title];
	       $videoauthor = $myrow[author];
	       $videodescription = $myrow[description];
	       $videoaddedtime = $myrow[date_added];
	       $videothumb = "../ftvideos/thumbs/" . $myrow[thumb];
	       $videosource = $myrow[source];

		   $videolist .='
           <td width="5%" valign="top" align="left" style="font-size: 0.8em; font-weight: bold;">
<div id="watermark_box"><a class="watermarklink" href="../jwflvplayer/showvideo2.php?video=' . removeextension($videosource) . '" target="_parent" title="' . $videotitle . '">
<img src="../images/icons/btn-play.png" height=0 width=0 class="watermark" /><img src="' . $videothumb . '" style="width:100px; height:75px; border:1;"/></a></div>Title: ' . $videotitle .  '<br />Author: <a href="../htmltemplates/useraccount2.php?accountname=' . $videoauthor .'" target="_parent" title="See ' . $videoauthor."'s" . ' profile">' . $videoauthor . '</a><br />Date added: ' . $videoaddedtime . '</td>';

	       $counter++;
		   if ($counter % $col == 0)
		      {
			  $videolist .='</tr><tr><td>&nbsp;&nbsp;</td></tr><tr>';
			  }

           }while ($myrow = mysql_fetch_array($result)) ;
         }
      else
         $videolist .= "<td>Error: No Video Found!</td>";

	  $videolist .= '
	                </tr>
                    </table>';
      }
   return $videolist;
   }

// populate same category video list method
function populatecategoryvideolist($condition, $col, $category)
   {
   global $videotitle, $videosource, $videothumb, $videoauthor, $videodescription, $videoaddedtime, $video_count;
   // return table html code
   $videolist = '
                <table cellspacing="0" cellpadding="0" style="margin:0; border:0" width=auto height=auto>
				<tr>';

   // query table
   if ($condition != NULL)
      {
	  if ($category != "")
	     $result = mysql_query("select * from ft_ftvideos where category = '$category' order by " . $condition . " desc") or die(mysql_error());
	  else
         $result = mysql_query("select * from ft_ftvideos order by " . $condition . " desc") or die(mysql_error());

      $video_count = mysql_num_rows($result);

	  if ($myrow = mysql_fetch_array($result))
	     {
		 $counter = 0;

	     do{
		   $videotitle = $myrow[title];
	       $videoauthor = $myrow[author];
	       $videodescription = $myrow[description];
	       $videoaddedtime = $myrow[date_added];
	       $videothumb = "../ftvideos/thumbs/" . $myrow[thumb];
	       $videosource = $myrow[source];

		   $videolist .='
           <td width="5%" valign="top" align="left" style="font-size: 0.8em; font-weight: bold;">
<div id="watermark_box"><a class="watermarklink" href="../jwflvplayer/showvideo2.php?video=' . removeextension($videosource) . '" target="_parent" title="' . $videotitle . '">
<img src="../images/icons/btn-play.png" height=0 width=0 class="watermark" /><img src="' . $videothumb . '" style="width:100px; height:75px; border:1;"/></a></div>Title: ' . $videotitle .  '<br />Author: <a href="../htmltemplates/useraccount2.php?accountname=' . $videoauthor .'" target="_parent" title="See ' . $videoauthor."'s" . ' profile">' . $videoauthor . '</a><br />Date added: ' . $videoaddedtime . '</td>';

	       $counter++;
		   if ($counter % $col == 0)
		      {
			  $videolist .='</tr><tr><td>&nbsp;&nbsp;</td></tr><tr>';
			  }

           }while ($myrow = mysql_fetch_array($result)) ;
         }
      else
         $videolist .= "<td>Error: No Video Found!</td>";

	  $videolist .= '
	                </tr>
                    </table>';
      }
   return $videolist;
   }


// populate user video list method
function populateuservideolist($username, $col)
   {
   // return table html code
   $videolist = '
                <table cellspacing="0" cellpadding="0" border="0" width="auto" height="auto">
				<tr>';

   // query table
   if ($username != NULL)
      {
      $result = mysql_query("select * from ft_ftvideos where author = '$username' order by date_added desc") or die(mysql_error());

	  if ($myrow = mysql_fetch_array($result))
	     {
		 $counter = 0;

	     do{
		   $videotitle = $myrow[title];
	       $videoauthor = $myrow[author];
	       $videodescription = $myrow[description];
	       $videoaddedtime = $myrow[date_added];
	       $videothumb = "../ftvideos/thumbs/" . $myrow[thumb];
	       $videosource = $myrow[source];

		   $videolist .='
           <td width="5%" valign="top" align="left" style="font-size: 0.8em; font-weight: bold;">
<div id="watermark_box"><a class="watermarklink" href="../jwflvplayer/showvideo2.php?video=' . removeextension($videosource) . '" target="_parent" title="' . $videotitle . '">
<img src="../images/icons/btn-play.png" height=0 width=0 class="watermark" /><img src="' . $videothumb . '" style="width:100px; height:75px; border:1;"/></a></div>Title: ' . $videotitle .  '<br />Author: <a href="../htmltemplates/useraccount2.php?accountname=' . $videoauthor .'" target="_parent" title="See ' . $videoauthor."'s" . ' profile">' . $videoauthor . '</a><br />Date added: ' . $videoaddedtime . '</td>'; //<br />Video description:<br />' . $videodescription . '<br />

	       $counter++;

		   if ($counter % $col == 0)
		      {
			  $videolist .='</tr><tr><td>&nbsp;&nbsp;</td></tr><tr>';
			  }

           }while ($myrow = mysql_fetch_array($result)) ;
         }
      else
         $videolist .= '<td width="5%" valign="top" align="left" style="font-size: 12px; font-weight: bold; color: #333333;">No video uploaded!</td>';

	  $videolist .= '
	                </tr>
                    </table>';
      }

   return $videolist;
   }

// populate video info method
function populatevideoinfo($updateviewcount)
   {
   global $video_id, $videotitle, $videosource, $videothumb, $videoauthor, $videodescription, $videoaddedtime, $views_count, $video_kind;
   
   $videosource = trim($videosource);
   $videosource .= ".flv";
   
   // query table
   if ($videosource)
      {	  
      $result = mysql_query("select * from ft_ftvideos where source='" . $videosource . "'");
      if ($myrow = mysql_fetch_array($result))
	     {
	     $videotitle = $myrow[title];
	     $videoauthor = $myrow[author];
	     $videodescription = $myrow[description];
	     $videoaddedtime = $myrow[date_added];
		 $views_count = $myrow[views_count];
		 $video_id = $myrow[videoid];
		 $video_kind = $myrow[category];
		 
		 // Increase views_count at the end
		 if ($updateviewcount == true)
	        mysql_query("UPDATE ft_ftvideos SET views_count = views_count + 1 WHERE source='" . $videosource . "'") or die(mysql_error());
		 
	     $videothumb = "../ftvideos/thumbs/" . $myrow[thumb];
	     $videosource = "../ftvideos/" . $myrow[source];		
		 }
	  else
		 {
	     header("Location: ../404.html");
		 exit();	
		 }
      }
   }

// populate video comment list method
function populatevideocommentlist($videoid)
   {
   // return table html code
   $commentlist = '
                <div style="height:300px; overflow:auto; border-bottom:1px solid #CCC; border-top:1px solid #CCC;">
                <table cellspacing="3" cellpadding="1">
				<tr>';

   // query table
   if ($videoid != NULL && $videoid != 0)
      {
      $result = mysql_query("select * from ft_ftvideocomments where videoid = '$videoid' order by post_date desc") or die(mysql_error());

	  if ($myrow = mysql_fetch_array($result))
	     {
		 // Populate video comments count
         $videocommentscount = mysql_num_rows($result);
         mysql_query("UPDATE ft_ftvideos SET comments_count = '$videocommentscount' WHERE videoid = '$video_id'") or die(mysql_error());
		 
		 $commentlist .='
		       <th class="first">Total Comments (' . $videocommentscount . ')</th>
               </tr>';
			   
	     do{
		   $username = $myrow[username];
	       $videocoment = $myrow[comment_text];
	       $postdate = $myrow[post_date];	      

		   $commentlist .='
		   <tr>
           <td class="first" style="padding-bottom:10px">
		   <div style="border: 1px solid #CCCCCC; width: 600px; height: 90px; overflow: auto; font-size: 12px; -moz-border-radius: 8px">
		   <p></p>
		   <span style="font-size: 12px">User: <a href="../htmltemplates/useraccount2.php?accountname=' . $username . '" target="_parent" title="See ' . $videoauthor."'s" . ' profile">' . $username .'</a> |  Posted: ' . $postdate . '</span><br /><br />' . $videocoment . '</div></td>';

	       $commentlist .='</tr>';
			
           }while ($myrow = mysql_fetch_array($result)) ;
         }
	  else
	     $commentlist .='<td><div style="border: 1px solid #CCCCCC; width: 420px; height: 100px; font-size: 12px; font-weight: bold; -moz-border-radius: 12px"><p>No video comments yet!</p></div></td>';

	  }
	  $commentlist .= '
                    </table></div>';

   return $commentlist;
   }
   
// populate user comment list method
function populateusercommentlist($username)
   {
   // return table html code
   $commentlist = '
                <table cellspacing="0" cellpadding="0" border="0" width="auto" height="auto">
				<tr>';

   // query table
   if ($username != NULL)
      {
      $result = mysql_query("select * from ft_ftvideocomments where username = '$username' order by post_date desc") or die(mysql_error());

	  if ($myrow = mysql_fetch_array($result))
	     {
		 //$counter = 0;
         $current_video_id = 0;
		 
	     do{
		   $video_id = $myrow[videoid];
	       $user_name = $myrow[username];
	       $comment_text = $myrow[comment_text];
	       $post_date = $myrow[post_date];
		   if ($current_video_id != $video_id)
		      {
			  $current_video_id = $video_id;
			  $video_result = mysql_query("select * from ft_ftvideos where videoid = '$current_video_id'") or die(mysql_error());
			  if ($myrow = mysql_fetch_array($video_result))
			     {
				 $videotitle = $myrow[title];
	             $videodescription = $myrow[description];
				 $videoauthor = $myrow[author];
	             $videoaddedtime = $myrow[date_added];
				 $videothumb = "../ftvideos/thumbs/" . $myrow[thumb];
				 $videosource = $myrow[source];
				 $video_kind = $myrow[category];
				 }
			  
			  // insert video info
			  $commentlist .='
                  <td valign="top" style="width=50px;"><div id="watermark_box"><a class="watermarklink" href="../jwflvplayer/showvideo2.php?video=' . removeextension($videosource) . '" target="_parent" title="' . $videotitle . '"><img src="../images/icons/btn-play.png" height=0 width=0 class="watermark"/><img src="' . $videothumb . '" style="width:100px; height:75px; border:1;"/></a></div></td>
				  <td align="left" style="font-size: 10px; font-weight: bold;">Comments added for video: ' . $videotitle . '<br />Author: <a href="../htmltemplates/useraccount2.php?accountname=' . $videoauthor .'" target="_parent" title="See ' . $videoauthor."'s" . ' profile">' . $videoauthor . '</a><br />Date added: ' . $videoaddedtime . '<br />Category: <a href="../category/category.php?cat=' . $video_kind .'">' . populatevidoecategoryname($video_kind) . '</a><br />
				  <div style="width: 410px; height: 55px; overflow: auto">Description: ' . $videodescription . '</div></td>
                  </tr>
				  <tr>';
			  }       

		   $commentlist .='
           <td></td>
		   <td valign="top" align="left" style="font-size: 10px; font-weight: bold; color: #333333;">
           <div style="border: 1px solid #CCCCCC; width: 420px; height: 70px; overflow: auto; font-size: 10px; -moz-border-radius: 8px">
		   <p></p>
		   <span style="font-size: 10px">User: <a href="../htmltemplates/useraccount2.php?accountname=' . $user_name . '" target="_parent" title="See ' . $videoauthor."'s" . ' profile">' . $user_name .'</a>  |  Posted: ' . $post_date . '</span><br /><br />' . $comment_text . '</div></td>';

	       //$counter++;

		   $commentlist .='</tr><tr><td></td></tr><tr>';

           }while ($myrow = mysql_fetch_array($result)) ;
         }
      else
         $commentlist .= '<td width="5%" valign="top" align="left" style="font-size: 12px; font-weight: bold; color: #333333;">No video comments added!</td>';

	  $commentlist .= '
	                </tr>
                    </table>';
      }

   return $commentlist;
   }   

// populate user info method
function populateuserinfo($user)
   {
   // Populate user INFO
   global $email, $aboutme, $sex, $dob, $showdob, $country, $icon_id, $join_date, $totalvideos, $totalcomments;
   $username = "";
   
   // read-in parameter
   $username = $user;
   
   // query table
   if ($username)
      {
      $result = mysql_query("select * from ft_users where username='" . $username . "'");
      if ($myrow = mysql_fetch_array($result))
	     {
	     $videotitle = $myrow[title];
	     $email = $myrow[email];
	     $aboutme = $myrow[about_me];
	     $sex = $myrow[sex];
		 $dob = $myrow[dob];
	     $showdob = $myrow[show_dob];
	     $country = $myrow[country];
		 $icon_id = $myrow[icon_id];
	     $join_date = $myrow[join_date];
	     $totalvideos = $myrow[total_videos];
		 $totalcomments = $myrow[total_comments];
		 }
	  else
	     {
	     header("Location: ../login&register/login2.php?msg=User name does not exist!");
		 exit();
		 }
      }
   else
      {
      header("Location: ../login&register/login2.php?msg=User name empty!");
	  exit();
	  }  
   }
   
// get user icon image
function getusericonimg($icon_id)
   {
	$usericonimg = '';   
	
	 switch($icon_id){
		   case 1:
		      $usericonimg .='../images/user-icons/adel_resize.jpg';
			  break;
		   case 2:
		      $usericonimg .='../images/user-icons/ash_resize.jpg';
			  break;
		   case 3:
		      $usericonimg .='../images/user-icons/athena_resize.jpg';
			  break;
		   case 4:
		      $usericonimg .='../images/user-icons/benimaru_resize.jpg';
			  break;
		   case 5:
		      $usericonimg .='../images/user-icons/billy_resize.jpg';
			  break;
		   case 6:
		      $usericonimg .='../images/user-icons/chang_resize.jpg';
			  break;
		   case 7:
		      $usericonimg .='../images/user-icons/chiziru_resize.jpg';
			  break;
		   case 8:
		      $usericonimg .='../images/user-icons/clark_resize.jpg';
			  break;
		   case 9:
		      $usericonimg .='../images/user-icons/duolon_resize.jpg';
			  break;
		   case 10:
		      $usericonimg .='../images/user-icons/gato_resize.jpg';
			  break;
		   case 11:
		      $usericonimg .='../images/user-icons/griffon_resize.jpg';
			  break;
		   case 12:
		      $usericonimg .='../images/user-icons/hinako_resize.jpg';
			  break;
		   case 13:
		      $usericonimg .='../images/user-icons/angel_resize.jpg';
			  break;
		   case 14:
		      $usericonimg .='../images/user-icons/iori_resize.jpg';
			  break;
		   case 15:
		      $usericonimg .='../images/user-icons/jhun_resize.jpg';
			  break;
		   case 16:
		      $usericonimg .='../images/user-icons/joe_resize.jpg';
			  break;
		   case 17:
		      $usericonimg .='../images/user-icons/kim_resize.jpg';
			  break;
		   case 18:
		      $usericonimg .='../images/user-icons/mai_resize.jpg';
			  break;
		   case 19:
		      $usericonimg .='../images/user-icons/malin_resize.jpg';
			  break;
		   case 20:
		      $usericonimg .='../images/user-icons/mary_resize.jpg';
			  break;
		   case 21:
		      $usericonimg .='../images/user-icons/maxima_resize.jpg';
			  break;
		   case 22:
		      $usericonimg .='../images/user-icons/mukai_resize.jpg';
			  break;
		   case 23:
		      $usericonimg .='../images/user-icons/ralf_resize.jpg';
			  break;
		   case 24:
		      $usericonimg .='../images/user-icons/robert_resize.jpg';
			  break;
		   case 25:
		      $usericonimg .='../images/user-icons/ryo_resize.jpg';
			  break;
		   case 26:
		      $usericonimg .='../images/user-icons/shenwoo_resize.jpg';
			  break;
		   case 27:
		      $usericonimg .='../images/user-icons/shingo_resize.jpg';
			  break;
		   case 28:
		      $usericonimg .='../images/user-icons/terry_resize.jpg';
			  break;
		   case 29:
		      $usericonimg .='../images/user-icons/whip_resize.jpg';
			  break;
		   case 30:
		      $usericonimg .='../images/user-icons/yuri_resize.jpg';
			  break;
		   case 31:
		      $usericonimg .='../images/user-icons/zero_resize.jpg';
			  break;		 		
		
		}
	return $usericonimg;	
	   
   }
   
// populate all user icons method
function populateallusericons()
   {
   // Populate user INFO
   $usericonlist = '<div class="thumbs">';
        
   $result = mysql_query("select * from ft_users order by join_date desc") or die(mysql_error());

   if ($myrow = mysql_fetch_array($result))
	  {
	  $counter = 0;
      
	  do{
		$icon_id = $myrow[icon_id];
		$username = $myrow[username];
        
		$usericonlist .= '<div class="float-left" align="center"><a href="../htmltemplates/useraccount2.php?accountname=' . $username .'">
				<img src="' . getusericonimg($icon_id) .'" style="width:40px; height:40px"/></a><br/>
				<span style="margin: 0 4px 0 10px;"><a href="../htmltemplates/useraccount2.php?accountname=' . $username .'">'. $username . '</a></span></div>';
      
	    $count++; 
        }while ($myrow = mysql_fetch_array($result)) ;
      }
   
   $usericonlist .= '</div>';
   
   return $usericonlist;
   }   

// manage user video list method
function manageuservideolist($username)
   {
   // return table html code
   $videolist = "";

   // query table
   if ($username != NULL)
      {
      $result = mysql_query("select * from ft_ftvideos where author = '$username' order by videoid desc") or die(mysql_error());

	  if ($myrow = mysql_fetch_array($result))
	     {		 	 
	     do{
		   $videoid = $myrow[videoid];
		   $videotitle = $myrow[title];
	       $videodescription = $myrow[description];
		   $videoauthor = $myrow[author];
	       $videoaddedtime = $myrow[date_added];
		   $videothumb = "../ftvideos/thumbs/" . $myrow[thumb];
		   $videosource = $myrow[source];
		   $video_kind = $myrow[category];
			
			  // insert video info
			  $videolist .='
			      <td><input type="checkbox" name="video' . $videoid . '" value="' . $videoid . '"/></td>
                  <td valign="top"><div id="watermark_box"><a class="watermarklink" href="../jwflvplayer/showvideo2.php?video=' . removeextension($videosource) . '" target="_parent" title="' . $videotitle . '"><img src="../images/icons/btn-play.png" height=0 width=0 class="watermark"/><img src="' . $videothumb . '" style="width:100px; height:75px; border:1;"/></a></div></td>
				  <td style="font-size: 10px; font-weight: bold;">Video title: ' . $videotitle . '<br />Author: <a href="../htmltemplates/useraccount2.php?accountname=' . $videoauthor .'" target="_parent" title="See ' . $videoauthor."'s" . ' profile">' . $videoauthor . '</a><br />Date added: ' . $videoaddedtime . '<br />
				  Category: <a href="../category/category.php?cat=' . $video_kind .'">' . populatevidoecategoryname($video_kind) . '</a><br />
				  <div style="width: 390px; height: 55px; overflow: auto">Description: ' . $videodescription . '</div></td>
				  <td><a href="./editvideo2.php?video=' . removeextension($videosource) . '" title="Edit this video">
				  <img src="../images/icons/edit.png" alt="edit" style="width:20px; height:20px; border:0; margin:0" /></a><br />
				  <a href="../ftvideos/' . $videosource . '" title="Download this video">
				  <img src="../images/icons/install.png" alt="download" style="width:20px; height:20px; border:0; margin:0"/></a><br />
				  <a href="#" onclick="createselectedlist(' . $videoid . ');" title="Delete this video"><img src="../images/icons/cancel.png" alt="remove" style="width:20px; height:20px; border:0; margin:0"/></a>
				  </td>
                  </tr>
				  <tr>';
				  
           $videolist .='</tr><tr>';
		   
           }while ($myrow = mysql_fetch_array($result)) ;
         }
      else
         $videolist .= '<td width="5%" valign="top" align="left" style="font-size: 12px; font-weight: bold; color: #333333;">No video uploaded!</td>';

      }

   return $videolist;
   }

// manage user comment list method
function manageusercommentlist($username)
   {
   // return table html code
   $commentlist = "";

   // query table
   if ($username != NULL)
      {
      $result = mysql_query("select * from ft_ftvideocomments where username = '$username' order by post_date desc") or die(mysql_error());

	  if ($myrow = mysql_fetch_array($result))
	     {
		 //$counter = 0;
         $current_video_id = 0;
		 
	     do{
		   $comment_id = $myrow[comment_id];
		   $video_id = $myrow[videoid];
	       $user_name = $myrow[username];
	       $comment_text = $myrow[comment_text];
	       $post_date = $myrow[post_date];
		   if ($current_video_id != $video_id)
		      {
			  $current_video_id = $video_id;
			  $video_result = mysql_query("select * from ft_ftvideos where videoid = '$current_video_id'") or die(mysql_error());
			  if ($myrow = mysql_fetch_array($video_result))
			     {
				 $videotitle = $myrow[title];
	             $videodescription = $myrow[description];
				 $videoauthor = $myrow[author];
	             $videoaddedtime = $myrow[date_added];
				 $videothumb = "../ftvideos/thumbs/" . $myrow[thumb];
				 $videosource = $myrow[source];
				 $video_kind = $myrow[category];
				 }
			  
			  // insert video info
			  $commentlist .='
                  <td valign="top"><div id="watermark_box"><a class="watermarklink" href="../jwflvplayer/showvideo2.php?video=' . removeextension($videosource) . '" target="_parent" title="' . $videotitle . '"><img src="../images/icons/btn-play.png" height=0 width=0 class="watermark"/><img src="' . $videothumb . '" style="width:100px; height:75px; border:1;"/></a></div></td>
				  <td style="font-size: 10px; font-weight: bold;">Comments added for video: ' . $videotitle . '<br />Author: <a href="../htmltemplates/useraccount2.php?accountname=' . $videoauthor .'" target="_parent" title="See ' . $videoauthor."'s" . ' profile">' . $videoauthor . '</a><br />Date added: ' . $videoaddedtime . '<br />
				  Category: <a href="../category/category.php?cat=' . $video_kind .'">' . populatevidoecategoryname($video_kind) . '</a><br />
				  <div style="width: 410px; height: 55px; overflow: auto">Description: ' . $videodescription . '</div></td>
                  </tr>
				  <tr>';
			  }       

		   $commentlist .='
		   <td align="center"><input type="checkbox" name="comment' . $comment_id . '" value="' . $comment_id . '"/></td>
           <td valign="top" align="left" style="font-size: 10px; font-weight: bold; color: #333333;">
           <div style="border: 1px solid #CCCCCC; width: 420px; height: 70px; overflow: auto; font-size: 10px; -moz-border-radius: 8px">
		   <p></p>
		   <span style="font-size: 10px">User: ' . $user_name . '  |  Posted: ' . $post_date . '</span><br /><br />' . $comment_text . '</div></td>
		   <td><a href="#" onclick="createselectedlist(' . $comment_id . ');" title="Delete this comment"><img src="../images/icons/cancel.png" alt="remove" style="width:20px; height:20px; border:0; margin:0"/></a></td>';

	       //$counter++;

		   $commentlist .='</tr><tr><td></td></tr><tr>';

           }while ($myrow = mysql_fetch_array($result)) ;
         }
      else
         $commentlist .= '<td width="5%" valign="top" align="left" style="font-size: 12px; font-weight: bold; color: #333333;">No video comments added!</td>';

      }

   return $commentlist;
   }

// Fuction for saving the video record into the mySQL database
function savevideo( $title, $author, $description, $target, $vttarget, $vkind)
{
  $query = "INSERT INTO ft_ftvideos
             VALUES(0, '" . $title . "', '" . $author . "', '" . $description ."', '" . $target . "', '" . $vttarget . "', 0, 0, 0, 350, 240, CURRENT_TIMESTAMP, '" . $vkind . "')";

  // Insert a row of information into the table "ft_ftvideos"
  mysql_query($query) or die(mysql_error());

  $result = mysql_query("select * from ft_ftvideos where source='" . $target . "'") or die(mysql_error());

  if ($myrow = mysql_fetch_array($result))
     {
	 // update user total_video count first
	 mysql_query("UPDATE ft_users SET total_videos = total_videos + 1 WHERE username = '$author'") or die(mysql_error()); 
	 
     header("Location: ../jwflvplayer/showvideo2.php?video=" . removeextension($target));
	 exit();
     }
  else
     echo "Error: No Video Found!<br>";

}

// Fuction for updating the video information into the mySQL database
function updatevideo( $title, $videoid, $description, $target, $vttarget, $vkind)
{
  if ($target != "" && $vttarget != "")
     $query = "UPDATE ft_ftvideos SET title = '$title', description = '$description', category = '$vkind', source = '$target', thumb = '$vttarget' WHERE videoid = '$videoid'";
  else if ($target != "")
     $query = "UPDATE ft_ftvideos SET title = '$title', description = '$description', category = '$vkind', source = '$target' WHERE videoid = '$videoid'";
  else if ($vttarget != "")
     $query = "UPDATE ft_ftvideos SET title = '$title', description = '$description', category = '$vkind', thumb = '$vttarget' WHERE videoid = '$videoid'";
  else
     $query = "UPDATE ft_ftvideos SET title = '$title', description = '$description', category = '$vkind' WHERE videoid = '$videoid'";
  
  // update video information
  mysql_query($query) or die(mysql_error());
  
  $result = mysql_query("select * from ft_ftvideos WHERE videoid = '$videoid'") or die(mysql_error());
 
  if ($myrow = mysql_fetch_array($result))
     {
	 // refresh page
     header("Location: ./editvideo2.php?video=" . removeextension($myrow[source]));
     exit();
	 }
  else
     {
	 header("Location: ../404.html");
     exit();	
	 } 
}

// Function for populate video category name
function populatevidoecategoryname($video_kind)
{
switch ($video_kind) {
                  case 'MTV':
                     return 'Music Video';
                     break;
                  case 'FTV':
                     return 'How to';
                     break;
                  case 'FAF':
                     return 'Friends&Family';
                     break;
                  case 'FUN':
                     return 'For Fun';
                     break;
                  case 'ADS':
                     return 'Advertisement';
                     break;
				  case 'TRL':
                     return 'Travel';
                     break;
				  case 'SPT':
                     return 'Sports';
                     break;
				  case 'ENT':
                     return 'Entertainment';
                     break;
                  case 'PET':
                     return 'Pets&Animals';
                     break;
				  default:
                     return 'Other';
					 break;
			  }
}

?>