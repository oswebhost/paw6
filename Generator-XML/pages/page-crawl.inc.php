<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$mKfSM18868713fCjoq=471201935;$RXWkS31667785ncapV=225964020;$qpnXy73822327kiQjJ=696806183;$RKohy24394836eenmm=291572174;$WlylY77447815MQEYL=914605744;$LJziX22043762RvQJc=973750641;$swnMH52245178SkYWu=375350616;$jlcon47114563dFOoX=524249420;$OCGWD20714416wRBhh=327790802;$vdEEr32107239Qcjqk=191818512;$Gtfrq95355530FGDes=22676300;$QzwWV89521790cWbEI=226207916;$XSgSU28668518cybiI=708757111;$JYrxs61858215fzRqx=877167633;$fzNyZ23153381yGyFc=637783234;$zgNzm61616516zkSIK=396447662;$kNUyq11310119itejZ=59504669;$IUBKP21296692CdmKX=32798004;$VZnyd15638732HgmJd=222671417;$SXhPi53398743oXDno=35968658;$IsFaq58639221lRKEB=378033478;$oaoQi90422669xlqiH=655709625;$IYSts72811585JkNCr=775340851;$ZjXnX64868469DQzqV=143770904;$oCSRT80655823UmQtZ=665343537;$hFLGP89236145LrufB=747902497;$bWewN14671936tIEdO=297791534;$WfZKJ96025696fuWge=719854401;$HKLJH77359925zXzSI=921434845;$BNYQd17737121ACSpm=309376617;$aLtBl21219787HWkVy=788023468;$HrpvP56870422UPfhQ=765219147;$nJvXW48751526mGsDh=147307403;$jAAKe55925598ALiHz=339131988;$arMDq92455140GXMHz=248036651;$YRAUL37402649FkIBd=279865143;$hNMqX84830628VuxqL=340961212;$ybvxZ23801574LnwrY=837168610;$vOKPv48377991iKSFQ=675831085;$wGAgD37622375DKTzn=262792389;$ivxtA95597229KVEcq=503396271;$TGzWF11365051xkWto=804486481;$Umfmv68988342AqGrn=73406768;$eLlxw57529602PluQB=714000885;$uyIix81051331AlFei=634612579;$IDIiF18616027CVYSt=241085602;$XWKgw64286194CGSRg=438763702;$OaCMa97124329zIjaF=634490631;$lMJoE41192932dBiXu=734610138;$dThkC45554504fYgfs=145965973;?><?php include KH6aKAnNWiCYJWvf.'page-top.inc.php'; $JcYkhlEMDOd63veSaCB = $_REQUEST['crawl']; if($_GET['act']=='interrupt'){ ZBWGkqS6VQ71(bjmS1HQhkPEjp1QMl,''); echo '<h2>The "stop" signal has been sent to a crawler.</h2><a href="index.'.$uIZDnQOguALfQ.'?op=crawl">Return to crawler page</a>'; }else if(file_exists($fn=z_fhGrViQaOeql9.A4sNJQoe6O47I_YC4)&&(time()-filemtime($fn)<10*60)){ $bMiLn9mmqhUUfV_x2kl=true; $JcYkhlEMDOd63veSaCB = 1; } if($JcYkhlEMDOd63veSaCB){ if($bMiLn9mmqhUUfV_x2kl) echo '<h4>Crawling already in progress.<br/>Last log access time: '.date('Y-m-d H:i:s',@filemtime($fn)).'<br><small><a href="index.'.$uIZDnQOguALfQ.'?op=crawl&act=interrupt">Click here</a> to interrupt it.</small></h4>'; else { echo '<h4>Please wait. Sitemap generation in progress...</h4>'; if($_POST['bg']) echo '<div class="block2head">Please note! The script will run in the background until completion, even if browser window is closed.</div>'; } ?>
																													<iframe id="cproc" style="width:100%;height:300px;border:0px" frameborder=0 src="index.<?php echo $uIZDnQOguALfQ?>?op=crawlproc&bg=<?php echo $_POST['bg']?>&resume=<?php echo $_POST['resume']?>"></iframe>
																													<div id="runlog" style="overflow:auto;height:100px;display:none;"></div>
																													<?php }else if(!$fiJIJjF_yojaqa) { ?>
																													<div id="sidenote">
																													<?php include KH6aKAnNWiCYJWvf.'page-sitemap-detail.inc.php'; ?>
																													</div>
																													<div id="shifted">
																													<h2>Crawling</h2>
																													<form action="index.<?php echo $uIZDnQOguALfQ?>?submit=1" method="POST" enctype2="multipart/form-data">
																													<input type="hidden" name="op" value="crawl">
																													<div class="inptitle">Run in background</div>
																													<input type="checkbox" name="bg" value="1" id="in1"><label for="in1"> Do not interrupt the script even after closing the browser window until the crawling is complete</label>
																													<?php if(@file_exists(z_fhGrViQaOeql9.PMVKiWGsLbTpXo0qagQ)){ $T_IVB6tYAThxWS = @J288sfitpupJnEcw3(hoxrmfFginIYPn(z_fhGrViQaOeql9.PMVKiWGsLbTpXo0qagQ)); ?>
																													<div class="inptitle">Resume last session</div>
																													<input type="checkbox" name="resume" value="1" id="in2"><label for="in2"> Continue the interrupted session 
																													(<?php echo date('Y-m-d H:i:s',filemtime(z_fhGrViQaOeql9.PMVKiWGsLbTpXo0qagQ))?>, 
																													URLs added: <?php echo count($T_IVB6tYAThxWS['urls_completed'])?>, 
																													estimated URLs left in a queue: <?php echo count($T_IVB6tYAThxWS['urls_list'])?>)</label>
																													<?php	 } ?>
																													<div class="inptitle">Click button below to start crawl manually:</div>
																													<div class="inptitle">
																													<input class="button" type="submit" name="crawl" value="Run" style="width:150px;height:30px">
																													</div>
																													</form>
																													<h2>Cron job setup</h2>
																													You can use the following command line to setup the cron job for sitemap generator:
																													<div class="inptitle">/usr/bin/php <?php echo dirname(dirname(__FILE__)).'/runcrawl.php'?></div>
																													</div>
																													<?php } include KH6aKAnNWiCYJWvf.'page-bottom.inc.php'; 



































































































