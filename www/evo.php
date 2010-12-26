<?php

session_start();

//Connect to database
mysql_connect("localhost", "sector14", "0t6eWBoL");
mysql_select_db("sector14");

?>



<?php

/*################################## Add theme #######################################*/

if(isSet($_POST["title"])){

$today = getdate(); 
$month = $today['mon']; 
$mday = $today['mday']; 
$year = $today['year']; 
$hours = $today['hours']; 
$minutes = $today['minutes']; 
$seconds = $today['seconds'];

$query = "INSERT INTO Themes (title, date, id_user) VALUES (";
$query .= "'".$_POST["title"]."'".", ";
$query .= "'".$year."-".$month."-".$mday." ".$hours.":".$minutes.":".$seconds."'".", ";
$query .= $_SESSION['id_user'].");";

//echo $query;

$result = mysql_query($query);
$link_goback_image =  "img/thmadd.gif";
$link_goback = "edge.php";

}

/*################################## Add message #######################################*/

elseif(isSet($_POST["message"])){

$new_message = $_POST["message"];
//echo $new_message;
$new_message = str_replace("\n", "<br>", $new_message);
$new_message = mysql_escape_string($new_message);
//$new_message = str_replace(" ", "&nbsp;", $new_message);
//$new_message = htmlspecialchars($new_message);
$new_id_message = $row[0]+1;

$today = getdate(); 
$month = $today['mon']; 
$mday = $today['mday']; 
$year = $today['year']; 
$hours = $today['hours']; 
$minutes = $today['minutes']; 
$seconds = $today['seconds'];

$id_theme_topic = $_SESSION['id_theme_topic'];

$query = "INSERT INTO Messages (text, date, id_user, id_theme) VALUES (";
$query .= "'".$new_message."'".", ";
$query .= "'".$year."-".$month."-".$mday." ".$hours.":".$minutes.":".$seconds."'".", ";
$query .= $_SESSION['id_user'].", ";
$query .= $id_theme_topic.");";

//echo $query; 

$result = mysql_query($query);

$link_goback_image = "img/msgadd.jpg";
$link_goback = "topic.php";

$link_goback .= "#"."bottom";

}

/*################################## Edit message #######################################*/

elseif(isSet($_POST["message_edit"])){

$new_message = $_POST["message_edit"];
$new_message = str_replace("\n", "<br>", $new_message);
//$new_message = str_replace(" ", "&nbsp;", $new_message);

$today = getdate(); 
$month = $today['mon']; 
$mday = $today['mday']; 
$year = $today['year']; 
$hours = $today['hours']; 
$minutes = $today['minutes']; 
$seconds = $today['seconds'];

$id_theme_topic = $_SESSION['id_theme_topic'];

$query = "UPDATE `Messages` SET `text` = ";
$query .= "'".$new_message."'";
$query .= ",`date` = ";
$query .= "'".$year."-".$month."-".$mday." ".$hours.":".$minutes.":".$seconds."'"." ";
$query .= " WHERE `id_message`=".$_SESSION['id_message'].";";

//echo $query; 

$result = mysql_query($query);

$link_goback_image = "img/msgadd.jpg";
$link_goback = "topic.php";

$link_goback .= "#".$_SESSION['id_message'] ;

}

/*################################## Delete message #######################################*/

elseif(isSet($_GET["id_message_del"])){

$del_message = $_GET["id_message_del"];

$id_theme_topic = $_SESSION['id_theme_topic'];

$query = "DELETE FROM `Messages` ";
//$query .= "'".$new_message."'";
//$query .= ",`date` = ";
//$query .= "'".$year."-".$month."-".$mday." ".$hours.":".$minutes.":".$seconds."'"." ";
$query .= " WHERE `id_message`=".$del_message.";";

//echo $query; 

$result = mysql_query($query);

$link_goback_image = "img/msgadd.jpg";
$link_goback = "topic.php";

$link_goback .= "#"."bottom";

}

/*######################################################################################*/


include "head.tpl";

?>


<META HTTP-EQUIV=Refresh Content="1;URL=<?php echo $link_goback; ?>">

<link rel="shortcut icon" href="img/icon.ico" type="image/x-icon">
<title>Edge.evo</title>
<style type="text/css">
<!--
.style1 {
	font-family: Tahoma;
	font-weight: bold;
}
-->
</style>
</head>

<BODY BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>
<!-- ImageReady Slices (Message copy.psd) -->
<div style=""><p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center"><a href="<?php echo $link_goback; ?>"><IMG SRC="<?php echo $link_goback_image; ?>" ALT="" WIDTH=150 HEIGHT=233 border="0" align="top"></a></p>
<!-- End ImageReady Slices -->

<?php 

include "down.tpl";
?>
