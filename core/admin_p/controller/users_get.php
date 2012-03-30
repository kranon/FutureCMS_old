<?php
include '../../config.php';
$json='';
$sql="SELECT `id`, `lang1`, `lang2` FROM `role`";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
	$rol[$row['id']]=$row['lang1'];
	$all.='<option value='.$row['id'].'>'.$row['lang1'].'</option>';
}
$num_mas=sizeof($rol);

$sql="SELECT `id`, `login`, `pass`, `email`, `sex`, `ava`, `group`, `datreg` FROM `users`";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
	$els='';
	for ($n=1;$n<=$num_mas;$n++){
		$now='<option value='.$row['group'].'>'.$rol[$row['group']].'</option>';
		if ($rol[$row['group']]!=$rol[$n]){
			$els.='<option value='.$n.'>'.$rol[$n].'</option>';
		}
	}
	$gr='<select name='.$row['id'].'>'.$now.$els.'</select>';
	$json.='{"id":"'.$row['id'].'","login":"'.$row['login'].'","pass":"'.$row['pass'].'","email":"'.$row['email'].'","sex":"'.$row['sex'].'","group":"'.$gr.'","datreg":"'.$row['datreg'].'","ava":"'.$row['ava'].'"},';
}
$db->CloseDBConnection();
$len=strlen($json);
$json=substr_replace($json, '', $len-1, 1);
echo '['.$json.']';
?>