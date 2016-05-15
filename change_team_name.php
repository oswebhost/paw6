<?php
include("config.ini.php");

$old_name = "AC Cesena";
$new_name = "Cesena";
$season = "2014-2015";
$old_season = "2013-2014";

$q = array(  
	  "update `fixtures` set ateam='$new_name'  where season='$season' and ateam='$old_name'" ,
	  "update `fixtures` set hteam='$new_name'  where season='$season' and hteam='$old_name'" ,
	  "update `fixt_list` set ateam='$new_name'  where season='$season' and ateam='$old_name'",
	  "update `fixt_list` set hteam='$new_name'  where season='$season' and hteam='$old_name'",
	  "update `tabs` set team='$new_name'  where season='$season' and team='$old_name'",
	  "update `matrix` set team='$new_name'  where season='$season' and team='$old_name'",
	  "update `cur_hedge` set ateam='$new_name'  where season='$season' and ateam='$old_name'",
	  "update `cur_hedge` set hteam='$new_name'  where season='$season' and hteam='$old_name'",
	  "update `cur_reb` set ateam='$new_name'  where season='$season' and ateam='$old_name'",
	  "update `cur_reb` set hteam='$new_name'  where season='$season' and hteam='$old_name'",
	  "update `cur_reb_air` set ateam='$new_name'  where season='$season' and ateam='$old_name'",
	  "update `cur_reb_air` set hteam='$new_name'  where season='$season' and hteam='$old_name'",
	  "update `cur_reb_dcr` set ateam='$new_name'  where season='$season' and ateam='$old_name'",
	  "update `cur_reb_dcr` set hteam='$new_name'  where season='$season' and hteam='$old_name'",
	  "update `cur_reb_ptr` set ateam='$new_name'  where season='$season' and ateam='$old_name'",
	  "update `cur_reb_ptr` set hteam='$new_name'  where season='$season' and hteam='$old_name'",
	  "update `pr_teams` set team='$new_name'  where season='$old_season' and team='$old_name'"
  );



for ($i=0; $i<count($q); $i++) {
	
	echo $q[$i] . " -> ".  $eu->exec($q[$i]) . " <br/>" ;
}


?>