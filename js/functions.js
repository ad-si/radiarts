counter = 0;

function show_slider(){	
	
	value = counter - 130;
	
	document.getElementById('content').style.left = value + 'px';
	document.getElementById('opener').style.left = counter + 'px';
	
	
	if(counter >= 130){
		clearTimeout(timer);
	}else{	
		counter += 10;
		timer = setTimeout("show_slider()", 10);
	}
	
}


function hide_slider(){	
	
	value = counter - 130;
	
	document.getElementById('content').style.left = value + 'px';
	document.getElementById('opener').style.left = counter  + 'px';
	
	
	if(counter <= 0){
		clearTimeout(timer);
	}else{
		counter -= 10;
		timer = setTimeout("hide_slider()", 10);
	}
	
}