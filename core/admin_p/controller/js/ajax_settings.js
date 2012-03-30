$(document).ready(function(){
	function getSettings(){
		// Получение JSON от сервера
		$.getJSON('../controller/settings_get.php',getContent);
		function getContent(data){
			var site_name_lang1='';
			var site_header_lang1='';
			var site_footer_lang1='';
			
			var meta_title_lang1='';
			var meta_keywords_lang1='';
			var meta_description_lang1='';
			var meta_charset_lang1='';
			
			
			var site_name_lang2='';
			var site_header_lang2='';
			var site_footer_lang2='';
			
			var meta_title_lang2='';
			var meta_keywords_lang2='';
			var meta_description_lang2='';
			var meta_charset_lang2='';
			$.each(data, function(adata){
				site_name_lang1=this.lang1.siteName;
				site_header_lang1=this.lang1.siteHeader;
				site_footer_lang1=this.lang1.siteFooter;
				
				meta_title_lang1=this.lang1.metaTitle;
				meta_keywords_lang1=this.lang1.metaKeywords;
				meta_description_lang1=this.lang1.metaDescription;
				meta_charset_lang1=this.lang1.metaCharset;
				
				
				site_name_lang2=this.lang2.siteName;
				site_header_lang2=this.lang2.siteHeader;
				site_footer_lang2=this.lang2.siteFooter;
				
				meta_title_lang2=this.lang2.metaTitle;
				meta_keywords_lang2=this.lang2.metaKeywords;
				meta_description_lang2=this.lang2.metaDescription;
				meta_charset_lang2=this.lang2.metaCharset;
			});
			
			$('#site_name_lang1').val(site_name_lang1);
			$('#site_header_lang1').val(site_header_lang1);
			$('#site_footer_lang1').val(site_footer_lang1);
			
			$('#meta_title_lang1').val(meta_title_lang1);
			$('#meta_keywords_lang1').val(meta_keywords_lang1);
			$('#meta_description_lang1').val(meta_description_lang1);
			$('#meta_charset_lang1').val(meta_charset_lang1);
			
			
			$('#site_name_lang2').val(site_name_lang2);
			$('#site_header_lang2').val(site_header_lang2);
			$('#site_footer_lang2').val(site_footer_lang2);
			
			$('#meta_title_lang2').val(meta_title_lang2);
			$('#meta_keywords_lang2').val(meta_keywords_lang2);
			$('#meta_description_lang2').val(meta_description_lang2);
			$('#meta_charset_lang2').val(meta_charset_lang2);
		}
	}
	
	function getHtml(){
		$.getJSON('../controller/settings_get_html.php',getData);
		function getData(data){
			var main_html='';
			var other_html='';
			$.each(data, function(adata){
				main_html=this.main_html;
				other_html=this.other_html;
			});
			$('#main_html_data').val(main_html);
			$('#other_html_data').val(other_html);
		}
	}
	// вывод результата действий при сохранений
	function report(answer,message){
		if (answer==1){
				$('#mess').html('<b>&nbsp;'+message+'&nbsp;</b>').show().fadeOut(1500);
			}
			else{
				$('#mess').html('<b>&nbsp;'+answer+'&nbsp;</b>').show().fadeOut(5000);
			}
	}
	getSettings();
	getHtml();
	// При изменении text сохраняется его значение (настройки lang1)
	$('#edit_settings_lang1 :text, textarea').live('change',function(){
		var data2=$('#edit_settings_lang1').serialize();
		$.post('../controller/settings_set.php',data2,rep);
		function rep(mess){
			report(mess,'Сохранено!');
		}
	});
	// При изменении text сохраняется его значение (настройки lang2)
	$('#edit_settings_lang2 :text, textarea').live('change',function(){
		var data2=$('#edit_settings_lang2').serialize();
		$.post('../controller/settings_set.php',data2,rep);
		function rep(mess){
			report(mess,'Сохранено!');
		}
	});
	
	$('#save_btn').click(function(){
		var data2=$('#edit_settings_html').serialize();
		$.post('../controller/settings_set_html.php',data2,rep);
		function rep(mess){
			report(mess,'Сохранено!');
		}
	});
});