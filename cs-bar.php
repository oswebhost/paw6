<?php


$datay = $_SESSION['cs_y'];
$data_x= $_SESSION['cs_x'];

include ("javas/jpgraph1/src/jpgraph.php");
include ("javas/jpgraph1/src/jpgraph_bar.php");

// Create the graph. These two calls are always required
$graph = new Graph(500,150,"auto");    
$graph->SetScale("textlin");
$graph->yaxis->scale->SetGrace(30);
 

// Adjust the margin a bit to make more room for titles
$graph->img->SetMargin(25,20,10,25);

$graph->xaxis->SetTickLabels($data_x);

// Create a bar pot
$bplot = new BarPlot($datay);

/*
$bplot->SetFillColor(array(
		"#75A4DD",
		"#95B3D7",
		"#8DB4E3"
		,"#B8CCE4",
		"#C5D9F1",
		"#DFFFDF",
		"#F2DDDC",
		"#FCD5B4",
		"#E6B9B8",
		"#FAC090",
		"#D99795"
		)
);
*/

$bplot->value->SetFormat('%.1f%%');
$bplot->value->SetAngle(90);
$bplot->value->Show();
$bplot->SetAbsWidth(30);

$graph->Add($bplot);


$graph->Stroke();

?>