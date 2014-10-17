<?php

require_once ('../include/dbc.php');
require_once '../include/common.inc.php';

// declare global variables
$videotitle = "";
//$videosource = $_GET['video']; // 这里用$_GET[]处理url传来的参数
$videosource = "";
$videothumb = "";
$videoauthor = "";
$videodescription = "";
$videoaddedtime = "";
$condition = $_GET['cond']; // 这里用$_GET[]处理url传来的视频order by的参数
$col = $_GET['col']; // 这里用$_GET[]处理url传来的video list column的个数
$hide = $_GET['hide']; // 这里用$_GET[]处理url传来的哪边的scrolling不显示
$htmlbody = "";


// no argumment specified
if ($condition == NULL)
   header("Location: ../404.html");

if ($hide == "Y")
   {
   $htmlbody = '
   <body style="overflow-y:hidden">
   <div>';
   }
else
   {
   $htmlbody = '
   <body style="overflow-x:hidden">
   <div>';
   }


$htmltail = '
</div>
</body>
</html>';

// call populate video list
//if ($condition)
   //echo ($htmlhead . $htmlbody . populatevideolist($condition, $col) . $htmltail);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="First Time, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="FirstTimer Video" name="Description" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<link href="http://www.firsttimer.ca/firsttimer-ico.png" rel="shortcut icon" />
<title>FirstTimer Video List</title>
<link href="../ftstyle.css" rel="stylesheet" type="text/css" />
</head>
<?php echo $htmlbody; ?>
<?php echo (populatevideolist($condition, $col)); ?>
</div>
</body>
</html>
