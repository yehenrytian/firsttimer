<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: ../login&register/login.php?msg=Error: Please login first!");
exit();	
}   

require_once ('../include/dbc.php'); 
require_once ('../include/common.inc.php');

$username = $_SESSION['user'];

// declare global variables
$videotitle = "";
$videosource = "";
$videothumb = "";
$videoauthor = "";
$videodescription = "";
$videoaddedtime = "";
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
	     updatevideo($title, $video_id, $description, $videofile_name, $videothumb_name);
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
	 
	 header("Location: ./managevideos.php");
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
<link href="../ftstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style3 {
	font-size: 10px;
	font-weight: bold;
	color:#FFFFFF;
}

.style1 {
   color: #0066FF;
   font-weight: bold;
   font-size:14px;
}
-->
</style>

</head>

<body>
<div id="page">
<script type="text/javascript">
document.write("<iframe src=\"./ftheader.php\" name=\"ftheader\" scrolling=\"no\" frameborder=\"no\" align=\"center\" height = \"200px\" width = \"970px\" ></iframe>")
</script>

<div id="content2">
<br />
<script type="text/javascript" src="../include/verifyform.js"></script>
<script type="text/javascript" language="javascript">  
function createselectedlist($video_id)  
  {  
    if ($video_id != 0)
	   {
	   if (confirm("Are you sure you want to delete this video?"))
          location.href="./managevideos.php?select=" + $video_id;
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
	      location.href="./managevideos.php?select=" + selectedvideos;
       else
          return "";
	   }
  }  
</script>  
<div align="center" style="width: auto; height: 620px; background-color: #999999; border: 1px solid #CCCCCC; -moz-border-radius: 20px">
<p></p>
<div align="left" style="width: 640px; height: 600px; background-color:#999999; overflow: auto">
<form onSubmit="return(verify(this));" action="./editvideo.php?videoid=<?php echo $video_id; ?>" method="post" name="editvideos_form" id="editvideos_form" enctype="multipart/form-data">
<table cellspacing="3" cellpadding="0" border="0" bgcolor="#999999" width="auto" height="auto">
<tbody>
<tr>
<td colspan="2">
<div align="center" style="width: 400px; height: 360px; background-color: #000000; border: 1px solid #CCCCCC; -moz-border-radius: 20px">
<h2 align="center" style="font-size: 18px;">Title: <?php echo $videotitle; ?></h2>
	<div id="preview" align="left">
	<script type="text/javascript" src="../jwflvplayer/swfobject.js"></script>
    <script type="text/javascript">
    var s1 = new SWFObject("../jwflvplayer/player.swf","player","400","320","9","ffffff");
    s1.addParam("allowfullscreen","true");
    s1.addParam("allowscriptaccess","always");
	s1.addParam("allownetworking","all");
    s1.addParam("wmode","opaque");
	s1.addParam("flashvars", "file=<?php echo $videosource;?>&config=../jwflvplayer/configsingle.xml");
    s1.write("preview");
    </script>
    </div>
</div></td>
<td valign="top" style="font-size: 10px; font-weight: bold; color: #333333;">
Video thumb:<br />
<img src="<?php echo $videothumb;?>" width="150" height="120" border="0"/><br/>
Author: <a id="ftlink" href="../htmltemplates/useraccount.php?accountname=<?php echo $videoauthor; ?>" target="_parent" title="See <?php echo $videoauthor;?>'s profile"><?php echo $videoauthor; ?></a><br />Date added: <?php echo $videoaddedtime; ?>
<br /><br /><br />
<div style="border: 1px solid #CCCCCC; width: 150px; -moz-border-radius: 16px">
<p><a id="ftlink" href="../jwflvplayer/showvideo.php?video=<?php echo $_GET['video'];?>" target="_parent" title="<?php echo $videotitle; ?>"><img src="../images/icons/play.png" alt="play" width="32" height="32" border="0" /></a><a id="ftlink" href="../jwflvplayer/showvideo.php?video=<?php echo $_GET['video'];?>" target="_parent" title="<?php echo $videotitle; ?>">Preview Video</a><br />

 <a id="ftlink" href="./managevideos.php" target="_parent" title="Go back to My Videos"><img src="../images/icons/rewind button white.png" alt="rewind" width="32" height="32" border="0" /></a><a id="ftlink" href="./managevideos.php" target="_parent" title="Go back to My Videos">Back to My Videos</a><br />
 <a id="ftlink" href="<?php echo $videosource;?>" title="Download this video"><img src="../images/icons/install.png" alt="download" width="32" height="32" border="0" /></a><a id="ftlink" href="<?php echo $videosource;?>" title="Download this video">Download this video</a><br />
 <a id="ftlink" href="#" onclick="createselectedlist(<?php echo $video_id; ?>);" title="Delete this video"><img src="../images/icons/cancel.png" alt="remove" width="32" height="32" border="0" /></a><a id="ftlink" href="#" onclick="createselectedlist(<?php echo $video_id; ?>);" title="Delete this video">Delete this video</a></p>
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
<td>
<div align="right" style="font-size: 12px; font-weight: bold; color: #333333;">Views: <?php echo $views_count; ?></div></td>
</tr>
<tr>
<td align="left"><strong style="color:#FFFFFF">Title:</strong></td>
<td align="left"><input type="text" name="title" compulsory="yes" size="40" value="<?php echo $videotitle; ?>" /></td>
</tr>
<tr>
<td align="left"><strong style="color:#FFFFFF">Update Video thumb:</strong></td>
<td align="left" colspan="2"><input type="file" name="vthumb" id="vthumb" size="40" /></td>
</tr>
<tr>
<td align="left"><strong style="color:#FFFFFF">Update Video:</strong></td>
<td align="left" colspan="2"><input type="file" name="uploaded" id="uploaded" size="40" /></td>
</tr>
<tr>
<td align="left"><p><strong style="color:#FFFFFF">Description:</strong><br /><span class="style3">(max. 120 characters)</span></p></td>
<td align="left"><textarea name="description" cols="34" rows="4" onfocus="this.onfocus=null;textcount(this, 120, this.form.remain);" onkeydown="textcount(this, 120, this.form.remain)" onkeyup="textcount(this, 120, this.form.remain)"><?php echo $videodescription; ?></textarea></td>
<td><span class="style3">Remain:</span><br /><INPUT disabled maxLength=4 name="remain" size=3 value=120></td>
</tr>
<tr>
<td></td>
<td align="left"><input type="submit" name="Submit" value="Update"/></td>
</tr>
</tbody>
</table>
</form>
</div>
</div>
<br />
<br />
</div>


<div align="left" id="sidebar">
<h2>Advertisements:</h2>
<br />
<div align="center">
<script type="text/javascript"><!--
google_ad_client = "pub-6635598879568444";
/* firsttimer 160x600, created 12/17/08 */
google_ad_slot = "1050254913";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
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
