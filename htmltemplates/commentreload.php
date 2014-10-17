<?php
session_start();

require_once ('../include/dbc.php');
require_once '../include/common.funcs.php';

$commentadded = false;

if ($_POST['Submit'] == 'Post Comment')
{    
    if (isset($_GET['videoid']))
       $video_id = $_GET['videoid'];
	   
    if ($video_id != 0)
       {
       $username = $_SESSION['user'];
       $comment = trim($_POST['comment']);
	   
       // insert comment into database table
       if (mysql_query("INSERT INTO ft_ftvideocomments
            (`videoid`,`username`,`comment_text`,`agree`,`disagree`,`post_date`)
		    VALUES ('$video_id','$username','$comment',0,0,now())") or die(mysql_error()))
		  {
		  // update user comment counts
		  mysql_query("UPDATE ft_users SET total_comments = total_comments + 1 WHERE username = '$username'") or die(mysql_error());
		  $commentadded = true;
		  }
		   
       }
	else
	   {
	   header("Location: ../404.html");
	   exit();
	   }
	
	// refresh comments
	header("Location: ../htmltemplates/addcomment2.php?videoid=$video_id&commentadded=1");
    exit();
}
else
   $video_id = $_GET['videoid'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Video Comment List</title>
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
<?php echo (populatevideocommentlist($video_id)); ?>
<?php
if ($commentadded)
{
?>
<script language="javascript" type="text/javascript">
window.parent.document.getElementById("videocommentlist").contentWindow.location.reload();
</script>
<?php
}
?>

</body>
</html>
