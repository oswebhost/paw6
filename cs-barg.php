<?php


$datay = $_SESSION['cs_y'];
$data_x= $_SESSION['cs_x'];


$color_array = array(
				"#2E86C1",
				"#3498DB",
				"#5DADE2",
				"#85C1E9",
				"#AED6F1",
				"#7DCEA0",
				"#F1948A",
				"#EC7063",
				"#E74C3C",
				"#B03A2E",
				"#78281F"
				) ;


?>

<script type="text/javascript">

  google.charts.load('current', {packages: ['corechart', 'bar']});
  
  google.charts.setOnLoadCallback(drawBasic);

  function drawBasic() {

  var data = new google.visualization.arrayToDataTable(
      	[
           ['Element', '', { role: 'style' }, { role: 'annotation' } ],

           <?php

           		for($_i=0; $_i<count($data_x); $_i++){

           			echo "['" . $data_x[$_i] . "'," . $datay[$_i] . ", '" . $color_array[$_i] . "', '" . $datay[$_i] . "%'],\n" ;

           		}

           ?>
        ]);

    var options = {
	      height: 150,
	      width: 500,
	      chartArea: {
	      	left:20,top:10,width:'95%',height:'80%'
	      },
	      legend: {position: 'none'},
	      vAxis: {format:'##'},
	      annotations: { fontsize:10, color: 'black' } ,
	      animation:{
	          startup:true,
	          duration:10,
	          easing: 'inAndOut'
	        }
      
     };

    var chart = new google.visualization.ColumnChart(
                  document.getElementById('cs_bar_chart')
                );

    	chart.draw(data, options);
  }

</script>

<div id="cs_bar_chart" ></div>

