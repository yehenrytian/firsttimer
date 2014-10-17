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

function deleteselectedvideos($selected_videos, $username)
  {
  if ($selected_videos != "")
     {
	 //$selected_comments = "(" . $selected_comments . ")";
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
<title>FirstTimer - Manage your videos</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="First Time, about, profile, history, introduction, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="manage user videos" name="Description" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<link href="../firsttimer-ico.png" rel="shortcut icon" />
<link href="../ftstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
   color: #0066FF;
   font-weight: bold;
   font-size:14px;
}
-->
</style>
<script type="text/javascript" language="javascript">  
  <!--  
  //全选按钮  
function clickall(v)  
  {  
	var f = this.document.forms["managevideos_form"];  
    for (i = 0; i < f.elements.length; i++)  
       f.elements[i].checked = v;  
    //document.forms["sendmail"].elements["mailselect"].checked=v;  
  }
  
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
</head>

<body>
<div id="page">
<script type="text/javascript">
document.write("<iframe src=\"./ftheader.php\" name=\"ftheader\" scrolling=\"no\" frameborder=\"no\" align=\"center\" height = \"200px\" width = \"970px\" ></iframe>")
</script>

<div id="content2">
<br />
<script type="text/javascript" src="../include/verifyform.js"></script>
<div align="center" style="width: auto; height: 560px; background-color: #999999; border: 1px solid #CCCCCC; -moz-border-radius: 20px">
<p></p>
<div align="left" style="width: 640px; height: 520px; background-color:#999999; overflow: auto">
<form onSubmit="return(verify(this));" action="managevideos.php" method="post" name="managevideos_form" id="managevideos_form">
<table cellspacing="1" cellpadding="0" border="0" bgcolor="#999999">
<tbody>
<tr>
<?php echo (manageuservideolist($username));  ?>

</tr>
</tbody>					
</table>
</form>
</div>
</div>
<br />

<div style="border: 1px solid #CCCCCC; width: 620px">
<p><a id="ftlink" href="#" onclick="clickall(true);">Select All</a><img src="../images/icons/plus.png" alt="select all" width="32" height="32" border="0" /> | <a id="ftlink" href="#" onclick="clickall(false);">Unselect All</a><img src="../images/icons/minus white.png" alt="unselect" width="32" height="32" border="0" /> | <a id="ftlink" href="#" onclick="createselectedlist(0);">Delete Selected</a><img src="../images/icons/trash full.png" alt="delete" width="32" height="32" border="0" /></p>
</div>
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
