<?php
# Класс изменения размера изображений #
class img_biper
{
	var $img; # загруженное изображение
	var $width; # ширина
	var $height; # высота
	var $type_file; # gif jpg и тд

	function img_biper($i)
	{
		if (!file_exists($i)) { die ('Указаный файл не существует');}

		$size=getimagesize($i);
		$this->width=$size[0]; #ширина
		$this->height=$size[1];# ВЫСОТА

		switch ($size[2])
		{
			case 1: $this->type_file="GIF"; $this->img=imagecreatefromgif($i); break;
			case 2: $this->type_file="JPG"; $this->img=imagecreatefromjpeg($i); break;
			case 3: $this->type_file="PNG"; $this->img=imagecreatefrompng($i); break;
			case 4: $this->type_file="SWF"; die('С файлами SWF работать неумею!');
			default: die( "Неподходящий тип файла");
		}
	} # img_biper

	function img_write($q=100)
	{ #Выводит изображение
		switch ($this->type_file)
		{
			case 'GIF': header("Content-type: image\gif"); imagegif($this->img); break;
			case 'JPG': header("Content-type: image\jpeg "); imageJPEG($this->img, null, $q); break;
			case 'PNG': header("Content-type: image\png"); imagePNG($this->img); break;
		}
	} #img_write

	function img_save($f)
	{ #Выводит изображение
		$filename=basename($f);
		$ras=explode('.', $filename);

		switch ($ras[1])
		{
			case 'GIF':  imagegif($this->img, $f); break;
			case 'JPG':  imageJPEG($this->img, $f); break;
			case 'PNG':  imagePNG($this->img, $f); break;
			case 'JPEG':  imageJPEG($this->img, $f); break;
			case 'gif':  imagegif($this->img, $f); break;
			case 'jpg':  imageJPEG($this->img, $f); break;
			case 'png':  imagePNG($this->img, $f); break;
			case 'jpeg':  imageJPEG($this->img, $f); break;
			default: die('неверное разширение файла');
		}
	} #img_save

	function img_resized($x, $y)
	{# $y=% ресайз по процентам  $y=w ресайз по ширине $y=h ресайз по высоте
	# $x- либо ширинаб либо высота, либо % маштаба
		if($y=='w' or $y=='W')
		{
			$k=$this->width/$x;
			$new_width=$x;
			$new_hight=floor($this->height/$k);
		}

		if($y=='h' or $y=='H')
		{
			$k=$this->height/$x;
			$new_hight=$x;
			$new_width=floor($this->width/$k);
		}

		if($y=='%')
		{
			$new_hight=floor($this->height*($x/100));
			$new_width=floor($this->width*($x/100));
		}

		$new_img=ImageCreateTrueColor($new_width, $new_hight);
		imagecopyresized($new_img, $this->img, 0, 0, 0, 0, $new_width, $new_hight, $this->width, $this->height );

		$this->img=$new_img;
		$this->height=$new_hight;
		$this->width=$new_width;
	}#img_resized
}#class
?>