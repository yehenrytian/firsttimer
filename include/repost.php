<?php
require_once ('jsonwrapper.php');
require_once ('twitterapi/config.php');
require_once ('twitterapi/twitter.lib.php');
require_once ('facebookapi/fbmain.php');
require_once ('buzz-php-client-1.0/src/buzz.php');
require_once ('weibo/config.php');
require_once ('weibo/weibooauth.php');

ini_set('session.gc_maxlifetime', 3600);
session_cache_limiter ('private, must-revalidate');
session_cache_expire(60); // in minutes 
session_start();

$repostTwitter = isset($_GET['twitter']) ? 1 : 0;
//$repostFB = isset($_GET['facebook']) ? 1 : 0;
//$repostBuzz = isset($_GET['buzz']) ? 1 : 0;
$repostWeibo = isset($_GET['weibo']) ? 1 : 0;
$repostComment = isset($_GET['comment']) ? 1 : 0;
$repostCommentOri = isset($_GET['oricomment']) ? 1 : 0;
$repostZhuanfa = isset($_GET['zhuanfa']) ? 1 : 0;
//$repostLike = isset($_GET['like']) ? 1 : 0;
//$repostFavor = isset($_GET['favorite']) ? 1 : 0;
$repostRetweet = isset($_GET['retweet']) ? 1 : 0;
$repostReply = isset($_GET['reply']) ? 1 : 0;

$sid = isset($_GET['sid']) ? $_GET['sid'] : 0;
$sidori = isset($_GET['oricomment']) ? $_GET['oricomment'] : 0;

$repostText = trim($_GET['reposttext']);

// strip "/"
if (get_magic_quotes_gpc())
   $repostText = stripslashes($repostText);


// check for Sina Weibo
if ($repostWeibo)
   {
   $weibo = $_SESSION['weibo'];
   
   if (!$weibo)
      {
      echo 'Session expired! Please refresh page to sign in again!';
	  return;
	  }
   
   if ($sid == 0)
      {
      echo 'Error: missing Sina weibo post ID!';
	  return;
	  }
	  
   // handle weibo actions
   try {
       // action zhuanfa
	   if ($repostZhuanfa)
	      {
	      if ($repostText != "")
             $weibo->repost($sid, $repostText);
          else
             $weibo->repost($sid);
		  }
	   
       // also action comment
       if ($repostComment)
          {
	      if ($repostText != "")
             $weibo->send_comment($sid, $repostText);
          else
	         $weibo->send_comment($sid, '转发微博');
	      }
	   
	   // also action comment original
	   if ($repostCommentOri) 
          {
		  if ($sidori == 0)
             {
             echo 'Error: missing Sina weibo oringinal post ID!';
	         return;
	         }  
	  
	      if ($repostText != "")
             $weibo->send_comment($sidori, ':'.$repostText);
          else
	         $weibo->send_comment($sidori, '转发微博!');
	      }
	   
	      
       } catch (Exception $e) {
         print_r($e);
       }
   } 

// check for Twitter
if ($repostTwitter)
   {
   $twitter = $_SESSION['twitter'];
   
   if (!$twitter)
      {
      echo 'Session expired! Please refresh page to sign in again!';
	  return;
	  }
	  
  if ($sid == 0)
      {
      echo 'Error: missing Twitter tweet ID!';
	  return;
	  }
	  
   // handle twitter actions
   try {
	   // action retweet
	   if ($repostRetweet)
	      {
		  $rtstring = $twitter->retweetStatus($sid);
		  //echo $rtstring.$sid;
		  }
       // also reply
       else if ($repostReply)
          {
		  $parameters = array('status' => $repostText, 'in_reply_to_status_id' => $sid);
	      //$rtstring = $twitter->post('statuses/update', $parameters);
		  $rtstring = $twitter->updateStatus($repostText, $sid);
		  //echo $rtstring;
	      }
	   
       } catch (Exception $e) {
         print_r($e);
       }
   }


   
// function used to repost a weibo
function repost_weibo($text, $sid, $comment)
   {
   ini_set('session.gc_maxlifetime', 3600);
   session_cache_limiter ('private, must-revalidate'); 
   session_cache_expire(60); // in minutes 	   
   session_start();
   $weibo = $_SESSION['weibo'];
   
   if (!$weibo)
      {
      $error .= '<h3>Session expired! Please refresh page to sign in again.</h3>';
	  return $error;
	  }

   // fetch public timeline in xml format
   if ($text != NULL)
      $weibo->repost($sid, $text);
   else
      $weibo->repost($sid);
   
   // also comment
   if ($comment)
      {
	  if ($text != NULL)
         $weibo->send_comment($sid, $text);
      else
	     $weibo->send_comment($sid, '转发微博');
	  }
   }
   

?>
