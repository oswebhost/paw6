<?	
session_start();
//include("authorization.php");

include("config.ini.php");

include("function.ini.php");

$eucur = curseason('eu');
$sacur = curseason('sa');

$page_title = "Major Divisions Free 1X2 Predictions";

include("header.ini.php");
?>



<? page_header("$page_title") ; ?>


        <font size="3" color="#0000FF"><b><i>Current Week’s Fixtures & Predictions <font size='2'>(no Score-Lines)</font></i></b></font> <BR><BR>
 
		<table border="1" width="570" align="center" bordercolor="#EBEBF3" cellspacing="0" style="border-collapse: collapse" cellpadding="4">
			
            
            <tr>
            	<td width="100%" colspan="2" style='padding:5px' bgcolor='#CADFEE'><span class="credit">EUROPE</span> - 
	 				<?php
	              	if (chk_season('eu')==1){
	              		 echo  " (" . curseason('eu') . " Season has been concluded)";
	              	}else{	
	            	 	echo "Week " . cur_week('eu') . "(" .  weekbegin('eu') . ")";
	            	}
	            	?> 		
            	</td>
            </tr>
            
			<tr><td width="100%" colspan="2" bgcolor='#f4f4f4'><B>ENGLAND</B></td></tr>
		
			<tr>
				<td width="50%" >
				<? if (gg_count('EP','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
				   echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=EP'.$wk.'">Barclay Premiership' ;
				   echo " (" . gg_count('EP','n/a','FIXTURE') . ")</a>" ;

				?>
				</td>
				<td width="50%" >
				<? if (gg_count('C0','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
				  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=C0'.$wk.'">Championship' ;
				  echo " (" . gg_count('C0','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
			</tr>
			<tr>
				<td>
				<? if (gg_count('C1','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
				  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=C1'.$wk.'">League 1' ;
				  echo " (" . gg_count('C1','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
				<td>
				<? if (gg_count('C2','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
				  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=C2'.$wk.'">League 2' ;
				  echo " (" . gg_count('C2','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				
				</td>
			</tr>
			<tr>
						
			
				<td colspan='2'>
				<? if (gg_count('FA','n/a','FIXTURE')>0) :
						 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
				  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=FA'.$wk.'">English FA Cup/Carling Cup' ;
				  echo " (" . gg_count('FA','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
				
			
				</tr>
        





			<tr><td width="100%" colspan="2" bgcolor='#f4f4f4'><B>SCOTLAND</B></td></tr>
			<tr>
				<td>
				<? if (gg_count('SP','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=SP'.$wk.'">Premier' ;
					  echo " (" . gg_count('SP','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
				<td>
				<? if (gg_count('S1','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=S1'.$wk.'">Division 1' ;
					  echo " (" . gg_count('S1','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
			</tr>
				<tr>

				<td>
				<? if (gg_count('S2','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=S2'.$wk.'">Division 2' ;
					  echo " (" . gg_count('S2','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
				<td>
				<? if (gg_count('S3','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=S3'.$wk.'">Division 3' ;
					  echo " (" . gg_count('S3','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<? if (gg_count('SA','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=SA'.$wk.'">Scottish FA / Bell\'s / Challenge Cup' ;
					  echo " (" . gg_count('SA','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
				</tr>
		<tr>
			<td width="100%" colspan="2" bgcolor='#f4f4f4'><B>OTHER EUROPEAN DIVISIONS</B></td>
		</td>
		</tr>

			<tr>

				<td width="50%">
				<? if (gg_count('FL','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=FL'.$wk.'"><B>France</B> - Le Championnat' ;
					  echo " (" . gg_count('FL','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
						
				<td width="50%">
				<? if (gg_count('GB','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=GB'.$wk.'"><B>Germany</B> - Bundesliga' ;
					   echo " (" . gg_count('GB','n/a','FIXTURE') . ")</a>" ;
				  
				?>
				</td>
				
			
			 </tr>
			 
			 <tr>
			
	
			<td width="50%">
				<? if (gg_count('G0','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=G0'.$wk.'"><b>Greece</b> - Super League' ;
					  echo " (" . gg_count('G0','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
				<td width="50%">
				<? if (gg_count('HK','n/a','FIXTURE')>0) :
						 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=HK'.$wk.'"><B>Holland</B> - KPN Erdivise' ;
					  echo " (" . gg_count('HK','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
			</tr>
			<tr>
				<td width="50%">
				<? if (gg_count('IS','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=IS'.$wk.'"><B>Italy</B> - Serie A' ;
					  echo " (" . gg_count('IS','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
				
			<td width="50%">
				<? if (gg_count('P0','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=P0'.$wk.'"><B>Portugal</b> - Liga Bwin' ;
					  echo " (" . gg_count('P0','n/a','FIXTURE') . ")</a>" ;
				   
				?>
			</td>
			</tr>
			<tr>
				<td width="50%"> 
				<? if (gg_count('SL','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=SL'.$wk.'"><B>Spain</B> - La Liga Primera' ;
					  echo " (" . gg_count('SL','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
			<td width="50%"> 
				<? if (gg_count('T0','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=T0'.$wk.'"><B>Turkey</b> - Turkcell Super Lig' ;
					  echo " (" . gg_count('T0','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>	
				
			</tr>
			<tr>


            <tr><td width="100%" colspan="2" style='padding:5px' bgcolor='#CADFEE'><span class="credit">AMERICAS</span> 
                <?php
              	if (chk_season('sa')==1){
              		 echo  " (" . curseason('sa') . " Season has been concluded)";
              	}else{	
            	 	echo "Week " . cur_week('sa') . "(" .  weekbegin('sa') . ")";
            	}
            	?> 		
            </td></tr>
            
            <tr>
				<td width="50%"> 
				<? if (gg_count('BRA','n/a','FIXTURE','sa')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=BRA&site=sa'.$wk.'">' . divname("BRA") ;
					  echo " (" . gg_count('BRA','n/a','FIXTURE','sa') . ")</a>" ;
				   
				?>
				</td>
			<td width="50%"> 
				<? if (gg_count('BRB','n/a','FIXTURE','sa')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=BRB&site=sa'.$wk.'">' . divname("BRB") ;
					  echo " (" . gg_count('BRB','n/a','FIXTURE','sa') . ")</a>" ;
				   
				?>
				</td>	
				
			</tr>
            
            <tr>
				<td colspan="3"> 
				<? if (gg_count('MLS','n/a','FIXTURE','sa')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=MLS&site=sa'.$wk.'">' . divname("MLS") ;
					  echo " (" . gg_count('MLS','n/a','FIXTURE','sa') . ")</a>" ;
				   
				?>
				</td>
            </tr>
			<tr><td width="100%" colspan="2" style='padding:5px' bgcolor='#CADFEE'><span class="credit">INTERNATIONAL</span> (<?php echo weekbegin('eu');?>)</td></tr>
			</td>
			<tr>
				<td colspan='2'>
				<? if (gg_count('IN','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="1x2-predictons.php?PARA=IN'.$wk.'">' .divname("IN")  ;
					  echo " (" . gg_count('IN','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
			</tr>
		</table>
				
					
	
		<!-- startprint -->      
<? include("footer.ini.php"); ?>