<?php
session_start();

require_once ("javas/jpgraph1/src/jpgraph.php");
require_once ("javas/jpgraph1/src/jpgraph_line.php");


// Create the graph. These two calls are always required
$graph = new Graph(500,200,"auto",0,ture); 
$graph->SetScale('textint',0,110); 

// Create the linear plot
$lineplot=new LinePlot($_SESSION[ydatalast]);

$lineplot2=new LinePlot($_SESSION[y2datalast]);

// Add the plot to the graph
$graph->Add($lineplot);
$graph->Add($lineplot2);

$graph->img->SetMargin(40,20,20,40);

$graph->xaxis->SetTickLabels($_SESSION[week_nolast]);
$graph->xaxis->title->Set("Match");

$graph->yaxis->title->Set("Ratio %");


$lineplot->SetColor("blue");
$lineplot->SetWeight(2);

$lineplot2->SetColor("red");
$lineplot2->SetWeight(2);

$graph->yaxis->SetColor("black");
$graph->yaxis->SetWeight(1);
//$graph->SetShadow();

$lineplot->SetLegend("Home Team $_SESSION[home]");
$lineplot2->SetLegend("Away Team $_SESSION[away]");
$graph->legend->SetLayout(LEGEND_HOR);
$graph->legend->Pos("center","bottom");
// Display the graph
$graph->Stroke();



?>