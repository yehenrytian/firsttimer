<?php 
session_start();

if (!isset($_SESSION['user']))
{
header("Location: ../login&register/login2.php?msg=Error: Please login first!");
exit();	
}   

include ('../include/dbc.php');
include ('../include/common.funcs.php');

$user = $_SESSION['user'];

$email = "";
$aboutme = "";
$sex = "";
$dob = "";
$showdob = "";
$country = "";
$icon_id = 0;
$join_date = "";
$totalvideos = 0;
$totalcomments = 0;


if ($_POST['Submit'] == 'Update')
{
if (strcmp($_POST['newpwd'], $_POST['retypenewpwd']) && !empty($_POST['newpwd']) )
   { 
   header("Location: ../htmltemplates/usersettings2.php?msg=Error: New Password does not match or empty..");
   exit();
   }

$rsPwd = mysql_query("select password from ft_users where username='$_SESSION[user]'") or die(mysql_error());
list ($oldpwd) = mysql_fetch_row($rsPwd);

if ($oldpwd == md5($_POST['oldpwd']))
   {   
   // set new password if applicable
   if (!empty($_POST['newpwd']))
   {
   $newpasswd = md5($_POST['newpwd']);
   mysql_query("Update ft_users
  				SET password = '$newpasswd'
				WHERE username = '$_SESSION[user]'
				") or die(mysql_error());
   }
  
  // update user profile
  $newaboutme = trim($_POST['newaboutme']);
  $newemail = trim($_POST['email']);
  $newsex = "";
	if ($_POST['gender'] == "M")
	   $newsex = 'male';
	else
	   $newsex = 'female';
  
  $newdob = trim($_POST['birthday']);
  $newshowdob = ($_POST['showdob'] == 'show')? '1' : '0';
  $newcountry = $_POST['country'];
  $newusericon = $_POST['usericon'];
  
  mysql_query("Update ft_users
	        SET email = '$newemail',sex = '$newsex',dob = '$newdob',show_dob = '$newshowdob',country = '$newcountry',
			about_me = '$newaboutme',icon_id = '$newusericon' WHERE username = '$_SESSION[user]'
				") or die(mysql_error());
  
  
  header("Location: useraccount2.php?msg=Your account has been updated successfully!");				
  } 
else 
  { 
  header("Location: usersettings2.php?msg=ERROR: You have entered a wrong password!");
  }
exit();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>FirstTimer.ca - Settings: <?php echo $_SESSION['user']; ?></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="First Time, about, profile, history, introduction, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="User profile settings of firsttimer.ca!" name="Description" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<link href="../firsttimer-ico.png" rel="shortcut icon" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Ye Henry Tian" />
<meta name="Robots" content="index,follow" />
<link rel="stylesheet" href="../images/ftstyle2.0.css" type="text/css" />
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
				<?php 
				if (isset($_GET['msg'])) { echo "<h1 style=\"color: red\" align=\"center\"> $_GET[msg] </h1>"; } 
				// populate user info method
                populateuserinfo($user);
				?>
            
				<a name="SampleTags"></a>
                <h1>We recommand the following browsers:</h1>
                <p>
                <a href="http://www.mozilla.com/en-US/" title="Get FireFox3.5">
                <img src="../images/fflogosmall.jpg" alt="firefox3.5" style="width:191px; height:30px;"/></a>
                <a href="http://www.google.com/chrome" title="Get Google Chrome">
                <img src="../images/logo_sm.jpg" alt="chrome" style="width:191px; height:30px;"/></a>
                <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx" title="Get IE8">
                <img src="../images/ie8_logo.gif" alt="ie8" style="width:191px; height:30px;"/></a>
                </p>
                               
                
                <h1>Update user account</h1>
			    <script type="text/javascript" src="../include/verifyform.js"></script>
                <div align="left">
                <div style="border: 1px solid #999999; width: 700px; height: 730px; -moz-border-radius: 20px">
                <form onSubmit="return(verify(this));" action="usersettings2.php" method="post" enctype="multipart/form-data" name="setting_form" id="setting_form">
                <table cellspacing="1" cellpadding="0" border="0" align="left">
                <tr><td><strong style="color: #06F;">Old Password:</strong></td>
                    <td><input name="oldpwd" type="password" id="oldpwd" size="50"><strong style="color: #F00;">(*mandatory)</strong></td>
                </tr>
                <tr><td><strong style="color: #06F;">New Password:</strong></td>
                    <td colspan="2"><input name="newpwd" type="password" id="newpwd" size="50">(optional) (at least 5 chars)</td>
                </tr>
                <tr><td><strong style="color: #06F;">Retype New Password:</strong></td>
                    <td><input name="retypenewpwd" type="password" id="retypenewpwd" size="50">(optional)</td>
                </tr>
                <tr><td><strong style="color: #06F;">Email:</strong></td> 
                    <td><input name="email" type="text" id="email" compulsory="yes" size="50" value=<?php echo $email; ?> />
                    Ex. <span style="color: #06F;">john@domain.com</span></td>
                </tr>
                <tr><td><strong style="color: #06F;">Gender:</strong></td>
                <td>
<?php
if ($sex == 'male')
{ 
?>
<input name="gender" type="radio" value="M" checked /><strong>Male</strong>
<input type="radio" name="gender" value="F" /><strong>Female</strong>
<?php
}
else
{
?>
<input name="gender" type="radio" value="M" /><strong>Male</strong>
<input type="radio" name="gender" value="F" checked /><strong>Female</strong>
<?php
}
?>
</td>
</tr>
               <tr><td><strong style="color: #06F;">Date of Birth:</strong></td>
<td>
<input type="text" name="birthday" value=<?php echo $dob; ?> size="20" />
<?php 
if ($showdob == '1') 
{
?>
<input type="checkbox" name="showdob" value="show" checked="checked"/><strong>show birthday</strong>
<?php
}
else
{
?>
<input type="checkbox" name="showdob" value="show" /><strong>show birthday</strong>
<?php
}
?>
</td></tr>
                <tr><td><strong style="color: #06F;">Country:</strong></td> 
            <td><select name="country" id="selectC" style="width:260px;">
            <option value=<?php echo $country; ?> selected="selected"><?php echo $country; ?></option>
            
            <option value="Afghanistan">Afghanistan</option>
            <option value="Albania">Albania</option>
            <option value="Algeria">Algeria</option>
            <option value="Andorra">Andorra</option>
            <option value="Anguila">Anguila</option>
            <option value="Antarctica">Antarctica</option>
            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
            <option value="Argentina">Argentina</option>
            <option value="Armenia ">Armenia </option>
            <option value="Aruba">Aruba</option>
            <option value="Australia">Australia</option>
            <option value="Austria">Austria</option>
            <option value="Azerbaidjan">Azerbaidjan</option>
            <option value="Bahamas">Bahamas</option>
            <option value="Bahrain">Bahrain</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="Barbados">Barbados</option>
            <option value="Belarus">Belarus</option>
            <option value="Belgium">Belgium</option>
            <option value="Belize">Belize</option>
            <option value="Bermuda">Bermuda</option>
            <option value="Bhutan">Bhutan</option>
            <option value="Bolivia">Bolivia</option>
            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
            <option value="Brazil">Brazil</option>
            <option value="Brunei">Brunei</option>
            <option value="Bulgaria">Bulgaria</option>
            <option value="Cambodia">Cambodia</option>
            <option value="Canada" selected="selected">Canada</option>
            <option value="Cape Verde">Cape Verde</option>
            <option value="Cayman Islands">Cayman Islands</option>
            <option value="Chile">Chile</option>
            <option value="China">China</option>
            <option value="Christmans Islands">Christmans Islands</option>
            <option value="Cocos Island">Cocos Island</option>
            <option value="Colombia">Colombia</option>
            <option value="Cook Islands">Cook Islands</option>
            <option value="Costa Rica">Costa Rica</option>
            <option value="Croatia">Croatia</option>
            <option value="Cuba">Cuba</option>
            <option value="Cyprus">Cyprus</option>
            <option value="Czech Republic">Czech Republic</option>
            <option value="Denmark">Denmark</option>
            <option value="Dominica">Dominica</option>
            <option value="Dominican Republic">Dominican Republic</option>
            <option value="Ecuador">Ecuador</option>
            <option value="Egypt">Egypt</option>
            <option value="El Salvador">El Salvador</option>
            <option value="Estonia">Estonia</option>
            <option value="Falkland Islands">Falkland Islands</option>
            <option value="Faroe Islands">Faroe Islands</option>
            <option value="Fiji">Fiji</option>
            <option value="Finland">Finland</option>
            <option value="France">France</option>
            <option value="French Guyana">French Guyana</option>
            <option value="French Polynesia">French Polynesia</option>
            <option value="Gabon">Gabon</option>
            <option value="Germany">Germany</option>
            <option value="Gibraltar">Gibraltar</option>
            <option value="Georgia">Georgia</option>
            <option value="Greece">Greece</option>
            <option value="Greenland">Greenland</option>
            <option value="Grenada">Grenada</option>
            <option value="Guadeloupe">Guadeloupe</option>
            <option value="Guatemala">Guatemala</option>
            <option value="Guinea-Bissau">Guinea-Bissau</option>
            <option value="Guinea">Guinea</option>
            <option value="Haiti">Haiti</option>
            <option value="Honduras">Honduras</option>
            <option value="Hong Kong">Hong Kong</option>
            <option value="Hungary">Hungary</option>
            <option value="Iceland">Iceland</option>
            <option value="India">India</option>
            <option value="Indonesia">Indonesia</option>
            <option value="Ireland">Ireland</option>
            <option value="Israel">Israel</option>
            <option value="Italy">Italy</option>
            <option value="Jamaica">Jamaica</option>
            <option value="Japan">Japan</option>
            <option value="Jordan">Jordan</option>
            <option value="Kazakhstan">Kazakhstan</option>
            <option value="Kenya">Kenya</option>
            <option value="Kiribati ">Kiribati </option>
            <option value="Kuwait">Kuwait</option>
            <option value="Kyrgyzstan">Kyrgyzstan</option>
            <option value="Lao People's Democratic Republic">Lao People's Democratic 
            Republic</option>
            <option value="Latvia">Latvia</option>
            <option value="Lebanon">Lebanon</option>
            <option value="Liechtenstein">Liechtenstein</option>
            <option value="Lithuania">Lithuania</option>
            <option value="Luxembourg">Luxembourg</option>
            <option value="Macedonia">Macedonia</option>
            <option value="Madagascar">Madagascar</option>
            <option value="Malawi">Malawi</option>
            <option value="Malaysia ">Malaysia </option>
            <option value="Maldives">Maldives</option>
            <option value="Mali">Mali</option>
            <option value="Malta">Malta</option>
            <option value="Marocco">Marocco</option>
            <option value="Marshall Islands">Marshall Islands</option>
            <option value="Mauritania">Mauritania</option>
            <option value="Mauritius">Mauritius</option>
            <option value="Mexico">Mexico</option>
            <option value="Micronesia">Micronesia</option>
            <option value="Moldavia">Moldavia</option>
            <option value="Monaco">Monaco</option>
            <option value="Mongolia">Mongolia</option>
            <option value="Myanmar">Myanmar</option>
            <option value="Nauru">Nauru</option>
            <option value="Nepal">Nepal</option>
            <option value="Netherlands Antilles">Netherlands Antilles</option>
            <option value="Netherlands">Netherlands</option>
            <option value="New Zealand">New Zealand</option>
            <option value="Niue">Niue</option>
            <option value="North Korea">North Korea</option>
            <option value="Norway">Norway</option>
            <option value="Oman">Oman</option>
            <option value="Pakistan">Pakistan</option>
            <option value="Palau">Palau</option>
            <option value="Panama">Panama</option>
            <option value="Papua New Guinea">Papua New Guinea</option>
            <option value="Paraguay">Paraguay</option>
            <option value="Peru ">Peru </option>
            <option value="Philippines">Philippines</option>
            <option value="Poland">Poland</option>
            <option value="Portugal ">Portugal </option>
            <option value="Puerto Rico">Puerto Rico</option>
            <option value="Qatar">Qatar</option>
            <option value="Republic of Korea Reunion">Republic of Korea Reunion</option>
            <option value="Romania">Romania</option>
            <option value="Russia">Russia</option>
            <option value="Saint Helena">Saint Helena</option>
            <option value="Saint kitts and nevis">Saint kitts and nevis</option>
            <option value="Saint Lucia">Saint Lucia</option>
            <option value="Samoa">Samoa</option>
            <option value="San Marino">San Marino</option>
            <option value="Saudi Arabia">Saudi Arabia</option>
            <option value="Seychelles">Seychelles</option>
            <option value="Singapore">Singapore</option>
            <option value="Slovakia">Slovakia</option>
            <option value="Slovenia">Slovenia</option>
            <option value="Solomon Islands">Solomon Islands</option>
            <option value="South Africa">South Africa</option>
            <option value="Spain">Spain</option>
            <option value="Sri Lanka">Sri Lanka</option>
            <option value="St.Pierre and Miquelon">St.Pierre and Miquelon</option>
            <option value="St.Vincent and the Grenadines">St.Vincent and the Grenadines</option>
            <option value="Sweden">Sweden</option>
            <option value="Switzerland">Switzerland</option>
            <option value="Syria">Syria</option>
            <option value="Taiwan ">Taiwan </option>
            <option value="Tajikistan">Tajikistan</option>
            <option value="Thailand">Thailand</option>
            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
            <option value="Turkey">Turkey</option>
            <option value="Turkmenistan">Turkmenistan</option>
            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
            <option value="Ukraine">Ukraine</option>
            <option value="UAE">UAE</option>
            <option value="UK">UK</option>
            <option value="USA">USA</option>
            <option value="Uruguay">Uruguay</option>
            <option value="Uzbekistan">Uzbekistan</option>
            <option value="Vanuatu">Vanuatu</option>
            <option value="Vatican City">Vatican City</option>
            <option value="Vietnam">Vietnam</option>
            <option value="Virgin Islands (GB)">Virgin Islands (GB)</option>
            <option value="Virgin Islands (U.S.) ">Virgin Islands (U.S.) </option>
            <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
            <option value="Yemen">Yemen</option>
            <option value="Yugoslavia">Yugoslavia</option>
          </select>   
          </td>
          </tr>
   <tr><td><strong style="color: #06F;">Select Icon:</strong></td>
       <td>
<select size=2 name="usericon" id="selectUI" style="height:auto; width:160px" onchange="document.getElementById('selImg').attributes['class'].value = this.options[this.selectedIndex].attributes['class'].value;">
	<option class="img1" value=1 selected="selected">adel</option>
	<option class="img2" value=2>ash</option>
	<option class="img3" value=3>athena</option>
    <option class="img4" value=4>benimaru</option>
    <option class="img5" value=5>billy</option>
	<option class="img6" value=6>chang</option>
	<option class="img7" value=7>chiziru</option>
    <option class="img8" value=8>clark</option>
    <option class="img9" value=9>duolon</option>
	<option class="img10" value=10>gato</option>
	<option class="img11" value=11>griffon</option>
    <option class="img12" value=12>hinako</option>
    <option class="img13" value=13>angel</option>
    <option class="img14" value=14>iori</option>
	<option class="img15" value=15>jhun</option>
	<option class="img16" value=16>joe</option>
    <option class="img17" value=17>kim</option>
    <option class="img18" value=18>mai</option>    
    <option class="img19" value=19>malin</option>
	<option class="img20" value=20>mary</option>
	<option class="img21" value=21>maxima</option>
    <option class="img22" value=22>mukai</option>
    <option class="img23" value=23>ralf</option>    
    <option class="img24" value=24>robert</option>
	<option class="img25" value=25>ryo</option>
	<option class="img26" value=26>shenwoo</option>
    <option class="img27" value=27>shingo</option>
    <option class="img28" value=28>terry</option>
    <option class="img29" value=29>whip</option>
    <option class="img30" value=30>yuri</option>
    <option class="img31" value=31>zero</option>    
</select></td>
<td><div id="selImg" align="left" class="img<?php echo $icon_id; ?>"><span class="style1">Your Icon</span></div></td>
</tr>
  <tr>  
    <td><strong style="color: #06F;">About me:</strong></td> 
    <td><textarea name="aboutme" cols="15" rows="4" onfocus="if (this.value == 'Tell sth about yourself... (max. 120 characters)' ) this.value=''" onblur="if (this.value == '') this.value='Tell sth about yourself... (max. 120 characters)'"  onkeydown="textcount(this, 120, this.form.remain)" onkeyup="textcount(this, 120, this.form.remain)"><?php echo $aboutme; ?></textarea></td>
    <td valign="bottom"><span style="font-size: 12px;">Remain text lenth:</span><INPUT disabled maxLength=4 name="remain" size=3 value=120></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="button" name="Submit" type="submit" id="Submit" value="Update" /><input class="button" type="reset" /></td>
  </tr>  
</table>
</form>
</div>
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
