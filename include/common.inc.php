<?php

$htmlhead = '
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
</head>';


$google2SideAds = '
<div align="center" id="adleftsidebar">
<script type="text/javascript">
google_ad_client = "pub-6635598879568444";
/* 120x600Sidebar, created 1/15/09 */
google_ad_slot = "0594443114";
google_ad_width = 120;
google_ad_height = 600;
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
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
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>';

$googleFooterAds = '
<br/>
<br/>
<div align="center">
<script type="text/javascript">
google_ad_client = "pub-6635598879568444";
/* 728x90footer, created 1/15/09 */
google_ad_slot = "7642261806";
google_ad_width = 728;
google_ad_height = 90;
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
';

// Function for remove file extension
function removeextension($strName)
   {
   $ext = strrchr($strName, '.');

   if ($ext !== false)
      {
      $strName = substr($strName, 0, -strlen($ext));
      }

   return $strName;
   }

// populate video info method
function populatevideoinfo($updateviewcount)
   {
   global $video_id, $videotitle, $videosource, $videothumb, $videoauthor, $videodescription, $videoaddedtime, $views_count;

   // Make a MySQL Connection
   //$db = mysql_connect("SQL06.FREEMYSQL.NET", "firsttimer", "firsttimer22") or die(mysql_error());

   // read Chinese properly
   //mysql_query("SET NAMES 'UTF8'") or die(mysql_error());

   //mysql_select_db("ftdb", $db) or die(mysql_error());

   $videosource = trim($videosource);
   $videosource .= ".flv";

   //echo "$videosource<br>";
   // query table

   if ($videosource)
      {	  
      $result = mysql_query("select * from ft_ftvideos where source='" . $videosource . "'");
      if ($myrow = mysql_fetch_array($result))
	     {
	     $videotitle = $myrow[title];
	     $videoauthor = $myrow[author];
	     $videodescription = $myrow[description];
	     $videoaddedtime = $myrow[date_added];
		 $views_count = $myrow[views_count];
		 $video_id = $myrow[videoid];
		 
		 // Increase views_count at the end
		 if ($updateviewcount == true)
	        mysql_query("UPDATE ft_ftvideos SET views_count = views_count + 1 WHERE source='" . $videosource . "'") or die(mysql_error());
		 
	     $videothumb = "../ftvideos/thumbs/" . $myrow[thumb];
	     $videosource = "../ftvideos/" . $myrow[source];		
		 }
	  else
		 {
	     header("Location: ../404.html");
		 exit();	
		 }

	    //echo "$videothumb<br>";
      }
   }



// populate video list method
function populatevideolist($condition, $col)
   {
   global $videotitle, $videosource, $videothumb, $videoauthor, $videodescription, $videoaddedtime;

   // Make a MySQL Connection
   //$db = mysql_connect("SQL06.FREEMYSQL.NET", "firsttimer", "firsttimer22") or die(mysql_error());

   // read Chinese properly
   //mysql_query("SET NAMES 'UTF8'") or die(mysql_error());

   //mysql_select_db("ftdb", $db) or die(mysql_error());
   
   // return table html code
   $videolist = '
                <table cellspacing="3" cellpadding="0" border="0" bgcolor="#999999" width="100%" height="100%">
				<tbody>
				<tr>';

   // query table
   if ($condition != NULL)
      {
      $result = mysql_query("select * from ft_ftvideos order by " . $condition . " desc") or die(mysql_error());

	  if ($myrow = mysql_fetch_array($result))
	     {
		 $counter = 0;

	     do{
		   $videotitle = $myrow[title];
	       $videoauthor = $myrow[author];
	       $videodescription = $myrow[description];
	       $videoaddedtime = $myrow[date_added];
	       $videothumb = "../ftvideos/thumbs/" . $myrow[thumb];
	       $videosource = $myrow[source];

		   $videolist .='
           <td width="5%" valign="top" align="left" style="font-size: 10px; font-weight: bold; color: #333333;">
<div id="watermark_box"><a href="../jwflvplayer/showvideo.php?video=' . removeextension($videosource) . '" target="_parent" title="' . $videotitle . '">
<img src="' . $videothumb . '" width="120" height="100" border="1"/><img src="../images/icons/btn-play.png" height=24, width=22 class="watermark" /></a></div><br />Title: ' . $videotitle .  '<br />Author: <a id="ftlink" href="../htmltemplates/useraccount.php?accountname=' . $videoauthor .'" target="_parent" title="See ' . $videoauthor."'s" . ' profile">' . $videoauthor . '</a><br />Date added: ' . $videoaddedtime . '<br />Video description:<br />' . $videodescription . '<br /></td>';

	       $counter++;

		   if ($counter % $col == 0)
		      {
			  $videolist .='</tr><tr><td>&nbsp;&nbsp;</td></tr><tr>';
			  }

           //printf("<a href="show.php?id=%s">%s %s</a><br>n",$myrow["id"],$myrow["first"],$myrow["last"]);
           }while ($myrow = mysql_fetch_array($result)) ;
         }
      else
         echo "Error: No Video Found!<br>";

	  $videolist .= '
	                </tr>
	                </tbody>
                    </table>';

	  //echo "$condition<br>";
	  //echo "$videosource<br>";
	  //echo "$videothumb<br>";
      }

   return $videolist;
   }
   
   
// populate user video list method
function populateuservideolist($username, $col)
   {
   //global $videotitle, $videosource, $videothumb, $videoauthor, $videodescription, $videoaddedtime;

   // return table html code
   $videolist = '
                <table cellspacing="3" cellpadding="0" border="0" bgcolor="#999999" width="100%" height="100%">
				<tbody>
				<tr>';

   // query table
   if ($username != NULL)
      {
      $result = mysql_query("select * from ft_ftvideos where author = '$username' order by date_added desc") or die(mysql_error());

	  if ($myrow = mysql_fetch_array($result))
	     {
		 $counter = 0;

	     do{
		   $videotitle = $myrow[title];
	       $videoauthor = $myrow[author];
	       $videodescription = $myrow[description];
	       $videoaddedtime = $myrow[date_added];
	       $videothumb = "../ftvideos/thumbs/" . $myrow[thumb];
	       $videosource = $myrow[source];

		   $videolist .='
           <td width="5%" valign="top" align="left" style="font-size: 10px; font-weight: bold; color: #333333;">
<div id="watermark_box"><a href="../jwflvplayer/showvideo.php?video=' . removeextension($videosource) . '" target="_parent" title="' . $videotitle . '">
<img src="' . $videothumb . '" width="120" height="100" border="1"/><img src="../images/icons/btn-play.png" height=24, width=22 class="watermark" /></a></div><br />Title: ' . $videotitle .  '<br />Author: <a id="ftlink" href="../htmltemplates/useraccount.php?accountname=' . $videoauthor .'" target="_parent" title="See ' . $videoauthor."'s" . ' profile">' . $videoauthor . '</a><br />Date added: ' . $videoaddedtime . '<br />Video description:<br />' . $videodescription . '<br /></td>';

	       $counter++;

		   if ($counter % $col == 0)
		      {
			  $videolist .='</tr><tr><td>&nbsp;&nbsp;</td></tr><tr>';
			  }

           }while ($myrow = mysql_fetch_array($result)) ;
         }
      else
         $videolist .= '<td width="5%" valign="top" align="left" style="font-size: 12px; font-weight: bold; color: #333333;">No video uploaded!</td>';

	  $videolist .= '
	                </tr>
	                </tbody>
                    </table>';
      }

   return $videolist;
   }
   
// populate user comment list method
function populateusercommentlist($username)
   {
   //global $videotitle, $videosource, $videothumb, $videoauthor, $videodescription, $comment_text, $post_date;

   // return table html code
   $commentlist = '
                <table cellspacing="3" cellpadding="0" border="0" bgcolor="#999999" width="100%" height="100%">
				<tbody>
				<tr>';

   // query table
   if ($username != NULL)
      {
      $result = mysql_query("select * from ft_ftvideocomments where username = '$username' order by videoid desc") or die(mysql_error());

	  if ($myrow = mysql_fetch_array($result))
	     {
		 //$counter = 0;
         $current_video_id = 0;
		 
	     do{
		   $video_id = $myrow[videoid];
	       $user_name = $myrow[username];
	       $comment_text = $myrow[comment_text];
	       $post_date = $myrow[post_date];
		   if ($current_video_id != $video_id)
		      {
			  $current_video_id = $video_id;
			  $video_result = mysql_query("select * from ft_ftvideos where videoid = '$current_video_id'") or die(mysql_error());
			  if ($myrow = mysql_fetch_array($video_result))
			     {
				 $videotitle = $myrow[title];
	             $videodescription = $myrow[description];
				 $videoauthor = $myrow[author];
	             $videoaddedtime = $myrow[date_added];
				 $videothumb = "../ftvideos/thumbs/" . $myrow[thumb];
				 $videosource = $myrow[source];
				 }
			  
			  // insert video info
			  $commentlist .='
                  <td><div id="watermark_box"><a href="../jwflvplayer/showvideo.php?video=' . removeextension($videosource) . '" target="_parent" title="' . $videotitle . '">
<img src="' . $videothumb . '" width="120" height="100" border="1"/><img src="../images/icons/btn-play.png" height=24, width=22 class="watermark" /></a></div></td>
				  <td align="left" style="font-size: 10px; font-weight: bold; color: #FFFFFF;">Comments added for video: ' . $videotitle . '<br />Author: <a id="ftlink" href="../htmltemplates/useraccount.php?accountname=' . $videoauthor .'" target="_parent" title="See ' . $videoauthor."'s" . ' profile">' . $videoauthor . '</a><br />Date added: ' . $videoaddedtime . '<br /><div style="width: 410px; height: 55px; overflow: auto">Description: ' . $videodescription . '</div></td>
                  </tr>
				  <tr>';
			  }       

		   $commentlist .='
		   <td></td>
           <td width="5%" valign="top" align="left" style="font-size: 10px; font-weight: bold; color: #333333;">
           <div style="border: 1px solid #CCCCCC; width: 420px; height: 60px; overflow: auto; font-size: 10px; -moz-border-radius: 8px">
		   <p></p>
		   <span style="font-size: 10px">User: <a id="ftlink" href="../htmltemplates/useraccount.php?accountname=' . $user_name . '" target="_parent" title="See ' . $videoauthor."'s" . ' profile">' . $user_name .'</a>  |  Posted: ' . $post_date . '</span><br /><br />' . $comment_text . '</div></td>';

	       //$counter++;

		   $commentlist .='</tr><tr><td></td></tr><tr>';

           }while ($myrow = mysql_fetch_array($result)) ;
         }
      else
         $commentlist .= '<td width="5%" valign="top" align="left" style="font-size: 12px; font-weight: bold; color: #333333;">No video comments added!</td>';

	  $commentlist .= '
	                </tr>
	                </tbody>
                    </table>';
      }

   return $commentlist;
   }
   
// manage user comment list method
function manageusercommentlist($username)
   {
   // return table html code
   $commentlist = "";

   // query table
   if ($username != NULL)
      {
      $result = mysql_query("select * from ft_ftvideocomments where username = '$username' order by videoid desc") or die(mysql_error());

	  if ($myrow = mysql_fetch_array($result))
	     {
		 //$counter = 0;
         $current_video_id = 0;
		 
	     do{
		   $comment_id = $myrow[comment_id];
		   $video_id = $myrow[videoid];
	       $user_name = $myrow[username];
	       $comment_text = $myrow[comment_text];
	       $post_date = $myrow[post_date];
		   if ($current_video_id != $video_id)
		      {
			  $current_video_id = $video_id;
			  $video_result = mysql_query("select * from ft_ftvideos where videoid = '$current_video_id'") or die(mysql_error());
			  if ($myrow = mysql_fetch_array($video_result))
			     {
				 $videotitle = $myrow[title];
	             $videodescription = $myrow[description];
				 $videoauthor = $myrow[author];
	             $videoaddedtime = $myrow[date_added];
				 $videothumb = "../ftvideos/thumbs/" . $myrow[thumb];
				 $videosource = $myrow[source];
				 }
			  
			  // insert video info
			  $commentlist .='
                  <td><div id="watermark_box"><a href="../jwflvplayer/showvideo.php?video=' . removeextension($videosource) . '" target="_parent" title="' . $videotitle . '">
<img src="' . $videothumb . '" width="120" height="100" border="1"/><img src="../images/icons/btn-play.png" height=24, width=22 class="watermark" /></a></div></td>
				  <td align="left" style="color: #FFFFFF; font-weight: bold; font-size:10px;">Comments added for video: ' . $videotitle . '<br />Author: <a id="ftlink" href="../htmltemplates/useraccount.php?accountname=' . $videoauthor .'" target="_parent" title="See ' . $videoauthor."'s" . ' profile">' . $videoauthor . '</a><br />Date added: ' . $videoaddedtime . '<br /><div style="width: 410px; height: 55px; overflow: auto">Description: ' . $videodescription . '</div></td>
                  </tr>
				  <tr>';
			  }       

		   $commentlist .='
		   <td align="center"><input type="checkbox" name="comment' . $comment_id . '" value="' . $comment_id . '"/></td>
           <td valign="top" align="left" style="font-size: 10px; font-weight: bold; color: #333333;">
           <div style="border: 1px solid #CCCCCC; width: 420px; height: 60px; overflow: auto; font-size: 10px; -moz-border-radius: 8px">
		   <p></p>
		   <span style="font-size: 10px">User: ' . $user_name . '  |  Posted: ' . $post_date . '</span><br /><br />' . $comment_text . '</div></td>
		   <td><a href="#" onclick="createselectedlist(' . $comment_id . ');" title="Delete this comment"><img src="../images/icons/cancel.png" alt="remove" width="24" height="24" border="0" /></a></td>';

	       //$counter++;

		   $commentlist .='</tr><tr><td></td></tr><tr>';

           }while ($myrow = mysql_fetch_array($result)) ;
         }
      else
         $commentlist .= '<td width="5%" valign="top" align="left" style="font-size: 12px; font-weight: bold; color: #333333;">No video comments added!</td>';

      }

   return $commentlist;
   }   
   

// populate user info method
function populateuserinfo($user)
   {
   // Populate user INFO
   global $email, $aboutme, $sex, $dob, $showdob, $country, $icon_id, $join_date, $totalvideos, $totalcomments;
   $username = "";

   // Make a MySQL Connection
   //$db = mysql_connect("SQL06.FREEMYSQL.NET", "firsttimer", "firsttimer22") or die(mysql_error());
   // read Chinese properly
  // mysql_query("SET NAMES 'UTF8'") or die(mysql_error());
   //mysql_select_db("ftdb", $db) or die(mysql_error());

   // read-in parameter
   $username = $user;
   
   // query table
   if ($username)
      {
      $result = mysql_query("select * from ft_users where username='" . $username . "'");
      if ($myrow = mysql_fetch_array($result))
	     {
	     $videotitle = $myrow[title];
	     $email = $myrow[email];
	     $aboutme = $myrow[about_me];
	     $sex = $myrow[sex];
		 $dob = $myrow[dob];
	     $showdob = $myrow[show_dob];
	     $country = $myrow[country];
		 $icon_id = $myrow[icon_id];
	     $join_date = $myrow[join_date];
	     $totalvideos = $myrow[total_videos];
		 $totalcomments = $myrow[total_comments];
		 }
	  else
	     {
	     header("Location: ../login&register/login.php?msg=User name does not exist!");
		 exit();
		 }
      }
   else
      {
      header("Location: ../login&register/login.php?msg=User name empty!");
	  exit();
	  }  
   }
   
   
// populate video comment list method
function populatevideocommentlist($videoid)
   {
   // return table html code
   $commentlist = '
                <table cellspacing="3" cellpadding="0" border="0" bgcolor="#999999" width="100%" height="auto">
				<tbody>
				<tr>';

   // query table
   if ($videoid != NULL && $videoid != 0)
      {
      $result = mysql_query("select * from ft_ftvideocomments where videoid = '$videoid' order by post_date desc") or die(mysql_error());

	  if ($myrow = mysql_fetch_array($result))
	     {
		 // Populate video comments count
         $videocommentscount = mysql_num_rows($result);
         mysql_query("UPDATE ft_ftvideos SET comments_count = '$videocommentscount' WHERE videoid = '$video_id'") or die(mysql_error());
		 
		 $commentlist .='
		       <th colspan="1" style="color: #0066CC; font-size: 12px; font-weight:bold;">Total comments: ' . $videocommentscount . '</th>
               </tr><tr>';
	     do{
		   $username = $myrow[username];
	       $videocoment = $myrow[comment_text];
	       $postdate = $myrow[post_date];
	      

		   $commentlist .='
           <td valign="top" align="left" style="font-size: 10px; font-weight: bold; color: #333333;">
           <div style="border: 1px solid #CCCCCC; width: 420px; height: 60px; overflow: auto; font-size: 10px; -moz-border-radius: 8px">
		   <p></p>
		   <span style="font-size: 10px">User: <a id="ftlink" href="../htmltemplates/useraccount.php?accountname=' . $username . '" target="_parent" title="See ' . $videoauthor."'s" . ' profile">' . $username .'</a> |  Posted: ' . $postdate . '</span><br /><br />' . $videocoment . '</div></td>';

	       $commentlist .='</tr><tr><td></td></tr><tr>';
			
           }while ($myrow = mysql_fetch_array($result)) ;
         }
	  else
	     $commentlist .='<td><div style="border: 1px solid #CCCCCC; width: 420px; height: 100px; font-size: 12px; font-weight: bold; -moz-border-radius: 12px"><p>No video comments yet!</p></div></td>';

	  }
	  $commentlist .= '
	                </tr>
	                </tbody>
                    </table>';

   return $commentlist;
   }


// manage user video list method
function manageuservideolist($username)
   {
   // return table html code
   $videolist = "";

   // query table
   if ($username != NULL)
      {
      $result = mysql_query("select * from ft_ftvideos where author = '$username' order by videoid desc") or die(mysql_error());

	  if ($myrow = mysql_fetch_array($result))
	     {		 	 
	     do{
		   $videoid = $myrow[videoid];
		   $videotitle = $myrow[title];
	       $videodescription = $myrow[description];
		   $videoauthor = $myrow[author];
	       $videoaddedtime = $myrow[date_added];
		   $videothumb = "../ftvideos/thumbs/" . $myrow[thumb];
		   $videosource = $myrow[source];
			
			  // insert video info
			  $videolist .='
			      <td align="center"><input type="checkbox" name="video' . $videoid . '" value="' . $videoid . '"/></td>
                  <td><div id="watermark_box"><a href="../jwflvplayer/showvideo.php?video=' . removeextension($videosource) . '" target="_parent" title="' . $videotitle . '">
<img src="' . $videothumb . '" width="120" height="100" border="1"/><img src="../images/icons/btn-play.png" height=24, width=22 class="watermark" /></a></div></td>
				  <td align="left" style="color: #FFFFFF; font-weight: bold; font-size:10px;">Comments added for video: ' . $videotitle . '<br />Author: <a id="ftlink" href="../htmltemplates/useraccount.php?accountname=' . $videoauthor .'" target="_parent" title="See ' . $videoauthor."'s" . ' profile">' . $videoauthor . '</a><br />Date added: ' . $videoaddedtime . '<br />
				  <div style="width: 390px; height: 55px; overflow: auto">Description: ' . $videodescription . '</div></td>
				  <td><a href="./editvideo.php?video=' . removeextension($videosource) . '" title="Edit this video">
				  <img src="../images/icons/edit.png" alt="edit" width="24" height="24" border="0" /></a>
				  <a href="../ftvideos/' . $videosource . '" title="Download this video">
				  <img src="../images/icons/install.png" alt="download" width="24" height="24" border="0" /></a>
				  <a href="#" onclick="createselectedlist(' . $videoid . ');" title="Delete this video"><img src="../images/icons/cancel.png" alt="remove" width="24" height="24" border="0" /></a>
				  </td>
                  </tr>
				  <tr>';
				  
           $videolist .='</tr><tr>';
		   
           }while ($myrow = mysql_fetch_array($result)) ;
         }
      else
         $videolist .= '<td width="5%" valign="top" align="left" style="font-size: 12px; font-weight: bold; color: #333333;">No video uploaded!</td>';

      }

   return $videolist;
   }   

// Fuction for saving the video record into the mySQL database
function savevideo( $title, $author, $description, $target, $vttarget )
{
  // Make a MySQL Connection
  //$db = mysql_connect("SQL06.FREEMYSQL.NET", "firsttimer", "firsttimer22") or die(mysql_error());

  // read Chinese properly
  // mysql_query("SET NAMES 'UTF8'") or die(mysql_error());
  // mysql_select_db("ftdb", $db) or die(mysql_error());

  $query = "INSERT INTO ft_ftvideos
             VALUES(0, '" . $title . "', '" . $author . "', '" . $description ."', '" . $target . "', '" . $vttarget . "', 0, 0, 0, 350, 240, CURRENT_TIMESTAMP)";

  // Insert a row of information into the table "ft_ftvideos"
  mysql_query($query) or die(mysql_error());

  $result = mysql_query("select * from ft_ftvideos where source='" . $target . "'") or die(mysql_error());

  if ($myrow = mysql_fetch_array($result))
     {
	 // update user total_video count first
	 mysql_query("UPDATE ft_users SET total_videos = total_videos + 1 WHERE username = '$author'") or die(mysql_error()); 
	 
     header("Location: ../jwflvplayer/showvideo.php?video=" . removeextension($target));
	 exit();
     }
  else
     echo "Error: No Video Found!<br>";

}

// Fuction for updating the video information into the mySQL database
function updatevideo( $title, $videoid, $description, $target, $vttarget )
{
  // Make a MySQL Connection
  // $db = mysql_connect("SQL06.FREEMYSQL.NET", "firsttimer", "firsttimer22") or die(mysql_error());

  // read Chinese properly
  // mysql_query("SET NAMES 'UTF8'") or die(mysql_error());
  // mysql_select_db("ftdb", $db) or die(mysql_error());
  if ($target != "" && $vttarget != "")
     $query = "UPDATE ft_ftvideos SET title = '$title', description = '$description', source = '$target', thumb = '$vttarget' WHERE videoid = '$videoid'";
  else if ($target != "")
     $query = "UPDATE ft_ftvideos SET title = '$title', description = '$description', source = '$target' WHERE videoid = '$videoid'";
  else if ($vttarget != "")
     $query = "UPDATE ft_ftvideos SET title = '$title', description = '$description', thumb = '$vttarget' WHERE videoid = '$videoid'";
  else
     $query = "UPDATE ft_ftvideos SET title = '$title', description = '$description' WHERE videoid = '$videoid'";
  
  // update video information
  mysql_query($query) or die(mysql_error());
  
  $result = mysql_query("select * from ft_ftvideos WHERE videoid = '$videoid'") or die(mysql_error());
 
  if ($myrow = mysql_fetch_array($result))
     {
	 // refresh page
     header("Location: ./editvideo.php?video=" . removeextension($myrow[source]));
     exit();
	 }
  else
     {
	 header("Location: ../404.html");
     exit();	
	 }
  
  
}


?>
