<?php
require_once ('jsonwrapper.php');
require_once ('twitterapi/config.php');
//require_once ('buzz-php-client-1.0/src/auth/OAuth.php');
require_once ('twitterapi/twitter.lib.php');
require_once ('facebookapi/fbmain.php');
require_once ('buzz-php-client-1.0/src/buzz.php');
require_once ('weibo/config.php');
require_once ('weibo/weibooauth.php');

$func = '';
if (isset($_GET['func']))
   {
   $func = $_GET['func']; 
   }

if (function_exists($func)) 
   {
   if ($func == "short_streampost")
      {
	  echo (call_user_func_array($func, $_GET['parms']));
	  }
   else if (isset($_GET['parms']))
      {
      $parms = $_GET['parms'];
	  $args = explode(',', $parms);
	  //print_r($args);
	  echo (call_user_func_array($func, $args));
	  }
   else
      echo ($func());
   }

function echo_title($title)
   {
   echo ($title); 
   }
   
function buzzLogin()
  {
  ini_set('session.gc_maxlifetime', 3600);
  session_cache_limiter ('private, must-revalidate'); 
  session_cache_expire(60); // in minutes 	   
  session_start();
  $_SESSION['buzz'] = 1;
  }
  
// function used to shorten URL in streamed post
function short_streampost($t) 
  {
  if (get_magic_quotes_gpc())
     $t = stripslashes($t);
  
   // link URLs
  // make sure to exclude already shorten url by sina t.cn service	  
  //$t = " ".preg_replace( "/(([[:alnum:]]+:\/\/)|www\.)(?!(t|sinaurl)\.cn)([^[:space:]]*)".
	 // "([[:alnum:]#?\/&=])/ie", "getShortUrlStreamIt('\\1\\3\\4')", $t);
  
  $t = " ".preg_replace( "/(([[:alnum:]]+:\/\/)|www\.)([^[:space:]]*)".
	  "([[:alnum:]#?\/&=])/ie", "getShortUrlStreamIt('$1$3$4')", $t);
  
  //$t = " ".preg_replace('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', "getShortUrlStreamIt('$1')", $t);
  return trim($t);
  }
   
function isValidURL($url)
   {
   return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
   }   
   
// function to get short url for streamit   
function getShortUrlStreamIt($longUrl)
   {
   if (strlen($longUrl) <= 25)
      return $longUrl;
	
   //$ch = curl_init('http://api.t.sina.com.cn/short_url/shorten.xml?source=1550075579&url_long='.$longUrl);
   $ch = curl_init('http://www.lnk.cm/?module=ShortURL&file=Add&mode=api&url='.$longUrl);
   curl_setopt($ch, CURLOPT_HEADER, 0);
   curl_setopt($ch, CURLOPT_POST, 0);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   
   try {
	   $surl = curl_exec($ch);
       curl_close($ch);
	   
	   if (isValidURL($surl))
	      return $surl;
	   else
	      return $longUrl;
	/*  
	  $surl_xml = new SimpleXMLElement($surl);
      if ($surl_xml->url[0]->url_short)
         return ($surl_xml->url[0]->url_short);
      else
         return $longUrl; */
	   }
       catch(Exception $o){
		   //curl_close($ch);
		   return $longUrl;
           //dump($o);
        }
   }
   
// function used to get recent tweets for the user
function get_tweets()
   {
   ini_set('session.gc_maxlifetime', 3600);
   session_cache_limiter ('private, must-revalidate'); 
   session_cache_expire(60); // in minutes 	   
   session_start();
   $twitter =  $_SESSION['twitter'];
   
   if (!$twitter)
      {
      $error .= '<h3>Session expired! Please refresh page to sign in again.</h3>';
	  return $error;
	  }
   	   
   // initialize the twitter class

   // fetch public timeline in xml format
   $xml = $twitter->getHomeTimeline();

   $twitter_status = new SimpleXMLElement($xml);
   
   //print_r($twitter_status->status[0]);
   
   $counts = count($twitter_status->status);
   $tweets = '<div id="twitterlist">';
   $tweets .= '<h4>' .$counts. ' tweet(s) found. </h4>';
   $tweets .= '<div style="overflow:auto; overflow-x: hidden; height:650px; width:100%; -moz-border-radius: 15px;">';
   $tweets .= '<ul>';
   foreach($twitter_status->status as $status){
      foreach($status->user as $user){
	     $tweets .= '<li><div class="grid-item twitter"><div class="grid-item-content">';
         $tweets .= (parse_twitter(htmlspecialchars($status->text)));
		 $streamit = 'FS:@'.$user->screen_name.': '.$status->text;
	     $tweets .= '<br/><div><img src="../images/twitter.ico" alt="twitter" /><a target="_blank" href="http://twitter.com/'.$user->name.'/statuses/'.$status->id.'">Tweet Link</a></div>';
		 $tweets .= '<br/><div align="right" style="font-size:90%">';
		 /*if ($status->retweeted == 'true')
		    $tweets .= '<img src="../images/retweet_on.gif" alt="retweet_on" style="width:13px; height:13px;"/>';
		 else*/
		    $tweets .= '<img src="../images/icon-twitter-retweet.png" alt="retweet" style="width:13px; height:13px;"/>';
		 $tweets .= '<a href="javascript:void(0);" onclick="retweetPopUp('.'\''.htmlspecialchars(addcslashes($user->profile_image_url, "\n\r\'\""), ENT_QUOTES).'\',\''.htmlspecialchars(addcslashes($status->text, "\n\r\'\""), ENT_QUOTES).'\',\''.$status->id.'\')">Retweet</a> | <img src="../images/icon-twitter-reply.png" alt="reply" style="width:13px; height:13px;"/><a href="javascript:void(0);" onclick="replyPopUp('.'\''.htmlspecialchars(addcslashes($user->profile_image_url, "\n\r\'\""), ENT_QUOTES).'\',\''.htmlspecialchars(addcslashes($status->text, "\n\r\'\""), ENT_QUOTES).'\',\''.$status->id.'\','.'\''.$user->screen_name.'\')">Reply</a> | <img src="../images/fsicon2.png" alt="friendstream" style="width:13px; height:13px;"/><a href="javascript:void(0);" onclick="getShortUrl(\''.htmlspecialchars(addcslashes($streamit, "\n\r\'\""), ENT_QUOTES).'\')">StreamIt</a></div>';
				 
		 $tweets .= '</div><div class="grid-item-meta">';
	     $tweets .= '<a target="_blank" href="http://twitter.com/'.$user->name.'"><img class="grid-item-avatar" style="width:25px; height:25px;" src="'.$user->profile_image_url.'"></a>';
         $tweets .= '<a target="_blank" href="http://twitter.com"><img src="../images/twitter.gif" class="grid-service-icon" alt="Twitter" style="width: 16px; height: 16px;"></a>';
	     $tweets .= '<cite>Tweeted by <a target="_blank" href="http://twitter.com/#!/'.$user->screen_name.'">'.$user->name.'</a>';
		 if ($user->verified == 'true')
			$tweets .= '<img src="../images/verified.png" alt="verified" width="13px" height="13px" />';
		 
		 $tweets .= ' via '.$status->source;
		 if ($user->location != NULL)
		    $tweets .= ' from '.$user->location.'<br /><span class="grid-item-date">'.$status->created_at.'</span></cite>';
	     else
		    $tweets .= '<br /><span class="grid-item-date">'.$status->created_at.'</span></cite>';
       }
     $tweets .= '</div></div></li>';
     }  
   $tweets .= '</ul></div></div>';
   return $tweets;	   
   }
   
// function used to get user recent Facebook Profile feed (Wall)
function get_fbupdates()
   {
   ini_set('session.gc_maxlifetime', 3600);
   session_cache_limiter ('private, must-revalidate'); 
   session_cache_expire(60); // in minutes 
   session_start();
   $facebook = $_SESSION['facebook']; 
   
   if (!$facebook)
      {
      $error .= '<h3>Session expired! Please refresh page to sign in again.</h3>';
	  return $error;
	  }
	   
   // call facebook graph API
   try {
	     //$movies = $facebook->api('/me/movies');
        $fbupdates = $facebook->api('/me/home');
        }
        catch(Exception $o){
            dump($o);
        }
	   
	   
   $updates = '<div id="fblist">';
   $updates .= '<h4>' .count($fbupdates->{"data"}). ' post(s) found. </h4>';
   $updates .= '<div style="overflow:auto; overflow-x: hidden; height:650px; width:100%; -moz-border-radius: 15px;">';
   $updates .= '<ul>';	
   
   // Create an array for caching user id and link/location mapping
   //$userLinkTable = array();
   //$userLocTable = array();
   
   //print_r($fbupdates->{"data"}[0]);
   
   foreach ($fbupdates->{"data"} as $fbupdate){
	     /*   
	     if (!isset($userLinkTable[$fbupdate->{"from"}->{"id"}]))
	        {
			$user = $facebook->api('/'.$fbupdate->{"from"}->{"id"}.'?fields=location,link');
			$userLink = $user->{"link"};
			$userLocation = $user->{'location'}->{'name'};
			$userLinkTable[$fbupdate->{"from"}->{"id"}] = $userLink;
			$userLocTable[$fbupdate->{"from"}->{"id"}] = $userLocation;
			}
	     else
		    {
		    $userLink = $userLinkTable[$fbupdate->{"from"}->{"id"}];
			$userLocation = $userLocTable[$fbupdate->{"from"}->{"id"}];
			}
		 */
		 // use facebook profile link to get the profile 
		 $userLink = 'http://www.facebook.com/profile.php?id='.$fbupdate->{"from"}->{"id"};
			
	     // get the post url
		 list($userid, $postid) = split('_', $fbupdate->{"id"});
		 
		 //$userLink = 'https://graph.facebook.com/'.$fbupdate->{"from"}->{"id"}.'?fields=link&access_token='.$facebook->getAccessToken();
	     $updates .= '<li><div class="grid-item flickr"><div class="grid-item-content">';
		 $streamit = 'FS:@'.$fbupdate->{"from"}->{"name"}.': ';
		 // parse facebook wall post
		 if ($fbupdate->{"type"} == "photo")
		    {
			$updates .= '<a target="_blank" href="'.$fbupdate->{"link"}.'"><img class="grid-item-avatar" style="width:45px; height:45px;" src="'.$fbupdate->{"picture"}.'"></a>';
			$updates .= '<span style="font-weight:bold">'.$fbupdate->{"name"}.'</span>';
			if (isset($fbupdate->{"caption"}))
			   $updates .= '<br/>'.parse_twitter(htmlspecialchars($fbupdate->{"caption"}));
			if (isset($fbupdate->{"description"}))   
			   $updates .= '<br/>'.parse_twitter(htmlspecialchars($fbupdate->{"description"}));
			if (isset($fbupdate->{"properties"}))
			   {
			   foreach ($fbupdate->{"properties"} as $property){
				  if (isset($property->{"href"}))
				     $updates .= '<br/><a target="_blank" href="'.$property->{"href"}.'">'.$property->{"name"}.': '.$property->{"text"}.'</a>';
				  else
			         $updates .= '<br/>'.$property->{"name"}.': '.$property->{"text"};
				  }
			   }
			$updates .= '<br/>';
			$streamit .= $fbupdate->{"name"}.' '.$fbupdate->{"description"}.' '.$fbupdate->{"link"};
			}
		 else if ($fbupdate->{"picture"} != NULL)
		    {
		    $updates .= '<a target="_blank" href="'.$fbupdate->{"link"}.'"><img class="grid-item-avatar" style="width:45px; height:45px;" src="'.$fbupdate->{"picture"}.'"></a>';
			if ($fbupdate->{"type"} != "link")
			   {
			   $updates .= '<span style="font-weight:bold">'.$fbupdate->{"name"}.'</span><br/>'.parse_twitter($fbupdate->{"description"}).'<br/>';
			   $streamit .= $fbupdate->{"name"}.' '.$fbupdate->{"description"}.' '.$fbupdate->{"link"};
			   }
			}
	     if (isset($fbupdate->{"message"}))
		    {
            $updates .= parse_twitter(htmlspecialchars($fbupdate->{"message"})).'<br/>';
			$streamit .= ' '.$fbupdate->{"message"};
			}
		 if ($fbupdate->{"type"} == "link")
		    {
			$updates .= '<a target="_blank" href="'.$fbupdate->{"link"}.'"><span style="font-weight:bold">'.$fbupdate->{"name"}.'</span></a>';
			if (isset($fbupdate->{"caption"}))
			   $updates .= '<br/>'.parse_twitter(htmlspecialchars($fbupdate->{"caption"}));
			if (isset($fbupdate->{"description"}))   
			   $updates .= '<br/>'.parse_twitter(htmlspecialchars($fbupdate->{"description"}));
			if (isset($fbupdate->{"properties"}))
			   {
			   foreach ($fbupdate->{"properties"} as $property){
				  if (isset($property->{"href"}))
				     $updates .= '<br/><a target="_blank" href="'.$property->{"href"}.'">'.$property->{"name"}.': '.$property->{"text"}.'</a>';
				  else
			         $updates .= '<br/>'.$property->{"name"}.': '.$property->{"text"};
				  }
			   }
			$updates .= '<br/>'; 
			$streamit .= $fbupdate->{"name"}.' '.$fbupdate->{"description"}.' '.$fbupdate->{"link"};
			}
			
		 $updates .= '<br/><div style="display:inline"><img src="../images/commentfb.PNG" alt="comment" style="width: 16px; height: 16px;"/><a target="_blank" href="http://www.facebook.com/'.$userid.'/posts/'.$postid.'">Comment('.($fbupdate->{"comments"}->{"count"}?$fbupdate->{"comments"}->{"count"}:0).')</a> | ';
		 $updates .= '<img src="../images/likefb.PNG" alt="like" style="width: 16px; height: 16px;"/><a target="_blank" href="http://www.facebook.com/'.$userid.'/posts/'.$postid.'">Like('.($fbupdate->{"likes"}?$fbupdate->{"likes"}:0).')</a></div>';
		 
		 // streamIt	 
	     $updates .= '<div align="right" style="font-size:90%"><img src="../images/fsicon2.png" alt="friendstream" style="width:13px; height:13px;"/><a href="javascript:void(0);" onclick="getShortUrl(\''.htmlspecialchars(addcslashes($streamit, "\n\r\'\""), ENT_QUOTES).'\')">StreamIt</a></div>';
	 
	     $updates .= '</div><div class="grid-item-meta">';
	     $updates .= '<a target="_blank" href="'.$userLink.'"><img class="grid-item-avatar" style="width:25px; height:25px;" src="http://graph.facebook.com/'.$fbupdate->{"from"}->{"id"}.'/picture"></a>';
         $updates .= '<a target="_blank" href="http://www.facebook.com"><img src="../images/facebook.gif" class="grid-service-icon" alt="Facebook"  style="width: 16px; height: 16px;"></a>';
	     $updates .= '<cite>Posted by <a target="_blank" href="'.$userLink.'">'.$fbupdate->{"from"}->{"name"}.'</a> via '.($fbupdate->{'attribution'} ? $fbupdate->{'attribution'} : 'facebook');
		 //if ($userLocation != NULL)
		   // $updates .= ' from '.$userLocation;
		 
		 $updates .='<br /><span class="grid-item-date">'.$fbupdate->{"created_time"}.'</span></cite>';
		 $updates .= '</div></div></li>';
					
   }
   $updates .= '</ul></div></div>';
      
   return $updates;	   
   }
   
// function used to get user recent Good buzzs from followees
function get_buzzs()
   {
   ini_set('session.gc_maxlifetime', 3600);
   session_cache_limiter ('private, must-revalidate'); 
   session_cache_expire(60); // in minutes 
   session_start();
   $buzzobj = $_SESSION['buzzobj'];  
   
   if (!$buzzobj)
      {
      $error .= '<h3>Session expired! Please refresh page to sign in again.</h3>';
	  return $error;
	  }
   
   // call Google buzz API
   // fetch authenticated user's public feed
   $result = $buzzobj->getPosts('@consumption', '@me', 16, 16, 36);
	
   $buzzUpdates = '<div id="buzzlist">';
   $buzzUpdates .= '<h4>' .count($result->posts). ' buzz(s) found. </h4>';
   $buzzUpdates .= '<div style="overflow:auto; overflow-x: hidden; height:650px; width:100%; -moz-border-radius: 15px;">';
   $buzzUpdates .= '<ul>';
   
   //print_r($result->posts[0]);
   
   foreach ($result->posts as $post){
		  
     $buzzUpdates .= '<li><div class="grid-item google_reader"><div class="grid-item-content">'; 
     $buzzUpdates .= $post->object->content;
	 // streamIt
	 $streamIt = 'FS:@'.$post->person->name.' '.$post->title;
	 
	 // handle attachments
	 $photoContent = $articleContent = $videoContent = '';
  if (isset($post->object->attachments)) {
    foreach ($post->object->attachments as $attachment) {
      switch ($attachment->type) {
        case 'article':
          $aTitle = isset($attachment->title) ? $attachment->title : null;
          $aContent = isset($attachment->content) ? $attachment->content : null;
          $aLink = isset($attachment->links['alternate'][0]->href) ? $attachment->links['alternate'][0]->href : null;
          $articleContent .= "<p><a target=\"_blank\" href=\"$aLink\">$aTitle</a> $aContent</p><br/>";
		  $buzzUpdates .= $articleContent;
		  $streamIt .= ' '.$aTitle.' '.$aContent;
		  if ($aLink)
		     $streamIt .= ' '.$aLink;
          break;
        case 'photo':
          $url = isset($attachment->links['preview'][0]->href) ? $attachment->links['preview'][0]->href : null;
          $enclosure = isset($attachment->links['enclosure'][0]->href) ? $attachment->links['enclosure'][0]->href : null;
          //$onClick = $enclosure ? " onClick=\"window.location='$enclosure'\"" : '';
          //FIXME need to add proper click cursor here!
          //$photoContent .= "<div $onClick class=\"photo\" style=\"background-image : url(" . htmlentities($url) . ");\"></div>";
		  $photoContent = '<div><a href="javascript:void(0);"><img onmouseover="imgpreloader(\''.$enclosure.'\')" class="weiboimg" style="width:100%;height:100%" onclick="zC(\''.$enclosure.'\')" src="'.$url.'"/></a></div>';
		  $buzzUpdates .= $photoContent;
		  $streamIt .= '[img]'.$enclosure.' ';
          break;
        case 'photo-album':
          if (isset($attachment->links['alternate'][0]->href)) {
            $articleContent .= "<br><br><a target=\"_blank\" href=\"{$attachment->links['alternate'][0]->href}\">{$attachment->title}</a><br>";
          }
          if (isset($attachment->content)) {
            $articleContent .= $attachment->content . "<br>";
          }
		  $buzzUpdates .= $articleContent;
          break;
        case 'video':
          $flashUrl = isset($attachment->links['alternate'][0]->href) ? str_replace('&autoplay=1', '', $attachment->links['alternate'][0]->href) : null;
          $videoContent .= "
  			<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' width=100% height=\"180\" id='player1' name='player1'>
    				<param name='movie' value='../jwflvplayer/player-viral.swf'>
                    <param name='allowfullscreen' value='true'>
                    <param name='allowscriptaccess' value='always'>
                    <param name='allownetworking' value='all'>
                    <param name='wmode' value='opaque'>
					<param name='flashvars' value=\"file=$flashUrl\">
    				<embed id='player1' name='player1' src='../jwflvplayer/player-viral.swf' flashvars=\"file=$flashUrl\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=100% height=\"180\"></embed>
  			</object>\n";
		  $buzzUpdates .= $videoContent;	
          break;
        default:
          $content = "<span class=\"error\">Unsupported attachment type:</span><pre>\n".print_r($attachment, true)."</pre>";
		  $buzzUpdates .= $content;
      }
    }
  }
	 
	 
	 // emit likes 
	 if (isset($post->liked) && count($post->liked)) {
        $implode = array();
	    //$buzzUpdates .= '<p>Like('.count($post->liked).')</p>';
        foreach ($post->liked as $person) {
          $implode[] = "<a href=\"$person->profileUrl\" target=\"_blank\">{$person->name}</a>";
        }
        $buzzUpdates .= "<div><img src=\"../images/like-selected.gif\" style=\"width: 16px; height: 16px;\">".count($implode)." people liked this: ".implode(', ', $implode)."</div>";
        }

     // emit comments
	 if (isset($post->comments) && count($post->comments)) {
        $buzzUpdates .= '<p style="color:#000"><strong>Comments('.count($post->comments).')</strong></p>';
	    foreach ($post->comments as $comment) {
          $buzzUpdates .= "<div><a target=\"_blank\" class=\"person\" href=\"{$comment->person->profileUrl}\"><img src=\"{$comment->person->thumbnailUrl}\" style=\"width: 20px; height: 20px;\">{$comment->person->name}</a> - {$comment->content} <span style=\"font-size:10px\">($comment->published)</span></div>";
        }
     }
	 
	 // show original buzz link for comment and like
	 if (count($post->links['alternate']) > 0)
	    {
		if ((isset($post->liked) && count($post->liked)) || (isset($post->comments) && count($post->comments)))
		   $buzzUpdates .= '<br/>';
		else if (!$articleContent)
		   $buzzUpdates .= '<br/><br/>';
		$buzzUpdates .= '<div style="display:inline">';
		$buzzUpdates .= '<img src="../images/comment.PNG" alt="comment"/><a target="_blank" href="'.$post->links['alternate'][0]->href.'"">Comment('.count($post->comments).')</a> | ';
		$buzzUpdates .= '<img src="../images/like-deselected.gif" alt="like"/><a target="_blank" href="'.$post->links['alternate'][0]->href.'">Like('.count($post->liked).')</a></div>';
		$streamIt .= ' '.$post->links['alternate'][0]->href;
		}
	 
	 // streamIt	 
	 $buzzUpdates .= '<div align="right" style="font-size:90%"><img src="../images/fsicon2.png" alt="friendstream" style="width:13px; height:13px;"/><a href="javascript:void(0);" onclick="getShortUrl(\''.htmlspecialchars(addcslashes($streamIt, "\n\r\'\""), ENT_QUOTES).'\')">StreamIt</a></div>';
	 
	 $buzzUpdates .= '</div><div class="grid-item-meta">';
	 $buzzUpdates .= '<a target="_blank" href="'.$post->person->profileUrl.'"><img class="grid-item-avatar" style="width:25px; height:25px;" src="'.$post->person->thumbnailUrl.'"></a>';
     $buzzUpdates .= '<a target="_blank" href="http://www.google.com/buzz"><img src="../images/buzz.png" class="grid-service-icon" alt="Google Buzz"  style="width: 16px; height: 16px; background-color:#b6b6b6;"></a>';
	 $buzzUpdates .= '<cite>Buzzed by <a target="_blank" href="'.$post->person->profileUrl.'">'.$post->person->name.'</a> via '.$post->sourceTitle;
	 
	 $buzzUpdates .= '<br /><span class="grid-item-date">'.$post->published.'</span></cite>';
	 $buzzUpdates .= '</div></div></li>';				
   }
   $buzzUpdates .= '</ul></div></div>';
      
   return $buzzUpdates;	   
   }



// function used to get recent weibos for the user
function get_weibos()
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
   //$wb  = $weibo->home_timeline(); // done
   $wb  = $weibo->friends_timeline(); // done

   //print_r($wb);
   
   $weibos = '<div id="weibolist">';
   $weibos .= '<h4>' . count($wb) . ' (条)微博. </h4>';
   $weibos .= '<div style="overflow:auto; overflow-x: hidden; height:650px; width:100%; -moz-border-radius: 15px;">';
   $weibos .= '<ul>';
   foreach($wb as $status){
	     $retweeted_status = $status->{'retweeted_status'};
		 $user = $status->{'user'};
	     $weibos .= '<li><div class="grid-item weibo"><div class="grid-item-content">';
         $weibos .= (parse_weibo(htmlspecialchars($status->{'text'})));
		 $streamit = 'FS:@'.$user->{'name'}.': '.$status->{'text'};
		 if ($status->{'thumbnail_pic'} != NULL)
		    {
			$weibos .= '<br/><a href="javascript:void(0);"><img onmouseover="imgpreloader(\''.$status->{'bmiddle_pic'}.'\')" class="weiboimg" onclick="zC(\''.$status->{'bmiddle_pic'}.'\')" src="'.$status->{'thumbnail_pic'}.'"/></a>';
			$streamit .= ' [img]'.$status->{'bmiddle_pic'};
		    }
		 
	     $weibos .= '<br/><img src="../images/weibo_64x64.png" width="16px" height="16px" alt="weibo" /><a target="_blank" href="http://api.t.sina.com.cn/'.$user->{'id'}.'/statuses/'.$status->{'id'}.'">微博地址</a>';
		 
		 if ($retweeted_status != NULL)
		    {
		    $streamit .= ' RT@'.$retweeted_status->{'user'}->{'name'}.': '.'http://api.t.sina.com.cn/'.$retweeted_status->{'user'}->{'id'}.'/statuses/'.$retweeted_status->{'id'};
			$weibos .= '<br/><div class="retweet"><img src="../images/wall post.png" width="16px" height="16px" alt="zhuanfa" />';
			$weibos .= '<a target="_blank" href="http://t.sina.com.cn/'.$retweeted_status->{'user'}->{'id'}.'">@'.$retweeted_status->{'user'}->{'name'}.'</a>';			
			if ($retweeted_status->{'user'}->{'verified'})
			   $weibos .= '<img src="../images/icon_vip.gif" alt="vip" width="20px" height="13px" />';
			
			$weibos .=  ': '.(parse_weibo(htmlspecialchars($retweeted_status->{'text'})));
			if ($retweeted_status->{'thumbnail_pic'} != NULL)
		       {
			   $weibos .= '<br/><a href="javascript:void(0);"><img onmouseover="imgpreloader(\''.$retweeted_status->{'bmiddle_pic'}.'\')" class="weiboimg" onclick="zC(\''.$retweeted_status->{'bmiddle_pic'}.'\')" src="'.$retweeted_status->{'thumbnail_pic'}.'"/></a>';	
		       }
			$weibos .= '</div>';	
			}
	     else
		    $weibos .= '<br/>';
			
			//repostPopUp('http://tp4.sinaimg.cn/1880690955/50/1291316522/1','//@yehenrytian:测试空格 转发 因','','6963646225',0)

	     $weibos .= '<div align="right" style="font-size:90%"><img src="../images/icon-twitter-retweet.png" alt="retweet" style="width:13px; height:13px;"/><a href="javascript:void(0);" onclick="repostPopUp(\''.htmlspecialchars(addcslashes($user->{'profile_image_url'}, "\n\r\'\""), ENT_QUOTES).'\',\''.htmlspecialchars(addcslashes('//@'.$user->{'name'}.':'.$status->{'text'}, "\n\r\'\""), ENT_QUOTES).'\',\''.(($retweeted_status != NULL) ? ('//@'.$retweeted_status->{'user'}->{'name'}.':'.htmlspecialchars(addcslashes($retweeted_status->{'text'}, "\n\r\'\""), ENT_QUOTES)):"").'\',\''.$status->{'id'}.'\','.(($retweeted_status != NULL) ? '\''.$retweeted_status->{'id'}.'\'':0).')">转发</a> | <img src="../images/comment-icon.png" alt="retweet" style="width:13px; height:13px;"/><a href="javascript:void(0);" onclick="commentPopUp(\''.htmlspecialchars(addcslashes($user->{'profile_image_url'}, "\n\r\'\""), ENT_QUOTES).'\',\''.'@'.$user->{'name'}.':'.htmlspecialchars(addcslashes($status->{'text'}, "\n\r\'\""), ENT_QUOTES).'\',\''.(($retweeted_status != NULL) ? ('//@'.$retweeted_status->{'user'}->{'name'}.':'.htmlspecialchars(addcslashes($retweeted_status->{'text'}, "\n\r\'\""), ENT_QUOTES)):"").'\',\''.$status->{'id'}.'\','.(($retweeted_status != NULL) ? '\''.$retweeted_status->{'id'}.'\'':0).')">评论</a>';
		 
		 $weibos .= ' | <img src="../images/fsicon2.png" alt="friendstream" style="width:13px; height:13px;"/><a href="javascript:void(0);" onclick="getShortUrl(\''.htmlspecialchars(addcslashes($streamit, "\n\r\'\""), ENT_QUOTES).'\')">广播转发</a></div>';
		 
		 
		 $weibos .= '</div><div class="grid-item-meta">';
	     $weibos .= '<a target="_blank" href="http://t.sina.com.cn/'.$user->{'id'}.'"><img class="grid-item-avatar" style="width:25px; height:25px;" src="'.$user->{'profile_image_url'}.'"></a>';
         $weibos .= '<a target="_blank" href="http://t.sina.com.cn"><img src="../images/weibo128.png" class="grid-service-icon" alt="Weibo"  style="width: 16px; height: 16px;"></a>';
	     $weibos .= '<cite>发布者: <a target="_blank" href="http://t.sina.com.cn/'.$user->{'id'}.'">'.$user->{'name'}.'</a>';
		 if ($user->{'verified'})
			 $weibos .= '<img src="../images/icon_vip.gif" alt="vip" width="20px" height="13px" />';
		 
		 $weibos .= ' 来自 '.$status->{'source'};
		 if ($user->{'location'} != NULL)
		    $weibos .= ' 地点: '.$user->{'location'}.'<br /><span class="grid-item-date">'.$status->{'created_at'}.'</span></cite>';
	     else
		    $weibos .= '<br /><span class="grid-item-date">'.$status->{'created_at'}.'</span></cite>';

     $weibos .= '</div></div></li>';
     }  
   $weibos .= '</ul></div></div>';
   return $weibos;	   
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

// function used to parse sina weibo
function parse_weibo($t) 
  {
   // link URLs
   $t = " ".preg_replace( "/(([[:alnum:]]+:\/\/)|www\.)([^[:space:]]*)".
	       "([[:alnum:]#?\/&=])/i", "<a href=\"\\1\\3\\4\" target=\"_blank\">".
	        "\\1\\3\\4</a>", $t);
	 
   // link mailtos
   $t = preg_replace( "/(([a-z0-9_]|\\-|\\.)+@([^[:space:]]*)".
	        "([[:alnum:]-]))/i", "<a href=\"mailto:\\1\">\\1</a>", $t);
	 
   //link Sina users
   $t = preg_replace( "/ *@([\x{4e00}-\x{9fa5}A-Za-z0-9_]*) ?/u", " <a href=\"http://t.sina.com.cn/n/\\1\" target=\"_blank\">@\\1</a> ", $t);
		
        //$t = preg_replace( "/ *@[\x{4e00}-\x{9fa5}A-Za-z0-9_]+/ue ", " '<a href=\"http://t.sina.com.cn/n/\\1\" target=\"_blank\">@'.utf8_decode('\\1').'</a>' ", $t);
        
		/*
        $pregstr = "/[\x{4e00}-\x{9fa5}]+/u";
        if (preg_match("/ *@[\x{4e00}-\x{9fa5}A-Za-z0-9_]+/u ",$t,$matchArray)){
            //echo $matchArray[0];
           }*/
	 
	//link sina hot topics
	$t = preg_replace( "/ *#([\x{4e00}-\x{9fa5}A-Za-z0-9_]*)# ?/u", " <a href=\"http://t.sina.com.cn/k/\\1\" target=\"_blank\">#\\1#</a> ", $t);
	 
	// truncates long urls that can cause display problems (optional)
	$t = preg_replace("/>(([[:alnum:]]+:\/\/)|www\.)([^[:space:]]".
	        "{30,40})([^[:space:]]*)([^[:space:]]{10,20})([[:alnum:]#?\/&=])".
	        "</", ">\\3...\\5\\6<", $t);
	return trim($t);
   }

function genChineseNameUrl($cName)
   {
   echo $cName;
   $utf8Name = utf8_decode($cName);
   echo($utf8Name);
   return ('<a href="http://t.sina.com.cn/n/'.$utf8Name.'" target="_blank\">@'.utf8Name.'</a>'); 
   }

// function used to parse twitter tweets
function parse_twitter($t) 
  {
	    // link URLs
	    $t = " ".preg_replace( "/(([[:alnum:]]+:\/\/)|www\.)([^[:space:]]*)".
	        "([[:alnum:]#?\/&=])/i", "<a href=\"\\1\\3\\4\" target=\"_blank\">".
	        "\\1\\3\\4</a>", $t);
	 
	    // link mailtos
	    $t = preg_replace( "/(([a-z0-9_]|\\-|\\.)+@([^[:space:]]*)".
	        "([[:alnum:]-]))/i", "<a href=\"mailto:\\1\">\\1</a>", $t);
	 
	    //link twitter users
	    $t = preg_replace( "/ *@([a-z0-9_]*) ?/i", " <a href=\"http://twitter.com/\\1\" target=\"_blank\">@\\1</a> ", $t);
	 
	    //link twitter arguments
	    $t = preg_replace( "/ *#([a-z0-9_]*) ?/i", " <a href=\"http://twitter.com/search?q=%23\\1\" target=\"_blank\">#\\1</a> ", $t);
	 
	    // truncates long urls that can cause display problems (optional)
	    $t = preg_replace("/>(([[:alnum:]]+:\/\/)|www\.)([^[:space:]]".
	        "{30,40})([^[:space:]]*)([^[:space:]]{10,20})([[:alnum:]#?\/&=])".
	        "</", ">\\3...\\5\\6<", $t);
	    return trim($t);
   }   
   
// function used to echo sidebar
function echo_sidebar()
  {
  $sidebar = '
  <ul>
<li>
<a target="_blank" href="http://twitter.com/yehenrytian"><img src="../images/twitter-button.png" width="150" height="56" alt="follow me" /></a>
</li>
<li>
<p>
<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://friendstream.ca" layout="box_count" font="arial"></fb:like>
</p>
</li>
<li>
<br/>
<p>
<a title="Post to Google Buzz" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="normal-count"></a>
<script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>
</p>
</li>
<li>
<br/>
<p>
<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical" data-via="yehenrytian">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
</p>
</li>
<li>
<br/>
 <!-- Include the Google Friend Connect javascript library. -->
<script type="text/javascript" src="http://www.google.com/friendconnect/script/friendconnect.js"></script>
<!-- Define the div tag where the gadget will be inserted. -->
<div id="div-8048205862728875412" style="width:180px;border:1px solid #cccccc;"></div>
<!-- Render the gadget into a div. -->
<script type="text/javascript">
var skin = {};
skin[\'BORDER_COLOR\'] = \'#cccccc\';
skin[\'ENDCAP_BG_COLOR\'] = \'#e0ecff\';
skin[\'ENDCAP_TEXT_COLOR\'] = \'#333333\';
skin[\'ENDCAP_LINK_COLOR\'] = \'#0000cc\';
skin[\'ALTERNATE_BG_COLOR\'] = \'#ffffff\';
skin[\'CONTENT_BG_COLOR\'] = \'#ffffff\';
skin[\'CONTENT_LINK_COLOR\'] = \'#0000cc\';
skin[\'CONTENT_TEXT_COLOR\'] = \'#333333\';
skin[\'CONTENT_SECONDARY_LINK_COLOR\'] = \'#7777cc\';
skin[\'CONTENT_SECONDARY_TEXT_COLOR\'] = \'#666666\';
skin[\'CONTENT_HEADLINE_COLOR\'] = \'#333333\';
skin[\'NUMBER_ROWS\'] = \'4\';
google.friendconnect.container.setParentUrl(\'/smartpage/\' /* location of rpc_relay.html and canvas.html */);
google.friendconnect.container.renderMembersGadget(
 { id: \'div-8048205862728875412\',
   site: \'15178007209702352684\' },
  skin);
</script>
    </li>
    <li>
    <br/>
    <iframe src="http://www.ebuddy.com/widgets/loginbox/custom_login.html?version=small" scrolling="no" frameborder="0"  style="width: 200px; height: 250px;"></iframe>
    </li>
    <li>
    <br/>
    <a href="http://s03.flagcounter.com/more/EzF"><img src="http://s03.flagcounter.com/count/EzF/bg=FFFFFF/txt=075FF7/border=0C9FCC/columns=2/maxflags=12/viewers=0/labels=1/pageviews=1/" alt="free counters" border="0"></a>
    </li>
</ul>
  ';

   return $sidebar;
   }
   
?>