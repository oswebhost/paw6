<?php
print_r($ydata);

?>
<script type="text/javascript">

google.charts.load('current', {'packages':['corechart','line']});

google.charts.setOnLoadCallback(drawChart);   

  function drawBasic() {

  var data = new google.visualization.arrayToDataTable(
      	[
           ['Match', '' ],

           <?php

           		for($_i=0; $_i<count($_SESSION['ydata']); $_i++){

           			echo "['" . ($_i+1) ."'," . $_SESSION['ydata'][$_i] ."],\n" ;

           		}

           ?>
        ]);

    var options = {
        height:230,
        width:500,
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' },
          vAxis: { ticks: [20,40,50,60,70,80,90,100] }
        };

        var chart = new google.visualization.LineChart(
                  document.getElementById('homeLine_chart')
                );

    	chart.draw(data, options);
  }

</script>

<div id="homeLine_chart" ></div>