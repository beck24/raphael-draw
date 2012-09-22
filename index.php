<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="scripts/jquerytools/jquery.tools.range.css" type="text/css" />
<link rel="stylesheet" href="scripts/colorpicker/jquery.miniColors.css" type="text/css" />

<script type='text/javascript' src='scripts/jquery-1.8.1.min.js'></script>
<script type='text/javascript' src='scripts/jquerytools/jquery.tools.min.js'></script>

<script type='text/javascript' src='scripts/raphael/raphael-min.js'></script>
<script type="text/javascript" src="scripts/raphael/rgbcolor.js"></script> 
<script type="text/javascript" src="scripts/raphael/canvg.js"></script>
<script type="text/javascript" src="scripts/raphael/raphael-to-svg.js"></script>

<script type="text/javascript" src="scripts/colorpicker/jquery.miniColors.min.js"></script>

<script type="text/javascript" src="scripts/basic-draw.js"></script>

<head>
<body>

<div id="canvaswrapper">
	<div id="linewidths">
		Line Width<br>
		<input id='line-width-input' type="range" name="lineWidth" min="1" max="100" step="1" value="1" />
	</div>
	<div id="colorSelector"><input type="hidden" name="lineColor" class="color-picker black" size="7" value="#000000"/></div>
	<div id="canvas"></div>
</div>

<br><br>
<a href='#' id='save'>Save</a>
<a href='#' id='reset'>Reset</a>
<br><br>

<canvas id='realcanvas' width="700px" height="500px" style='border: 1px solid black;'></canvas>

<form id='form' action='action.php' method='post'>
<input type='hidden' name='dataU' id='dataU' value=''>
<input type='hidden' name='method' value='save'>
</form>
</body>
</html>