<?php	
include("config.ini.php");
include("function.ini.php");
$active_mtab = 1;
  
$page_title = "FIFA World Cup 2014 Brazil - THIRD PLACE PLAY-OFF FIXTURE";
include("header.ini.php"); 
 
page_header($page_title); 
  
?>
<div style='border:0px solid red;width:572px;'>
<img src='worldcup/logo.gif' border='0' alt='<?echo $page_title;?>'>
</div>
	
  
<div style="padding:15px">
  <table  width="98%" align="center" border="0">
  <tr>
  	<td width='10%'> <? echo back(); ?> </td>
  	<td align="center" width='80%'></td>
  	<td width='10%' align="right"><? echo printscr(); ?></td>
  </tr>
  </table>
</div>

<?


    $data[] = "TD, 12-Jul-14, BRAZIL, NETHERLANDS,20:00, br, ne" ;
    
   
?>   
<!-- startprint -->
      
    	<table border="1" cellpadding="4"  width="570" style="border-collapse: collapse" bordercolor="#D2D2D2" cellspacing="0">
    		<tr bgcolor="#D3EBAB">
          
          <td class="wcteam bold wcdate ctd">DATE</td>
          <td class="wcteam bold wcsm ctd">GMT</td>
    			<td class="wcteam bold wcmatch ctd" colspan='2'>MATCH</td>
    		</tr>

    
<?php    
    
     for ($i=0; $i<count($data); $i++){
        $line = explode("," , $data[$i]);
           
?>  

        		<tr <? echo rowcol($i);?> >
        			
        	<td class="wctd ctd"><? echo $line[1]; ?></td>
        	<td class="wctd ctd"><? echo $line[4]; ?></td>
            <td class="wctd wcname" style="background:url(worldcup/<? echo trim($line[5]);?>.gif) no-repeat 3px center;padding-left:40px;"><? echo strtoupper($line[2]); ?></td>
            <td class="wctd wcname" style="background:url(worldcup/<? echo trim($line[6]);?>.gif) no-repeat 3px center;padding-left:40px;"><? echo strtoupper($line[3]); ?></td>
              
        		</tr>

       
        
<?} // main for loop ?>



  </table>

<!-- stopprint -->  
  
  <div style="padding-bottom:10px"></div>






<div style="padding-bottom:10px"></div>	
  
	

<? include("footer.ini.php"); ?>