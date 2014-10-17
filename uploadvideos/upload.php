<?php
session_start();

require_once ('../include/dbc.php');
require_once ('../include/common.inc.php');

if ($_POST['Submit'] == 'Upload')
   {
   if (!isset($_SESSION['user']))
      {
      header("Location: ../login&register/login.php?msg=Error: Please login first!");
      exit();	
      }

   $author = trim($_GET['user']);
   $title = trim($_REQUEST["title"]);
   $description = $_REQUEST["description"];
   $description = trim($description);
   $target = "./../ftvideos/";
   $videofile_name = $_FILES['uploaded']['name'];
   $uploaded_size = $_FILES['uploaded']['size'];
   $uploaded_type = $_FILES['uploaded']['type'];
   $target = $target . $videofile_name;
   $vttarget = "./../ftvideos/thumbs/";
   $vttarget = $vttarget . basename( $_FILES['vthumb']['name'] );
   $vthumb_type = $_FILES['vthumb']['type'];
   $type = array(".jpg",".gif",".flv"); 
   $ok = 1;

   // 404 page
   if ($videofile_name == NULL)
      {
      header("Location: ../404.html");
      exit();
      }

   // Insert default title if $title is NULL
   if ($title == NULL)
      {
      $title = "FirstTimer Video";
      }
   else
      {
      $title = trim($title);
      }
 

   //This is our size condition
   if ($uploaded_size > 8000000)
      {
      echo "Your video file is too large.<br>";
      $ok = 0;
      }

   // This is our limit file type condition
   if ($uploaded_type == "text/php")
      {
      echo "No PHP files.<br>";
      $ok = 0;
      }
   
   // file type test
   //if (!in_array(strtolower(strstr($videofile_name, '.')),$type))
      //{
      //echo "You may only upload FLV videos.<br>";
      //$ok = 0;
      //}

   // thumb type test
   if ($_FILES['vthumb']['name'] == NULL)
      {
      $ok = 2;
      }
   else if (!($vthumb_type=="image/gif" || $vthumb_type=="image/jpg" || $vthumb_type=="image/jpeg")) 
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
      if (move_uploaded_file($_FILES['uploaded']['tmp_name'], $target))
         {
	     if (move_uploaded_file($_FILES['vthumb']['tmp_name'], $vttarget))
            {
            savevideo($title, $author, $description, $_FILES['uploaded']['name'], $_FILES['vthumb']['name']);
		    }
	     else
            {
            echo "Sorry, there was a problem uploading your tumb file:" . basename( $_FILES['vthumb']['tmp_name'] ).".<br>";
            }
         }
      else
         {
         echo "Sorry, there was a problem uploading your video file:" . basename( $videofile_name ).".<br>";
         }
	 
      if ($ok == 2)
         {
         echo "Warning: you didn't upload a thumb for your video! Default thumb will be used.<br>";
         }
      }
	
   }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="First Time, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="upload your firsttime video!" name="Description" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<link href="../firsttimer-ico.png" rel="shortcut icon" />
<title>FirstTimer - Upload your FirstTimer videos</title>
<link href="../ftstyle.css" rel="stylesheet" type="text/css" /> 
<style type="text/css">
<!--
.style2 {
	color: #0066FF;
	font-weight: bold;
}

.style3 {
	font-size: 10px;
	font-weight: bold;
}
.style4 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>


<body>
<div id="page">
<script type="text/javascript">
document.write("<iframe src=\"../htmltemplates/ftheader.php\" name=\"ftheader\" scrolling=\"no\" frameborder=\"no\" align=\"center\" height = \"200px\" width = \"970px\" ></iframe>")
</script>

<div id="content">
<p align="center">Here is a web tool you can use to convert your videos into FLV format or MP4 HD. Please try it out! We are currently using this free service from a flv encoding company. The converted FLV video will be saved at their server. We recommend you download the .flv file after the conversion and upload it to us!<a href="http://www.firsttimer.ca/bbs7/viewthread.php?tid=2&amp;extra=page%3D1" target="_blank"><img height="32" border="0" width="32" src="../images/question.png" alt="question" /></a>
<br />
<strong>Thanks a lot!</strong></p>

<div align="center">
<div style="border: 1px solid #999999; background-color:#CCCCCC; width: 400px; -moz-border-radius: 20px">
<!---------Begin FLV Encoder code ---------------->  
<script language="JavaScript" type=text/javascript>
document.write("<iframe src=\"./covert.html\" name=\"FLVEncoder\" scrolling=\"no\" frameborder=\"no\" align=\"center\" height = \"300px\" width = \"389px\"></iframe>" )
</script> 
<!-----------End FLV Encoder code ------------- -->
</div>
</div>
<br />

<div align="center">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.1/build/assets/skins/sam/skin.css" /> <script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/utilities/utilities.js"></script> <script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/container/container-min.js"></script> <script type="text/javascript" src="loadingpanelUpload.js"></script> <script type="text/javascript">
var loadingPanelUpload = new yuiLoadingPanelUpload();
</script>
<script type="text/javascript" src="../include/verifyform.js"></script>

<div style="border: 1px solid #999999; background-color:#CCCCCC; width: 480px; -moz-border-radius: 20px">
<form onsubmit="return(verify(this));" method="post" action="upload.php?user=<?php echo $_SESSION['user']; ?>" enctype="multipart/form-data" name="uploadform" id="uploadform">
<table cellspacing="1" cellpadding="0" border="0" style="background-image:url(../images/css-images/table_background.gif); background-repeat:repeat-x; background-color:#CCCCCC" align="center" width="auto">
<tbody> 
<tr>
<td><input type="hidden" name="MAX_FILE_SIZE" value="8000000" /></td>                  
</tr>
<tr>
<td>&nbsp;</td>
<td align="left"><span class="style2">FLV Video File Upload (limit file size 8MB)</span></td>
</tr>
<tr>
<td align="left"><strong>Title:</strong></td>
<td align="left"><input type="text" name="title" compulsory="yes" size="35" /></td>
</tr>
<tr>
<td align="left"><p><strong>Description:</strong><br /><span class="style3">(max. 120 characters)</span></p></td>
<td align="left"><textarea name="description" cols="30" rows="4" onfocus="this.value=''; this.onfocus=null;" onkeydown="textcount(this, 120, this.form.remain)" onkeyup="textcount(this, 120, this.form.remain)">Enter your description here... (max. 120 characters)</textarea><span class="style3">Remain:</span><INPUT disabled maxLength=4 name="remain" size=3 value=120></td>
</tr>
<tr>
<td align="left"><strong>Video thumb:</strong> <a href="http://www.firsttimer.ca/bbs7/viewthread.php?tid=2&amp;extra=page%3D1" target="_blank"><img height="32" border="0" width="32" src="../images/question.png" alt="question" /></a></td>
<td align="left"><input type="file" name="vthumb" id="vthumb" size="35" /></td>
</tr>
<tr>
<td align="left"><strong>Video:</strong></td>
<td align="left"><input type="file" name="uploaded" id="uploaded" size="35" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<?php
if (!isset($_SESSION['user']))
{
?>
<td align="left"><input type="submit" name="Submit" id="submitvideo" value="Upload" disabled="disabled"/><input type="reset" />
  <span class="style4">(You must login first!)</span></td>
<?php
}
else
{
?>
<td align="left"><input type="submit" name="Submit" value="Upload"/><input type="reset" /></td>
<?php
}
?>
</tr>
</tbody>           
</table>
</form>
</div>
</div>
<br />

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
</div>


<div align="left" id="sidebar"><script type="text/javascript" src="http://www.gmodules.com/ig/ifr?url=http://padmanijain.googlepages.com/1YTP_6.xml&amp;up_mychoice=1&amp;up_searchkey=first%20time&amp;up_searchkeyUser=youtube&amp;up_initVideo=no&amp;synd=open&amp;w=220&amp;h=330&amp;title=search+YouTube+video+player&amp;border=http%3A%2F%2Fwww.gmodules.com%2Fig%2Fimages%2F&amp;output=js"></script>

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

<div>
<script type="text/javascript">
document.write("<iframe src=\"../htmltemplates/ftfooter.html\" name=\"ftfooter\" scrolling=\"no\" frameborder=\"no\" height = \"auto\" width = \"100%\" ></iframe>")
</script>
</div>
</div>


<div align="center" id="adleftsidebar">
<script type="text/javascript">
google_ad_client = "pub-6635598879568444";
/* 120x600Sidebar, created 1/15/09 */
google_ad_slot = "0594443114";
google_ad_width = 120;
google_ad_height = 600;
</script> 
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>

<div align="center" id="adrightsidebar">
<script type="text/javascript">
google_ad_client = "pub-6635598879568444";
/* 120x600Sidebar, created 1/15/09 */
google_ad_slot = "0594443114";
google_ad_width = 120;
google_ad_height = 600;
</script> 
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
</body>
</html>
