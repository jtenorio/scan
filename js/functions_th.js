ddsmoothmenu.init({
	mainmenuid: "nav", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})
$(function () {
	var tabContainers = $('div.tabs > div');
	tabContainers.hide().filter(':first').show();
	
	$('div.tabs ul.tabNavigation a').click(function () {
					tabContainers.hide();
					tabContainers.filter(this.hash).show();
					$('div.tabs ul.tabNavigation a').removeClass('selected');
					$(this).addClass('selected');
					return false;
	}).filter(':first').click();
});