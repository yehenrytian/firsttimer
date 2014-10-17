<?php 
session_start();
if (isset($_SESSION['user']))
   {
   header("Location: ../htmltemplates/useraccount.php?msg=You have alredy logged in!");
   exit();	
   } 
   
require_once ('../include/dbc.php'); 


if ($_POST['Submit'] == 'Register')
{
   if (strlen($_POST['email']) < 5)
      {
      die("Incorrect email. Please enter valid email address..");
      }
   if (strcmp($_POST['password'], $_POST['retype_password']) || empty($_POST['password']) )
	  { 
	  //die ("Password does not match");
	  die("ERROR: Password does not match or empty..");
  	  }
   if (strcmp(md5($_POST['user_code']), $_SESSION['ckey']))
	  { 
	  die("Invalid code entered. Please enter the correct code as shown in the Image");
      } 
	$rs_duplicates = mysql_query("select userid from ft_users where email='$_POST[email]'");
	$duplicates = mysql_num_rows($rs_duplicates);
	
	if ($duplicates > 0)
	{	
	//die ("ERROR: User account already exists.");
	header("Location: register.php?msg=ERROR: User account already exists..");
	exit();
	}		
	
	$md5pass = md5($_POST['retype_password']);
	//$activ_code = rand(1000,9999);
	// Populate user INFO
	$username = trim($_POST['user_name']);
	$aboutme = trim($_POST['aboutme']);
	$email = trim($_POST['email']);
	$sex = "";
	if ($_POST['gender'] == "M")
	   $sex = 'male';
	else
	   $sex = 'female';
	
	$dob = trim($_POST['birthday']);
	$showdob = ($_POST['showdob'] == 'show')? '1' : '0';
	
	
	mysql_query("INSERT INTO ft_users
	        (`username`,`password`,`email`,`sex`,`dob`,`show_dob`,`country`,`about_me`,`icon_id`,`join_date`,`total_videos`,`total_comments`)
			VALUES
		    ('" . $username . "','$md5pass','" . $email . "','" . $sex . "','" . $dob . "','" . $showdob . "','$_POST[country]','" . $aboutme . "','$_POST[usericon]',now(),0,0)") or die(mysql_error());
	
	unset($_SESSION['ckey']);
	//echo("Registration Successful!");
	$_SESSION['user'] = $username;
	header("Location: ../htmltemplates/useraccount.php");
	
	exit();
	}	

?> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="First Time, How To, Howto, video, help, Money, youtube, video website, video sharing" name="Keywords" />
<meta content="register to firsttimer.ca" name="Description" />
<meta content="jaolb+4U3+k7xWefD1IT+pPv3Nevk/TJsQW8ZV3uXBI=" name="verify-v1" />
<link href="../firsttimer-ico.png" rel="shortcut icon" />
<title>FirstTimer - Register</title>
<link href="../ftstyle.css" rel="stylesheet" type="text/css" /> 
<style type="text/css">
<!--
.style1 {color: #0066CC}
.style3 {
	color: #0066FF;
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
</head>


<body>
<div id="page">
<script type="text/javascript">
document.write("<iframe src=\"../htmltemplates/ftheader.php\" name=\"ftheader\" scrolling=\"no\" frameborder=\"no\" align=\"center\" height = \"200px\" width = \"970px\" ></iframe>")
</script>
<?php if (isset($_GET['msg'])) { echo "<div class=\"msg\"> $_GET[msg] </div>"; } ?><!-- <p>&nbsp;</p> -->
<div id="content2">
<script type="text/javascript" src="../include/verifyform.js"></script>
<br />
<div align="center">
<div style="border: 1px solid #999999; background-color:#CCCCCC; width: 540px; -moz-border-radius: 20px">
<form onSubmit="return(verify(this));" method="post" action="register.php" enctype="multipart/form-data" name="registerform" id="registerform" style="padding:5px;" >
<table width="atuo" cellspacing="1" cellpadding="0" border="0" style="background-image:url(../images/css-images/table_background.gif); background-repeat:repeat-x; background-color:#CCCCCC" align="center">
<tbody>
  <tr> 
    <td>&nbsp;</td>
    <td><span class="style3">Register Account</span></td>
  </tr>  
  <tr>  
    <td align="left"><strong>User Name:</strong></td> 
    <td><input name="user_name" type="text" id="user_name" compulsory="yes" size="35" /></td>
    <td>Ex. John Wilson</td>
  </tr>
  <tr>  
    <td align="left"><strong>Password:</strong></td> 
    <td><input name="password" type="password" id="pass1" compulsory="yes" size="35" /></td>
    <td>(At least 5 chars)</td>
  </tr>
  <tr>  
    <td align="left"><strong>Retype Password:</strong></td> 
    <td><input name="retype_password" type="password" id="pass2" compulsory="yes" size="35" /></td>
  </tr>
  <tr>  
    <td align="left"><strong>Email:</strong></td> 
    <td><input name="email" type="text" id="email" compulsory="yes" size="35" /></td>
    <td>Ex. <span class="style1">john@domain.com</span></td>
  </tr>
  <tr>
    <td><strong>Gender:</strong></td>
    <td>
    <input name="gender" type="radio" value="M" checked /><strong>Male</strong>
    <input type="radio" name="gender" value="F" /><strong>Female</strong>
    </td>
  </tr>
  <tr>
    <td><strong>Date of Birth:</strong></td>
    <td>
    <input type="text" name="birthday" value="YYYY-MM-DD" onfocus="if (this.value == \'YYYY-MM-DD\') this.value=\'\';" 
    onblur="if (this.value == \'\') this.value= \'YYYY-MM-DD\';"size="20" />
    <input type="checkbox" name="showdob" value="show"/><strong>show birthday</strong>
    </td>
  </tr>  
  <tr>  
    <td align="left"><strong>Country:</strong></td> 
    <td><select name="country" id="selectC" style="width:260px;">
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
  <tr>
<td><strong>Select Icon:</strong></td>
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
<td>
<div id="selImg" align="left" class="img1"><span class="style1">Your Icon</span></div>
</td>
</tr>
  <tr>  
    <td align="left"><strong>About me:</strong></td> 
    <td><textarea name="aboutme" cols="30" rows="4" onfocus="this.value=''; this.onfocus=null; textcount(this, 120, this.form.remain);" onkeydown="textcount(this, 120, this.form.remain)" onkeyup="textcount(this, 120, this.form.remain)">Tell sth about yourself... (max. 120 characters)</textarea></td>
    <td valign="bottom"><span style="font-size: 12px;">Remain text lenth:</span><INPUT disabled maxLength=4 name="remain" size=3 value=120></td>
  </tr>
  <tr>  
    <td align="left"><strong>Verification code:</strong></td> 
    <td><input name="user_code" type="text" size="10" compulsory="yes" /><img src="pngimg.php" align="middle"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><input type="submit" name="Submit" value="Register" /><input type="reset" /></td>
  </tr>
</tbody>   
</table>
</form>
</div>
</div>
<br />
</div>

<div align="left" id="sidebar">
<h2>Advertisements:</h2>
<div align="center">
<script type="text/javascript"><!--
google_ad_client = "pub-6635598879568444";
/* firsttimer 160x600, created 12/17/08 */
google_ad_slot = "1050254913";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
</div>

<div align="center">
<script type="text/javascript">
google_ad_client = "pub-6635598879568444";
/* 728x90footer, created 1/15/09 */
google_ad_slot = "7642261806";
google_ad_width = 728;
google_ad_height = 90;
</script> 
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>

<div align="center">
<script type="text/javascript">
document.write("<iframe src=\"../htmltemplates/ftfooter.html\" name=\"ftfooter\" scrolling=\"no\" frameborder=\"no\" height = \"auto\" width = \"100%\" ></iframe>")
</script>
</div>
</div>
</body>
</html>