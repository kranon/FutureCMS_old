<?php
$result = mysql_query("SELECT * FROM `page` WHERE `link`='LeftSideBar'");
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
	echo $row['text_'.$lang];
}
?>