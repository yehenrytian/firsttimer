<?php 
session_start();

$video_id = 0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>add video comments</title>
<link rel="stylesheet" href="../images/ftstyle2.0.css" type="text/css" />
</head>

<style type="text/css">
body {
	margin: 0; 	padding: 0;
	font: normal 73%/1.5em 'Trebuchet MS', Tahoma, sans-serif;
	background:none;
	text-align: left;
}
</style>

<body>
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
				<script type="text/javascript" src="../include/verifyform.js"></script>
                <form name="submitcomment" enctype="multipart/form-data" action="../htmltemplates/commentreload.php?videoid=<?php echo $video_id ?>" method="post">
					<p>
					<label>Your Comments</label>
					<textarea rows="5" cols="5" name="comment" id="comment_text" onfocus="this.value=''; this.onfocus=null;" onkeydown="textcount(this, 180, this.form.remain)" 
                    onkeyup="textcount(this, 180, this.form.remain)">(max. 180 characters)</textarea>
					<br />
                    <!-- <button onclick="addcomment()">Add Comment</button> -->
					<input class="button" type="submit" name="Submit" value="Post Comment" />Remain text lenth:<input disabled maxLength=4 name="remain" size=3 value=180>
					</p>
				</form>
<?php
   }
else
   {
?>
                <p>Please <a href="../login&register/login2.php" rel="nofollow" target="_parent" title="Go to login">Login</a> to post comments! | (<a href="../login&register/register.php" rel="nofollow" target="_parent" title="Go to register">Register</a>)</p>
<?php
   }
?>
</body>
</html>
