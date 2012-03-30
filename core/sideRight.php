<?php
$sql="SELECT `text_".$lang."` FROM `page` WHERE `link`='RightSideBar'";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result)){
	echo $row[0];
}
?>