<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$GhZIl13490905UCYbM=764182587;$UKfis15655212vQsLL=346265961;$KaBur76706238EFmTs=347851288;$TtUJc53206482gbYMI=925032319;$jdROC26718445xYKdB=735402802;$jBTwT33804626oVsQq=934056488;$YxBmN66027527zTWVt=178587127;$AEbjt69949646dkGWM=623088471;$eDzXn37133484HqoOq=925154267;$LinUo94141541MRpgX=241878265;$SZetL52536316GyXHB=227854217;$MNZbt38880310vkFwV=40175872;$lDhaZ44736023KuBno=334436981;$MfBBy16665954XvZqx=267731292;$xAjCg36232605GsYrX=495652557;$BzXzb49998474IbOQn=175294525;$Phjwu49526062hBtHc=961250947;$uvqMz71377869CQcKn=12615570;$dgQVL17116394xgODV=981982148;$GJQwi13304138BXaBY=29444427;$WpdCk51503601cQRQJ=807596161;$uWOHM78277283wDGci=475531097;$RpZlN85187683TVeet=687842987;$vrKxp18797302aECas=601625580;$LRnwo50668640iFzKp=872472626;$BYVkB37364197ksqec=657477875;$pRaOt60446472adFHd=612235077;$VzWmR66477966AvfJI=892837983;$jvJaB47021179nFEcL=156880340;$UIGvh38638611QrrOg=558455902;$ucCaw32892761JvZVU=755158417;$gICff66346130bWWtE=903081635;$yHtCR40561218cQeRs=658819306;$iIksC82100525XwNhJ=178465179;$cKRhS92526551KhdRe=117613006;$bXCDa18401794uSYcr=632356537;$dEEPe31288757VVCpe=380289520;$mUhNX77749939zlKFG=516505707;$emfxn59347839gFtPR=697598847;$mtmrG12644958CzWLo=80662689;$ZDtOa19203796etygA=320290985;$LRZsj25586853BTdsv=573577484;$wJiJB23356628belho=497115936;$zgOwW49075622GufBA=247000091;$HEKZQ94306336JBISH=478823700;$JnycC15611267UlHDO=349680511;$sntfg74552918lwOfZ=515164276;$tcvKI37693786JtCpi=132368744;$qJbfQ76596375eEWZH=855887665;$IaClV47823181xwwgQ=843814789;?><?php if(!defined('s_kA5FLQ9p4i'))exit(); $a4CGTfBmhiIdgx = $adO3ioNATQ1yoZVep = ''; if(!is_writable(z_fhGrViQaOeql9)){ $a4CGTfBmhiIdgx .= '<br>Datastorage folder is not writable: <b>'.z_fhGrViQaOeql9.'</b>'; }   if(isset($_POST['save']) && is_writable(sMuf2pf0iKaQ)){ $grab_parameters['xs_initurl'] = trim($_POST['initurl']); $grab_parameters['xs_freq'] = $_POST['freq']; $grab_parameters['xs_lastmod'] = $_POST['lastmod']; $grab_parameters['xs_lastmodtime'] = $_POST['lastmodtime']; $grab_parameters['xs_priority'] = $_POST['priority']; $grab_parameters['xs_autopriority'] = $_POST['autopriority']?1:0; $grab_parameters['xs_max_pages'] = $_POST['max_pages']; $grab_parameters['xs_max_depth'] = $_POST['max_depth']; $grab_parameters['xs_exec_time'] = $_POST['exec_time']; $grab_parameters['xs_memlimit'] = $_POST['mem_limit']; $grab_parameters['xs_savestate_time'] = $_POST['savestate_time']; $grab_parameters['xs_delay_req'] = $_POST['delay_req']; $grab_parameters['xs_delay_ms'] = $_POST['delay_ms']; $grab_parameters['xs_yping'] = $_POST['LXUQuxNDxlej9']; $grab_parameters['xs_smname'] = $_POST['smname']; $grab_parameters['xs_excl_urls'] = $_POST['excl_urls']; $grab_parameters['xs_incl_urls'] = $_POST['incl_urls']; $grab_parameters['xs_incl_only'] = $_POST['incl_only']; $grab_parameters['xs_parse_only'] = $_POST['parse_only']; $grab_parameters['xs_ind_attr'] = $_POST['ind_attr']; $grab_parameters['xs_weblog_ping'] = $_POST['weblogup']; $grab_parameters['xs_smurl'] = $_POST['smurl']; if($_POST['changepass']) { $grab_parameters['xs_login'] = trim($_POST['xslogin']); if($_POST['xspassword']!='-----') { $grab_parameters['xs_password'] = trim($_POST['xspassword']) ? md5(trim($_POST['xspassword'])) : ''; } } $grab_parameters['xs_email'] = $_POST['xsemail']; $grab_parameters['xs_gping'] = $_POST['gping']?1:0; $grab_parameters['xs_chlog'] = $_POST['gchlog']?1:0; $grab_parameters['xs_extlinks'] = $_POST['extlinks']?1:0; $grab_parameters['xs_makeror'] = $_POST['makeror']?1:0; $grab_parameters['xs_maketxt'] = $_POST['maketxt']?1:0; foreach($sm_proc_list as $duBMhqfH7kGKH) { $grab_parameters[$duBMhqfH7kGKH->ifLJ96S2XFSDmmWXE] = $_POST[$duBMhqfH7kGKH->ifLJ96S2XFSDmmWXE]?1:0; if($duBMhqfH7kGKH->ifLJ96S2XFSDmmWXE) $grab_parameters[$duBMhqfH7kGKH->movY_zRZJdSVrB] = $_POST[$duBMhqfH7kGKH->movY_zRZJdSVrB]; } $grab_parameters['xs_makehtml'] = $_POST['makehtml']?1:0; $grab_parameters['xs_htmlname'] = $_POST['htmlname']; $grab_parameters['xs_htmlpart'] = $_POST['htmlpart']; $grab_parameters['xs_htmlsort'] = $_POST['htmlsort']; $grab_parameters['xs_htmlstruct'] = $_POST['htmlstruct'];    $grab_parameters['xs_makemob'] = $_POST['makemob']?1:0; if($_POST['makemob']) { $grab_parameters['xs_mobilefilename'] = $_POST['mobilefilename']; } $grab_parameters['xs_sm_size'] = $_POST['sm_size']; $grab_parameters['xs_sm_filesize'] = $_POST['sm_filesize']; $grab_parameters['xs_purgelogs'] = $_POST['purge']; $grab_parameters['xs_maxref'] = $_POST['maxref']; $grab_parameters['xs_compress'] = $_POST['compress']?1:0; $grab_parameters['xs_usecurl'] = $_POST['usecurl']?1:0; $grab_parameters['xs_memsave'] = $_POST['memsave']?1:0; $grab_parameters['xs_inc_skip'] = '\.('.preg_replace('#\s+#','|',trim($_POST['incl'])).')'; $grab_parameters['xs_exc_skip'] = '\.('.preg_replace('#\s+#','|',trim($_POST['excl'])).')'; $grab_parameters['xs_dumptype'] = $_POST['storage']; $grab_parameters['xs_ipconnection'] = $_POST['ipaddr']; $grab_parameters['xs_cleanpar'] = preg_replace('#\s+#','|',trim($_POST['cleanpar'])); $grab_parameters['xs_metadesc'] = $_POST['metadesc']?1:0; $grab_parameters['xs_canonical'] = $_POST['canonical']?1:0; $grab_parameters['xs_checkver'] = $_POST['checkver']?1:0; $grab_parameters['xs_disable_xsl'] = $_POST['xslon']?0:1; $grab_parameters['xs_utf8'] = $_POST['xsutf'] ? 1 : 0; $grab_parameters['xs_lastmod_notparsed'] = $_POST['lmnp']?1:0; $grab_parameters['xs_debug'] = $_POST['dbg']?1:0; SWv7WC7WEJVO(sMuf2pf0iKaQ, $grab_parameters); $adO3ioNATQ1yoZVep = 'Configuration has been saved';		 } $Dm3PRno_nAd = dYfVkEYUS1map3XFd8(); if(count($Dm3PRno_nAd)>0){ $NTNwwUxSQ4XXmLyW7 = array_pop($Dm3PRno_nAd); $VRIU8Yff7QG = @unserialize(hoxrmfFginIYPn(z_fhGrViQaOeql9.$NTNwwUxSQ4XXmLyW7)); } $q2PfaTx_3ig = $grab_parameters['xs_smname']; if($grab_parameters['xs_compress'])$RvGpMMUREL77 = '.gz'; $sG53YQ0A72 = $grab_parameters['xs_sm_size'] ? $grab_parameters['xs_sm_size'] : 50000; for($i=0;$i<ceil($VRIU8Yff7QG['ucount']/$sG53YQ0A72);$i++) {    $KDdCtJPGUBu9Wq = (($VRIU8Yff7QG['ucount']>$sG53YQ0A72) ? DXwTWcPx8gwRJFL($i+1,$q2PfaTx_3ig):$q2PfaTx_3ig).$RvGpMMUREL77; if(!@is_writable($KDdCtJPGUBu9Wq) && !@is_writable(dirname($KDdCtJPGUBu9Wq)) ) { if($pf = @fopen($KDdCtJPGUBu9Wq)) @fclose($pf); $a4CGTfBmhiIdgx .= '<br>Sitemap file is not writable: <b>'.$KDdCtJPGUBu9Wq.'</b>'; } }	 foreach($sm_proc_list as $duBMhqfH7kGKH) $a4CGTfBmhiIdgx .= $duBMhqfH7kGKH->XUVNOTiArMdxtZj(); $sG53YQ0A72 = $grab_parameters['xs_htmlpart']; $q2PfaTx_3ig = $grab_parameters['xs_htmlname']; for($i=0;$i<ceil($VRIU8Yff7QG['ucount']/$sG53YQ0A72);$i++) {    $KDdCtJPGUBu9Wq = (($VRIU8Yff7QG['ucount']>$sG53YQ0A72) ? DXwTWcPx8gwRJFL($i+1,$q2PfaTx_3ig,true):$q2PfaTx_3ig); if(!is_writable($KDdCtJPGUBu9Wq) && !is_writable(dirname($KDdCtJPGUBu9Wq)) ) $a4CGTfBmhiIdgx .= '<br>Sitemap file is not writable: <b>'.$KDdCtJPGUBu9Wq.'</b>'; }	 include KH6aKAnNWiCYJWvf.'page-top.inc.php'; ?>
																												<div id="sidenote">
																												<?php include KH6aKAnNWiCYJWvf.'page-sitemap-detail.inc.php'; ?>
																												<div class="block1head">
																												1. General Parameters
																												</div>
																												<div class="block1">
																												Define website URL, sitemap filename and URL, sitemap types.
																												</div>
																												<div class="block1head">
																												2. Sitemap Entry Attributes
																												</div>
																												<div class="block1">
																												Pages update frequency, last modification time, priority and other attributes.
																												</div>
																												<div class="block1head">
																												3. Miscellaneous Settings
																												</div>
																												<div class="block1">
																												Login and password, email notification, compression, search engines pings etc.
																												</div>
																												<div class="block1head">
																												4. Narrow Indexed Pages Set
																												</div>
																												<div class="block1">
																												Exclude specific filenames, filetypes, folders etc.
																												</div>
																												<div class="block1head">
																												5. Crawler Limitations, Finetune
																												</div>
																												<div class="block1">
																												Limit sitemap size, links depth level, maximum running time etc.
																												</div>
																												<div class="block1head">
																												6. Advanced Settings
																												</div>
																												<div class="block1">
																												Server's IP address, session ID parameters etc.
																												</div>
																												</div>
																												<div id="shifted">
																												<?php if($_GET['errmsg'])$a4CGTfBmhiIdgx = $_GET['errmsg']; if($a4CGTfBmhiIdgx){ ?>
																												<div class="block2head">
																												An error occured
																												</div>
																												<div class="block1">
																												<?php echo strip_tags($a4CGTfBmhiIdgx, '<b><br>');?>
																												</div>
																												<?php }?>
																												<?php if($adO3ioNATQ1yoZVep){ ?>
																												<div class="block1head">
																												Note
																												</div>
																												<div class="block1">
																												<?php echo $adO3ioNATQ1yoZVep?>
																												</div>
																												<?php }?>
																												<h2>Configuration</h2>
																												<form name="sgform" action="index.<?php echo $uIZDnQOguALfQ?>?submit=1" method="POST" enctype2="multipart/form-data">
																												<input type="hidden" name="op" value="<?php echo $op?>">
																												<div class="inptitle">Starting URL:</div>
																												<input type="text" name="initurl" size="70" value="<?php echo $grab_parameters['xs_initurl']?>">
																												<br /><small>
																												Please enter the <b>full</b> http address for your site, only 
																												the links within the starting directory will be included.</small>
																												<div class="inptitle">Save sitemap to:</div>
																												<input type="text" name="smname" size="70" value="<?php echo $grab_parameters['xs_smname']?>">
																												<br /><small>
																												Please enter complete file name, including the path. Make sure that the file is existing and has write permissions allowed.
																												<br />Hint: current path to Sitemap generator is: <?php echo dirname(dirname(__FILE__))?>/
																												</small>
																												<div class="inptitle">Your Sitemap URL:</div>
																												<input type="text" name="smurl" size="70" value="<?php echo $grab_parameters['xs_smurl']?>">
																												<br/><br/>
																												<h3 style="cursor:pointer" onclick="javascript:e5VXUaptWL7P('configother')" id="hconfigother">[-] Other Sitemap Types (click to collapse)</h3>
																												<div id="configother">
																												<small style="color:#600">(*) Note that any extra sitemap type will require additional resources to complete the process</small>
																												<div class="inptitle">Create Text Sitemap:</div>
																												<input type="checkbox" name="maketxt" <?php echo $grab_parameters['xs_maketxt']?'checked':''?> id="in11"><label for="in11"> Create sitemap in Text format</label>
																												<div class="inptitle">Create ROR Sitemap:</div>
																												<input type="checkbox" name="makeror" <?php echo $grab_parameters['xs_makeror']?'checked':''?> id="in13"><label for="in13"> Create sitemap in ROR format</label>
																												<br><small>It will be stored in the same folder as XML sitemap, but with different filename: ror.xml</small>
																												<div class="inptitle">Create HTML Sitemap:</div>
																												<input type="checkbox" onclick="e5VXUaptWL7P('sm_html_div')" name="makehtml" <?php echo $grab_parameters['xs_makehtml']?'checked':''?> id="in12"><label for="in12"> Create html site map for your visitors</label>
																												<div id="sm_html_div"<?php echo $grab_parameters['xs_makehtml']?'':' style="display:none"'?>>
																												<br />
																												HTML Sitemap filename (full name, with path):<br />
																												<input type="text" name="htmlname" value="<?php echo $grab_parameters['xs_htmlname']?>" size="70">
																												</div>
																												<div class="inptitle">Create Images Sitemap:
																												<?php $xz = 'n_img';?>
																												Not available - <a href="http://www.xml-sitemaps.com/generator-addons.html" target="_blank">click here to order an add-on</a>
																												<?php $xz = '/n_img';?>
																												</div>
																												<?php ?>
																												<div class="inptitle">Create Video Sitemap:
																												<?php $xz = 'n_video';?>
																												Not available - <a href="http://www.xml-sitemaps.com/generator-addons.html" target="_blank">click here to order an add-on</a>
																												<?php $xz = '/n_video';?>
																												</div>
																												<?php ?>
																												<div class="inptitle">Create News Sitemap:
																												<?php $xz = 'n_news';?>
																												Not available - <a href="http://www.xml-sitemaps.com/generator-addons.html" target="_blank">click here to order an add-on</a>
																												<?php $xz = '/n_news';?>
																												</div>
																												<?php ?>
																												<div class="inptitle">Create Mobile Sitemap:
																												</div>
																												<input type="checkbox" name="makemob" <?php echo $grab_parameters['xs_makemob']?'checked':''?> id="mobinfo1" onclick="e5VXUaptWL7P('sm_mob_div')"><label for="mobinfo1"> 
																												Create a separate mobile sitemap</label>
																												<div id="sm_mob_div"<?php echo $grab_parameters['xs_makemob']?'':' style="display:none"'?>>
																												<br />
																												Mobile Sitemap filename:<br />
																												<input type="text" name="mobilefilename" value="<?php echo $grab_parameters['xs_mobilefilename']?>" size="70">
																												</div>
																												<?php foreach($sm_proc_list as $duBMhqfH7kGKH) { ?>
																												<div class="inptitle">Create <?php echo $duBMhqfH7kGKH->PCiMWHKGB5lwUwCci?>:</div>
																												<input type="checkbox" onclick="e5VXUaptWL7P('<?php echo $duBMhqfH7kGKH->ifLJ96S2XFSDmmWXE?>_div')" name="<?php echo $duBMhqfH7kGKH->ifLJ96S2XFSDmmWXE?>" <?php echo $grab_parameters[$duBMhqfH7kGKH->ifLJ96S2XFSDmmWXE]?'checked':''?> id="in<?php echo $duBMhqfH7kGKH->ifLJ96S2XFSDmmWXE;?>"><label for="in<?php echo $duBMhqfH7kGKH->ifLJ96S2XFSDmmWXE;?>"> Create <?php echo $duBMhqfH7kGKH->PCiMWHKGB5lwUwCci;?></label>
																												<br><small><?php echo $duBMhqfH7kGKH->DViaBKXmteSZF4cgvzj?></small>
																												<div id="<?php echo $duBMhqfH7kGKH->ifLJ96S2XFSDmmWXE?>_div"<?php echo $grab_parameters[$duBMhqfH7kGKH->ifLJ96S2XFSDmmWXE]?'':' style="display:none"'?>>
																												Sitemap filename:<br />
																												<input type="text" name="<?php echo $duBMhqfH7kGKH->movY_zRZJdSVrB?>" value="<?php echo $grab_parameters[$duBMhqfH7kGKH->movY_zRZJdSVrB]?>" size="70">
																												</div>
																												<?php }?>
																												</div>
																												<h3 style="cursor:pointer" onclick="javascript:e5VXUaptWL7P('configattr')" id="hconfigattr">[-] Sitemap Entry Attributes (click to collapse)</h3>
																												<div id="configattr">
																												<div class="inptitle">Change frequency:</div>
																												<select name="freq">
																												<option value="">Do not specify</option>
																												<?php $tIGZKpwqkKpgM = array('Always','Hourly','Daily','Weekly','Monthly','Yearly','Never'); foreach($tIGZKpwqkKpgM as $fa) echo ' <option value="'.strtolower($fa).'"'.(strtolower($fa)==$grab_parameters['xs_freq']?' selected':'').'>'.$fa.'</option>'; ?>
																												</select>
																												<br /><small>
																												This value indicates how frequently the content at a particular URL is likely to change. 
																												</small>
																												<?php $qHEfslblz = substr(str_replace('|',' ',$grab_parameters['xs_inc_skip']),3,-1); $blUx9Th8GWx0bsSC = substr(str_replace('|',' ',$grab_parameters['xs_exc_skip']),3,-1); $lm = $grab_parameters['xs_lastmod']; $YX9orxWleH = $grab_parameters['xs_lastmodtime']; ?>
																												<div class="inptitle">Last modification:</div>
																												<input<?php echo $lm==0?' checked':''?> type="radio" name="lastmod" value="0" id="lm1"><label for="lm1"> None</label>
																												<br><input<?php echo $lm==1?' checked':''?> type="radio" name="lastmod" value="1" id="lm2"><label for="lm2"> Use server's response</label>
																												<br><input<?php echo $lm==2?' checked':''?> type="radio" name="lastmod" value="2" id="lm3"><label for="lm3"> Use current time</label>
																												<br><input<?php echo $lm==3?' checked':''?> type="radio" name="lastmod" value="3" id="lm4"><label for="lm4"> Use this date/time:</label>
																												<input type="text" name="lastmodtime" size=30 value="<?php echo $YX9orxWleH?$YX9orxWleH:date('Y-m-d H:i:s')?>">
																												<br /><small>
																												The time the URL was last modified. You can let the generator set this field from your server's response headers or to specify your own date and time. 
																												</small>
																												<div class="inptitle">Priority:</div>
																												<input type="text" name="priority" size="5" value="<?php echo $grab_parameters['xs_priority']?>">
																												<br /><small>
																												The priority of a particular URL relative to other pages on the same site. The value for this tag is a number between 0.0 and 1.0. 
																												</small>
																												<div class="inptitle">Automatic Priority:</div>
																												<input type="checkbox" name="autopriority" <?php echo $grab_parameters['xs_autopriority']?'checked':''?> id="autopriority"><label for="autopriority"> Automatically assign priority attribute</label>
																												<br><small>Enable this option to automatically reduce priority depending on the page's depth level</small>
																												<div class="inptitle">Individual attributes:</div>
																												<textarea name="ind_attr" rows="4" cols="40"><?php echo $grab_parameters['xs_ind_attr']?></textarea>
																												<br><small>define specific frequency and priority attributes here in the following format: 
																												<br/>"url substring,lastupdate YYYY-mm-dd,frequency,priority". 
																												<br/><b>example:</b>
																												<br/>page.php?product=,2005-11-14,monthly,0.9
																												</small>
																												<br/>
																												<br/><br/>
																												</div>
																												<h3 style="cursor:pointer" onclick="javascript:e5VXUaptWL7P('miscset')" id="hmiscset">[-] Miscellaneous Settings (click to collapse)</h3>
																												<div id="miscset">
																												<div class="inptitle">Require authorization to access generator interface:</div>
																												<input type="checkbox" name="changepass" onclick="e5VXUaptWL7P('loginform');" id="chgpass" />
																												<label for="chgpass">Set or modify login/password</label>
																												<div id="loginform" style="display:none">
																												Login:<br/><input type="text" name="xslogin" value="<?php echo $grab_parameters['xs_login']?>" size="70">
																												<br/>
																												Password:<br/><input type="password" name="xspassword" value="" size="70">
																												</div>
																												<br/>
																												<div class="inptitle">Send email notifications:</div>
																												<input type="text" name="xsemail" value="<?php echo $grab_parameters['xs_email']?>" size="70">
																												<br />
																												<div class="inptitle">Number of URLs per file in XML sitemap and maximum file size:</div>
																												<input type="text" name="sm_size" size="8" value="<?php echo $grab_parameters['xs_sm_size']?>"> URLs per file, 
																												<input type="text" name="sm_filesize" size="12" value="<?php echo $grab_parameters['xs_sm_filesize']?>"> Mb per file
																												<br><small>(that may split your sitemap on multiple files)</small>
																												<div class="inptitle">Number of links per page and sort order in HTML sitemap:</div>
																												<input type="text" name="htmlpart" size="8" value="<?php echo $grab_parameters['xs_htmlpart']?>">
																												<select name="htmlsort">
																												<?php $tIGZKpwqkKpgM = array('Unsorted (default)','Alphabetical (asc)','Alphabetical (desc)','Randomize'); foreach($tIGZKpwqkKpgM as $k=>$fa) echo ' <option value="'.$k.'"'.($k==$grab_parameters['xs_htmlsort']?' selected':'').'>'.$fa.'</option>'; ?>
																												</select>
																												<select name="htmlstruct">
																												<?php $tIGZKpwqkKpgM = array('Tree-like (default)','Folders list','Plain list'); foreach($tIGZKpwqkKpgM as $k=>$fa) echo ' <option value="'.$k.'"'.($k==$grab_parameters['xs_htmlstruct']?' selected':'').'>'.$fa.'</option>'; ?>
																												</select>
																												<div class="inptitle">Compress sitemap using GZip:</div>
																												<input type="checkbox" name="compress" <?php echo $grab_parameters['xs_compress']?'checked':''?> id="in1"><label for="in1"> Use sitemap files compression</label>
																												<br><small>(".gz" will be added to all filenames automatically)</small>
																												<div class="inptitle">Inform (ping) Search Engines upon completion (Google, Yahoo, Ask, Moreover, Live):</div>
																												<input type="checkbox" name="gping" <?php echo $grab_parameters['xs_gping']?'checked':''?> id="in2"><label for="in2"> Ping Search Engines when generation is done</label>
																												<br>
																												<div class="inptitle">Send "weblogUpdate" type of Ping Notification to:</div>
																												<textarea name="weblogup" rows="2" cols="40"><?php echo $grab_parameters['xs_weblog_ping']?></textarea>
																												<div class="inptitle">Calculate changelog:</div>
																												<input type="checkbox" name="gchlog" <?php echo $grab_parameters['xs_chlog']?'checked':''?> id="in3"><label for="in3"> Calculate Change Log after completion</label>
																												<br><small>please note that this option requires more resources to complete</small>
																												<div class="inptitle">Store the external links list:</div>
																												<input type="checkbox" name="extlinks" <?php echo $grab_parameters['xs_extlinks']?'checked':''?> id="inextlinks"><label for="inextlinks"> Store External Links List</label>
																												<br><small>this option increases memory usage</small>
																												<br/><br/>
																												</div>
																												<h3 style="cursor:pointer" onclick="javascript:e5VXUaptWL7P('narrow')" id="hnarrow">[-] Narrow Indexed Pages Set (click to collapse)</h3>
																												<div id="narrow">
																												<div class="inptitle">Exclude from sitemap extensions:</div>
																												<input type="text" name="excl" size="90" value="<?php echo $blUx9Th8GWx0bsSC?>">
																												<br><small>these URLs are NOT included in sitemap</small>
																												<div class="inptitle">Do not parse extensions:</div>
																												<input type="text" name="incl" size="90" value="<?php echo $qHEfslblz?>">
																												<br><small>these URLs ARE included in sitemap, although not retrieved from server</small>
																												<div class="inptitle">Exclusion preset:</div>
																												<select style="width:220px" onchange="B0bZK2_9KnR8WXXzmsf(this.value)">
																												<option value="0">Select one to apply</option>
																												<option value="1">osCommerce</option>
																												<option value="2">Joomla</option>
																												<option value="3">Simple Machines Forum</option>
																												<option value="4">vBulletin</option>
																												<option value="5">phpBB</option>
																												<option value="6">Gallery 2</option>
																												<option value="7">CubeCart</option>
																												</select>
																												<br><small>changing this setting will automatically prepopulate the options below with preset data</small>
																												<script type="text/javascript">
																												function B0bZK2_9KnR8WXXzmsf(set)
																												{
																												document.forms['sgform'].elements['excl_urls'].value = aexc[set];
																												document.forms['sgform'].elements['incl_urls'].value = anop[set];
																												}
																												var aexc = new Array();
																												var anop = new Array();
																												aexc[0] = anop[0] = '';
																												aexc[1] = "redirect.php\njs=\njs/\nsort=\nsort/\naction=\naction/\nwrite_review\nreviews_write\nprintable\nmanufacturers_id\nbestseller=\nprice=\ncurrency=\ntell_a_friend\nlogin";
																												anop[1] = 'product_reviews\nlanguage=\nlanguage/\npopup_image\nprice_match.php';
																												aexc[2] = 'print=\ndo_pdf=\npop=1\ntask=emailform\ntask=trackback\ntask=rss';
																												anop[2] = '';
																												aexc[3] = 'sort,\naction=\n.new.html\n.msg\nprev_next';
																												anop[3] = '';
																												aexc[4] = 'attachment.php\ncalendar.php\ncron.php\neditpost.php\nimage.php\nmember.php\nmemberlist.php\nmisc.php\nnewattachment.php\nnewreply.php\nnewthread.php\nonline.php\nprivate.php\nprofile.php\nregister.php\nsearch.php\nusercp.php\ngoto=\np=\nsort=\norder=\nmode=';
																												anop[4] = '';
																												aexc[5] = 'p=\nmode=\nmark=\norder=\nhighlight=\nprofile.php\nprivmsg.php\nposting.php\nview=previous\nview=next\nsearch.php';
																												anop[5] = 'view=print';
																												aexc[6] = 'core.UserLogin\ncore.UserRecoverPassword\ng2_return\nsearch.\nslideshow';
																												anop[6] = 'g2_keyword\ng2_imageViewsIndex';
																												aexc[7] = 'ccUser=\nskins\nthumbs\nsort_\nredir\nreview=\ntell\nact=taf\nlanguage=';
																												anop[7] = 'prod_';
																												</script>
																												<div class="inptitle">Exclude URLs:</div>
																												<textarea name="excl_urls" rows="4" cols="40"><?php echo $grab_parameters['xs_excl_urls']?></textarea>
																												<br><small>do NOT include URLs that contain these substrings, one string per line</small>
																												<div class="inptitle">Do not parse URLs:</div>
																												<textarea name="incl_urls" rows="3" cols="40"><?php echo $grab_parameters['xs_incl_urls']?></textarea>
																												<br><small>do not retrieve pages that contain these substrings in URL, but still INCLUDE them in sitemap</small>
																												<div class="inptitle">"Include ONLY" URLs:</div>
																												<input type="text" name="incl_only" size="90" value="<?php echo $grab_parameters['xs_incl_only']?>">
																												<br><small>leave this field empty by default. Fill it if you would like to include into sitemap ONLY those URls that match the specified string, separate multiple matches with space.</small>
																												<br/>
																												<div class="inptitle">"Parse ONLY" URLs:</div>
																												<input type="text" name="parse_only" size="90" value="<?php echo $grab_parameters['xs_parse_only']?>">
																												<br><small>leave this field empty by default. Fill it if you would like to parse (crawl) ONLY those URls that match the specified string, separate multiple matches with space.</small>
																												<br/>
																												<br/><br/>
																												</div>
																												<h3 style="cursor:pointer" onclick="javascript:e5VXUaptWL7P('configopt')" id="hconfigopt">[-] Crawler Limitations, Finetune (click to collapse)</h3>
																												<div id="configopt">
																												<div class="inptitle">Maximum pages:</div>
																												<input type="text" name="max_pages" size="5" value="<?php echo $grab_parameters['xs_max_pages']?>">
																												<br /><small>
																												This will limit the number of pages crawled. You can enter "0" value for unlimited crawling. 
																												<?php  if($ulCVuyvzZwsip){  ?>
																												<br />
																												<b style="color:red">THIS IS A TRIAL VERSION of sitemap generator, it will NOT index more than 500 pages</b>
																												<?php } ?>
																												</small>
																												<div class="inptitle">Maximum depth level:</div>
																												<input type="text" name="max_depth" size="5" value="<?php echo $grab_parameters['xs_max_depth']?>">
																												<small>"0" for unlimited</small>
																												<div class="inptitle">Maximum execution time, seconds:</div>
																												<input type="text" name="exec_time" size="5" value="<?php echo $grab_parameters['xs_exec_time']?>">
																												<small>"0" for unlimited</small>
																												<div class="inptitle">Maximum memory usage, MB:</div>
																												<input type="text" name="mem_limit" size="5" value="<?php echo $grab_parameters['xs_memlimit']?>">
																												<small>"0" for default. Note: might not work depending on the server configuration.</small>
																												<div class="inptitle">Save the script state, every X seconds:</div>
																												<input type="text" name="savestate_time" size="5" value="<?php echo $grab_parameters['xs_savestate_time']?>">
																												<small>this option allows to resume crawling operation if it was interrupted. "0" for no saves</small>
																												<div class="inptitle">Make a delay between requests, X seconds after each N requests:</div>
																												<input type="text" name="delay_ms" size="5" value="<?php echo $grab_parameters['xs_delay_ms']?>"> s
																												after each
																												<input type="text" name="delay_req" size="5" value="<?php echo $grab_parameters['xs_delay_req']?>"> requests
																												<br/><small>This option allows to reduce the load on your webserver. "0" for no delay</small>
																												</div>
																												<h3 style="cursor:pointer" onclick="javascript:e5VXUaptWL7P('configopt2')" id="hconfigopt2">[-] Advanced Settings (click to collapse)</h3>
																												<div id="configopt2">
																												<div class="inptitle">Extract meta description tag</div>
																												<input type="checkbox" name="metadesc" <?php echo $grab_parameters['xs_metadesc']?'checked':''?> id="inmetadesc"><label for="inmetadesc"> enable META descriptions</label>
																												<br /><small>Note: this option may significantly increase memory usage and is not recommended for larger sitemaps</small>
																												<div class="inptitle">Purge log records older than X days:</div>
																												<input type="text" name="purge" size="5" value="<?php echo $grab_parameters['xs_purgelogs']?>">
																												<div class="inptitle">Maximum referred pages to store (for broken links list):</div>
																												<input type="text" name="maxref" size="5" value="<?php echo $grab_parameters['xs_maxref']?>">
																												<br><small>this option increases memory usage</small>
																												<div class="inptitle">Use IP address for crawling:</div>
																												<input type="text" name="ipaddr" size="40" value="<?php echo $grab_parameters['xs_ipconnection']?>">
																												<br><small>Hint: SERVER[SERVER_ADDR] - <?php echo $_SERVER['SERVER_ADDR']?></small>
																												<div class="inptitle">Use CURL extension for http requests:</div>
																												<input type="checkbox" name="usecurl" <?php echo $grab_parameters['xs_usecurl']?'checked':''?> id="curl1"><label for="curl1"> Use CURL extension</label>
																												<?php $i3SMAPpcK = str_replace('|',' ',$grab_parameters['xs_cleanpar']); ?>
																												<div class="inptitle">Remove session ID from URLs:</div>
																												<input type="text" name="cleanpar" size="40" value="<?php echo $i3SMAPpcK?>">
																												<br />
																												<small>common session parameters (separate with spaces): PHPSESSID, sid, osCsid</small>
																												<div class="inptitle">Progress state storage type:</div>
																												<input type="radio" name="storage" value="serialize" id="stor01"<?php echo $grab_parameters['xs_dumptype']=='serialize'?' checked':''?>><label for="stor01"> serialize</label>
																												<input type="radio" name="storage" value="varexport" id="stor02"<?php echo $grab_parameters['xs_dumptype']!='serialize'?' checked':''?>><label for="stor02"> var_export</label>
																												<br />
																												<small>try to change this option in case of memory usage issues</small>
																												<div class="inptitle">Minimize script memory usage:</div>
																												<input type="checkbox" name="memsave" <?php echo $grab_parameters['xs_memsave']?'checked':''?> id="memsave1"><label for="memsave1"> use temporary files to store crawling progress</label>
																												<br />
																												<small>this option may significantly increase crawling time</small>
																												<div class="inptitle">Show debug output when crawling:</div>
																												<input type="checkbox" name="dbg" <?php echo $grab_parameters['xs_debug']?'checked':''?> id="dbg1"><label for="dbg1"> enable debug output</label>
																												<div class="inptitle">Check for new versions of sitemap generator:</div>
																												<input type="checkbox" name="checkver" <?php echo $grab_parameters['xs_checkver']?'checked':''?> id="checkver1"><label for="checkver1"> check for new versions</label>
																												<div class="inptitle">Detect canonical URL meta tags:</div>
																												<input type="checkbox" name="canonical" <?php echo $grab_parameters['xs_canonical']?'checked':''?> id="can1"><label for="can1"> enable canonical URLs</label>
																												<div class="inptitle">Enable stylesheet for XML sitemap:</div>
																												<input type="checkbox" name="xslon" <?php echo $grab_parameters['xs_disable_xsl']?'':'checked'?> id="can2"><label for="can2"> enable XSL stylesheet</label>
																												<div class="inptitle">Site uses UTF-8 charset:</div>
																												<input type="checkbox" name="xsutf" <?php echo $grab_parameters['xs_utf8']?'checked':''?> id="can3"><label for="can3"> UTF8 charset</label>
																												<div class="inptitle">Enable last-modification time tag for "not parsed" URLs:</div>
																												<input type="checkbox" name="lmnp" <?php echo $grab_parameters['xs_lastmod_notparsed']?'checked':''?> id="lmnp1"><label for="lmnp1"> enable last-mod for "not parsed" URLs</label>
																												<br />
																												<small>additional HTTP HEAD requests are required in this case</small>
																												</div>
																												<div class="inptitle">
																												<input class="button" type="submit" name="save" value="Save" style="width:150px;height:30px">
																												</div>
																												</form>
																												<script language="Javascript">
																												<!--
																												function e5VXUaptWL7P(eid)
																												{
																												var gel = document.getElementById(eid);
																												var isvis = gel.style.display ? 1 : 0;
																												gel.style.display = isvis ? '' : 'none';
																												var th = document.getElementById('h'+eid);
																												if(th)
																												{
																												var al = ['[+]', '[-]'];
																												var rl = ['collapse', 'expand'];
																												th.innerHTML = al[isvis]+th.innerHTML.substring(3, 100);
																												th.innerHTML = th.innerHTML.replace(rl[isvis], rl[1-isvis]);
																												}
																												}
																												e5VXUaptWL7P('configopt');
																												e5VXUaptWL7P('configopt2');
																												e5VXUaptWL7P('configattr');
																												
																												
																												//-->
																												</script>
																												</div>
																												<?php include KH6aKAnNWiCYJWvf.'page-bottom.inc.php'; 



































































































