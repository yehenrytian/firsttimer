<?php

require_once ('../include/dbc.php');
require_once ('../include/common.inc.php');

$title = $_REQUEST["title"];
//$author = $_REQUEST["author"];
$author = $_GET['usr'];

$description = $_REQUEST["description"];
$author = trim($author);
$description = trim($description);
$target = "./../ftvideos/";
$videofile_name = $_FILES['uploaded']['name'];
$uploaded_size = $_FILES['uploaded']['size'];
$uploaded_type = $_FILES['uploaded']['type'];
$target = $target . $videofile_name;
$vttarget = "./../ftvideos/thumbs/";
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
   //echo $title;
   }
 

//This is our size condition
if ($uploaded_size > 8000000)
   {
   echo "Your video file is too large.<br>";
   $ok = 0;
   }

//This is our limit file type condition
if ($uploaded_type == "text/php")
   {
   echo "No PHP files.<br>";
   $ok = 0;
   }
   
// file type test
//if (!in_array(strtolower(strstr($videofile_name, '.')),$type))
   //{
   //echo "You may only upload FLV videos.<br>";
   //$ok = 0;
   //}

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
   Echo "Sorry your video file was not uploaded.<br>";
   }

//If everything is ok we try to upload it
else
   {
   if (move_uploaded_file($_FILES['uploaded']['tmp_name'], $target))
      {
	  if (move_uploaded_file($_FILES['vthumb']['tmp_name'], $vttarget))
         {
         //echo "The thumb file ". basename( $_FILES['vthumb']['name']). " has been uploaded.<br>";
	     //echo "The video file ". basename( $videofile_name ). " has been uploaded.<br>";
	     savevideo($title, $author, $description, $_FILES['uploaded']['name'], $_FILES['vthumb']['name']);
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


?> 