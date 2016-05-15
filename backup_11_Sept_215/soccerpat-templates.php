<?php

include("config.ini.php");
include("function.ini.php");

$page_title = "SoccerPAT Templates";

include("header.ini.php");
page_header($page_title);

?>
<!--
 <form method="get" action="<?echo $PHP_SELEF;?>">
	<table border="0" cellpadding="2" cellspacing="0" style="margin:auto auto;border:1px solid #ccc;background:#E1EFFD;" bordercolor="#f4f4f4" width="60%   ">
		<tr>
		   <td class='rtd'><b><font size="2" color="#0000FF">Bet Types </font></b></td>
			<td style='width:150px;'>
				<select size="1" name="bettype" class="text" style="width:180px;padding:3px;" >
					<?php
						$query1 = "select DISTINCT(bettype) as bettype from patdownloads order by bettype";
						$temp = $eu->prepare($query1) ;
						$temp->execute();
						while ($row = $temp->fetch()) {
							echo "<option value='" . trim($row['bettype']) . "'>". trim($row['bettype']) . "</option>\n";
						}
					?>					
			  </select>
			</td>
		</tr>

		<tr>
		   <td class='rtd'><b><font size="2" color="#0000FF">Call Types </font></b></td>
			<td style='width:150px;'>
				<select size="1" name="calltype" class="text" style="width:180px;padding:3px;" >
					<?php
						$query1 = "select DISTINCT(calltype) as calltype from patdownloads order by calltype";
						$temp = $eu->prepare($query1) ;
						$temp->execute();
						while ($row = $temp->fetch()) {
							echo "<option value='" . trim($row['calltype']) . "'>". trim($row['calltype']) . "</option>\n";
						}
					?>					
			  </select>
			</td>
		</tr>
		
		<tr>
		   <td class='rtd'><b><font size="2" color="#0000FF">Reverse Call </font></b></td>
			<td style='width:150px;'>
				<select size="1" name="parameter1" class="text" style="width:180px;padding:3px;" >
					<?php
						$query1 = "select DISTINCT(parameter1) as parameter1 from patdownloads order by parameter1";
						$temp = $eu->prepare($query1) ;
						$temp->execute();
						while ($row = $temp->fetch()) {
							echo "<option value='" . trim($row['parameter1']) . "'>". trim($row['parameter1']) . "</option>\n";
						}
					?>					
			  </select>
			</td>
		</tr>
		
		<tr>
		   <td class='rtd'><b><font size="2" color="#0000FF">Rel/Prom Treatment </font></b></td>
			<td style='width:150px;'>
				<select size="1" name="parameter2" class="text" style="width:180px;padding:3px;" >
					<option value='0'>Optional</option>
					<?php
						$query1 = "select DISTINCT(parameter2) as parameter2 from patdownloads order by parameter2";
						$temp = $eu->prepare($query1) ;
						$temp->execute();
						while ($row = $temp->fetch()) {
							echo "<option value='" . trim($row['parameter2']) . "'>". trim($row['parameter2']) . "</option>\n";
						}
					?>					
			  </select>
			</td>
		</tr>

		<tr>
		   <td class='rtd'><b><font size="2" color="#0000FF">Match Limitation</font></b></td>
			<td style='width:150px;'>
				<select size="1" name="parameter3" class="text" style="width:180px;padding:3px;" >
					<option value='0'>Optional</option>
					<?php
						$query1 = "select DISTINCT(parameter3) as parameter3 from patdownloads order by parameter3";
						$temp = $eu->prepare($query1) ;
						$temp->execute();
						while ($row = $temp->fetch()) {
							echo "<option value='" . trim($row['parameter3']) . "'>". trim($row['parameter3']) . "</option>\n";
						}
					?>					
			  </select>
			</td>
		</tr>

		<tr>
		   <td class='rtd'><b><font size="2" color="#0000FF">Divisions to Use</font></b></td>
			<td style='width:150px;'>
				<select size="1" name="parameter4" class="text" style="width:180px;padding:3px;" >
					<option value='0'>Optional</option>
					<?php
						$query1 = "select DISTINCT(parameter4) as parameter4 from patdownloads order by parameter4";
						$temp = $eu->prepare($query1) ;
						$temp->execute();
						while ($row = $temp->fetch()) {
							echo "<option value='" . trim($row['parameter4']) . "'>". trim($row['parameter4']) . "</option>\n";
						}
					?>					
			  </select>
			</td>
		</tr>
		<tr>
			<td colspan='2' class='ctd' style='padding:15px'><input type="submit" value="View Files" name="B1" class="bt" style="padding:0px;"/></td>
		</tr>
	</table>
</form>

<br/><br/>
-->	
	
	
	<table border="0" cellpadding="2" cellspacing="0" style="margin:auto auto;border:0px solid #ccc;background:#E1EFFD;" bordercolor="#f4f4f4" width="100%   ">	
		<tr>
			<td style='font-size:14px;padding:5px;border-bottom:1px solid #c0c0c0' ><b>Available Templates</b></td>
		</tr>
		
		<?php
			$query1 = "select filename from patdownloads order by filename";
			$temp = $eu->prepare($query1) ;
			$temp->execute();
			while ($row = $temp->fetch()) {
				$file = "patdownloads/". trim($row['filename']);
				echo "<tr>\n";
				echo "<td style='padding:8px;'><a class='sbar' href='" . $file . "' title='Click to download'>". trim($row['filename']) . "</a></td>\n";
				echo "</tr>\n";
			}
		?>
	
	</table>
	
	
<? include("footer.ini.php"); ?>