<?php
session_start();

unset($_SESSION['match_ids']);
unset($_SESSION['cur_wk']);
unset($_SESSION['cur_sea']);
unset($_SESSION['db']);


include("config.ini.php") ;
include("function.ini.php") ;

$db = $_GET['db'];

if ($db=='eu'){
	$divs = array("EP", "C0", "C1", "C2", "NC", "SP", "S1", "S2", "S3", "FL", "G0", "GB", "HK", "IS", "P0", "SL","T0");
	$_SESSION['db']= 'eu';
}else{
	$divs = array("BRA", "BRB", "MLS");
	$_SESSION['db']= 'sa';
}  
?>

<html>

<link rel="stylesheet" type="text/css" href="css/style_v4.css">
<title>Predict-a-Win.com</title>

<head>
<script src="javas/js/lib/prototype.js" type="text/javascript"></script>
<script src="javas/js/src/scriptaculous.js" type="text/javascript"></script>

<!-- Our JS Functions -->
<script type="text/javascript">
	function startLoading() {
	  Element.show('mainAreaLoading');
	  Element.hide('mainAreaInternal');
	}
	function finishLoading() {
	  Element.show('mainAreaInternal');
	  setTimeout("Effect.toggle('mainAreaLoading');", 100);
	}
	function startLoading2() {
	  Element.show('mainAreaLoading2');
	  Element.hide('selectedArea');
	}
	function finishLoading2() {
	  Element.show('selectedArea');
	  setTimeout("Effect.toggle('mainAreaLoading2');", 0.5);
	}
	function loadContent() {
	  startLoading();
	  week = document.loadform.weekid.value ;
	  div  = document.loadform.divid.value ;
	  id   = div + "&week=" + week;
	  new Ajax.Updater('mainAreaInternal', 'matchbydiv.php', {method: 'post', postBody:'content='+ id +''});
	  finishLoading();
	  Element.hide('TotalArea');
	}
	function loadMatch(id) {
	  startLoading2();
	  new Ajax.Updater('selectedArea', 'selected.php', {method: 'post', postBody:'mid='+ id +''});
	  finishLoading2();
	  Element.hide('TotalArea');
	}
	function delMatch(id) {
	  startLoading2();
	  new Ajax.Updater('selectedArea', 'selected.php', {method: 'post', postBody:'d=del&id='+ id +''});
	  finishLoading2();
	  Element.hide('TotalArea');
	}

	function show_odd(id,key) {
		var txtodd = "odd" + key;
		var total = 0;
		var y = 0;
		document.getElementById(txtodd).value = id.value;

		for (x=0;x<100;x++) {
			vvv = "odd" + x;
			if (document.getElementById(vvv)){
				next = Number(document.getElementById(vvv).value)	;	
				if (next>0){
					if (total>0){
						total *= next;
					}
					else { 
						total = next ; 
					}
				}
			}  
		}
		//document.getElementById("final").value = total.toFixed(2);
	}
	
	function show_total() {
		Element.hide('go');
		Element.show('mainAreaLoading3');
		Element.hide('TotalArea');
		var total = 0;
		var y = 0;
		
		for (x=0;x<100;x++) {
			vvv = "odd" + x;
			if (document.getElementById(vvv)){
				next = Number(document.getElementById(vvv).value)	;	
				if (next>0){
					if (total>0){
						total *= next;
					}
					else { 
						total = next ; 
					}
				}
			}  
		}
		
		setTimeout("Effect.toggle('mainAreaLoading3');", 2500);
		setTimeout("Element.show('TotalArea');",3500);
		document.getElementById("final").value = "£" + addCommas(total) ;
		
	}

	function addCommas(nStr)
	{
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}
</script>


<style>
.mainAreaInternal {
   height: 450px;
   overflow: auto;
	padding: 0px;
   z-index: 0;
 }

 .mainAreaLoading {
   z-index: 1;
 }
 
.jackpot {
margin:0 auto;  
padding-top:116px;
text-align:center;
background:url('images/cal-bg.gif') no-repeat;
width:325px;
height:163px;
}
.jackpot input {
font-size:30px;
font-weight:bold;
text-align:center;
width:300px;
border:none;
color:#0000ff;
}

</style>

</head>
<? 
$page_title="Correct Scores Jackpot Winnings Calculator "; 
page_header($page_title) ; 
?>


<!-- startprint -->
 


<div style="padding-bottom:5px"></div>

<? if (isset($_GET['db'])) { ?>


<center>
<table width='100%' cellpadding='0' cellspacing='0' border='0'>

<tr>
	
	<td width='45%' valign='top' >
	
	   <div style='padding-left:15px;'>
  
      
		<div style="padding-bottom:5px"></div>
		<form method='post' name='loadform' id='loadform' >
			<input type='hidden' name='db' value='<?php echo $db;?>' />

    <span class='credit'>Week No.</span>
  		<select name='weekid' style='width:50px;font-size:13px;' onChange="loadContent();">
  		<? 
  			for ($i=1; $i<=cur_week($db); $i++):
  			  echo "<option value='$i'". ($i==cur_week($db) ? "selected" : "") ."> $i </option>\n";
  			endfor;
  		?>
  		</select>
  		<div style="padding-bottom:5px"></div>
      <span class='credit'>Select Division</span>
  		<div style="padding-bottom:5px"></div>
  		
  		<select name='divid' style='width:320px;font-size:13px;' onChange="loadContent();">
  		<option value=''></option>
  		<? 
  			for ($i=0; $i<count($divs); $i++):
  			  echo "<option value='$i'>" . divname($divs[$i]) . "</option>\n";
  			endfor;
  		?>
  		</select>
  		</div>
    </form>
    
		<div style="padding-bottom:5px"></div>
		


		<div id="mainAreaLoading" class="mainAreaLoading" style="display: none;padding-top:10px;">
			<span style="position: relative;padding-left:20px;">
				<img src="images/loading.gif" align="center">
				Loading Please Wait...
			</span>
		</div>	

		<div id="mainAreaInternal" class="mainAreaInternal">  </div>

		

	
	</td>

	<td width='55%' valign='top'>
	


	<div style="padding-bottom:8px;padding-left:300px;">
		<A HREF="javascript:close()" class='sbar'>x Close this window x</A>
	</div>
	
	<div style='marign:0;padding:0;border:0px solid #ff0000;text-align:center;'>
		<img src='images/cal-tips.jpg' border='0'>
	</div>
	
	
		<div id="mainAreaLoading2" class="mainAreaLoading" style="display: none;padding-top:0px;">
			<span style="position: relative;padding-left:20px;">
				<img src="images/loading.gif" align="center">
				Loading Please Wait...
			</span>
		</div>	

	<div id="selectedArea" class="selectedArea">  </div>

	
	
	
	
	<div id="mainAreaLoading3" class="mainAreaLoading" style="display: none;padding-top:10px;text-align:center;">
		<span style="position: relative;padding-left:20px;">
			<img src="images/loading.gif" align="center">
			Calculating Total Please Wait...
		</span>
	</div>	
	
	<div style="text-align:center;padding-top:20px;">
		<div id="TotalArea" class="jackpot" style="display:none;">
			<input name='final' readonly id='final'>
		</div>
	</div>	
	
	</td>

</tr>
</table>

<?}else{

  	include("select-option.ini.php");
  }
  
  ?>
</center>
