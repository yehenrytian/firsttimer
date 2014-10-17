<?php 
session_start();

require_once ('../include/dbc.php'); 
require_once '../include/common.inc.php';

$video_id = 0;

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
		  
		  // update video comment counts
		  //mysql_query("UPDATE ft_ftvideos SET comments_count = comments_count + 1 WHERE videoid = '$video_id'") or die(mysql_error());
		  }
		   
       }
	else
	   {
	   header("Location: ../404.html");
	   exit();	   
	   }
	
	// refresh comments
	header("Location: ./addcomment.php?videoid=$video_id&commentadded=1");
	exit();
} 

//echo (populatevideocommentlist($_GET['videoid']));

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="First Time, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="FirstTimer Video" name="Description" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<link href="../firsttimer-ico.png" rel="shortcut icon" />
<title>FirstTimer Video List</title>
<link href="../ftstyle.css" rel="stylesheet" type="text/css" />
</head>
<body style="background-color:#999999">
<?php echo (populatevideocommentlist($_GET['videoid'])); ?>
</body>
</html>
