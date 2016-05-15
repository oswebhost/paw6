<? 
$page_title="Head to Head ";
include("config.ini.php") ;
include("function.ini.php");

$db = $_GET['db'];
$ID = $_GET['ID'];

$c = curseason($db);
$q = "select `hteam`, `ateam` from `fixtures` where `mid`='$ID' and season='$c'";
if($db=='eu'){
    $temp = $eu->prepare($q);
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();

$d = $temp->fetch();  

$home = trim($d[hteam]) ;
$away = trim($d[ateam]) ;

?>
<html>
 <head>
		<title> <?= $page_title ;?> </title>
	</head>
	<link rel="stylesheet" type="text/css" href="css/style_v4.css">
 </head>

<body>

<? page_header($page_title); ?>

<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;"><?echo site($db);?></div>

<table border='1' cellpadding='5' cellspacing='0' width='98%' align='center'  style="border-collapse: collapse"  bordercolor="#cccccc">
	<tr bgcolor='#f4f4f4'>
		<td width='50%' align='center'><span class='credit'> <?= strtoupper($home) ?> </span></td>
		<td width='50%' align='center'><span class='credit'> <?= strtoupper($away) ?> </span></td>
	</tr>
	
	<tr bgcolor='#f4f4f4'>
		<td valign='top'>

			<table border='1' cellpadding='2' cellspacing='0' width='99%' align='center'  style="border-collapse: collapse"  bordercolor="#cccccc">
				<tr  bgcolor="#D3EBAB" height='25'>
					<td width='25%' align='center'><B>Season</B></td>
					<td width='10%' align='center'><B>Div</B></td>
					<td width='40%' align='center'><B>Away Team</B></td>
					<td width='15%' align='center'><B>Score</B></td>
					<td width='15%' align='center'><B>Result</B></td>
				</tr>
				<?	$curwk = cur_week($db);
					$h=$a=$d=$th=$ta=$td=0;
					// current season data
					$q= "select season,mdate,ateam,`div`,h_s,a_s from fixtures where hteam='$home' and ateam='$away' and weekno<>'$curwk' order by match_date desc";


					if($db=='eu'){
					    $temp = $eu->prepare($q);
					}else{
					    $temp = $sa->prepare($q);
					}
					$temp->execute();

					$n =0 ;	
					while ($d = $temp->fetch()) :
						$n++; 
						$rowcol = rowcol($n);
						
						echo "<tr> \n";
						echo "<td $rowcol class='ctd padd'>" . $d[season] . "</td>\n";
						echo "<td $rowcol align='center'>" . $d[div] . "</td>\n";
						echo "<td $rowcol align='left'>" . $d[ateam] . "</td>\n";
						echo "<td $rowcol align='center'>" . $d[h_s] ."-". $d[a_s] . "</td>\n";
						echo "<td $rowcol align='center'>" . res(trim($d['h_s']), trim($d['a_s'])) . "</td>\n";
						echo "</tr>\n";
						$h += $d['h_s']; 
						$a += $d['a_s'];
						$th += (res(trim($d['h_s']), trim($d['a_s']))=="<b>Win</b>"? 1: 0) ;
						$ta += (res(trim($d['h_s']), trim($d['a_s']))=="Loss"? 1: 0) ;
						$td += (res(trim($d['h_s']), trim($d['a_s']))=="Draw"? 1: 0) ;
					endwhile;

					// Past season data
					$q="select season,mdate,ateam,`div`,h_s,a_s from old_fixt where hteam='$home' and ateam='$away' order by season desc, match_date desc";
					if($db=='eu'){
					    $temp = $eu->prepare($q);
					}else{
					    $temp = $sa->prepare($q);
					}
					$temp->execute();				

					while ($d = $temp->fetch()) :
						$n++; 
						$rowcol = rowcol($n);
						
						echo "<tr>\n";
						echo "<td $rowcol class='ctd padd'>" . $d[season] . "</td>\n";
						echo "<td $rowcol align='center'>" . $d[div] . "</td>\n";
						echo "<td $rowcol align='left'>" . $d[ateam] . "</td>\n";
						echo "<td $rowcol align='center'>" . $d[h_s] ."-". $d[a_s] . "</td>\n";
						echo "<td $rowcol align='center'>" . res(trim($d['h_s']), trim($d['a_s'])) . "</td>\n";
						echo "</tr>\n";
						$h += $d['h_s']; 
						$a += $d['a_s'];
						$th += (res(trim($d['h_s']), trim($d['a_s']))=="<b>Win</b>"? 1: 0) ;
						$ta += (res(trim($d['h_s']), trim($d['a_s']))=="Loss"? 1: 0) ;
						$td += (res(trim($d['h_s']), trim($d['a_s']))=="Draw"? 1: 0) ;
					endwhile;
					echo "<tr bgoclor='#ccccc' height='22'>\n"  ;
					echo "<td colspan='5' align='right'> ";
					
					echo "<table width='100%' cellpadding='2' border='1' style='border-collapse: collapse'  bordercolor='#999999'>\n\n";
					echo "<tr  bgcolor=\"#D3EBAB\">\n";
					echo "<td width='20%' align='center'>GF</td>\n";
					echo "<td width='20%' align='center'>GA</td>\n";
					echo "<td width='20%' align='center'>Win</td>\n";
					echo "<td width='20%' align='center'>Loss</td>\n";
					echo "<td width='20%' align='center'>Draw</td>\n";
					echo "</tr>\n";

					echo "<tr>\n";
					
					echo "<td width='20%' align='center'><b> $h </b></td>\n";
					echo "<td width='20%' align='center'><b> $a </b></td>\n";
					echo "<td width='20%' align='center'><b> $th </b></td>\n";
					echo "<td width='20%' align='center'><b> $ta </b></td>\n";
					echo "<td width='20%' align='center'><b> $td </b></td>\n";
					echo "</tr>\n";

					echo "</table>\n";

					echo "</td> \n" ;

							
					echo "</tr>\n";

				?>
			</table>
		</td>

		<td valign='top'>
			<table border='1' cellpadding='2' cellspacing='0' width='99%' align='center'  style="border-collapse: collapse"  bordercolor="#cccccc">
				<tr  bgcolor="#D3EBAB" height='25'>
					<td width='25%' align='center'><B>Season</B></td>
					<td width='10%' align='center'><B>Div</B></td>
					<td width='40%' align='center'><B>Away Team</B></td>
					<td width='15%' align='center'><B>Score</B></td>
					<td width='15%' align='center'><B>Result</B></td>
				</tr>

				<?	$curwk = cur_week($db);
					$h=$a=$d=$th=$ta=$td=0;
					// current season data  Away Team
					$q="select season,mdate,ateam,`div`,h_s,a_s from fixtures where hteam='$away' and ateam='$home' and weekno<>'$curwk' order by match_date desc";
					if($db=='eu'){
					    $temp = $eu->prepare($q);
					}else{
					    $temp = $sa->prepare($q);
					}
					$temp->execute();					
					$n =0 ;	
					while ($d = $temp->fetch()) :
						$n++; 
						$rowcol = rowcol($n);
						
						echo "<tr>\n";
						echo "<td $rowcol class='ctd padd'>" . $d[season] . "</td>\n";
						echo "<td $rowcol align='center'>" . $d[div] . "</td>\n";
						echo "<td $rowcol align='left'>" . $d[ateam] . "</td>\n";
						echo "<td $rowcol align='center'>" . $d[h_s] ."-". $d[a_s] . "</td>\n";
						echo "<td $rowcol align='center'>" . res(trim($d['h_s']), trim($d['a_s'])) . "</td>\n";
						echo "</tr>\n";
						$h += $d['h_s']; 
						$a += $d['a_s'];
						$th += (res(trim($d['h_s']), trim($d['a_s']))=="<b>Win</b>"? 1: 0) ;
						$ta += (res(trim($d['h_s']), trim($d['a_s']))=="Loss"? 1: 0) ;
						$td += (res(trim($d['h_s']), trim($d['a_s']))=="Draw"? 1: 0) ;
					endwhile;

					// Past season data
					$q="select season,mdate,ateam,`div`,h_s,a_s from old_fixt where hteam='$away' and ateam='$home' order by season desc, match_date desc";
					if($db=='eu'){
					    $temp = $eu->prepare($q);
					}else{
					    $temp = $sa->prepare($q);
					}
					$temp->execute();					
				
					while ($d = $temp->fetch()) :
						$n++; 
						$rowcol = rowcol($n);
						
						echo "<tr>\n";
						echo "<td $rowcol class='ctd padd'>" . $d[season] . "</td>\n";
						echo "<td $rowcol align='center'>" . $d[div] . "</td>\n";
						echo "<td $rowcol align='left'>" . $d[ateam] . "</td>\n";
						echo "<td $rowcol align='center'>" . $d[h_s] ."-". $d[a_s] . "</td>\n";
						echo "<td $rowcol align='center'>" . res(trim($d['h_s']), trim($d['a_s'])) . "</td>\n";
						echo "</tr>\n";
						$h += $d['h_s']; 
						$a += $d['a_s'];
						$th += (res(trim($d['h_s']), trim($d['a_s']))=="<b>Win</b>"? 1: 0) ;
						$ta += (res(trim($d['h_s']), trim($d['a_s']))=="Loss"? 1: 0) ;
						$td += (res(trim($d['h_s']), trim($d['a_s']))=="Draw"? 1: 0) ;
					endwhile;

					echo "<tr bgoclor='#ccccc' height='22'>\n"  ;
					echo "<td colspan='5' align='right'> ";

					echo "<table width='100%' cellpadding='2' border='1' style='border-collapse: collapse'  bordercolor='#999999'>\n\n";
					echo "<tr  bgcolor=\"#D3EBAB\">\n";
					echo "<td width='20%' align='center'>GF</td>\n";
					echo "<td width='20%' align='center'>GA</td>\n";
					echo "<td width='20%' align='center'>Win</td>\n";
					echo "<td width='20%' align='center'>Loss</td>\n";
					echo "<td width='20%' align='center'>Draw</td>\n";
					echo "</tr>\n";

					echo "<tr>\n";
					
					echo "<td width='20%' align='center'><b> $h </b></td>\n";
					echo "<td width='20%' align='center'><b> $a </b></td>\n";
					echo "<td width='20%' align='center'><b> $th </b></td>\n";
					echo "<td width='20%' align='center'><b> $ta </b></td>\n";
					echo "<td width='20%' align='center'><b> $td </b></td>\n";
					echo "</tr>\n";

					echo "</table>\n";

					echo "</td> \n" ;

							
					echo "</tr>\n";
				?>
			</table>


			
		</td>


	</tr>

</table>

<div style="padding-bottom:20px"></div>

<div align="center"><A HREF="javascript:close()" class='sbar'>x Close this window x</A></div>


 </body>
 </html>

 <?
function res($hs, $as)
{
	if ( $hs > $as )
	{
		$res = "<b>Win</b>";
	}
	elseif ( $hs==$as )
	{
		$res = "Draw" ;
	}
	else
	{	
		$res ="Loss";
	}
	return $res;
}

 ?>