<?php


/**
 * @author IM Khan
 * @copyright 2013
 * 
 * 13786215 job order globe === june 20
 * ref: ofu13060007078
 *  
 * u b 1mb = 
 * 
 * 3m= 1599  
 * 
 * 
 * 5mb =  
 * 
 * 
 * due: 4704---* 2370--
 * 
 */

session_start();
ob_end_clean();
ob_start();

include("config.ini.php");
include("function.ini.php");
include("combinations.php");
include("page-header.ini.php");

$season = $_GET['season'];

foreach($_GET as $key => $value){

    $url .= "$key=$value&";
}
 
 
?>


<html !DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

<head>

<link rel="shortcut icon" href="<?=$domain?>/images/betware.ico">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="title" content="Soccer Predictions Analysis Tool (SoccerPAT) <?echo $page_title ?>">

<title>Soccer Selections Analysis Tool</title>

<link rel="stylesheet" type="text/css" href="<?=$domain?>/css/style_v4.css" media="screen">

<style>
  .dark {border-right:2px solid #333;}
  .row:hover {background-color: #e4d4d4}
</style>
</head>


<body>

<?php  page_header("Summary for Season $_GET[season]"); 
       $page_title ="Summary for Season $_GET[season]  ";

?>

<div style="padding-bottom:5px"></div>

<? if (isset($_GET['db'])){ 
     
?>
<div style='padding-left:30px;'>

<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;background:#E1EFFD;" bordercolor="#f4f4f4" width="99%   ">
	 
	  <form method="get" action="<?echo $PHP_SELEF;?>">
        <input type="hidden" name="db" value="<?echo $_GET['db'];?>"/>
        <input type="hidden" name="season" value="<?echo $_GET['season'];?>"/>
		

		<tr>
           <td class='rtd'><b><font size="2" color="#0000FF">Bet Types </font></b></td>
            <td style='width:150px;'>
                <select size="1" name="BETTING" class="text" style="width:120px;padding:3px;" onchange="this.form.submit();">
              		 <option value="1" <?echo selected($_GET['BETTING'],'1')?>>1X2 Betting</option> 
                     <option value="2" <?echo selected($_GET['BETTING'],'2')?>>Double Chance Betting</option>
                     <option value="3" <?echo selected($_GET['BETTING'],'3')?>>Win Only Betting</option>
                     <option value="4" <?echo selected($_GET['BETTING'],'4')?>>Under 2.5 Goals Betting</option>
                     <option value="5" <?echo selected($_GET['BETTING'],'5')?>>Over 2.5 Goals Betting</option>
      		  </select>
            
            </td>


		  <td class='rtd' style="width: 100px;"><b><font size="2" color="#0000FF">Division(s)</font></b></td>
	
	      <td>
		   <select size="1" name="DIV" class="text" style="width:266px; padding:3px;">

            <? if ($_GET['db']=='eu'){ ?>
		            <option value="0" <?echo selected($_GET['DIV'],'0')?>>UK/European Premier Divisions</option> 
                    <option value="1" <?echo selected($_GET['DIV'],'1')?>>UK/European Major Divisions</option> 
                    <option value="2" <?echo selected($_GET['DIV'],'2')?>>UK Minor Divisions</option> 
            
                    <optgroup label="One Division Only">
          			<? for ($_i=0; $_i<count($arry_div); $_i++){ ?>
          			   <? if ($_i<>4 and $_i<>9 and $_i<>18){ ?>
          					<option value="<? echo $arry_div[$_i];?>" <? echo selected($_GET['DIV'], $arry_div[$_i]);?>><? echo divname($arry_div[$_i]); ?></option>
          			   <? } ?>
          			<? } ?>
                    </optgroup>
             <?}?>

            <? if ($_GET['db']=='sa'){ ?>
          		    <option value="0" <?echo selected($_GET['DIV'],'0')?>>All Divisions</option> 
          			<? for ($_i=0; $_i<count($arry_div_sa); $_i++){ ?>
          				<option value="<? echo $arry_div_sa[$_i];?>" <? echo selected($_GET['DIV'], $arry_div_sa[$_i]);?>><? echo divname($arry_div_sa[$_i]); ?></option>
          			<? } ?>
             <?}?>

			</select>
		  </td>

	</tr>

       <tr>
            
         
           <td class='rtd'><b><font size="2" color="#0000FF">Call Type</font></b></td>
              <td>
    		  <select size="1" name="CALL" class="text" style="width:120px;padding:3px;" onchange="this.form.submit();">
              
                <? if ($_GET['BETTING']==1 or $_GET['BETTING']==4 or $_GET['BETTING']==5){ ?>
        		   <option value="1" <?echo selected($_GET['CALL'],'1')?>>Home Win Calls (PaW)</option> 
                   <option value="2" <?echo selected($_GET['CALL'],'2')?>>Away Win Calls (PaW)</option>
                   <option value="3" <?echo selected($_GET['CALL'],'3')?>>Draw Calls (PaW)</option>
			   <?}?>
			   <? if ($_GET['BETTING']==1 or $_GET['BETTING']==4 or $_GET['BETTING']==5){ ?>
        		   <option value="6" <?echo selected($_GET['CALL'],'6')?>>Home Win Calls (Bookie)</option> 
                   <option value="7" <?echo selected($_GET['CALL'],'7')?>>Away Win Calls (Bookie)</option>
                   <option value="8" <?echo selected($_GET['CALL'],'8')?>>Draw Calls (Bookie)</option>
				<?}?>
               
               <? if ($_GET['BETTING']==2){ ?>
        		   <option value="1" <?echo selected($_GET['CALL'],'1')?>>Home Win/Draw Calls</option> 
                   <option value="2" <?echo selected($_GET['CALL'],'2')?>>Away Win/Draw Calls</option>
               <?}?>
               
               
                 <? if ($_GET['BETTING']==3){ ?>
        		   <option value="1" <?echo selected($_GET['CALL'],'1')?>>Home Win Calls</option> 
                   <option value="2" <?echo selected($_GET['CALL'],'2')?>>Away Win Calls</option>
               <?}?>



    		  </select>
    		</td>
         
         
            
             <td class='rtd'><b><font size="2" color="#0000FF">Sort On</font></b></td>
            <td>
    		 <select size="1" name="SORTBY" class="text" style="width:180px;padding:3px;">
             
          <? if ($_GET['BETTING']=="1"){ ?>   
              <optgroup label="1X2 Odds">  
                <option value="10" <?echo selected($_GET['SORTBY'],'10')?>>1X2 Home Wins Odds</option>
                <option value="11" <?echo selected($_GET['SORTBY'],'11')?>>1X2 Away Wins Odds</option>
                <option value="12" <?echo selected($_GET['SORTBY'],'12')?>>1X2 Draw Odds</option>
    
              </optgroup>
			  
			   
			 <optgroup label="Goals">  
           		 <option value="13" <?echo selected($_GET['SORTBY'],'13')?>> Total Goals Predicted</option>
           		 <option value="14" <?echo selected($_GET['SORTBY'],'14')?>> ASL Goal Difference</option>
             </optgroup>
			 
          <?}?>
          
           <? if ($_GET['BETTING']=="2"){ ?>   
		     <optgroup label="1X2 Odds">  
                <option value="10" <?echo selected($_GET['SORTBY'],'10')?>>1X2 Home Wins Odds</option>
                <option value="11" <?echo selected($_GET['SORTBY'],'11')?>>1X2 Away Wins Odds</option>
                <option value="12" <?echo selected($_GET['SORTBY'],'12')?>>1X2 Draw Odds</option>
              </optgroup>
			  
              <optgroup label="Double Chance Odds">  
                <option value="20" <?echo selected($_GET['SORTBY'],'20')?>>DC 1/X Odds</option>
                <option value="21" <?echo selected($_GET['SORTBY'],'21')?>>DC 2/X Odds</option>
                <option value="22" <?echo selected($_GET['SORTBY'],'22')?>>DC 1/2 Odds</option>
              </optgroup>
			  
			    </optgroup>
			     <optgroup label="Goals">  
           		 <option value="13" <?echo selected($_GET['SORTBY'],'13')?>> Total Goals Predicted</option>
           		 <option value="14" <?echo selected($_GET['SORTBY'],'14')?>> ASL Goal Difference</option>
             </optgroup>
          <?}?>
          
          <? if ($_GET['BETTING']=="3"){ ?>   
		      <optgroup label="1X2 Odds">  
                <option value="10" <?echo selected($_GET['SORTBY'],'10')?>>1X2 Home Wins Odds</option>
                <option value="11" <?echo selected($_GET['SORTBY'],'11')?>>1X2 Away Wins Odds</option>
                <option value="12" <?echo selected($_GET['SORTBY'],'12')?>>1X2 Draw Odds</option>
              </optgroup>
              <optgroup label="Win Only Odds">  
                <option value="30" <?echo selected($_GET['SORTBY'],'30')?>>Home Win Only Odds</option>
                <option value="31" <?echo selected($_GET['SORTBY'],'31')?>>Away Win Only Odds</option>
              </optgroup>
			 
			 </optgroup>
			     <optgroup label="Goals">  
           		 <option value="13" <?echo selected($_GET['SORTBY'],'13')?>> Total Goals Predicted</option>
           		 <option value="14" <?echo selected($_GET['SORTBY'],'14')?>> ASL Goal Difference</option>
             </optgroup>
          <?}?>
          
          <? if ($_GET['BETTING']=="4" or $_GET['BETTING']=="5"){ ?>  

			 <optgroup label="1X2 Odds">  
                <option value="10" <?echo selected($_GET['SORTBY'],'10')?>>1X2 Home Wins Odds</option>
                <option value="11" <?echo selected($_GET['SORTBY'],'11')?>>1X2 Away Wins Odds</option>
                <option value="12" <?echo selected($_GET['SORTBY'],'12')?>>1X2 Draw Odds</option>
              </optgroup>	
			  
              <optgroup label="Under/Over Odds">  
                <option value="40" <?echo selected($_GET['SORTBY'],'40')?>>Under 2.5 Goals Odds</option>
                <option value="41" <?echo selected($_GET['SORTBY'],'41')?>>Over 2.5 Goals Odds</option>
              </optgroup>
			  
			  
          <?}?>
          
          <optgroup label="Goals">  
            <option value="13" <?echo selected($_GET['SORTBY'],'13')?>> Total Goals Predicted</option>
            <option value="14" <?echo selected($_GET['SORTBY'],'14')?>> ASL Goal Difference</option>
          </optgroup>




          <optgroup label="Probabilities">    
            <option value="7" <?echo selected($_GET['SORTBY'],'7')?>>Home Win Probabilities</option>
            <option value="8" <?echo selected($_GET['SORTBY'],'8')?>>Away Win Probabilities</option>
            <option value="9" <?echo selected($_GET['SORTBY'],'9')?>>Draw Probabilities</option>
            
            <option value="50" <?echo selected($_GET['SORTBY'],'50')?>>DC 1/X Probabilities</option>
            <option value="51" <?echo selected($_GET['SORTBY'],'51')?>>DC 2/X Probabilities</option>
            
          </optgroup>    
          
          <optgroup label="All Inclusive Reliabilities">  
            <option value="70" <?echo selected($_GET['SORTBY'],'70')?>>Home Team AI Reliability</option>
            <option value="71" <?echo selected($_GET['SORTBY'],'71')?>>Away Team AI Reliability</option>
            <option value="72" <?echo selected($_GET['SORTBY'],'72')?>>Average AI Reliability</option>
          </optgroup>
          
          <optgroup label="General Prediction Reliabilities">  
            <option value="60" <?echo selected($_GET['SORTBY'],'60')?>>Home Team GP Reliability</option>
            <option value="61" <?echo selected($_GET['SORTBY'],'61')?>>Away Team GP Reliability</option>
            <option value="62" <?echo selected($_GET['SORTBY'],'62')?>>Average GP Reliability</option>
          </optgroup>
          
          <optgroup label="Prediction Type Reliabilities">  
            <option value="1" <?echo selected($_GET['SORTBY'],'1')?>>Home Team PT Reliability</option> 
            <option value="2" <?echo selected($_GET['SORTBY'],'2')?>>Away Team PT Reliability</option>
            <option value="3" <?echo selected($_GET['SORTBY'],'3')?>>Average PT Reliabilities</option>
          </optgroup>    
          
          <optgroup label="Double Chance Reliabilities">  
            <option value="4" <?echo selected($_GET['SORTBY'],'4')?>>Home Team DC Reliability</option>
            <option value="5" <?echo selected($_GET['SORTBY'],'5')?>>Away Team DC Reliability</option>
            <option value="6" <?echo selected($_GET['SORTBY'],'6')?>>Average DC RReliability</option>
          </optgroup>

          
          
    	</select>

    		  	<select size="1" name="ordered" class="text" style="width:85px;padding:3px;" >
                	<option value="1" <? if ($_GET['ordered']==1) echo 'selected';?>>Low-High</option>
                	<option value="2" <? if ($_GET['ordered']==2) echo 'selected';?>>High-Low</option>
		  		</select>
    		  </td>

          
          </tr>
       
       <tr>
           
          
            <td class='rtd'><b><font size="2" color="#0000FF">Odds Range</font></b></td>
            <td><input type='text' style='width:33px;text-align:center;' name='min_odd' value='<?php echo num2($_GET['min_odd'])?>'/> Min
              &nbsp;<input type='text' style='width:33px;text-align:center;' name='max_odd' value='<?php echo num2($_GET['max_odd'])?>'/> Max
            </td>
            
            
              <td class='rtd'><b><font size="2" color="#0000FF">Period/Date</font></b></td>
              <td>
      		  <select size="1" name="PERIOD" class="text" style="width:180px;padding:3px;">
          		   <option value="1" <?echo selected($_GET['PERIOD'],'1')?>>Full Week (Mon - Sun)</option> 
                 <option value="2" <?echo selected($_GET['PERIOD'],'2')?>>Weekend (Sat - Sun)</option>
                 <option value="3" <?echo selected($_GET['PERIOD'],'3')?>>Midweek (Mon - Fri)</option>

                 <?php echo fixture_date($season, $weekno, $db, $_GET['PERIOD'], $divs) ;?>

      		  </select>
    		  </td>
            
       </tr>

            
            <tr>
                <td class='rtd'><b><font size="2" color="#0000FF">ASL</font></b></td>
            <td>
            
            <select size="1" name="ASL2GET" class="text" style="width:120px;padding:3px;">
              	<option value="all">ALL</option>
              	
               <?php if ($_GET['CALL']==3 ){ ?>
              		<option value="00" <?echo selected($_GET['ASL2GET'],'00')?> >0-0</option>
              		<option value="11" <?echo selected($_GET['ASL2GET'],'11')?> >1-1</option>
              		<option value="22" <?echo selected($_GET['ASL2GET'],'22')?> >2-2</option>
              		<option value="33" <?echo selected($_GET['ASL2GET'],'33')?> >3-3</option>
              <?php }?>
			
			   <?php if ($_GET['CALL']==1){ ?>
					<option value="10" <?echo selected($_GET['ASL2GET'],'10')?> >1-0</option>
              		<option value="20" <?echo selected($_GET['ASL2GET'],'20')?> >2-0</option>
              		<option value="21" <?echo selected($_GET['ASL2GET'],'21')?> >2-1</option>
              		<option value="30" <?echo selected($_GET['ASL2GET'],'30')?> >3-0</option>
              		<option value="31" <?echo selected($_GET['ASL2GET'],'31')?> >3-1</option>
              		<option value="32" <?echo selected($_GET['ASL2GET'],'32')?> >3-2</option>
              		<option value="40" <?echo selected($_GET['ASL2GET'],'40')?> >4-0</option>
              		<option value="41" <?echo selected($_GET['ASL2GET'],'41')?> >4-1</option>
               <?php }?>		
 			   
 			   <?php if ($_GET['CALL']==2 ){ ?>
 			   		
					<option value="01" <?echo selected($_GET['ASL2GET'],'01')?> >0-1</option>
              		<option value="02" <?echo selected($_GET['ASL2GET'],'02')?> >0-2</option>
              		<option value="12" <?echo selected($_GET['ASL2GET'],'12')?> >1-2</option>
              		<option value="03" <?echo selected($_GET['ASL2GET'],'03')?> >0-3</option>
              		<option value="13" <?echo selected($_GET['ASL2GET'],'13')?> >1-3</option>
              		<option value="23" <?echo selected($_GET['ASL2GET'],'23')?> >2-3</option>
              		<option value="04" <?echo selected($_GET['ASL2GET'],'04')?> >0-4</option>
              		<option value="14" <?echo selected($_GET['ASL2GET'],'14')?> >1-4</option>
              <?php }?>
              
              </select>

            	
            	
            </td>
            
             <td class='rtd'><b><font size="2" color="#0000FF">Match Limitation</font></b></td>
             
              <td>
 
             <select size="1" name="CALLPARAM" class="text" style="width:180px;padding:3px;" onchange="this.form.submit();">

              <? if ($_GET['BETTING']<>6){ ?>	
               
                 <? if ($_GET['BETTING']==1 and $_GET['CALL']>5 and $_GET['CALL']<8){ ?>	
				 
				  <option value="0" <?echo selected($_GET['CALLPARAM'],'0')?>>All Matches</option> 
                  <option value="1" <?echo selected($_GET['CALLPARAM'],'1')?>>Bookie Aligned with PaW</option> 
                  <option value="2" <?echo selected($_GET['CALLPARAM'],'2')?>>Bookie Opposite to PaW</option>
             
				 <?} elseif ($_GET['BETTING']==1 and $_GET['CALL']==8 ){ ?>	
				 
					<option value="0" <?echo selected($_GET['CALPARAML'],'0')?>>All Matches</option> 
					
				<?}else{ ?>

				  <option value="0" <?echo selected($_GET['CALLPARAM'],'0')?>>All Matches</option> 
                  <option value="1" <?echo selected($_GET['CALLPARAM'],'1')?>>PaW Aligned with Bookie</option> 
                  <option value="2" <?echo selected($_GET['CALLPARAM'],'2')?>>PaW Opposite to Bookie</option>
				
				<?} ?>
			 
			 <?}else{ ?>
             
				<option value="0" <?echo selected($_GET['CALLPARAM'],'0')?>>All Matches</option>
             
			 <?} ?>	 

               </select>

              
			  
			  </td>
             
            </tr>
            <tr>
            


			
				
             	
             <td class='rtd'><b><font size="2" color="#0000FF">Limit Calls to 1st</font></b></td>
            <td><input type='text' style='width:40px;text-align:center;' name='limitedto' value='<?php echo $_GET['limitedto']?>'/>(insert No.)</td>
             
             
              <td class='rtd' ><b><font size="2" color="#0000FF">Rel/Prom </font></b></td>
              <td class='ltd'>
              <select size="1" name="PROPTION" class="text" style="width:180px;padding:3px;">
                  <option value="1" <?echo selected($_GET['PROPTION'],'1')?>>Staying Teams Only</option>
                  <option value="2" <?echo selected($_GET['PROPTION'],'2')?>>All Teams (incl R/P)</option>
                  <option value="3" <?echo selected($_GET['PROPTION'],'3')?>>Just R/P Matches</option>
              </select>
              
              </td>
              
             </tr>
            
		  <tr>
		
			 <?php if ($_GET['BETTING']==1 and $_GET['CALL']==1){ ?>
			<td class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
                   <option value="2" <?echo selected($_GET['CALLAS'],'2')?>>Call as Aways</option>
                   <option value="3" <?echo selected($_GET['CALLAS'],'3')?>>Call as Draws</option>
				   <option value="5" <?echo selected($_GET['CALLAS'],'5')?>>Use Bookies Call</option> 
				</select>
			</td>
			<?php } ?>
			
			<?php if ($_GET['BETTING']==1 and $_GET['CALL']==2 ){ ?>
			<td  class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
				   <option value="1" <?echo selected($_GET['CALLAS'],'1')?>>Call as Homes</option> 
                   <option value="3" <?echo selected($_GET['CALLAS'],'3')?>>Call as Draws</option>
				   <option value="5" <?echo selected($_GET['CALLAS'],'5')?>>Use Bookies Call</option>  
				</select>
			</td>
			<?php } ?>
			
			<?php if ($_GET['BETTING']==1 and $_GET['CALL']==3 ){ ?>
			<td  class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
				   <option value="1" <?echo selected($_GET['CALLAS'],'1')?>>Call as Homes</option> 
                   <option value="2" <?echo selected($_GET['CALLAS'],'2')?>>Call as Aways</option>
				   <option value="5" <?echo selected($_GET['CALLAS'],'5')?>>Use Bookies Call</option>  
				</select>
			</td>
			<?php } ?>
			
			
			
			<?php if ($_GET['BETTING']==1 and $_GET['CALL']==6){ ?>
			<td class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
                   <option value="2" <?echo selected($_GET['CALLAS'],'2')?>>Call as Aways </option>
                   <option value="3" <?echo selected($_GET['CALLAS'],'3')?>>Call as Draws</option>
				   <option value="4" <?echo selected($_GET['CALLAS'],'4')?>>Use PaW Calls</option>
				   
				</select>
			</td>
			<?php } ?>
			
			<?php if ($_GET['BETTING']==1 and $_GET['CALL']==7 ){ ?>
			<td class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
				   <option value="1" <?echo selected($_GET['CALLAS'],'1')?>>Call as Homes</option> 
                   <option value="3" <?echo selected($_GET['CALLAS'],'3')?>>Call as Draws</option>
				   <option value="4" <?echo selected($_GET['CALLAS'],'4')?>>Use PaW Calls</option>
				</select>
			</td>
			<?php } ?>
			
			<?php if ($_GET['BETTING']==1 and $_GET['CALL']==8 ){ ?>
			<td class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
				   <option value="1" <?echo selected($_GET['CALLAS'],'1')?>>Call as Homes</option> 
                   <option value="2" <?echo selected($_GET['CALLAS'],'2')?>>Call as Aways</option>
				   <option value="4" <?echo selected($_GET['CALLAS'],'4')?>>Use PaW Calls</option>
				</select>
			</td>
			<?php } ?>	

			<?php if ($_GET['BETTING']==5 ){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
				   <option value="10" <?echo selected($_GET['CALLAS'],'10')?>>Call as Under 2.5</option> 
				</select>
			</td>
			<?php } ?>
			
			<?php if ($_GET['BETTING']==4 ){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
				   <option value="11" <?echo selected($_GET['CALLAS'],'11')?>>Call as Over 2.5</option> 
				</select>
			</td>
			<?php } ?>

						<?php if ($_GET['BETTING']==2 and $_GET['CALL']==1){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
                   <option value="7" <?echo selected($_GET['CALLAS'],'7')?>>Away Win/Draw Call</option>
                   <option value="9" <?echo selected($_GET['CALLAS'],'9')?>>Home Win/Away Win</option>
				</select>
			</td>
			<?php } ?>
			
			<?php if ($_GET['BETTING']==2 and $_GET['CALL']==2){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
                   <option value="8" <?echo selected($_GET['CALLAS'],'8')?>>Home Win/Draw Call</option>
                   <option value="9" <?echo selected($_GET['CALLAS'],'9')?>>Home Win/Away Win</option>
				</select>
			</td>
			<?php } ?>
			
			
			
				<?php if ($_GET['BETTING']==3 and $_GET['CALL']==1){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
                   <option value="12" <?echo selected($_GET['CALLAS'],'12')?>>Call as Away Wins</option>
				   <option value="14" <?echo selected($_GET['CALLAS'],'14')?>>Call as Draws</option>
				   
				</select>
			</td>
			<?php } ?>
			
			<?php if ($_GET['BETTING']==3 and $_GET['CALL']==2){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
                   <option value="13" <?echo selected($_GET['CALLAS'],'13')?>>Call as Home Wins</option>
				   <option value="14" <?echo selected($_GET['CALLAS'],'14')?>>Call as Draws</option>
				</select>
			</td>
			<?php } ?>



			
		      <td colspan='3' class='ctd padd'>
		      <input type="submit" value="View Data" name="B1" class="bt" style="padding:0px;"/>

		   </td>
		</tr>
        </form>
</table>





<table  width="90%">
<tr>
  <td></td>
  <td align="center"><span class='bot'></span></td>
  <td align="right"> <? echo printscr(); ?></td>
</tr>
<tr>
	<td colspan='3' style='padding-left:3px;'>
	<?
		foreach($_GET as $key => $value){

				$url .= "$key=$value&";
		}

		$summaryURL =  substr($url, 0, strlen($url)-14) 
	
	?>
		<ul id="countrytabs" class="shadetabs" style='margin:0px;padding:0'>
			<li><a href="#" rel="#default" class="selected">SINGLES</a></li>
			<li><a href="doubles.php?<?php echo $summaryURL;?>" rel="countrycontainer">DOUBLES</a></li>
			<li><a href="triples.php?<?php echo $summaryURL;?>" rel="countrycontainer">TREBLES</a></li>
			<li><a href="quadruples.php?<?php echo $summaryURL;?>" rel="countrycontainer">QUADRUPLES</a></li>
			<li><a href="quintuples.php?<?php echo $summaryURL;?>" rel="countrycontainer">QUINTUPLES</a></li>
			<li><a href="sextuples.php?<?php echo $summaryURL;?>" rel="countrycontainer">SEXTUPLES</a></li>
		</ul>

	</td>
</tr>
</table>

<!-- startprint -->

<div id="countrydivcontainer" style="width:630px;padding: 0px;margin-top:1px;">
	<?php include("singles.php"); ?>
</div>

<script type="text/javascript">
	var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
	countries.setpersist(false)
	countries.setselectedClassTarget("link") //"link" or "linkparent"
	countries.init()
</script>

<?php }?>

</div>

</body>

</html>

<?php
 // echo "<pre>";
 // print_r($_GET);
//  echo "</pre>";
  $eu = null;
  $sa = null;
  $sp = null;
  mysql_close($link);
?>