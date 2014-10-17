<?php
session_start();

require_once ('../include/dbc.php');
require_once ('../include/common.funcs.php');

if ($_POST['Submit'] == 'Upload')
   {
   if (!isset($_SESSION['user']))
      {
      header("Location: ../login&register/login2.php?msg=Error: Please login first!");
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
   $vkind = $_REQUEST["category"];
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
      echo "Sorry your video file was not uploaded.<br>";
      }
   else //If everything is ok we try to upload it
      {
	  if (move_uploaded_file($_FILES['uploaded']['tmp_name'], $target))
         {
		
	     if (move_uploaded_file($_FILES['vthumb']['tmp_name'], $vttarget))
            {
            savevideo($title, $author, $description, $_FILES['uploaded']['name'], $_FILES['vthumb']['name'], $vkind);
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
<meta name="Distribution" content="Global" />
<meta name="Author" content="Ye Henry Tian" />
<meta name="Robots" content="index,follow" />
<link rel="stylesheet" href="../images/ftstyle2.0.css" type="text/css" />
<link href="../firsttimer-ico.png" rel="shortcut icon" />
<title>FirstTimer - Upload your FirstTimer videos</title>
</head>

<body>
<!-- wrap starts here -->
<div id="wrap">
	<?php echo (emitpageheader()); ?>
				
<!-- content-wrap starts here -->
	<div id="content-wrap">
       <div id="content">
       	<div id="sidebar">            
            <div class="sidebox">
			  <?php echo (emituseraccountbox($_SESSION['user'])); ?>
			</div>
            
            <div class="sidebox">						
			   <?php echo (emitsearchbox(true)); ?>
	        </div>
            
            <div class="sidebox">
				<?php echo(emitgooglefriend()) ?>
			</div>
            
            <div class="sidebox">			
				<?php echo (emitstartnow()); ?>			
		    </div>
            
			<div class="sidebox">			
				<h1 class="clear">Sidebar Menu</h1>
				<ul class="sidemenu">
					<li><a href="#UploadInfo">Upload Info</a></li>
					<li><a href="#GenFlvFile">Generate FLV File</a></li>
					<li><a href="#UploadVideo">Upload Video File</a></li>				
				</ul>				
			</div>	
			
			<div class="sidebox">			
				<h1>Advertisements</h1>
				<div align="center">
                  <script type="text/javascript"><!--
                   google_ad_client = "pub-6635598879568444";
                   /* firsttimer 160x600, created 12/17/08 */
                   google_ad_slot = "1050254913";
                   google_ad_width = 160;
                   google_ad_height = 600;
                   //-->
                  </script>
                  <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                  </script>
                </div>				
			</div>
			
			<div class="sidebox">
			 <h1>Visitor Statistic</h1>
             <div align="center"> 
			  <a href="http://s03.flagcounter.com/more/3lNE">
             <img src="http://s03.flagcounter.com/count/3lNE/bg=FFFFFF/txt=0066FF/border=CCCCCC/columns=2/maxflags=20/viewers=0/labels=1/pageviews=1/" 
             alt="free counters" border="0"></a></div>
			</div>
					
		</div>
		<div id="main">			
			<div class="post">			
				<a name="UploadInfo"></a>	
				<h1>Upload File Info</h1>				
				<p>Here is a web tool you can use to convert your videos into FLV format or MP4 HD. Please try it out! 
                We are currently using this free service from a flv encoding company. The converted FLV video will be saved at their server. 
                We recommend you download the .flv file after the conversion and upload it to us!
                <a href="../phpBB3/viewtopic.php?f=1&t=3" target="_blank">
                <img style="height:20px; border:0; width:20px; margin:0" src="../images/question.png" alt="question" /></a></p>
                <p><strong>Thanks a lot!</strong></p>
				
				<p class="post-footer align-right">					
					<a href="../phpBB3/viewtopic.php?f=1&t=3" class="readmore">Read more</a>
					<a href="../phpBB3/viewtopic.php?f=1&t=3#p3" class="comments">Comments (5)</a>
					<span class="date">Jul 22, 2009</span>
				</p>				
			</div>            
            
            <a name="GenFlvFile"></a>	
            <h1>Generate FLV file</h1>
            <div align="center">
            <div style="border: 1px solid #999999; width: 600px; -moz-border-radius: 20px">
            <!---------Begin FLV Encoder code ---------------->  
            <script language="JavaScript" type=text/javascript>
            document.write("<iframe align=\"center\" src=\"./covert.html\" name=\"FLVEncoder\" scrolling=\"no\" frameborder=\"no\" align=\"center\" height = \"300px\" width = \"600px\"></iframe>" )
            </script> 
            <!-----------End FLV Encoder code ------------- -->
            </div>
            </div>
            
			<?php echo emitrecbrowsers(); ?>
			
            <a name="UploadVideo"></a>	
			<h1>Upload your video</h1>			
			<div align="center">
            <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.1/build/assets/skins/sam/skin.css" /> 
			<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/utilities/utilities.js"></script> 
			<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/container/container-min.js"></script> 
			<script type="text/javascript" src="loadingpanelUpload.js"></script> <script type="text/javascript">
			var loadingPanelUpload = new yuiLoadingPanelUpload();
            </script>
            
			<script type="text/javascript" src="../include/verifyform.js"></script>
            <div style="border: 1px solid #999999; width: 600px; -moz-border-radius: 20px">
            <form onsubmit="return(verify(this));" method="post" action="./index.php?user=<?php echo $_SESSION['user']; ?>" 
            enctype="multipart/form-data" name="uploadform" id="uploadform">
            <table cellspacing="1" cellpadding="0" border="0" align="center" width="auto">
            <tr><td>&nbsp;</td><td align="left"><span style="color: #F00; font:bold;">FLV Video File Upload (limit file size 8MB)</span></td></tr>
            <tr><td align="left"><strong style="color: #06F;">Title:</strong></td><td align="left"><input type="text" name="title" compulsory="yes" size="50" /></td></tr>
            <tr><td align="left"><strong style="color: #06F;">Description:</strong><br /><span>(max. 300 characters)</span></td>
                <td align="left"><textarea name="description" cols="30" rows="4" onfocus="if (this.value == 'Enter your video description here... (max. 300 characters)' ) this.value=''" onblur="if (this.value == '') this.value='Enter your video description here... (max. 300 characters)'" onkeydown="textcount(this, 300, this.form.remain)" onkeyup="textcount(this, 300, this.form.remain)">Enter your video description here... (max. 300 characters)</textarea><span class="style3">Remain text:</span><INPUT disabled maxLength=4 name="remain" size=3 value=300></td></tr>
            <tr><td align="left"><strong style="color: #06F;">Category:</strong></td><td>
            <select name="category">
              <option value="FTV">How to</option>
              <option value="MTV">Music Video</option>
              <option value="FAF">Friends&Family </option>
              <option value="ADS">Advertisement</option>
              <option value="FUN">For Fun</option>
              <option value="SPT">Sports</option>
              <option value="TRL">Travel</option>
              <option value="ENT">Entertainment</option>
              <option value="PET">Pets&Animals </option>
              <option value="Other">Other</option>
            </select> (select the category that best match to your video)           
            </td></tr>
            <tr><td align="left"><strong style="color: #06F;">Video thumb:</strong> <a href="../phpBB3/viewtopic.php?f=1&t=4" target="_blank"><img style="height:32px; border:0; width:32px; margin:0" src="../images/question.png" alt="question" /></a></td><td align="left"><input type="file" name="vthumb" id="vthumb" size="50" /></td></tr>
            <tr><td align="left"><strong style="color: #06F;">Video:</strong></td><td align="left"><input type="file" name="uploaded" id="uploaded" size="50" /></td></tr>
            <tr><td>&nbsp;</td>
<?php
if (!isset($_SESSION['user']))
{
?>
<td align="left"><input type="submit" name="Submit" id="submitvideo" value="Upload" disabled="disabled"/><input class="button" type="reset" />
  <span style="color: #F00; font:bold;">(You must login first!)</span></td>
<?php
}
else
{
?>
<td align="left"><input class="button" type="submit" name="Submit" value="Upload"/><input class="button" type="reset" /></td>
<?php
}
?>
</tr>          
</table>
</form>
</div>
</div>
<br />
	    
                <h3>Google Ads</h3>       
		        <div align="center">
                <script type="text/javascript">
                google_ad_client = "pub-6635598879568444";
                /* 728x90footer, created 1/15/09 */
                google_ad_slot = "7642261806";
                google_ad_width = 728;
                google_ad_height = 90;
                </script>
                <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
                </div>		
			<br />										
		</div>					
		
	<!-- content-wrap ends here -->		
	</div></div>

   <?php echo (emitpagefooter()); ?>
	
<!-- wrap ends here -->
</div>

</body>
</html>
