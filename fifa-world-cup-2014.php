<?php
include ("config.ini.php");
include ("function.ini.php");

$active_mtab = 1;

$page_title = "FIFA World Cup 2014 Brazil";
include ("header.ini.php");


page_header($page_title);
?>
<div style='border:0px solid red;width:572px;'>
	<img src='worldcup/logo.gif' border='0' alt='<?echo $page_title; ?>'>
</div>

<table width="98%" align="center" bgcolor="#ffffff">

	<tr>

		<td align='center' width='2%'>&nbsp;</td>

		<td width="97%"> &nbsp;</td>

	</tr>

	<tr>
		<td width="97%"> &nbsp;</td>
	</tr>
	<tr>
		<td align='left' bgcolor="#ebebf3"  style="padding:4px;"><font size="4" color="#ff0000" ><b><i>OPEN ACCESS DATA</i></b></font></td>
	</tr>

	<tr>
		<td > &nbsp;</td>
	</tr>

	<tr>
		<td>
			<div class="mainlink" style="width:440px;" onclick="location.href='fifa-worldcup-2014-group-tables.php'">
				<a href="fifa-worldcup-2014-group-tables.php">&raquo; Group Tables</a>
			</div>
		</td>
	</tr>

	<tr>
		<td>
		<div class="mainlink" style="width:440px;" onclick="location.href='fifa-worldcup-2014-fixtures-final.php'">
			<a href="fifa-worldcup-2014-fixtures-final.php">&raquo; Final Fixture</a>
		</div></td>
	</tr>

	<tr>
		<td>
		<div class="mainlink" style="width:440px;" onclick="location.href='fifa-worldcup-2014-fixtures-third-place.php'">
			<a href="fifa-worldcup-2014-fixtures-third-place.php">&raquo; Third Place Play-Off Fixture</a>
		</div></td>
	</tr>

	<tr>
		<td>
		<div class="mainlink" style="width:440px;" onclick="location.href='fifa-worldcup-2014-fixtures-quarter-finals.php'">
			<a href="fifa-worldcup-2014-fixtures-quarter-finals.php">&raquo; Quarter Final Fixtures</a>
		</div></td>
	</tr>

	<tr>
		<td>
		<div class="mainlink" style="width:440px;" onclick="location.href='fifa-worldcup-2014-fixtures-round16.php'">
			<a  href="fifa-worldcup-2014-fixtures-round16.php">&raquo; Round of 16 Fixtures</a>
		</div></td>
	</tr>

	<tr>
		<td >
		<div class="mainlink" style="width:440px;" onclick="location.href='fifa-worldcup-2014-fixtures.php'">
			<a  href="fifa-worldcup-2014-fixtures.php">&raquo; Group Fixtures</a>
		</div></td>
	</tr>

	<tr>
		<td height="12" align='center' width='2%'>&nbsp;</td>
		<td width="97%">&nbsp;</td>
	</tr>

	<tr>
		<td width="97%"> &nbsp;</td>
	</tr>
	<tr>
		<td align='left' bgcolor="#ebebf3"  style="padding:4px;"><font size="4" color="GREEN" ><b><i>RESTRICTED ACCESS (NOW REMOVED)</i></b></font></td>
	</tr>

	<tr>
		<td > &nbsp;</td>
	</tr>
	
		<tr>
		<td >
			<div class="mainlink" style="width:440px;" onclick="location.href='fifa-worldcup-2014-predictions-final.php'">
				<a  href="fifa-worldcup-2014-predictions-final.php">&raquo; Final</a>
			</div>
		</td>
	</tr>
	
	<tr>
		<td >
		<div class="mainlink" style="width:440px;" onclick="location.href='fifa-worldcup-2014-predictions-third-place.php'">
			<a  href="fifa-worldcup-2014-predictions-third-place.php">&raquo; Third Place Play-Off</a>
		</div></td>
	</tr>
	
	
	<tr>
		<td >
		<div class="mainlink" style="width:440px;" onclick="location.href='fifa-worldcup-2014-predictions-semi-finals.php'">
			<a  href="fifa-worldcup-2014-predictions-semi-finals.php">&raquo; Semi-Finals</a>
		</div></td>
	</tr>

	<tr>
		<td >
		<div class="mainlink" style="width:440px;" onclick="location.href='fifa-worldcup-2014-predictions-quarter-finals.php'">
			<a  href="fifa-worldcup-2014-predictions-quarter-finals.php">&raquo; Quarter Finals</a>
		</div></td>
	</tr>

	<tr>
		<td >
		<div class="mainlink" style="width:440px;" onclick="location.href='fifa-worldcup-2014-predictions-round-of-16.php'">
			<a  href="fifa-worldcup-2014-predictions-round-of-16.php">&raquo; Round of 16 Matches</a>
		</div></td>
	</tr>

	<tr>
		<td >
		<div class="mainlink" style="width:440px;" onclick="location.href='fifa-worldcup-2014-group-matches-round-3.php'">
			<a  href="fifa-worldcup-2014-group-matches-round-3.php">&raquo; Group Matches Batch 3</a>
		</div></td>
	</tr>

	<tr>
		<td >
		<div class="mainlink" style="width:440px;" onclick="location.href='fifa-worldcup-2014-group-matches-round-2.php'">
			<a  href="fifa-worldcup-2014-group-matches-round-2.php">&raquo; Group Matches Batch 2</a>
		</div></td>
	</tr>

	<tr>
		<td >
		<div class="mainlink" style="width:440px;" onclick="location.href='fifa-worldcup-2014-group-matches-round-1.php'">
			<a  href="fifa-worldcup-2014-group-matches-round-1.php">&raquo; Group Matches Batch 1</a>
		</div></td>
	</tr>

	<tr>
		<td >
		<div class="mainlink" style="width:440px;" onclick="location.href='fifa-worldcup-2014-1stround-points-odds.php'">
			<a  href="fifa-worldcup-2014-1stround-points-odds.php">&raquo; Odds for 1st Round No. of Points</a>
		</div></td>
	</tr>

</table>

<?
include ("footer.ini.php");
?>