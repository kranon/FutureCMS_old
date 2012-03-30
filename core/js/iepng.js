// fixPNG(); author Nikita Timoshenko a.k.a. Nekteyn (http://nekteyn.name)
function fixPNG(element)
{
	if (/MSIE (5\.5|6).+Win/.test(navigator.userAgent))
	{
		var src;
		
		if (element.tagName=='IMG')
		{
			if (/\.png$/.test(element.src))
			{
				src = element.src;
				element.src = "core/js/null.gif";
			}
		}
		else
		{
			src = element.currentStyle.backgroundImage.match(/url\("(.+\.png)"\)/i)
			if (src)
			{
				src = src[1];
				element.runtimeStyle.backgroundImage="none";
			}
		}
		
		if (src) element.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + src + "',sizingMethod='scale')";
	}
}