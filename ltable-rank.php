<?php

session_start();

$parts = explode(",",$t_url);

$DIV    = $parts[0];
$wk     = ($parts[1]>1 ? $parts[1]-1 : 1);
$sea    = $parts[2];
$last_season =$parts[3];
$congrp     =$parts[4];

$db = div2db($DIV);

$qry = "select season,team,`div`,sum(hw+hd+hl+aw+ad+al) as tp,sum(hpoint+apoint) as points,sum(hw+aw) as w,sum(hd+ad) as d,
sum(hl+al) as l,sum(hgf+agf) as gf,sum(hga+aga) as ga,sum((hgf+agf)-(hga+aga)) as gd from tabs where `div`='$DIV' and 
season='$sea' and weekno='$wk' ";

if (count($parts)==5) $qry .= " and congrp='$congrp' ";

$qry .= "group by team order by points desc,gd desc, gf desc, team";

?>

<table border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse;" bordercolor="#000000" width="100%" align="center">
 
 <tr>
    <td style='background:#f4f4f4;padding:5px;text-align:center;' colspan="12"><font class='credit'>Overall League Standings <font color="purple"><?php echo divname($DIV); ?></font></font></td>
 </tr>

 
  <tr bgcolor="#D3EBAB">
    <td  style="text-align: center;width:20px"><b>Rank</b></td>
	<td style="text-align: left;width:230px"><b>Team</b></td>
	<td style="text-align: center;width:30px"><b>RLS</b></td>
	<td style="text-align: center;width:50px"><b>Played</b></td>
	<td style="text-align: center;width:40px"><b>W</b></td>
	<td style="text-align: center;width:40px"><b>D</b></td>
	<td style="text-align: center;width:40px"><b>L</b></td>
	<td style="text-align: center;width:40px"><b>GF</b></td>
	<td style="text-align: center;width:40px"><b>GA</b></td>
	<td style="text-align: center;width:40px"><b>GD</b></td>
	<td style="text-align: center;width:50px"><b>Pts</b></td>
    <td style="text-align: center;width:250px;"><b>*Last 5 Matches</b></td>
  </tr>


<?php






if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();

 
$num_of_rows = $temp->rowCount() ;
//echo $num_of_rows ;
 
$data="";
$number=0;



while ($row = $temp->fetch()){

	$DIV=$row["div"];
	$number++;
	
	$rowcol = rowcol($number);

	$rank = last_season_rank(addslashes($row['team']),$last_season,$db);	
    $last5 = last_five_matches($row['team'], $row['div'],"ALL",$wk,$db);
    

    if (trim($row["team"]) == trim($_SESSION['home'])):
		$rowcol =" style='height:15px;background:blue;color:white;text-align:center;' ";
	elseif (trim($row["team"]) == $_SESSION['away']):
		$rowcol =" style='height:15px;background:red;color:white;text-align:center;' ";
	else:
		$rowcol = rowcol($number);
	endif;
    
?>
       
 <tr <?php echo $rowcol; ?>>
    <td class='ctd padd'><?php echo $number; ?></td>
    <td ><?php echo $row['team'];?></td>
    <td class='ctd'><?php echo $rank;?></td>
    <td class='ctd'><?php echo $row['tp'];?></td>
    <td class='ctd'><?php echo $row['w'];?></td>
    <td class='ctd'><?php echo $row['d'];?></td>
    <td class='ctd'><?php echo $row['l'];?></td>
    <td class='ctd'><?php echo $row['gf'];?></td>
    <td class='ctd'><?php echo $row['ga'];?></td>
    <td class='ctd'><?php echo $row['gd'];?></td>
    <td class='ctd'><?php echo $row['points'];?></td>
    <td class='ctd'><?php echo $last5;?></td>
 </tr>

<?php } ?>


</table>	

<div style='padding-top:3px;font-size:10px;font-family:verdana;text-align:center;'>
    <font color='red'>RLS</font> = Rank Last Season&nbsp;&nbsp;|&nbsp;&nbsp;  
    <font color='red'>prom</font> = promoted team&nbsp;&nbsp;|&nbsp;&nbsp;
    <font color='red'>rel</font> = relegated team <br />
    <span class='bb'>*</span> Last 5 matches listed in order of oldest first, latest last.
</div>