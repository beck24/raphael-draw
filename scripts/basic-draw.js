$(document).ready( function() {

    var canvas = document.getElementById('canvas'),
    paper = new Raphael(canvas, 500, 700),
    colour = '#000000',
    mousedown = false,
    width = 1,
    lastX, lastY, path, pathString;

	$(canvas).mousedown(function (e) {
		mousedown = true;
		
		/*
		var x = e.pageX - canvas.offsetLeft + (window.pageXOffset||document.body.scrollLeft||document.documentElement.scrollLeft),
			y = e.pageY - canvas.offsetTop + (window.pageYOffset||document.body.scrollTop||document.documentElement.scrollTop);
		*/
		
		var x = e.pageX - canvas.offsetLeft,
			y = e.pageY - canvas.offsetTop;

		
		pathString = 'M' + x + ' ' + y + 'l0 0';
		path = paper.path(pathString);
		path.attr({
			'stroke': colour,
			'stroke-linecap': 'round',
			'stroke-linejoin': 'round',
			'stroke-width': width
		});

		lastX = x;
		lastY = y;
	});
	
	$(document).mouseup(function () {
		mousedown = false;
	});

	$(canvas).mousemove(function (e) {
		if (!mousedown) {
			return;
		}

		/*
		var x = e.pageX - canvas.offsetLeft + (window.pageXOffset||document.body.scrollLeft||document.documentElement.scrollLeft),
			y = e.pageY - canvas.offsetTop + (window.pageYOffset||document.body.scrollTop||document.documentElement.scrollTop);
		*/
		
		var x = e.pageX - canvas.offsetLeft,
			y = e.pageY - canvas.offsetTop;
	
		pathString += 'l' + (x - lastX) + ' ' + (y - lastY);
		path.attr('path', pathString);

		lastX = x;
		lastY = y;
	});

	
	/**
		save our image
	*/
	$('#save').click( function(event) {
	
		// note that this is a 2 step process
		// due to IE stupidity
		// parse the paper object and send the attributes to our php script
		// it will return the full svg via ajax, which we can then convert
		// to png, and send that back to php for saving to the filesystem
		event.preventDefault();
		var json_svg = buildJSON(paper);
		
		$.ajax({
			type: "POST",
			url: "action.php",
			data: { dataU: json_svg }
			}).done(function( svg ) {
				canvg(document.getElementById('realcanvas'), svg, {ignoreDimensions: true});
				var realCanvas = document.getElementById('realcanvas');
				var img = realCanvas.toDataURL("image/png");
		
				$('#dataU').val(img);
				$('#form').submit();
			});
	});
	
	
	/**
		Initiate the range picker
	**/
    $(":range").rangeinput();
	
	/** 
		Set our line width
	*/
	$("#line-width-input").change(function(event, value) {
		width = value;
	});
	
	/**
		Initiate the colorpicker
	*/
	$("#colorSelector input").miniColors({
		change: function(hex, rgb) {
			colour = hex;
		}
	});
	
	
	/**
		reset the page
	*/
	
	$("#reset").click( function(event) {
		event.preventDefault();
		paper.clear();
	});
});