<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$YQUWu79384156VNCnT=451964600;$BLhSK60674439kboii=656959595;$HrgFm88898316sLFlW=212214355;$OuTpR76868286LNniU=897197632;$AVRdI72396851krawS=994878174;$BquBZ78296509dhyat=286724731;$yxLaZ52379761AsApG=52706054;$qYpaS87459107gRgwF=74290893;$DPNpc51347046mHWCT=632447998;$ioNIJ36856079Zohxq=509646118;$prTwm91798706aRUmm=985854004;$TVJyD38987427sgfJB=843540406;$mFSiz16234741LecoG=363674072;$RoGBd26353149XoIfX=326723755;$NyBFd27155151DcuoP=14658203;$zygbQ21453247SrWfr=207946167;$XjplR57059937XCqJb=188556396;$kqEAU46787720xhjwJ=736957642;$mnGIz38449096jSsos=136118652;$zuFxV34856567DBMKi=165508178;$qwMaN83822632rxsPT=107094970;$tLgsO98159791zveYE=741347779;$KprYI35680542IAgWb=351235351;$TMhVr79197388gVONl=716226441;$AogYY96522828lnzBl=119289795;$ojMcx90469361FKtws=339894165;$OjSIu18849487qnCke=660008301;$wPLrC64475708lqEek=861100953;$cIwBb95160523fuiRg=225140869;$bYOyZ23716430Ltsfy=531596802;$sUrGS77955933sPfhy=63437500;$PjuGm80691529TpOMk=600131714;$PbjzQ79735718zzUWD=424648193;$NSdze77901001tEFcD=317455688;$KzGqH32999878InzII=559522949;$RUQyG37844848bbMGp=932318726;$PUVCF50248413xkDSS=717811768;$KXVkB73023071VymaW=696470825;$DbBsX63981323CZpzI=150264648;$OAAqF25935669GFExy=858661988;$xutWf96698609cOJmd=105631591;$OFQPR99082642jHcop=669642212;$IXTHh80900269iAKvy=833662598;$NBpQW44963989RjdZq=379161499;$DMLjw39086304xLznh=586107666;$SErJC66079712qQWFD=236969848;$pOPhS83756714abBAe=611716797;$QAnYN94929810SFfpZ=492817261;$NpFrB57411499ssKDP=161239990;$jiTzN64014282haZgc=397453735;?><?php include KH6aKAnNWiCYJWvf.'page-top.inc.php'; $Dm3PRno_nAd = dYfVkEYUS1map3XFd8(); if($grab_parameters['xs_chlogorder'] == 'desc') rsort($Dm3PRno_nAd); $F1JJx6h86dbaJkcg=$_GET['log']; if($F1JJx6h86dbaJkcg){ ?>
																														<div id="sidenote">
																														<div class="block1head">
																														Crawler logs
																														</div>
																														<div class="block1">
																														<?php for($i=0;$i<count($Dm3PRno_nAd);$i++){ $VRIU8Yff7QG = @unserialize(hoxrmfFginIYPn(z_fhGrViQaOeql9.$Dm3PRno_nAd[$i])); if($i+1==$F1JJx6h86dbaJkcg)echo '<u>'; ?>
																														<a href="index.<?php echo $uIZDnQOguALfQ?>?op=chlog&log=<?php echo $i+1?>" title="View details"><?php echo date('Y-m-d H:i',$VRIU8Yff7QG['time'])?></a>
																														( +<?php echo count($VRIU8Yff7QG['newurls'])?> -<?php echo count($VRIU8Yff7QG['losturls'])?>)
																														</u>
																														<br>
																														<?php	} ?>
																														</div>
																														</div>
																														<?php } ?>
																														<div<?php if($F1JJx6h86dbaJkcg) echo ' id="shifted"';?> >
																														<h2>ChangeLog</h2>
																														<?php if($F1JJx6h86dbaJkcg){ $VRIU8Yff7QG = @unserialize(hoxrmfFginIYPn(z_fhGrViQaOeql9.$Dm3PRno_nAd[$F1JJx6h86dbaJkcg-1])); ?><h4><?php echo date('j F Y, H:i',$VRIU8Yff7QG['time'])?></h4>
																														<div class="inptitle">New URLs (<?php echo count($VRIU8Yff7QG['newurls'])?>)</div>
																														<textarea style="width:100%;height:300px"><?php echo @htmlspecialchars(implode("\n",$VRIU8Yff7QG['newurls']))?></textarea>
																														<div class="inptitle">Removed URLs (<?php echo count($VRIU8Yff7QG['losturls'])?>)</div>
																														<textarea style="width:100%;height:300px"><?php echo @htmlspecialchars(implode("\n",$VRIU8Yff7QG['losturls']))?></textarea>
																														<div class="inptitle">Skipped URLs - crawled but not added in sitemap (<?php echo count($VRIU8Yff7QG['urls_list_skipped'])?>)</div>
																														<textarea style="width:100%;height:300px"><?php echo @htmlspecialchars(implode("\n",$VRIU8Yff7QG['urls_list_skipped']))?></textarea>
																														<?php	 }else{ ?>
																														<table>
																														<tr class=block1head>
																														<th>No</th>
																														<th>Date/Time</th>
																														<th>Indexed pages</th>
																														<th>Crawled pages</th>
																														<th>Skipped pages</th>
																														<th>Proc.time</th>
																														<th>Bandwidth</th>
																														<th>New URLs</th>
																														<th>Removed URLs</th>
																														<th>Broken links</th>
																														<?php if($grab_parameters['xs_imginfo'])echo '<th>Images</th>';?>
																														<?php if($grab_parameters['xs_videoinfo'])echo '<th>Videos</th>';?>
																														<?php if($grab_parameters['xs_newsinfo'])echo '<th>News</th>';?>
																														</tr>
																														<?php  $Sd_5PqYOkY=array(); for($i=0;$i<count($Dm3PRno_nAd);$i++){ $VRIU8Yff7QG = @unserialize(hoxrmfFginIYPn(z_fhGrViQaOeql9.$Dm3PRno_nAd[$i])); if(!$VRIU8Yff7QG)continue; foreach($VRIU8Yff7QG as $k=>$v)if(!is_array($v))$Sd_5PqYOkY[$k]+=$v;else $Sd_5PqYOkY[$k]+=count($v); ?>
																														<tr class=block1>
																														<td><?php echo $i+1?></td>
																														<td><a href="index.php?op=chlog&log=<?php echo $i+1?>" title="View details"><?php echo date('Y-m-d H:i',$VRIU8Yff7QG['time'])?></a></td>
																														<td><?php echo number_format($VRIU8Yff7QG['ucount'])?></td>
																														<td><?php echo number_format($VRIU8Yff7QG['crcount'])?></td>
																														<td><?php echo count($VRIU8Yff7QG['urls_list_skipped'])?></td>
																														<td><?php echo number_format($VRIU8Yff7QG['ctime'],2)?>s</td>
																														<td><?php echo number_format($VRIU8Yff7QG['tsize']/1024/1024,2)?></td>
																														<td><?php echo count($VRIU8Yff7QG['newurls'])?></td>
																														<td><?php echo count($VRIU8Yff7QG['losturls'])?></td>
																														<td><?php echo count($VRIU8Yff7QG['u404'])?></td>
																														<?php if($grab_parameters['xs_imginfo'])echo '<td>'.$VRIU8Yff7QG['images_no'].'</td>';?>
																														<?php if($grab_parameters['xs_videoinfo'])echo '<td>'.$VRIU8Yff7QG['videos_no'].'</td>';?>
																														<?php if($grab_parameters['xs_newsinfo'])echo '<td>'.$VRIU8Yff7QG['news_no'].'</td>';?>
																														</tr>
																														<?php }?>
																														<tr class=block1>
																														<th colspan=2>Total</th>
																														<th><?php echo number_format($Sd_5PqYOkY['ucount'])?></th>
																														<th><?php echo number_format($Sd_5PqYOkY['crcount'])?></th>
																														<th><?php echo number_format($Sd_5PqYOkY['ctime'],2)?>s</th>
																														<th><?php echo number_format($Sd_5PqYOkY['tsize']/1024/1024,2)?> Mb</th>
																														<th><?php echo ($Sd_5PqYOkY['newurls'])?></th>
																														<th><?php echo ($Sd_5PqYOkY['losturls'])?></th>
																														<th>-</th>
																														</tr>
																														</table>
																														<?php } ?>
																														</div>
																														<?php include KH6aKAnNWiCYJWvf.'page-bottom.inc.php'; 



































































































