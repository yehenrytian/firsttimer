<?php 
session_start();

require_once ('../include/dbc.php'); 
require_once '../include/common.inc.php';

$video_id = 0;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="First Time, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="FirstTimer Video" name="Description" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<link href="../firsttimer-ico.png" rel="shortcut icon" />
<title>add video comments</title>
<link href="../ftstyle.css" rel="stylesheet" type="text/css" />
</head>
<body style="background-color:#999999">

<style type="text/css">
textarea{
 color: #999999;
}

textarea:focus{
 color: #000000;
}
</style>
<div align="left">
<?php
if (isset($_SESSION['user']))
{
if (isset($_GET['videoid']) && $_GET['videoid'] != 0)
   $video_id = $_GET['videoid'];	
	
if (isset($_GET['commentadded']) && $_GET['commentadded'] == 1)
{
?>
<script language="javascript" type="text/javascript">
window.parent.document.getElementById("videocommentlist").contentWindow.location.reload();
</script>
<?php
}
?>
<p></p><p></p>
<script type="text/javascript" src="../include/verifyform.js"></script>
<form onSubmit="return(verify(this));" id="comment_form" name="comment_form" action="../htmltemplates/comments.php?videoid=<?php echo $video_id ?>" method="post">
<table cellspacing="1" cellpadding="0" border="0" style="background-image:url(../images/css-images/table_background.gif); background-repeat:repeat-x; background-color:#CCCCCC;" align="left" width="100%">
<tbody> 
<tr>
<td align="left"><span style="font: 13px 'Trebuchet MS', Arial, Helvetica, sans-serif; font-weight: bold; color: #7F7772;">Comment:</span></td>
<td><textarea name="comment" cols="40" rows="5" onfocus="this.value=''; this.onfocus=null;" onkeydown="textcount(this, 180, this.form.remain)" onkeyup="textcount(this, 180, this.form.remain)">(max. 180 characters)</textarea></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="left"><input type="submit" name="Submit" value="Post Comment" /><input type="reset" /><span style="font: 'Trebuchet MS', Arial, Helvetica, sans-serif; font-weight: bold; color: #7F7772; font-size: 10px">Remain text lenth:</span><INPUT disabled maxLength=4 name="remain" size=3 value=180></td>
</tr>
</tbody>
</table>
</form>
<?php 
}
else
{
?>
<div style="width: 420px; font-size: 12px; font-weight: bold; color: #333333;">Please <a id="ftlink" href="../login&register/login.php" rel="nofollow" target="_parent" title="Go to login">Login</a> to post comments! | (<a id="ftlink" href="../login&register/register.php" rel="nofollow" target="_parent" title="Go to register">Register</a>) </div>
<?php
}
?>
</div>
</body>
</html>
