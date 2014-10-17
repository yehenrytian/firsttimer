<?php
session_start();
if (!isset($_SESSION['user']))
{
header("Location: ../login&register/login2.php?msg=Error: Please login first!");
exit();	
}   

require_once ('../include/dbc.php'); 
require_once ('../include/common.funcs.php');

$username = $_SESSION['user'];

function deleteselectedcomments($selected_comments, $username)
  {
  if ($selected_comments != "")
     {
	 //$selected_comments = "(" . $selected_comments . ")";
     mysql_query("delete from ft_ftvideocomments where comment_id IN ($selected_comments)") or die(mysql_error());
	 
	 // Update user video comments
	 $usercommentsresult = mysql_query("select * from ft_ftvideocomments where username = '$username'") or die(mysql_error());
	 $numrows = mysql_num_rows($usercommentsresult);
	 mysql_query("UPDATE ft_users SET total_comments = '$numrows' WHERE username = '$username'") or die(mysql_error());
	 
	 header("Location: ./managecomments2.php");
	 exit();
	 }
  }

if (isset($_GET['select'])) 
   {
   //echo ($_GET['select']);
   //exit();
   deleteselectedcomments($_GET['select'], $username);
   }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FirstTimer - Manage your video comments</title>
<meta content="First Time, about, profile, history, introduction, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="manage user video comments" name="Description" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<link href="../firsttimer-ico.png" rel="shortcut icon" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Ye Henry Tian" />
<meta name="Robots" content="index,follow" />
<link rel="stylesheet" href="../images/ftstyle2.0.css" type="text/css" />
<script type="text/javascript" language="javascript">  
  <!--  
  //全选按钮  
function clickall(v)  
  {  
    var f = this.document.forms["managecomments_form"];  
    for (i = 0; i < f.elements.length; i++)  
       f.elements[i].checked = v;  
    //document.forms["sendmail"].elements["mailselect"].checked=v;  
  }
  
function createselectedlist($comment_id)  
  {  
    if ($comment_id != 0)
	   {
	   if (confirm("Are you sure you want to delete this comment?"))
          location.href="./managecomments2.php?select=" + $comment_id;
       else
          return "";	   
	   }
	else
	   {
	   var selectedcomments = "";
	   var f = this.document.forms["managecomments_form"];  
       for (i = 0; i < f.elements.length; i++)
	      {  
          if (f.elements[i].checked)
	         {
		     selectedcomments += f.elements[i].value + ",";
		     }  
	      }
		// remove the last comma
	   selectedcomments = selectedcomments.substring(0, selectedcomments.length - 1);
	   if (selectedcomments == "")
	      alert("No comments selected!");  
       else if (confirm("Are you sure you want to delete the selected comments?"))
	      location.href="./managecomments2.php?select=" + selectedcomments;
       else
          return "";
	   }
  }  
</script> 
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
				<?php echo (emitstartnow()); ?>						
		    </div>			
			
			<div class="sidebox">			
				<h1>Advertisements</h1>
				<div align="center">
                  <script type="text/javascript"><!--
                    google_ad_client = "pub-6635598879568444";
                    /* 200x200firsttimer, created 1/17/09 */
                    google_ad_slot = "1941255369";
                    google_ad_width = 200;
                    google_ad_height = 200;
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
				<a name="MessageInfo"></a>	
				<?php if (isset($_GET['msg'])) { echo "<h1 style=\"color: red\" align=\"center\"> $_GET[msg] </h1>"; } ?>
            
				<a name="SampleTags"></a>
				<?php echo emitrecbrowsers(); ?>
                
                <script type="text/javascript" src="../include/verifyform.js"></script>
                <h1>Manage your comments</h1>
                <div align="left" style="width: auto; height: 560px; border: 1px solid #CCCCCC; -moz-border-radius: 20px" >
                <p></p>
                <div align="left" style="width: 680px; height: 520px; overflow: auto">
                <form onSubmit="return(verify(this));" action="managecomments2.php" method="post" enctype="multipart/form-data" name="managecomments_form" id="managecomments_form">
                <table cellspacing="0" cellpadding="0" border="0">
                <tr><?php echo (manageusercommentlist($username)); ?></tr>
                </table>
                </form>
                </div>
                </div>
                <br />

                <div style="border: 1px solid #CCCCCC; width: 700px; -moz-border-radius: 20px">
                <p><a href="#" onclick="clickall(true);">Select All</a>
                <img src="../images/icons/plus.png" alt="select all" style="width:30px; height:30px; border:0; margin:0" /> | 
                <a href="#" onclick="clickall(false);">Unselect All</a>
                <img src="../images/icons/minus white.png" alt="unselect" style="width:30px; height:30px; border:0; margin:0"/> | 
                <a href="#" onclick="createselectedlist(0);">Delete Selected</a>
                <img src="../images/icons/trash full.png" alt="delete" style="width:30px; height:30px; border:0; margin:0"/></p>
                </div>
			    
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
