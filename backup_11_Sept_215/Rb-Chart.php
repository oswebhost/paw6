<?
session_start();

include ("javas/jpgraph1/src/jpgraph.php");
include ("javas/jpgraph1/src/jpgraph_line.php");


// Create the graph. These two calls are always required
$graph = new Graph(500,200,"auto",0,ture);   
$graph->SetScale('textint',0,110); 




// Create the linear plot
$lineplot=new LinePlot($_SESSION['ydata']);


// Add the plot to the graph
$graph->Add($lineplot);

$graph->img->SetMargin(40,20,20,40);
$graph->xaxis->SetTickLabels($_SESSION[week_no]);
$graph->xaxis->title->Set("Match");
$graph->yaxis->title->Set("Ratio %");

$lineplot->SetColor("blue");
$lineplot->SetWeight(2);

$graph->yaxis->SetColor("black");
$graph->yaxis->SetWeight(1);

$graph->legend->Pos("center","bottom");
$graph->Stroke();

unset($ydata);
unset($week_no);


?>