$(document).ready(function(){
	function getGallery(){
		// Получение JSON от сервера
		$.getJSON('../controller/album_get.php',getContent);
		function getContent(data){
			var text='';
			var i=1;
			$.each(data, function(adata){
				text+=('<tr><td class="al_center">'+i+'</td><td><a href="pages.php?content=album&id='+this.id+'">'+this.name_lang1+'</a></td><td class="al_center"><a href="pages.php?content=album&id='+this.id+'">'+this.name_lang2+'</a></td><td class="al_center">&nbsp;'+this.date+'&nbsp;</td><td class="al_center"><a href="../controller/album_del.php?id='+this.id+'" class="del"><img src="../view/del.png" /></a></td></tr>');
				i++;
			});
			$('#tbody_gallery').html(text);
		}
	}
	// вывод результата действий при сохранений
	function report(answer,message){
		if (answer==1){
				getGallery();
				$('#mess').html('<b>&nbsp;'+message+'&nbsp;</b>').show().fadeOut(1500);
			}
			else{
				$('#mess').html('<b>&nbsp;'+answer+'&nbsp;</b>').show().fadeOut(5000);
			}
	}
	getGallery();
	// При изменении text сохраняется его значение
	$('#edit_album :text').live('change',function(){
		var data2=$('#edit_album').serialize();
		$.post('../controller/album_set.php',data2);
	});
		
	// Удаление альбома
	$('.del').live('click',function(evt){
		var link=$(this).attr('href');
		var querystr=link.slice(link.indexOf('?')+1);
		$.get('../controller/album_del.php',querystr,rep);
		function rep (mess){
			report(mess,'Альбом удалён!');
		}
		evt.preventDefault();	// Отмена стандартного события
	});
	
	// Добавление нового альбома
	$('#add_album_sub').click(function(evt){
		var newMenu=$('#add_album').serialize();
		$.post('../controller/album_add.php',newMenu,rep);
		function rep(mess){
			report(mess,'Альбом добавлен!');
		}
		evt.preventDefault();	// Отмена стандартного события
	});
});