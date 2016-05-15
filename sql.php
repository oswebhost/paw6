<?php

/**
 * @author IM Khan
 * @copyright 2013
 */

include('config.ini.php');

$db = "sa";



if ($db=="eu"){
    $q1 = 'select * from pr_teams where rank in ("prom","rel") and season in ("2009-2010","2010-2011","2011-2012","2012-2013","2013-2014") order by season';
    $temp = $eu->prepare($q1) ;
}else{
    $q1 = 'select * from pr_teams where rank in ("prom","rel")  order by season';
    $temp = $sa->prepare($q1) ;
}    

$temp->execute();
echo $temp->rowCount();
echo "<br/>";

while ($row = $temp->fetch()) {
    $SEASON = trim($row['season']);
    $team   = trim($row['team']); 
    
    
    if ($db=='eu'){
      switch ($SEASON){
        case "2012-2013": $season = "2013-2014"; break;
        case "2011-2012": $season = "2012-2013"; break;
    	case "2010-2011": $season = "2011-2012"; break;
        case "2009-2010": $season = "2010-2011"; break;
      }
   }else{
    
      switch ($SEASON){
        case "2013": $season = "2014"; break;
        case "2012": $season = "2013"; break;
   	    case "2011": $season = "2013"; break;
        case "2010": $season = "2011"; break;
      }
   }
   
    $q2 = "update fixtures set prvalue='1' where season='$season' and hteam='$team'";
    $q3 = "update fixtures set prvalue='1' where season='$season' and ateam='$team'";
    echo $q2 . ";<br/>";
    echo $q3 . ";<br/>";
    if ($db=="eu"){
         $eu->exec($q2);
         $eu->exec($q3);
    }else{
        $sa->exec($q2);
        $sa->exec($q3);
    }      
   
}




?>