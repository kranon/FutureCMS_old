$(document).ready(function(){
	// Обновление контента
	function getCon(){
		$.getJSON('../controller/news_get.php',getContent);	// Получение JSON от сервера
		function getContent(data){
			var text='';
			var i=1;
			$.each(data, function(adata){
				text+='<tr><td class="al_center">&nbsp;'+i+'&nbsp;</td><td><a href="../view/pages.php?content=news_edit&id='+this.id+'">'+this.caption+'</a></td><td>'+this.count+'</td><td>&nbsp;'+this.date+'&nbsp;</td><td class="al_center"><a href="../controller/news_del.php?id='+this.id+'" class="del"><img src="../view/del.png" /></a></td></tr>';
				//text+='<tr><td class="al_center">&nbsp;'+this.id+'&nbsp;</td><td><a href="../controller/news_edit.php?id='+this.id+'">'+this.caption+'</a></td><td>&nbsp;'+this.date+'&nbsp;</td><td class="al_center"><a href="../controller/news_del.php?id='+this.id+'" class="del">Удалить</a></td></tr>';
				i++;
			});
			$('#tbody').html(text);
		}
	}
	// вывод результата действий при сохранений
	function report(answer,message){
		if (answer==1){
				getCon();
				$('#mess').html('<b>&nbsp;'+message+'&nbsp;</b>').show().fadeOut(1500);
			}
			else{
				$('#mess').html('<b>&nbsp;'+answer+'&nbsp;</b>').show().fadeOut(5000);
			}
	}
	getCon();
	// Удаление новости
	$('.del').live('click',function(evt){
		var link=$(this).attr('href');
		var querystr=link.slice(link.indexOf('?')+1);
		$.get('../controller/news_del.php',querystr,rep);
		function rep (mess){
			report(mess,'Новость удалена!');
		}
		evt.preventDefault();	// Отмена стандартного события
	});
		
	// Добавление новой новости
	$('#add_news_sub').click(function(evt){
		var newNews=$('#add_news').serialize();
		$.post('../controller/news_add.php',newNews,rep);
		function rep(mess){
			report(mess,'Новость добавлена!');
		}
		evt.preventDefault();	// Отмена стандартного события
	});
});