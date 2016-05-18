<?php
session_start();

require_once ("javas/jpgraph1/src/jpgraph.php");
require_once ("javas/jpgraph1/src/jpgraph_bar.php");
 	



$data_y=array($_REQUEST[win],$_REQUEST[draw],$_REQUEST[loss]);
$data_z=array($_REQUEST[win_last],$_REQUEST[draw_last],$_REQUEST[loss_last]);



$data_x=array("Win","Draw","Loss");

// Create the graph. These two calls are always required

$graph = new Graph(230,210,"auto",0,ture);    
$graph->SetScale('textint',0,46); 
$graph->ClearTheme();
$graph->SetMarginColor("#ccc");

$graph->xaxis->SetColor('black'); 
$graph->yaxis->SetColor('black');
$graph->SetMarginColor("#ccc");

$graph->xaxis->SetTickLabels($data_x);


// Add a drop shadow
//$graph->SetShadow();


// Adjust the margin a bit to make more room for titles
$graph->img->SetMargin(30,20,38,30);

// Create a bar pot
$bplot = new BarPlot($data_y);
$bplot->value->Show();
$bplot->SetFillColor(array('blue','#336600','red'));
$bplot->value->SetFormat('%2.0f');
$bplot->value->SetAngle(90);


// Create a bar pot
$bplot2 = new BarPlot($data_z);
$bplot2->value->Show();
$bplot2->SetFillColor(array('#8282FF','#00CC99','#FFA8A8'));
$bplot2->value->SetFormat('%2.0f');
$bplot2->value->SetAngle(90);

$gbplot = new GroupBarPlot(array($bplot,$bplot2));
// ...and add it to the graPH
$gbplot->SetAbsWidth(30);
$graph->Add($gbplot);

$graph->yaxis->SetLabelFormat('%d');


// Display the graph
$graph->Stroke();

unset($datay);unset($dataz);
?>