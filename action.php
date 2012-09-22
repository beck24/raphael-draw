<?php

error_reporting(E_ALL ^ E_NOTICE);

$data = $_POST['dataU'];

if ($_POST['method'] == 'save') {

	preg_match('#^data:[\w/]+(;[\w=]+)*,[\w+/=%]+$#', $data);

	$imgfile = 'output-' . time() . '.png';

	copy($data, $imgfile);

	header('Location: ' . $imgfile);
	exit;
}
else {

	$json = json_decode($data, true);
	//echo "<pre>" . print_r($json,1) . "</pre>"; exit;
	$output = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="'.$json[0]['width'].'" height="'.$json[0]['height'].'" xml:space="preserve"><desc>Created with Raphael</desc><defs></defs>';

	for ($i=0; $i < count($json); $i++) {
		if ($json[$i]['type'] == "path") {
			$output .= '<path style="stroke-linecap: round; stroke-linejoin: round;" fill="'.$json[$i]['fill'].'" stroke="'.$json[$i]['stroke'].'" d="'.$json[$i]['path'].'" stroke-linecap="round" stroke-linejoin="round" stroke-width="' . $json[$i]['stroke-width'] . '"></path>';
		}
	}

	$output .= '</svg>';

	echo $output;
}