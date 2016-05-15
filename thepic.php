<?php

$page_title="Soccer Teams Performance Data";
require_once("config.ini.php");
require_once("function.ini.php");

$show_key= meta_tools();
$desc = "To understand how/why our Program makes the predictions it does, we produce what we call a Performance Indicator Chart (or PIC). A PIC is available for each and every League Division match posted on our websites. However, PIC's are not available for non-League Division fixtures, such as for UEFA Champions League matches or the World Cup, simply because there is no relevant or equivalent data to work with.";

require_once("header.ini.php");

$PAGE_TITLE="Performance Indicator Chart (PIC)";
?>
<!-- startprint -->

<?php page_header($PAGE_TITLE);?>


<p>For those who want a detailed understanding as to how/why our Program has made its predictions, we produce what we call a <span class='green'>Performance Indicator Chart</span> (or <span class='green'>PIC</span>). A <span class='green'>PIC</span> is available for each and every League Division match posted on this website. However, <span class='green'>PIC's</span> are not available for non-League Division fixtures, such as for UEFA Champions League matches or the World Cup, simply because there is no relevant or equivalent data to work with.</p>

<p>The <span class='green'>PIC</span> is our very own specially devised chart, <B>pictorially showing the immediate past and current scoring records for the two teams</B>, and it is best read in conjunction with the specially prepared series of associated prediction "Usefulness" tables and backup data that follow it (which we collectively refer to as the <span class='green'>PIC Backup Data</span>). </p>

<p>The purpose of the <span class='green'>PIC Backup Data</span> is to assist you to fully understand the relevance of our Program's predictions for each and every match. The level of information it contains is phenomenal and, if you spend the time to master its content, you will soon see that the benefits to you are inestimable. Of course, if you like being spoon-fed your betting selections and are happy to keep losing money on the "sure-fire" wins the scammers make you pay a fortune for, then all of this fantastic wealth of data will be meaningless to you.  This means you can stop reading at this point, because the rest of what is written below is aimed at serious Bettors. </p>


<p>If you click on the <b>Date/Time</b> shown against any listed match you will be taken to a scroll-down screen, where you will find the <span class='green'>PIC</span> and all the <span class='green'>PIC Backup Data</span> for the selected match. </p>

<p>The <span class='green'>PIC</span> itself is a very colourful chart presented in an easy-to-understand format, its principal advantage being that it is very visual, not just a boring table of statistics. It has a central vertical core showing a range of match score-lines (which are, in fact, the list of the 24 more usual score-lines utilised by the European Bookies, with the "<B>X</B>" denoting "extreme" scores, some perhaps not covered by the Bookies' Odds).  </p>

<p>The permutation of possible score-lines on the <span class='green'>PIC</span> is stacked so that the Draws occupy the centre of the block, the Home Win score-lines sit at the top, and the Away Win score-lines reside at the bottom. The stack of Draws is coloured green, the Home Wins blue, and the Away Wins red. The possible score-lines are incremented away from the centre block of Draws one goal at a time, with the Home Wins on the upper sector and their mirror image (for the Away Win scores) on the lower sector.</p>

<p>On the left-hand side of the <span class='green'>PIC's</span> vertical score-lines list you will see, set against each respective score-line, a record of the Home Team's performance when playing at Home, and on the right-hand side the corresponding details for the Away Team when playing Away. The "results" are represented by coloured squares, generally one per match but not where the space is insufficient), and the total number of occurrences is given either immediately to the left or to the right, according to whether it is the Home Team's or Away Team's data. </p>

<p>The <span class='green'>PIC</span> was arranged by us in this novel manner for the sole purpose of enabling you to see, almost at a glance, how both teams in each match have performed up to the end of the week preceding the date of the match. We initially invented it as a visual "sanity check" against the Program's purely statistical output, but we quickly appreciated that it had great potential for helping us to identify the best "Correct Score" bets (based around the "median" rather than the "mean" of the score-lines achieved by both teams).</p>

<p>In essence, you should use the <span class='green'>PIC</span> as a pure visual check like this:</p>


<ul>
	<li style='padding-top:10px;margin-left:60px;'>If most of the Home Team's current squares are against the blue central zone, then it means it is doing well when playing at Home. Conversely, if its squares are predominantly against the green central zone it means it returns more Draws than wins or losses. However, if the squares are mainly alongside the red central zone it means the team is losing badly when playing at Home.</li>

	<li style='padding-top:10px;margin-left:60px;'>If most of the Away Team's current squares are against the red central zone, then it means it is doing well when playing Away. Conversely, if its squares are predominantly against the green central zone it means it returns more Draws than wins or losses. And if the squares are mainly alongside the blue central zone, then it means the team is losing badly when playing Away.</li>

</ul>

<p style='padding-top:14px'>Of course, you can't expect the <span class='green'>PIC</span> to be equally as useful for every team, let alone every match! You have to use it as just one more "aid" to selection in conjunction with all its associated "<B>Prediction Backup & Usefulness Data</B>" (found in the tables and charts under the <span class='green'>PIC</span> chart, and which we deal with in detail under the section titled "<a class='prv' href='upic.php'>Utilising the PIC Backup Data</a>" from the Services Information menu).</p>

<p>One very important point to bear in mind is that if you look back at the <span class='green'>PIC</span> for a previous week's match, all reports AFTER the "PREDICTION BACKUP & USEFULNESS DATA" (i.e. from "Prediction Accuracy This Season for Home Team" on and downwards) will require_once all the FIXTURES and RESULTS information right up to the current week - it won't show you the position "as was" at the date of the match. This is because the database required to store all such past <span class='green'>PIC's</span> would simply be too huge for the server to handle. This means that you will need to do some minor mental gymnastics if going back too many weeks (and if you need to do so, we are sorry about that).</p>


<!-- stopprint -->
<?php 
	$ptopic="ggexplained.php"; $ntopic="compilingpic.php";
	$msg=$PAGE_TITLE;
	require_once("icons.ini.php") ;
	require_once("footer.ini.php"); 
?>