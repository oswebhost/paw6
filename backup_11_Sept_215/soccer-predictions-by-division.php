<?	
session_start();
//include("authorization.php");

include("config.ini.php");

include("function.ini.php");

$eucur = curseason('eu');
$sacur = curseason('sa');

$page_title = "1X2 Predictions by Division";
$active_mtab = 0;

include("header.ini.php");
?>



<? page_header("$page_title") ; ?>


        <font size="3" color="#0000FF"><b><i>Current Week's Fixtures &amp; Predictions</i></b></font>
        
     	
	     <?php if (!isset($_SESSION["userid"])){ ?>
	     		
	 		<div class='errordiv' style='margin-top:10px;'>
	 			
	 		  
			   <b>NOTE:</b> You will <span class='red'>NOT</span> be able to access the Current Week's Predictions Data <span class='red'>if you are not registered</span>, but you will be able to review the predictions for all Past Weeks.<br />
	 			 <div style='margin-top:10px;text-align:center'>
				  <a title='Get Soccer Predictions Data Now!' href="<?=$domain?>/register.php">	
				  <img src='<?=$domain?>/images/joinnow2.png' border='0' alt='Get Soccer Predictions Data Now!'></a>
				</div>
	 		</div>
	
		<?php }else{ echo "<br/ ><br/ >"; } ?>
	
	
 		
		<table border="1" width="570" align="center" bordercolor="#EBEBF3" cellspacing="0" style="border-collapse: collapse" cellpadding="4">
			
            
            <tr><td width="100%" colspan="2" style='padding:5px' bgcolor='#CADFEE'><span class="credit">EUROPE</span>  
			
				<?php
				
	              	
	              	echo  " (" . weekbegin('eu') .")";
	              
	            	//echo "- Week " . cur_week('eu') . "&nbsp;(" .  weekbegin('eu') . ")";
	            	
	           	?> 		


            </td></tr>
            
			<tr><td width="100%" colspan="2" bgcolor='#f4f4f4'><B>ENGLAND</B></td></tr>
		
			<tr>
				<td width="50%" >
				<? if (gg_count('EP','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
				   echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=EP&site=eu'.$wk.'">' . divname("EP",1) ;
				   echo " (" . gg_count('EP','n/a','FIXTURE') . ")</a>" ;

				?>
				</td>
				<td width="50%" >
				<? if (gg_count('C0','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
				  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=C0&site=eu'.$wk.'">'  . divname("C0",1) ;
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
				  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=C1&site=eu'.$wk.'">' . divname("C1",1) ;
				  echo " (" . gg_count('C1','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
				<td>
				<? if (gg_count('C2','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
				  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=C2&site=eu'.$wk.'">' . divname("C2",1) ;
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
				  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=FA&site=eu'.$wk.'">' . divname("FA") ; 
				  echo " (" . gg_count('FA','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
				
			
				</tr>
        

        <tr>
        
        	<td>
				<? if (gg_count('NC','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
				  echo '<A class="' . $cla . '" HREF="free-soccer-predictions-list.php?PARA=NC&site=eu'.$wk.'">' . divname("NC") ;
				  echo " (" . gg_count('NC','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				
				</td>
				<td>
				<? if (gg_count('RP','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
				  echo '<A class="' . $cla . '" HREF="free-soccer-predictions-list.php?PARA=RP&&site=eu'.$wk.'">' . divname("RP") ;
				  echo " (" . gg_count('RP','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				
				</td>
			
        
        </tr>


  
        	<td>
				<? if (gg_count('MP','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
				  echo '<A class="' . $cla . '" HREF="free-soccer-predictions-list.php?PARA=MP&site=eu'.$wk.'">' . divname("MP") ;
				  echo " (" . gg_count('MP','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				
				</td>
				<td>
				<? if (gg_count('UP','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
				  echo '<A class="' . $cla . '" HREF="free-soccer-predictions-list.php?PARA=UP&&site=eu'.$wk.'">' . divname("UP") ;
				  echo " (" . gg_count('UP','n/a','FIXTURE') . ")</a>" ;
				   
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
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=SP&site=eu'.$wk.'">' . divname("SP",1) ;
					  echo " (" . gg_count('SP','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
				<td>
				<? if (gg_count('S1','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=S1&site=eu'.$wk.'">' .  divname("S1",1) ; 
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
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=S2&site=eu'.$wk.'">' . divname("S2",1) ;
					  echo " (" . gg_count('S2','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
				<td>
				<? if (gg_count('S3','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=S3&site=eu'.$wk.'">'  . divname("S3",1) ;
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
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=SA&site=eu'.$wk.'">'  . divname("SA") ;
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
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=FL&site=eu'.$wk.'">' . divname("FL") ;
					  echo " (" . gg_count('FL','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
						
				<td width="50%">
				<? if (gg_count('GB','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=GB&site=eu'.$wk.'">' . divname("GB") ;
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
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=G0&site=eu'.$wk.'">' . divname("G0") ;
					  echo " (" . gg_count('G0','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
				<td width="50%">
				<? if (gg_count('HK','n/a','FIXTURE')>0) :
						 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=HK&site=eu'.$wk.'">' . divname("HK") ;
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
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=IS&site=eu'.$wk.'">' . divname("IS") ;
					  echo " (" . gg_count('IS','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
				
			<td width="50%">
				<? if (gg_count('P0','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=P0&site=eu'.$wk.'">' . divname("P0") ;
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
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=SL&site=eu'.$wk.'">' . divname("SL") ;
					  echo " (" . gg_count('SL','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
			<td width="50%"> 
				<? if (gg_count('T0','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=T0&site=eu'.$wk.'">' . divname("T0") ;
					  echo " (" . gg_count('T0','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>	
				
			</tr>
			<tr>
            <tr><td width="100%" colspan="2" style='padding:5px' bgcolor='#CADFEE'><span class="credit">AMERICAS</span> - 
               <?php
              	if (chk_season('sa')==1){
              		 echo  " (" . curseason('sa') . " Season has been concluded)";
              	}else{	
            	 	echo "Week " . cur_week('sa') . "&nbsp;(" .  weekbegin('sa') . ")";
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
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=BRA&site=sa'.$wk.'">' . divname("BRA") ;
					  echo " (" . gg_count('BRA','n/a','FIXTURE','sa') . ")</a>" ;
				   
				?>
				</td>
			<td width="50%"> 
				<? if (gg_count('BRB','n/a','FIXTURE','sa')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=BRB&site=sa'.$wk.'">' . divname("BRB") ;
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
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=MLS&site=sa'.$wk.'">' . divname("MLS") ;
					  echo " (" . gg_count('MLS','n/a','FIXTURE','sa') . ")</a>" ;
				   
				?>
				</td>
            </tr>
			<tr><td width="100%" colspan="2" style='padding:5px' bgcolor='#CADFEE'><span class="credit">INTERNATIONAL</span> </td></tr>   
			</td>
			<tr>
				<td colspan='2'>
				<? if (gg_count('IN','n/a','FIXTURE')>0) :
					 $cla="mblue" ;
				   else:
					 $cla="red" ;
				   endif;
					  echo '<A class="' . $cla . '" HREF="prediction-details.php?PARA=IN&site=eu'.$wk.'">' .divname("IN")  ;
					  echo " (" . gg_count('IN','n/a','FIXTURE') . ")</a>" ;
				   
				?>
				</td>
			</tr>
		</table>
				
					
	
     
<!-- startprint -->	
					
<font color="#FF0000">
<div style="padding:5px;font-size:11px;">Red lettering means "No Matches This Week"</font></div></td>

<!--
<div style="margin: 20px auto 10px auto; border:1px solid #ccc; width:400px;">
    <div style="padding:5px; background:#ccc;font-size:11px;"><b>UK Minor Divisions Predictions</b></div>
    <div style="padding:5px;font-size:11px;">
    If you wish to see the predictions data for the UK's Minor Divisions, please go to "Free Soccer Predictions" under FREE-ACCESS DATA and click on the sub-menu displayed there ("4 UK Minor Divisions").
    </div>
</div>
-->
	      
<? include("footer.ini.php"); ?>