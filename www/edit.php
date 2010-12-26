<?php

/*Initial*/

//Start session
session_start();

//If id_theme isn't exist create this one
if (!isset($_SESSION['id_theme_topic'])){

$_SESSION['id_theme_topic']=$_GET["id_theme"];
$id_theme_topic = $_GET["id_theme"];

}
//Else get value from session
else{

$id_theme_topic = $_SESSION['id_theme_topic'];
}

//Connect to database
mysql_connect("localhost", "sector14", "0t6eWBoL");
mysql_select_db("sector14");

$result = array();
$getname = array();

//Query for get messages from curent theme
$query = "SELECT id_user, date, text FROM `Messages` WHERE `id_theme` = ";
$q=$query.$id_theme_topic." ORDER BY `date` ASC;";
$result = mysql_query($q);

//Make query for name of current theme
$query = "SELECT title FROM `Themes` WHERE `id_theme` =";
$query .= $id_theme_topic.";";

//Run query
$title_topic = mysql_query($query);
$title_topic_text = mysql_fetch_row($title_topic);


$first_post=0;

//Define maximum posts on the page
$max_on_page = 40;
//Get number of rows
$num_rows = mysql_num_rows($result);
//Calculate number of pages
$page_counter = (int)($num_rows/$max_on_page);
if($num_rows!=$max_on_page*$page_counter){

	$page_counter++;
	//Number posts on the last page
	$last_page = $num_rows - $max_on_page*($page_counter-1);

}else{
	//Number posts on the last page
	//$page_counter++;
	$last_page=$max_on_page;

}

//Create nimeric for pages
if ((!isset($_GET['page_number']))&&(!isset($_SESSION['page_number']))){

//Default is last page
$page_number = $page_counter;
$_SESSION['page_number'] = $page_number;

}else{

	if(isset($_GET['page_number']))
	 {
	 $page_number = $_GET['page_number'];
	 $_SESSION['page_number'] = $page_number;
	 
	 }
	else 
	{$page_number = $_SESSION['page_number'];}

}

if($page_counter>1){

	$string_num_pages = "[";
	//In loop for page
	for($i=0;$i<$page_counter;$i++){
	
	if($i+1!=$page_number){
	
	$string_num_pages .= "<a href='topic.php?id_theme=".$id_theme_topic."&page_number=".($i+1)."'>";
	$string_num_pages .= ($i+1)."</a>";
	
	}else{
	
	$string_num_pages .= "<font color='#111111'>";
	$string_num_pages .= ($i+1)."</font>";
	
	}
	
	if($i+1!=$page_counter) $string_num_pages .= ".";
	
	}
	
	$string_num_pages .= "]";
}

//echo $string_num_pages;

if(($page_counter!=0)) mysql_data_seek($result, ($page_number-1)*$max_on_page);

if($page_counter==$page_number&&$page_counter!=0){

$max_on_this_page = $last_page;

}
else if($page_counter==0){

$max_on_this_page=0;

}else{ $max_on_this_page = $max_on_page; }

/*################################## Edit message #######################################*/

//Create nimeric for pages
if (isset($_GET['id_message'])){

$_SESSION['id_message'] = $_GET['id_message'];

$query = "SELECT text, date FROM `Messages` WHERE `id_message` =";
$query .= $_GET['id_message'].";";

//Run query
$message_result = mysql_query($query);
$message_result_text = mysql_fetch_row($message_result);

$edit_text = $message_result_text[0];
$edit_text = str_replace("<br>","\n", $edit_text);
$edit_date = $message_result_text[1];

/*######################################################################################*/

}
include "head.tpl";
?>

<!--Header begin-->

<title>Edge.topic</title><style type="text/css">
<!--
a:link {
	color: #FFFFFF;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #FFFFFF;
}
a:hover {
	text-decoration: underline;
	color: #FFFFFF;
}
a:active {
	text-decoration: none;
	color: #FFFFFF;
}
.style6 {
	font-family: Tahoma;
	font-size: small;
	color: #FFFFFF;
}
.style7 {color: #6F6E6C}
.style8 {color: #000000}
.style10 {
	color: #6F6E6C;
	font-size: small;
	font-family: Tahoma;
}
.style12 {color: #6F6E6C; font-size: xx-small; font-family: Tahoma; }
.style14 {color: #D4D0C8}
.style17 {font-family: Tahoma; font-size: x-small; color: #FFFFFF; }
.style19 {font-size: small}
-->
</style></head>



<BODY BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>
<map name="MapMap" id="MapMap">
  <area shape="rect" coords="166,15,216,64" href="../index.html" target="_self" />
</map>
<!-- ImageReady Slices (sector14_posts2_vers copy.psd) -->
<TABLE WIDTH=1024 BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<TR>
		<TD COLSPAN=13>		  <IMG SRC="img/edge-topic_01.gif" ALT="" WIDTH=1024 HEIGHT=103 border="0" usemap="#Map"></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=1 HEIGHT=103 ALT=""></TD>
	</TR>
	
	
<!--Header end-->

<TR>
		<TD ROWSPAN=2>
			<IMG SRC="img/edge-topic_02.gif" WIDTH=148 HEIGHT=23 ALT=""></TD>
		<TD ROWSPAN=2>
			<IMG SRC="img/edge-topic_03.gif" WIDTH=18 HEIGHT=23 ALT=""></TD>
		<TD COLSPAN=4>
			<a href="edge.php"><IMG SRC="img/edge-topic_04.gif" ALT="" WIDTH=45 HEIGHT=19 border="0"></a></TD>
		<TD ROWSPAN=2>
			<IMG SRC="img/edge-topic_05.gif" WIDTH=1 HEIGHT=23 ALT=""></TD>
		<TD WIDTH=634 HEIGHT=19 COLSPAN=4 bgcolor="#B2B6B9"><span class="style6">&nbsp;&nbsp;<a href="topic.php?id_theme=<?php echo $id_theme_topic; ?>"><?php echo $title_topic_text[0] ?></a>&nbsp;<span class="style19">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $string_num_pages; ?></span></span></TD>
		<TD ROWSPAN=2>
			<IMG SRC="img/edge-topic_07.gif" WIDTH=32 HEIGHT=23 ALT=""></TD>
		<TD ROWSPAN=6 WIDTH=146>&nbsp;</TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=1 HEIGHT=19 ALT=""></TD>
  </TR>
	<TR>
		<TD COLSPAN=4>
			<IMG SRC="img/edge-topic_09.gif" WIDTH=45 HEIGHT=4 ALT=""></TD>
		<TD COLSPAN=4>
			<IMG SRC="img/edge-topic_10.gif" WIDTH=634 HEIGHT=4 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=1 HEIGHT=4 ALT=""></TD>
	</TR>
	<TR>
		<TD>
			<IMG SRC="img/edge-topic_11.gif" WIDTH=148 HEIGHT=16 ALT=""></TD>
		<TD bgcolor="#E4E9ED">
			<IMG SRC="img/edge-topic_12.gif" WIDTH=18 HEIGHT=16 ALT=""></TD>
		<TD bgcolor="#D5DADD">
			<IMG SRC="img/edge-topic_13.gif" WIDTH=3 HEIGHT=16 ALT=""></TD>
		<TD WIDTH=143 HEIGHT=16 COLSPAN=6 bgcolor="#D5DADD" class="style6 style7">Edit post  </TD>
		<TD bgcolor="#D5DADD">
			<IMG SRC="img/edge-topic_15.gif" WIDTH=420 HEIGHT=16 ALT=""></TD>
		<TD WIDTH=114 HEIGHT=16 bgcolor="#D5DADD">
			<span class="style12"><?php echo $edit_date; ?></span></TD>
		<TD bgcolor="#E4E9ED">
			<IMG SRC="img/edge-topic_17.gif" WIDTH=32 HEIGHT=16 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=1 HEIGHT=16 ALT=""></TD>
	</TR>
	<TR>
		<TD width="148" ROWSPAN=4>&nbsp;</TD>
		<TD>
			<IMG SRC="img/edge-topic_19.gif" WIDTH=18 HEIGHT=5 ALT=""></TD>
		<TD COLSPAN=10 WIDTH=712 HEIGHT=5>
			<IMG SRC="img/edge-topic_20.gif" WIDTH=712 HEIGHT=5 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=1 HEIGHT=5 ALT=""></TD>
	</TR>
	<TR>
		<TD width="18" ROWSPAN=3 bgcolor="#E4E9ED">&nbsp;</TD>
		<TD WIDTH=12 COLSPAN=2 ROWSPAN=3 bgcolor="#D5DADD">&nbsp;</TD>
		<TD WIDTH=29 HEIGHT=29 bgcolor="#D5DADD">
			<IMG SRC="<?php echo $_SESSION['image_link']; ?>" border="0"></TD>
		<TD WIDTH=9 COLSPAN=3 ROWSPAN=3 bgcolor="#D5DADD">&nbsp;	  </TD>
		<td WIDTH=516 HEIGHT=49 COLSPAN=2 ROWSPAN=3 align="left" valign="top" bgcolor="#D5DADD" class="style10">
		<?php if(isSet($_SESSION['login'])){ ?>
		<form method="post" action="evo.php">
		  <p>
		    <textarea name="message_edit"  cols="60" rows="5" wrap="physical" class="style10"><?php echo $edit_text; ?>
</textarea>
	      </p>
		  <p>
		    <input name="Submit" type="submit" class="style10" value="Write in edge" />
	      </p>
		</form>	
		<?php } else {
	  echo "<div align='left' class='style5'>";
	  echo "You need to login, guy";
	  echo "</div>";
	  }
	  ?>		</td>
		<TD width="114" ROWSPAN=3 bgcolor="#D5DADD">&nbsp;</TD>
		<TD width="32" ROWSPAN=3 bgcolor="#E4E9ED">&nbsp;</TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=1 HEIGHT=29 ALT=""></TD>
	</TR>
	<TR>
		<TD width="29" ROWSPAN=2 bgcolor="#D5DADD">&nbsp;</TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=1 HEIGHT=19 ALT=""></TD>
	</TR>
	<TR>
		<TD width="146" ROWSPAN=2>&nbsp;</TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=1 HEIGHT=1 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=148 HEIGHT=4>
			<IMG SRC="img/edge-topic_30.gif" WIDTH=148 HEIGHT=4 ALT=""></TD>
		<TD WIDTH=730 HEIGHT=4 COLSPAN=11 bgcolor="#E4E9ED">
			<IMG SRC="img/edge-topic_31.gif" WIDTH=730 HEIGHT=4 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=1 HEIGHT=4 ALT=""></TD>
	</TR>



<TR>
		<TD>
			<IMG SRC="img/edge-topic_32.gif" WIDTH=148 HEIGHT=66 ALT=""></TD>
		<TD COLSPAN=11>
			<IMG SRC="img/edge-topic_33.gif" WIDTH=730 HEIGHT=66 ALT=""></TD>
		<TD>
			<IMG SRC="img/edge-topic_34.gif" WIDTH=146 HEIGHT=66 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=1 HEIGHT=66 ALT=""></TD>
  </TR>
	<TR>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=148 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=18 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=3 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=9 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=29 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=4 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=1 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=4 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=96 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=420 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=114 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=32 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="img/spacer.gif" WIDTH=146 HEIGHT=1 ALT=""></TD>
		<TD></TD>
	</TR>
</TABLE>

<?php 
include "map.tpl";
include "down.tpl";
?>



