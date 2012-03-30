<?php
include '../../classes/img_biper.class.php';
// проверить входные данные!!!!!!
$link=$_GET['link'];

$uploaddir = '../../../gallery/'.$link.'/';
$thumb_dir = '../../../gallery/'.$link.'/thumbs/';
if (!empty($_FILES)){
	$tempFile = $_FILES['Filedata']['tmp_name'];
	
	$targetFile = str_replace('//','/',$uploaddir) . $_FILES['Filedata']['name'];
	$targetThumb = str_replace('//','/',$thumb_dir) . $_FILES['Filedata']['name'];
	
	$fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	$fileTypes  = str_replace(';','|',$fileTypes);
	$typesArray = split('\|',$fileTypes);
	$fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);
		copy($tempFile, $targetThumb);
		if (move_uploaded_file($tempFile,$targetFile)){
			$info = getimagesize($targetFile);
			// $info = getimagesize($thumb[$i]);
			// $info[0] содержит ширину/width в пикселах.
			// $info[1] содержит высоту/height.
			// $info[2] содержит тип файла:
			// 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(байтовый порядок intel),
			// 8 = TIFF(байтовый порядок motorola), 9 = JPC, 10 = JP2, 11 = JPX.
			if ($info[2]==2){
				if ($info[0]>1000 || $info[1]>760){
					$new_img=new img_biper($targetFile);
					if ($info[0]>$info[1]){
						$new_img->img_resized(1000, 'w');
					}
					else{
						$new_img->img_resized(760, 'h');
					}
					$new_img->img_save($targetFile);
				}
				$thumb=new img_biper($targetThumb);
				$thumb->img_resized(100, 'w');
				$thumb->img_save($targetThumb);
			}
			else{
				echo 'not type 2';
				
				unlink($targetFile);
				unlink($targetThumb);
			}
		}
		else{
			echo 'error downloading foto!';
		}
		echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
	 }
	 else {
	 	echo 'Invalid file type.';
	 }
}
?>