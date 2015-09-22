$(document).ready(function(){
	var link = window.location.pathname.split('/');
	var index = 0;
	for(var x= 0 ; x < link.length; x++){
		if(link[x] == 'admin' && index == 0){
			index = x+1;
			console.log(index);
		}
	}
	var classSearch = link[index];
	//$('.' + classSearch).addClass('active-menu');
});