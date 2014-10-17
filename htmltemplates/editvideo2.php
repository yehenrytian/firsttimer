<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: ../login&register/login2.php?msg=Error: Please login first!");
exit();	
}   

require_once ('../include/dbc.php'); 
require_once ('../include/common.funcs.php');

$username = $_SESSION['user'];

// declare global variables
$videotitle = "";
$videosource = "";
$videothumb = "";
$videoauthor = "";
$videodescription = "";
$videoaddedtime = "";
$video_kind = "";
$views_count = 0;
$video_id = 0;
$videocommentscount = 0;


if ($_POST['Submit'] == 'Update')
   {
   $title = trim($_REQUEST["title"]);
   $description = trim($_REQUEST["description"]);
   $target = "./../ftvideos/";
   $videofile_name = $_FILES['uploaded']['name'];
   $uploaded_size = $_FILES['uploaded']['size'];
   $uploaded_type = $_FILES['uploaded']['type'];
   $target = $target . $videofile_name;
   $vttarget = "./../ftvideos/thumbs/";
   $videothumb_name = $_FILES['vthumb']['name'];
   $vttarget = $vttarget . basename($videothumb_name);
   $vkind = $_REQUEST["category"];
   $vthumb_type = $_FILES['vthumb']['type'];
   $type = array(".jpg",".gif",".flv"); 
   $ok = 1;
   $uploadNewVideo = 1;
   $uploadNewThumb = 1;
   $video_id = $_GET['videoid'];
   
   //This is our size condition
   if ($uploaded_size > 8000000)
      {
      echo "Your video file is too large.<br>";
      $ok = 0;
      }
   
   if ($videothumb_name != "" && !($vthumb_type=="image/gif" || $vthumb_type=="image/jpg" || $vthumb_type=="image/jpeg")) 
      {
      echo "You may only upload GIF or JPG video thumbs.<br>";
      $ok = 0;
      }
   
   //Here we check that $ok was not set to 0 by an error
   if ($ok == 0)
      {
      Echo "Sorry your video file was not uploaded.<br>";
      }
   else //If everything is ok we try to upload it
      {
	  if ($videofile_name != "")
	     {
		 if (move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
		    {
		    // new video uploaded successfully
			}
		 else
            {
            echo "Sorry, there was a problem uploading your video file:" . $videofile_name . ".<br>";
			$uploadNewVideo = 0;
            }
		 }
		 
	  if ($videothumb_name != "")
	     {
		 if (move_uploaded_file($_FILES['vthumb']['tmp_name'], $vttarget))
            {
		    // new video thumb uploaded successfully
		    }
	     else
            {
            echo "Sorry, there was a problem uploading your tumb file:" . $videothumb_name . ".<br>";
			$uploadNewThumb = 0;
            }			 
	     }
	  
	  if ($uploadNewVideo && $uploadNewThumb)
	     updatevideo($title, $video_id, $description, $videofile_name, $videothumb_name, $vkind);
      }
	
   }
else 
   {
   $videosource = $_GET['video']; // 这里用$_GET[]处理url传来的参数   
   // no argumment specified
   if ($videosource == NULL)
       header("Location: ../404.html");	   
	   
   // call populate video info  
   if ($videosource)
      populatevideoinfo(false);
   }


function deleteselectedvideos($selected_videos, $username)
  {
  if ($selected_videos != "")
     {
     mysql_query("delete from ft_ftvideos where videoid IN ($selected_videos)") or die(mysql_error());
	 
	 // Update user video counts
	 $uservideosresult = mysql_query("select * from ft_ftvideos where author = '$username'") or die(mysql_error());
	 $numrows = mysql_num_rows($uservideosresult);
	 mysql_query("UPDATE ft_users SET total_videos = '$numrows' WHERE username = '$username'") or die(mysql_error());
	 
	 header("Location: ./managevideos2.php");
	 exit();
	 }
  }
  
if (isset($_GET['select'])) 
   {
   deleteselectedvideos($_GET['select'], $username);
   }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>FirstTimer - Edit video: <?php echo $videotitle; ?></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="First Time, about, profile, history, introduction, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="manage user videos" name="Description" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<link href="../firsttimer-ico.png" rel="shortcut icon" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Ye Henry Tian" />
<meta name="Robots" content="index,follow" />
<link rel="stylesheet" href="../images/ftstyle2.0.css" type="text/css" />
<script type="text/javascript" src="../include/verifyform.js"></script>
<script type="text/javascript" language="javascript">  
function createselectedlist($video_id)  
  {  
    if ($video_id != 0)
	   {
	   if (confirm("Are you sure you want to delete this video?"))
          location.href="./managevideos2.php?select=" + $video_id;
       else
          return "";	   
	   }
	else
	   {
	   var selectedvideos = "";
	   var f = this.document.forms["managevideos_form"];  
       for (i = 0; i < f.elements.length; i++)
	      {  
          if (f.elements[i].checked)
	         {
		     selectedvideos += f.elements[i].value + ",";
		     }  
	      }
		// remove the last comma
	   selectedvideos = selectedvideos.substring(0, selectedvideos.length - 1);
	   if (selectedvideos == "")
	      alert("No videos selected!");  
       else if (confirm("Are you sure you want to delete the selected videos?"))
	      location.href="./managevideos2.php?select=" + selectedvideos;
       else
          return "";
	   }
  }  
</script> 
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
				<?php echo (emitstartnow()); ?>					
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
				<?php echo emitrecbrowsers(); ?>
                
                <script type="text/javascript" src="../include/verifyform.js"></script>
                <h1>Update video info</h1>
                <div align="center" style="width: 725px; height: 780px; border: 1px solid #CCCCCC; -moz-border-radius: 20px">
                
                <form onSubmit="return(verify(this));" action="./editvideo2.php?videoid=<?php echo $video_id; ?>" method="post" name="editvideos_form" id="editvideos_form" 
                enctype="multipart/form-data">
                <table cellspacing="0" cellpadding="0" border="0" width="auto" height="auto">
                <tr><td colspan="2">
                <div align="center" style="width: 500px; height: 380px; background-color:#000; border: 1px solid #CCCCCC; -moz-border-radius: 20px">
                <h1 align="center">Title: <?php echo $videotitle; ?></h1>
  	              <div id="preview" align="left">
	              <script type="text/javascript" src="../jwflvplayer/swfobject.js"></script>
                  <script type="text/javascript">
                  var s1 = new SWFObject("../jwflvplayer/player-viral.swf","player","500","320","9","ffffff");
                  s1.addParam("allowfullscreen","true");
                  s1.addParam("allowscriptaccess","always");
	              s1.addParam("allownetworking","all");
                  s1.addParam("wmode","opaque");
	              s1.addParam("flashvars", "file=<?php echo $videosource;?>&config=../jwflvplayer/configsingle.xml");
                  s1.write("preview");
                  </script>
                </div></div></td><td style="font-size: 10px; font-weight: bold;" valign="top"><strong style="color: #06F;">Video thumb:</strong><br />
                <img src="<?php echo $videothumb;?>" style="width:100px; height:80px;"/><br/>
                Author: <a href="../htmltemplates/useraccount2.php?accountname=<?php echo $videoauthor; ?>" target="_parent" title="See <?php echo $videoauthor;?>'s profile">
				<?php echo $videoauthor; ?></a><br />Date added: <?php echo $videoaddedtime; ?>
                <br /><br /><br />
                <div style="border: 1px solid #CCCCCC; width: 150px; -moz-border-radius: 16px">
                <p><a href="../jwflvplayer/showvideo2.php?video=<?php echo $_GET['video'];?>" target="_parent" title="<?php echo $videotitle; ?>">
                <img src="../images/icons/play.png" alt="play" style="width:30px; height:30px; border:0; margin:0"/></a>
                <a href="../jwflvplayer/showvideo2.php?video=<?php echo $_GET['video'];?>" target="_parent" title="<?php echo $videotitle; ?>">Preview</a><br />
                <a href="./managevideos2.php" target="_parent" title="Go back to My Videos">
                <img src="../images/icons/rewind button white.png" alt="rewind" style="width:30px; height:30px; border:0; margin:0"/></a>
                <a href="./managevideos2.php" target="_parent" title="Go back to My Videos">Back</a><br />
                <a href="<?php echo $videosource;?>" title="Download this video">
                <img src="../images/icons/install.png" alt="download" style="width:30px; height:30px; border:0; margin:0"/></a>
                <a href="<?php echo $videosource;?>" title="Download this video">Download</a><br />
                <a href="#" onclick="createselectedlist(<?php echo $video_id; ?>);" title="Delete this video">
                <img src="../images/icons/cancel.png" alt="remove" style="width:30px; height:30px; border:0; margin:0"/></a>
                <a href="#" onclick="createselectedlist(<?php echo $video_id; ?>);" title="Delete this video">Delete</a></p>
                </div></td>
                </tr>
                <tr>
                <td>
<ul class="star-rating">
<li class='current-rating' title='Currently 3.5/5 Stars' style='width:51px;'>Currently 2.5/5 Stars.</li> 
<li><a href="#" title="Rate this 1 star out of 5" class="one-star">It deserves 1 star</a></li>
<li><a href="#" title="Rate this 2 stars out of 5" class="two-stars">It deserves 2 stars</a></li>
<li><a href="#" title="Rate this 3 stars out of 5" class="three-stars">It deserves 3 stars</a></li>
<li><a href="#" title="Rate this 4 stars out of 5" class="four-stars">It deserves 4 stars</a></li>
<li><a href="#" title="Rate this 5 stars out of 5" class="five-stars">It deserves 5 stars!</a></li>
</ul></td>
<td align="right"><h3>Views: <?php echo $views_count; ?></h3></td>
</tr>
<tr>
<td><strong style="color: #06F;">Title:</strong></td>
<td><input type="text" name="title" compulsory="yes" size="40" value="<?php echo $videotitle; ?>" /></td>
</tr>
<tr>
<td><strong style="color: #06F;">Update Video thumb:</strong></td>
<td colspan="2"><input type="file" name="vthumb" id="vthumb" size="40" /></td>
</tr>
<tr>
<td><strong style="color: #06F;">Update Video:</strong></td>
<td colspan="2"><input type="file" name="uploaded" id="uploaded" size="40" /></td>
</tr>
 <tr><td><strong style="color: #06F;">Category:</strong></td><td>
              <select name="category">
              <option value=<?php echo $video_kind; ?> selected="selected">
			  <?php echo populatevidoecategoryname($video_kind); ?></option>
              <option value="FTV">How to</option>
              <option value="MTV">Music Video</option>
              <option value="FAF">Friends&Family </option>
              <option value="ADS">Advertisement</option>
              <option value="FUN">For Fun</option>
              <option value="SPT">Sports</option>
              <option value="TRL">Travel</option>
              <option value="ENT">Entertainment</option>
              <option value="PET">Pets&Animals </option>
              <option value="Other">Other</option>
            </select> (select the category that best match to your video)           
            </td></tr>
<tr>
<td><p><strong style="color: #06F;">Description:</strong><br /><span class="style3">(max. 300 characters)</span></p></td>
<td><textarea name="description" cols="34" rows="4" onfocus="this.onfocus=null;textcount(this, 300, this.form.remain);" onkeydown="textcount(this, 300, this.form.remain)" onkeyup="textcount(this, 300, this.form.remain)"><?php echo $videodescription; ?></textarea></td>
<td>Remain:<br /><INPUT disabled maxLength=4 name="remain" size=3 value=120></td>
</tr>
<tr>
<td></td>
<td align="left"><input class="button" type="submit" name="Submit" value="Update"/></td>
</tr>
</table>
</form>
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
