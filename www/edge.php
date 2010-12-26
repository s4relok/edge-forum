<?php

session_start();

mysql_connect("localhost", "sector14", "0t6eWBoL");
mysql_select_db("sector14");

if (isset($_SESSION['id_theme_topic'])){ unset($_SESSION['id_theme_topic']);}
if (isset($_SESSION['page_number'])){ unset($_SESSION['page_number']);}
if (isset($_SESSION['id_message'])){ unset($_SESSION['id_message']);}


if(isSet($_POST['login'])||isSet($_GET['login'])){

	$_SESSION['login'] = $_POST['login'];
	
	$result = array();
	
	
	//Query for log in
	$query = "SELECT pswd, id_user, image_link FROM `Users` WHERE `name` = ";
	$query .="'".$_SESSION['login']."';";
	$result = mysql_query($query);
	//echo $query;
	$row = mysql_fetch_row($result);
	
	

	if(md5($_POST['password'])!=$row[0]){ 
	
	echo "Unset login";
	unset($_SESSION['login']);
	unset($_SESSION['id_user']);
	unset($_SESSION['image_link']);
	
	} 
	else{
	
	$_SESSION['id_user'] = $row[1];
	$_SESSION['image_link'] = $row[2];
	}
	
} 

include "head.tpl";

?>


<title>Edge</title><style type="text/css">
<!--
a:link {
	color: #6d6d6d;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #6d6d6d;
}
a:hover {
	text-decoration: underline;
	color: #6d6d6d;
}
a:active {
	text-decoration: none;
	color: #6d6d6d;
}
.style5 {
	font-family: Tahoma;
	font-size: small;
	color: #6d6d6d;
}
-->
</style></head>

<body BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>

<!-- ImageReady Slices (edge-main.psd) -->
<TABLE WIDTH=1024 BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<TR>
		<TD COLSPAN=8>
			<IMG SRC="img/edge-main-spacer_01.jpg" ALT="" WIDTH=1024 HEIGHT=122 border="0" usemap="#Map"></TD>
	</TR>
	




  <?php

$result = array();
$getname = array();
$query = "SELECT * FROM `Themes` ORDER BY `date` ASC";
$result = mysql_query($query);

for($i=0; $i<mysql_num_rows($result); $i++){

$row = mysql_fetch_row($result);

$q = "SELECT date FROM `Messages` WHERE `id_theme` = ".$row[0]." ORDER BY `date` DESC;";
$getname = mysql_query($q);
$last_date = mysql_fetch_row($getname);

?>

<TR>
		<TD>
			<IMG SRC="img/edge-main-spacer_02.jpg" WIDTH=148 HEIGHT=28 ALT=""></TD>
		<TD>
			<IMG SRC="img/edge-main-spacer_03.jpg" WIDTH=18 HEIGHT=28 ALT=""></TD>
		<TD>
			<IMG SRC="img/edge-main-spacer_04.jpg" WIDTH=25 HEIGHT=28 ALT=""></TD>
		<TD width="413" height="28" bgcolor="#D4D9DC"><span class="style5"><a href="topic.php?id_theme=<?php echo $row[0]; ?>#bottom"> <?php echo $row[1]; ?> </a></span></TD>
		<TD>
			<IMG SRC="img/edge-main-spacer_06.jpg" WIDTH=64 HEIGHT=28 ALT=""></TD>
		<TD width="178" height="28" bgcolor="#D5DADD"><div align="center" class="style5"><?php echo $last_date[0] ?></div></TD>
		<TD>
			<IMG SRC="img/edge-main-spacer_08.jpg" WIDTH=32 HEIGHT=28 ALT=""></TD>
		<TD>
			<IMG SRC="img/edge-main-spacer_09.jpg" WIDTH=146 HEIGHT=28 ALT=""></TD>
  </TR>
	<TR>
		<TD COLSPAN=8>
			<IMG SRC="img/edge-main-spacer_10.jpg" WIDTH=1024 HEIGHT=3 ALT=""></TD>
	</TR>

<?php
} ?>
 
 <!--  <tr>
    <td>&nbsp;</td>
    <td class="style2">
	<form method="post" action="edge.php">
     
      <input type="text" name="title" />
      <input type="submit" name="Submit" value="Create new theme" />
	  
    </form>
    </td>
    <td>&nbsp;</td>
  </tr>-->
  <TR>
		<TD COLSPAN=8>
			<IMG SRC="img/edge-main-spacer_10.jpg" WIDTH=1024 HEIGHT=3 ALT=""></TD>
  </TR>
	<TR>
		<TD COLSPAN=8>
			<IMG SRC="img/edge-main-spacer_10.jpg" WIDTH=1024 HEIGHT=3 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=8>
			<IMG SRC="img/edge-main-spacer_10.jpg" WIDTH=1024 HEIGHT=3 ALT=""></TD>
	</TR>
  <TR>
		<TD>
			<IMG SRC="img/edge-main-spacer_02.jpg" WIDTH=148 HEIGHT=28 ALT=""></TD>
		<TD bgcolor="#E4E9ED">
			<IMG SRC="img/edge-main-spacer_03.jpg" WIDTH=18 HEIGHT=28 ALT=""></TD>
		<TD bgcolor="#D5DADD" >
			<IMG SRC="img/edge-main-spacer_04.jpg" WIDTH=25 HEIGHT=28 ALT=""></TD>
		<TD width="413" height="28" align="left" valign="middle" bgcolor="#D4D9DC" class="style5"><?php if(isSet($_SESSION['login'])){ ?><form method="post" action="evo.php">
     
      
          <div align="left">
            <input name="title" type="text" class="style5" value="Base of magic" size="26" maxlength="32" />
            <input name="Submit" type="submit" class="style5" value="Create new theme" />
          </div>
	</form><?php } else {
	
	echo "Thank you, guy";
	
	}	
	
	?></TD>
		<TD bgcolor="#D5DADD">
			<IMG SRC="img/edge-main-spacer_06.jpg" WIDTH=64 HEIGHT=28 ALT=""></TD>
		<TD width="178" height="28" bgcolor="#D5DADD"><span class="style5">&copy; A.V. Kolesin, K.V. Voronin</span></TD>
		<TD bgcolor="#E4E9ED">
			<IMG SRC="img/edge-main-spacer_08.jpg" WIDTH=32 HEIGHT=28 ALT=""></TD>
		<TD>
			<IMG SRC="img/edge-main-spacer_09.jpg" WIDTH=146 HEIGHT=28 ALT=""></TD>
  </TR>
	<TR>
		<TD COLSPAN=8>
			<IMG SRC="img/edge-main-spacer_10.jpg" WIDTH=1024 HEIGHT=3 ALT=""></TD>
	</TR>
	<TR>
		<TD>
			<IMG SRC="img/edge-main-spacer_02.jpg" WIDTH=148 HEIGHT=28 ALT=""></TD>
		<TD bgcolor="#E4E9ED">
			<IMG SRC="img/edge-main-spacer_03.jpg" WIDTH=18 HEIGHT=28 ALT=""></TD>
		<TD align="left" valign="middle" bgcolor="#D5DADD" >
			<IMG SRC="img/edge-main-spacer_04.jpg" WIDTH=25 HEIGHT=28 ALT=""></TD>
		<TD width="413" height="28" align="left" valign="middle" bgcolor="#D4D9DC" class="style5">
		
		<?php if(!isSet($_SESSION['login'])){ ?>
		
		<form method="post" action="edge.php">
		  
	      
          <div align="left" class="style5">
            <input name="login" type="text" class="style5" value="login" size="15" maxlength="32" />
            <input name="password" type="password" class="style5" value="password" size="15" maxlength="32" />  
            <input name="Submit2" type="submit" class="style5" value="Into the Edge" />  
          </div>
	  </form>
	  <?php } else {
	  echo "<div align='left' class='style5'>";
	  echo "You are ".$_SESSION['login'];
	  echo "</div>";
	  ?>
	  
	  (<a href="edge.php?login=x">ReEdge</a>)
	  
	 	  
	  <?php }  
	  
	  ?>
      
     
	  </TD>
		<TD bgcolor="#D5DADD">
			<IMG SRC="img/edge-main-spacer_06.jpg" WIDTH=64 HEIGHT=28 ALT=""></TD>
		<TD width="178" height="28" bgcolor="#D5DADD" class="style5"> <div align="center">v.   <strong>0.7 Alpha</strong>   © 2009 HC.Design  </div></TD>
		<TD bgcolor="#E4E9ED">
			<IMG SRC="img/edge-main-spacer_08.jpg" WIDTH=32 HEIGHT=28 ALT=""></TD>
		<TD>
			<IMG SRC="img/edge-main-spacer_09.jpg" WIDTH=146 HEIGHT=28 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=8>
			<IMG SRC="img/edge-main-spacer_10.jpg" WIDTH=1024 HEIGHT=3 ALT=""></TD>
	</TR>
 	
 	<TR>
		<TD COLSPAN=8><img src="img/edge-main-spacer_11.jpg" width=1024 height=87 alt="" /></TD>
	</TR>
</TABLE>

<?php 
include "map.tpl";
include "down.tpl";
?>