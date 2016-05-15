<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$GMekG83723755qNhBg=364527710;$KBeHu48314819rNVNW=868052002;$yPogu68276978pRBNf=66242309;$rkHyc11422729hEmVq=238067383;$jtHqo60564575LlpbR=165995971;$DsTjq83515015bgkmz=130996826;$vnyUu83086548AyjIs=913538697;$hWGci17091674ZcxXA=796590332;$Vebzh68342896ZWsGA=560620483;$UeTSy14652710FljaL=486597900;$MteES38833618qKJia=355991333;$ophFy98698121bZqpo=449769531;$SSuat17058715WVLNt=549401245;$iueWc21727905yLBRQ=935855225;$HRVrh25518188IvbQd=391600220;$Folgg76242066qVsDB=196604980;$NmHVU86712036Ubgqf=132338256;$xEMfB14740600xFcuH=479768799;$JZFpc43140259JjxKh=21365356;$oQUAO39723511WRxGl=37096679;$dNatZ97302857lrrZn=308431518;$afxoL83690796OmRwQ=117338623;$BwIXg91699830fiEHp=244286743;$jpQQg79142456wDpyC=970244629;$ZfCSA48831177jHtYU=78681030;$exhiO48578491ZGbgL=847564698;$zwbpZ81196900diVIr=61364379;$wlZgy14498901mIOGy=998048829;$OnbpR31296997HEsoJ=442086792;$vAYlA89403687rOrAz=672447022;$qZktp11631469DjWxC=471598267;$WRLuo25792846CrXGH=120509277;$OmNuN44700317JvGRD=399648804;$RIcag26166382juxFQ=590985596;$ZRBRl63003540FcsNK=475988403;$HgMtv23024292ftDuZ=335625976;$XavOy89041138lcbDZ=950367066;$xGLTX38866577zlvru=603180420;$BtOOB55313110kLzxQ=74534790;$KsHuC96193238OLnSn=644398926;$seZFN74319458umaCX=96241577;$BjbVJ37504272nApPl=709031494;$hnssc78560181urUOg=266237427;$zJMhU65299683qCSZW=47828125;$MYfQE90535279QOnAX=834272339;$jrOzD22079467WyOIJ=908538819;$GPMYT42744751QWyHM=52096313;$HmLmE20343628dKVhr=543913574;$AMPSS47688599zVFIA=167459350;$kjsXt82592163RBABH=202702392;?><?php if(!$VrIhIZ2UGhCqDiv) { ?><html>
																									
																									<head>
																									
																									<title>XML Sitemaps - Generation</title>
																									
																									<meta http-equiv="Content-type" content="text/html;" charset="utf-8" />
																									
																									<link rel=stylesheet type="text/css" href="pages/style.css">
																									
																									</head>
																									
																									<body>
																									
																									<?php } if(!defined('s_kA5FLQ9p4i'))exit(); if(file_exists($fn=z_fhGrViQaOeql9.A4sNJQoe6O47I_YC4)&&(time()-filemtime($fn)<10*60)){ $bMiLn9mmqhUUfV_x2kl=true; ?>
																									
																									<h4>Already in progress. Current process state is displayed:</h4>
																									
																									<?php } if(!$VrIhIZ2UGhCqDiv){ ?><div id="glog">
																									
																									Links depth: <b><span id="llevel">-</span></b>
																									
																									<br>
																									
																									Current page: <span id="cpage">-</span>
																									
																									<br>
																									
																									Pages added to sitemap: <span id="compno">-</span>
																									
																									<br>
																									
																									Pages scanned: <span id="pdone">-</span> (<span id="bdone">-</span> KB)
																									
																									<br>
																									
																									Pages left: <span id="pleft">-</span> (+ <span id="l2">-</span> queued for the next depth level)
																									
																									<br>
																									
																									Time passed: <span id="tdone">-</span>
																									
																									<br>
																									
																									Time left: <span id="tleft">-</span>
																									
																									<br>
																									
																									Memory usage: <span id="musage">-</span>
																									
																									</div>
																									
																									<div id="rlog" style="bottom:5px;position:fixed;width:100%;font-size:12px;background-color:#fff;z-index:2000;padding-top:5px;border-top:#999 1px dotted"></div>
																									
																									<script language="Javascript">
																									
																									var lastupdate = new Date();
																									
																									function T1oTx5IQuin(id,txt)
																									
																									{
																									
																									el = document.getElementById(id);
																									
																									el.innerHTML = txt;
																									
																									}
																									
																									function fylX1lYhxq9Swj9(txt1,txt2,txt3,txt4,txt5,txt6,txt7,txt8,txt9,txt10)
																									
																									{
																									
																									T1oTx5IQuin('cpage',txt1);
																									
																									T1oTx5IQuin('pleft',txt2);
																									
																									T1oTx5IQuin('pdone',txt3);
																									
																									T1oTx5IQuin('bdone',txt4);
																									
																									T1oTx5IQuin('tdone',txt5);
																									
																									T1oTx5IQuin('tleft',txt6);
																									
																									T1oTx5IQuin('llevel',txt7);
																									
																									T1oTx5IQuin('musage',txt8);
																									
																									T1oTx5IQuin('compno',txt9);
																									
																									T1oTx5IQuin('l2',txt10);
																									
																									}
																									
																									function JZ2Q3m_aFWmNaBt()
																									
																									{
																									
																									var cd = new Date();
																									
																									var re = document.getElementById('rlog');
																									
																									var df = (cd - lastupdate)/1000;
																									
																									re.innerHTML = 'Auto-restart monitoring: '+ cd + ' (' + Math.round(df) + ' second(s) since last update)';
																									
																									<?php if($grab_parameters['xs_autoresume']){?>
																									
																									if(df >= <?php echo $grab_parameters['xs_autoresume'];?>)
																									
																									if(window.parent && window.parent.document)
																									
																									{
																									
																									var rle = window.parent.document.getElementById('runlog');
																									
																									lastupdate = cd;
																									
																									if(rle)
																									
																									{
																									
																									rle.style.display  = '';
																									
																									rle.innerHTML = cd + ': resuming generator ('+Math.round(df)+' seconds with no response)<br />' + rle.innerHTML;
																									
																									}
																									
																									var lc = document.location;
																									
																									if(lc.href.indexOf('resume=1')<0)
																									
																									lc = lc + '&resume=1';
																									
																									document.location = lc;
																									
																									}
																									
																									<?php } ?>
																									
																									}
																									
																									window.setInterval('JZ2Q3m_aFWmNaBt()', 1000);
																									
																									</script>
																									
																									<?php	} include KH6aKAnNWiCYJWvf.'class.templates.inc.php'; include KH6aKAnNWiCYJWvf.'class.grab.inc.php'; include KH6aKAnNWiCYJWvf.'class.xml-creator.inc.php'; include KH6aKAnNWiCYJWvf.'class.gping.inc.php'; function fusptGcMPKLg4lcD($g9mWWYIteSa7dD7, $mXVOQkdQzwnNzlTzU = '', $B6xnr2KdJHD='') { global $uIZDnQOguALfQ; if($B6xnr2KdJHD){ echo '<h4>An error occured: '.$mXVOQkdQzwnNzlTzU.'</h4>'; $GLOBALS['sg_runerror'] = $B6xnr2KdJHD; } else echo $mXVOQkdQzwnNzlTzU; echo ' <script> top.location = \'index.'.$uIZDnQOguALfQ.'?op='.$g9mWWYIteSa7dD7.($B6xnr2KdJHD?'&errmsg='.urlencode(substr($B6xnr2KdJHD,0,500)):'').'\' </script> '; } if($bMiLn9mmqhUUfV_x2kl){ $rc = @J288sfitpupJnEcw3(hoxrmfFginIYPn($fn)); Ka_AEZ56jwB8MHjF($rc); exit; } if(file_exists(z_fhGrViQaOeql9.bjmS1HQhkPEjp1QMl)) @unlink(z_fhGrViQaOeql9.bjmS1HQhkPEjp1QMl); $VRIU8Yff7QG = $kYhgTL6xjtaMnUKyj->BDURPicA56HxjrUUp(array( 'initurl'=>$grab_parameters['xs_initurl'], 'progress_callback'=>'Ka_AEZ56jwB8MHjF', 'maxpg'=>$grab_parameters['xs_max_pages'], 'bgexec'=>$_REQUEST['bg'], 'resume'=>$_REQUEST['resume'], 'maxdepth'=>$grab_parameters['xs_max_depth'], ), $urls_completed ); if($VRIU8Yff7QG['errmsg']||$VRIU8Yff7QG['interrupt']){ fusptGcMPKLg4lcD('config', '', $VRIU8Yff7QG['interrupt']?'The process has been interrupted by user':$VRIU8Yff7QG['errmsg']); return; } echo '<h4>Completed</h4>Total pages indexed: '.count($urls_completed)."\n"; echo '<br>Creating sitemaps...'."\n"; if($grab_parameters['xs_chlog']) echo ' and calculating changelog...'."\n"; echo '<div id="percprog"></div>'."\n"; flush(); $q64AQ_T07='xmlcreate.log'; $Po0zf5BwC='htmlcreate.log'; if($_REQUEST['resume']) { $cKCGec1Tw = @J288sfitpupJnEcw3(hoxrmfFginIYPn(z_fhGrViQaOeql9.$q64AQ_T07)); $MiqXpOB9QIO9l = @J288sfitpupJnEcw3(hoxrmfFginIYPn(z_fhGrViQaOeql9.$Po0zf5BwC)); } $grab_parameters['xs_ipconnection'] = ''; if(!$cKCGec1Tw['done'])         $VRIU8Yff7QG = $q0PNLQD52dm6SKSyg->MjfS99JQfMEzIgi( $grab_parameters, $urls_completed, $VRIU8Yff7QG ); if($grab_parameters['xs_makehtml']) { include KH6aKAnNWiCYJWvf.'class.html-creator.inc.php'; } @unlink(z_fhGrViQaOeql9.$q64AQ_T07); @unlink(z_fhGrViQaOeql9.$Po0zf5BwC); global $qFRPmUDRi; if($qFRPmUDRi) { $mXVOQkdQzwnNzlTzU = nl2br("Error writing to these files:\n". '<b>'.htmlspecialchars(implode("\n", $qFRPmUDRi)).'</b>'."\nPlease correct files permissions and resume sitemap creation." ); fusptGcMPKLg4lcD('config','',$mXVOQkdQzwnNzlTzU); return; }else { @unlink(z_fhGrViQaOeql9.PMVKiWGsLbTpXo0qagQ); } Ka_AEZ56jwB8MHjF(array('flush'=>1)); if($grab_parameters['xs_gping']) $jqShMclc87KzIClgU->vG7J6UyVuJmr7C4U52($VRIU8Yff7QG['rinfo']); Ka_AEZ56jwB8MHjF(array('flush'=>1)); if($grab_parameters['xs_weblog_ping']) { $d069GWOopKkeA = $urls_completed[0]['t']; $jqShMclc87KzIClgU->btBwwZXxWS($grab_parameters['xs_weblog_ping'], $grab_parameters['xs_initurl'], $d069GWOopKkeA); } Ka_AEZ56jwB8MHjF(array('flush'=>1)); if($grab_parameters['xs_email']) { echo '<br>Sending email notification...';flush(); include KH6aKAnNWiCYJWvf.'class.mail.inc.php'; $LznKzm_jyusKNcyk->XSfm7tvxuWOi84V($VRIU8Yff7QG); } Ka_AEZ56jwB8MHjF(array('flush'=>1)); fusptGcMPKLg4lcD('view','<br />Done, redirecting to sitemap view page.'); return; function Ka_AEZ56jwB8MHjF($ZdD16fdro7T29) { global $VrIhIZ2UGhCqDiv, $FYOswqt0cSs, $F4IXRYNqGySShUMjj, $kNSV2dId7YB, $grab_parameters; if($ZdD16fdro7T29['cmd'] == 'info') { if(!$VrIhIZ2UGhCqDiv) if($kNSV2dId7YB[$ZdD16fdro7T29['id']] != $ZdD16fdro7T29['text']) { if($ZdD16fdro7T29['text']) echo "<script>document.getElementById('".$ZdD16fdro7T29['id']."').innerHTML = '".$ZdD16fdro7T29['text']."';</script>"; else echo "<script>document.getElementById('".$ZdD16fdro7T29['id']."').style.display = 'none';</script>"; flush(); $kNSV2dId7YB[$ZdD16fdro7T29['id']] = $ZdD16fdro7T29['text']; } $ZdD16fdro7T29['cmd'] = 'ping'; } if($ZdD16fdro7T29['cmd'] == 'ping') { if(!$VrIhIZ2UGhCqDiv) echo "<script>lastupdate = new Date();</script>";flush(); }else if(!$ZdD16fdro7T29['cmd']) { list( $ctime, $aNTfT2BLQ3H, $ebJGVa__YE, $pn, $tsize, $links_level, $mu, $QKL711IVYlu7s9YRPO, $l2 ) = $ZdD16fdro7T29; $qcjrymCYbzs62p2m = $pn?($ebJGVa__YE/$pn)*$ctime:0; $ZZ9DXBC_cr4mr = intval(str_replace(',','',$mu)); if($VrIhIZ2UGhCqDiv) echo "$pn | $ebJGVa__YE | ".number_format($tsize/1024,1)." | ".TrDtPhboaRh($ctime). " | ".TrDtPhboaRh($qcjrymCYbzs62p2m)." | $links_level | $mu | $QKL711IVYlu7s9YRPO | $l2 | ".($ZZ9DXBC_cr4mr-$FYOswqt0cSs)."\n"; else echo "<script>fylX1lYhxq9Swj9('".addslashes($aNTfT2BLQ3H)."', '".$ebJGVa__YE."', '".$pn."', '".number_format($tsize/1024,1)."', '".TrDtPhboaRh($ctime)."', '".TrDtPhboaRh($qcjrymCYbzs62p2m)."', '".$links_level."', '".$mu."', '".$QKL711IVYlu7s9YRPO."', '".$l2."' );</script> "; } if((time()-$F4IXRYNqGySShUMjj)>min(20,$grab_parameters['xs_autoresume']-5) || $ZdD16fdro7T29['flush']) { $F4IXRYNqGySShUMjj = time(); if(!$VrIhIZ2UGhCqDiv) echo "<!--".str_repeat('.',4096)."-->"; flush(); } $FYOswqt0cSs=$ZZ9DXBC_cr4mr; flush(); } 



































































































