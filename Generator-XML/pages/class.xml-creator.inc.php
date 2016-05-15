<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$diwqZ47466125Jkzki=496933014;$PwDri37940979XOYWV=987286896;$zIeHs66208801DlDbs=539127106;$OTkNk56332092WjsPX=57797393;$srzut67373352YPCaU=948141510;$OLruL23395080wBSir=119503204;$bPdza73459778sCClh=974726227;$BUIHD51629944TqzoL=423154327;$BKtKx16968078fuekn=868631256;$JYoiS73536682mLpMe=219500763;$yvVbb10398254KTTOQ=879606598;$dZCWq21615295MjQZa=757292511;$otuGF76250305AEHFI=258402252;$CKyiT98365784dCUrZ=288279571;$aCXMO57024231VjASy=253768219;$GaqjF56288147JBJFA=61211944;$NpQdf65220032jVtto=116454498;$peXyC97882386mTisE=325839630;$lylqB33337707qAKJr=96211090;$seNVp65648499DyrBl=332912628;$aMkdZ73877259ngMtw=442787994;$WTQwS72086487MHHSr=332180939;$IwAms29338684Cvoaa=406935211;$MBHYi49696350hHmfx=573394562;$sQfGR12221984EYmDj=238402740;$MaNVa20978088SzmRv=307303497;$POSvD45027161OMkLM=186940582;$JtcjK98431702wAqXv=782657746;$VHKKs60254211nZYhF=502298737;$WafFn34557190enfQI=251207306;$dwpAx80403137hQZHB=435227203;$TvXSZ31854553ivYPf=960702179;$yKnuk37973938jifvL=235475982;$oEbUp22823791TwlOP=163892364;$EtAJr45466614PqyWg=152795074;$QMkcI29964905YmfLw=108527862;$ZxRMp35381164AaRdB=436934479;$XNbvm75777893nepeR=45358673;$aXZyD30217590NnVwB=338644195;$EGxBM92762757cMyVT=224134796;$jFwsj52475891fRbCW=107674224;$KUflz13419494PEgId=894606232;$HxjVP34656067yXzjB=992774567;$OGcbV40248108EMMxM=308522980;$lCDix89258118YKVjb=246695221;$ImMVZ15748596hWnbX=713635040;$GUBkU58782043rfxpf=117186187;$ZMhVb52420959evNrj=361692413;$JHBvI55727844JAMgJ=853997467;$IRQIB82765198pBJmd=501445099;?><?php class XMLCreator { var $e6rLElc7C4  = array(); var $CycjTbE1bsdEES4EbPq = array('xml','','','','mobile'); var $B14o0udck = array(); function MjfS99JQfMEzIgi($B14o0udck, $urls_completed, $VRIU8Yff7QG) { global $TEglXP6RvC, $qFRPmUDRi; $qFRPmUDRi = array();    $this->JXrAUXdkHB6bEow = new JzKTkgbg1Sie1k_("pages/"); $this->B14o0udck = $B14o0udck; $q2PfaTx_3ig = basename($this->B14o0udck['xs_smname']); $this->uurl_p = dirname($this->B14o0udck['xs_smurl']).'/'; $this->furl_p = dirname($this->B14o0udck['xs_smname']).'/'; $this->imgno = 0; $this->GZCFp_txIxdI = $this->B14o0udck['xs_compress'] ? '.gz' : ''; $this->urls_prev = $this->urls_prevnews = array(); if($this->B14o0udck['xs_chlog']) $this->urls_prev = $this->gZnBm63TnG1($q2PfaTx_3ig); if($this->B14o0udck['xs_newsinfo']) $this->urls_prevnews = $this->gZnBm63TnG1($this->B14o0udck['xs_newsfilename'], $this->B14o0udck['xs_newsage']); $PumGiN59i = $wR70CK76khtA4O6VZ4I = array(); $this->KsbskAuOsxLPc1sC = $this->B14o0udck['xs_compress'] ? array('fopen' => 'gzopen', 'fwrite' => 'gzwrite', 'fclose' => 'gzclose' ) : array('fopen' => 'fopen', 'fwrite' => 'fwrite', 'fclose' => 'fclose' ) ; $VGNz2mNQXx = strstr($this->B14o0udck['xs_initurl'],'://www.');
																														 $IOVrd_HyNGxshZQSHJ = $TEglXP6RvC.'/'; if(strstr($this->B14o0udck['xs_initurl'],'https:')) $IOVrd_HyNGxshZQSHJ = str_replace('http:', 'https:', $IOVrd_HyNGxshZQSHJ); $Pg9z9L_vlxcCxaz = strstr($IOVrd_HyNGxshZQSHJ,'://www.');
																														 if($VGNz2mNQXx && !$Pg9z9L_vlxcCxaz)$IOVrd_HyNGxshZQSHJ = str_replace('://', '://www.', $IOVrd_HyNGxshZQSHJ);
																														 if(!$VGNz2mNQXx && $Pg9z9L_vlxcCxaz)$IOVrd_HyNGxshZQSHJ = str_replace('://www.', '://', $IOVrd_HyNGxshZQSHJ);
																														 $this->B14o0udck['gendom'] = $IOVrd_HyNGxshZQSHJ; $this->nGj0r0BbusL($urls_completed, $PumGiN59i); $this->YcU5l0MyRpXPO(); if($this->B14o0udck['xs_chlog']) { $mjn1fX_2WAjK7iApvtY = array_diff($PumGiN59i,$this->urls_prev); $GksHakkDnjml = array_diff($this->urls_prev,$PumGiN59i); $mjn1fX_2WAjK7iApvtY  = array_slice($mjn1fX_2WAjK7iApvtY,  0, 1000); $GksHakkDnjml = array_slice($GksHakkDnjml, 0, 1000); } if($this->imgno)$this->e6rLElc7C4[1]['xn'] = $this->imgno; if($this->videos_no)$this->e6rLElc7C4[2]['xn'] = $this->videos_no; if($this->news_no)$this->e6rLElc7C4[3]['xn'] = $this->news_no; $F1JJx6h86dbaJkcg = array_merge($VRIU8Yff7QG, array( 'files'   => array(), 'rinfo'   => $this->e6rLElc7C4, 'newurls' => $mjn1fX_2WAjK7iApvtY, 'losturls'=> $GksHakkDnjml, 'urls_ext'=> $VRIU8Yff7QG['urls_ext'], 'images_no'  => $this->imgno, 'videos_no' => $this->videos_no, 'news_no'  => $this->newsno, 'fail_files' => $qFRPmUDRi, 'create_time' => time() )); $uOu1DWuwwQBrf = date('Y-m-d H-i-s').'.log'; ZBWGkqS6VQ71($uOu1DWuwwQBrf,serialize($F1JJx6h86dbaJkcg)); $this->urls_prev = $this->urls_prevnews = array(); $PumGiN59i = array(); return $F1JJx6h86dbaJkcg; } function MddRgpIor($pf) { global $eYgPj3ZHK0T12hAy; if(!$pf)return; $this->KsbskAuOsxLPc1sC['fwrite']($pf, $eYgPj3ZHK0T12hAy[3]); $this->KsbskAuOsxLPc1sC['fclose']($pf); } function ZoknvuUYP($pf, $XvU49oK_Vd) { global $eYgPj3ZHK0T12hAy; if(!$pf)return; $xs = $this->JXrAUXdkHB6bEow->VGnW7iJnFC33aI7tL0($eYgPj3ZHK0T12hAy[1], array('TYPE'.$XvU49oK_Vd=>true)); $this->KsbskAuOsxLPc1sC['fwrite']($pf, $xs); } function tk3aOovNCsJ4Z($wR70CK76khtA4O6VZ4I) { $vablW4zqAwA = ""; $kH_x88NZpV8q = implode('', file(Znq7ffD8tRtK7G7k.'sitemap_index_tpl.xml')); preg_match('#^(.*)%SITEMAPS_LIST_FROM%(.*)%SITEMAPS_LIST_TO%(.*)$#is', $kH_x88NZpV8q, $spSCVOMAe); $spSCVOMAe[1] = str_replace('%GEN_URL%', $this->B14o0udck['gendom'], $spSCVOMAe[1]); $T0gmFEXXIurPo = preg_replace('#[^\\/]+?\.xml$#', '', $this->B14o0udck['xs_smurl']); $spSCVOMAe[1] = str_replace('%SM_BASE%', $T0gmFEXXIurPo, $spSCVOMAe[1]); for($i=0;$i<count($wR70CK76khtA4O6VZ4I);$i++) $vablW4zqAwA.= $this->JXrAUXdkHB6bEow->VGnW7iJnFC33aI7tL0($spSCVOMAe[2], array( 'URL'=>$wR70CK76khtA4O6VZ4I[$i], 'LASTMOD'=>date('Y-m-d\TH:i:s+00:00') )); return $spSCVOMAe[1] . $vablW4zqAwA . $spSCVOMAe[3]; } function N4yuA2XEdnmwGMXLE4($PCiMWHKGB5lwUwCci, $RdLUQ0sfh1B3DH = false) { $t = $RdLUQ0sfh1B3DH ? htmlspecialchars($PCiMWHKGB5lwUwCci) : str_replace("&", "&amp;", $PCiMWHKGB5lwUwCci); if(function_exists('utf8_encode') && !$this->B14o0udck['xs_utf8']) { $t = utf8_encode($t); } return $t; } function NpOTWccEKPO7LjSMseh($IZiCYkziP_t0T0DX) { global $RdLUQ0sfh1B3DH; $l = str_replace("&amp;", "&", $IZiCYkziP_t0T0DX); $l = str_replace("&", "&amp;", $l); $l = strtr($l, $RdLUQ0sfh1B3DH); if($this->B14o0udck['xs_utf8']) { }else if(function_exists('utf8_encode')) $l = utf8_encode($l); return $l; } function aqAxgNGqxV($cKCGec1Tw) { $Z1gq78juXl150LtnVs = array( basename($this->B14o0udck['xs_smname']),  $this->B14o0udck['xs_imgfilename'], $this->B14o0udck['xs_videofilename'], $this->B14o0udck['xs_newsfilename'], $this->B14o0udck['xs_mobilefilename'], ); if($cKCGec1Tw['rinfo']) $this->e6rLElc7C4 = $cKCGec1Tw['rinfo']; foreach($this->CycjTbE1bsdEES4EbPq as $XvU49oK_Vd=>$Lqem3eMvsk4mB) if($Lqem3eMvsk4mB) { $this->e6rLElc7C4[$XvU49oK_Vd]['sitemap_file'] = $Z1gq78juXl150LtnVs[$XvU49oK_Vd]; $this->e6rLElc7C4[$XvU49oK_Vd]['filenum'] = intval($cKCGec1Tw['istart']/$this->sG53YQ0A72)+1; if(!$cKCGec1Tw['istart']) $this->JiNZdZTQFJ($Z1gq78juXl150LtnVs[$XvU49oK_Vd]); } } function ctboMafhgvqDmuTRdSR() { global $qFRPmUDRi; $ZR1vtYkW3IIT6ji = 0; $l = false; foreach($this->CycjTbE1bsdEES4EbPq as $XvU49oK_Vd=>$Lqem3eMvsk4mB) { $ri = &$this->e6rLElc7C4[$XvU49oK_Vd]; $sTOHkwY0EiWi = (($ri['xn'] % $this->sG53YQ0A72) == 0) && ($ri['xn'] || !$ri['pf']); $l|=$sTOHkwY0EiWi; if($this->sm_filesplit && $ri['xchs'] && $ri['xn']) $sTOHkwY0EiWi |= ($ri['xchs']/$ri['xn']*($ri['xn']+1)>$this->sm_filesplit); if( $sTOHkwY0EiWi ) { $ZR1vtYkW3IIT6ji++; $ri['xchs'] = $ri['xn'] = 0; $this->MddRgpIor($ri['pf']); if($ri['filenum'] == 2) { if(!copy(z_fhGrViQaOeql9 . $ri['sitemap_file'].$this->GZCFp_txIxdI,  z_fhGrViQaOeql9.($_xu = DXwTWcPx8gwRJFL(1,$ri['sitemap_file']).$this->GZCFp_txIxdI))) { $qFRPmUDRi[] = z_fhGrViQaOeql9.$_xu; } $ri['urls'][0] = $this->uurl_p . $_xu; } $KDdCtJPGUBu9Wq = (($ri['filenum']>1) ? DXwTWcPx8gwRJFL($ri['filenum'],$ri['sitemap_file']) :$ri['sitemap_file']) . $this->GZCFp_txIxdI; $ri['urls'][] = $this->uurl_p . $KDdCtJPGUBu9Wq; $ri['filenum']++; $ri['pf'] = $this->KsbskAuOsxLPc1sC['fopen'](z_fhGrViQaOeql9.$KDdCtJPGUBu9Wq,'w'); if(!$ri['pf']) $qFRPmUDRi[] = z_fhGrViQaOeql9.$KDdCtJPGUBu9Wq; $this->ZoknvuUYP($ri['pf'], $XvU49oK_Vd); } } return $l; } function C5VWcxw36h($D6IQA6CnCMx9RWf, $eYgPj3ZHK0T12hAy, $XvU49oK_Vd) { $D6IQA6CnCMx9RWf['TYPE'.$XvU49oK_Vd] = true; $ri = &$this->e6rLElc7C4[$XvU49oK_Vd]; if($ri['pf']) { $_xu = $this->JXrAUXdkHB6bEow->VGnW7iJnFC33aI7tL0($eYgPj3ZHK0T12hAy, $D6IQA6CnCMx9RWf); $ri['xchs'] += strlen($_xu); $ri['xn']++; $this->KsbskAuOsxLPc1sC['fwrite']($ri['pf'], $_xu); } }  function Gg5AAIeuiYp() { foreach($this->e6rLElc7C4 as $XvU49oK_Vd=>$ri) { $this->MddRgpIor($ri['pf']); } } function YcU5l0MyRpXPO() { foreach($this->CycjTbE1bsdEES4EbPq as $XvU49oK_Vd=>$Lqem3eMvsk4mB) { $ri = &$this->e6rLElc7C4[$XvU49oK_Vd]; if(count($ri['urls'])>1) { $xf = $this->tk3aOovNCsJ4Z($ri['urls']); array_unshift($ri['urls'],  $this->uurl_p.ZBWGkqS6VQ71($ri['sitemap_file'], $xf, z_fhGrViQaOeql9, $this->B14o0udck['xs_compress']) ); } $this->ffpknLH3lruh($ri['sitemap_file']); } } function KC5A4W9FxdMzpD0q($n6dlUxlV2r5) { 
																														return $n6dlUxlV2r5;
																														}
																														function nGj0r0BbusL($urls_completed, &$PumGiN59i)
																														{
																														global $eYgPj3ZHK0T12hAy, $Qw4OhMRiQXE9Pvp0y22, $RKwdWhsAFuDrxw3i6, $sm_proc_list, $cKCGec1Tw, $q64AQ_T07, $qFRPmUDRi;
																														$qDot7WxFYvQPR = $this->B14o0udck['xs_chlog'];
																														$bcUHiUvk1__NNu9qID = file_exists(Znq7ffD8tRtK7G7k.'sitemap_xml_tpl2.xml') ? 'sitemap_xml_tpl2.xml' : 'sitemap_xml_tpl.xml';
																														$kH_x88NZpV8q = implode('', file(Znq7ffD8tRtK7G7k.$bcUHiUvk1__NNu9qID));
																														preg_match('#^(.*)%URLS_LIST_FROM%(.*)%URLS_LIST_TO%(.*)$#is', $kH_x88NZpV8q, $eYgPj3ZHK0T12hAy);
																														$eYgPj3ZHK0T12hAy[1] = str_replace('www.xml-sitemaps.com', 'www.xml-sitemaps.com ('. joeXw9f7bW7PyEcEv.')', $eYgPj3ZHK0T12hAy[1]);
																														$eYgPj3ZHK0T12hAy[1] = str_replace('%GEN_URL%', $this->B14o0udck['gendom'], $eYgPj3ZHK0T12hAy[1]);
																														$T0gmFEXXIurPo = preg_replace('#[^\\/]+?\.xml$#', '', $this->B14o0udck['xs_smurl']);
																														$eYgPj3ZHK0T12hAy[1] = str_replace('%SM_BASE%', $T0gmFEXXIurPo, $eYgPj3ZHK0T12hAy[1]);
																														if($this->B14o0udck['xs_disable_xsl'])
																														$eYgPj3ZHK0T12hAy[1] = preg_replace('#<\?xml-stylesheet.*\?>#', '', $eYgPj3ZHK0T12hAy[1]);
																														$cELF4rAmlQsI9AR = implode('', file(Znq7ffD8tRtK7G7k.'sitemap_ror_tpl.xml'));
																														preg_match('#^(.*)%URLS_LIST_FROM%(.*)%URLS_LIST_TO%(.*)$#is', $cELF4rAmlQsI9AR, $Qw4OhMRiQXE9Pvp0y22);
																														$gCmDgG11zRQ1aO = implode('', file(Znq7ffD8tRtK7G7k.'sitemap_base_tpl.xml'));
																														preg_match('#^(.*)%URLS_LIST_FROM%(.*)%URLS_LIST_TO%(.*)$#is', $gCmDgG11zRQ1aO, $RKwdWhsAFuDrxw3i6);
																														$this->sG53YQ0A72 = $this->B14o0udck['xs_sm_size']?$this->B14o0udck['xs_sm_size']:50000;
																														$this->sm_filesplit = $this->B14o0udck['xs_sm_filesize']?$this->B14o0udck['xs_sm_filesize']:10;
																														$this->sm_filesplit = max(intval($this->sm_filesplit*1024*1024),2000)-1000;
																														if(!$this->B14o0udck['xs_imginfo'])
																														unset($this->CycjTbE1bsdEES4EbPq[1]);
																														if(!$this->B14o0udck['xs_videoinfo'])
																														unset($this->CycjTbE1bsdEES4EbPq[2]);
																														if(!$this->B14o0udck['xs_newsinfo'])
																														unset($this->CycjTbE1bsdEES4EbPq[3]);
																														if(!$this->B14o0udck['xs_makemob'])
																														unset($this->CycjTbE1bsdEES4EbPq[4]);
																														$ctime = date('Y-m-d H:i:s');
																														$fjOiR1rimG = 0;
																														global $RdLUQ0sfh1B3DH;
																														$tt = array('<','>');
																														foreach ($tt as $Wo1WjLciOv3NRe )
																														$RdLUQ0sfh1B3DH[$Wo1WjLciOv3NRe] = '&#'.ord($Wo1WjLciOv3NRe).';';
																														for($i=0;$i<31;$i++)
																														$RdLUQ0sfh1B3DH[chr($i)] = '&#'.$i.';';
																														$RdLUQ0sfh1B3DH[chr(0)] = $RdLUQ0sfh1B3DH[chr(10)] = $RdLUQ0sfh1B3DH[chr(13)] = '';
																														$RdLUQ0sfh1B3DH[' '] = '%20';
																														$pf = 0;
																														$dh6mwOEumX3JD = intval($cKCGec1Tw['istart']);
																														$this->aqAxgNGqxV($cKCGec1Tw);
																														if($this->B14o0udck['xs_maketxt'])
																														{
																														$pjWDjZIGXb1f = $this->KsbskAuOsxLPc1sC['fopen'](RGVnCnecoCvEL7oyPH.$this->GZCFp_txIxdI, $dh6mwOEumX3JD?'a':'w');
																														if(!$pjWDjZIGXb1f)$qFRPmUDRi[] = RGVnCnecoCvEL7oyPH.$this->GZCFp_txIxdI;
																														}
																														if($this->B14o0udck['xs_makeror'])
																														{
																														$ee6xJLhs_ZF4V7QG = fopen(jgYSLBDPtmpAo, $dh6mwOEumX3JD?'a':'w');
																														$rc = str_replace('%INIT_URL%', $this->B14o0udck['xs_initurl'], $Qw4OhMRiQXE9Pvp0y22[1]);
																														if($ee6xJLhs_ZF4V7QG)
																														fwrite($ee6xJLhs_ZF4V7QG, $rc);
																														else
																														$qFRPmUDRi[] = jgYSLBDPtmpAo;
																														}
																														foreach($sm_proc_list as $k=>$duBMhqfH7kGKH)
																														$sm_proc_list[$k]->FOCpwyCaa1zV8ITF($this->B14o0udck, $this->KsbskAuOsxLPc1sC, $this->JXrAUXdkHB6bEow);
																														for($i=$xn=$dh6mwOEumX3JD;$i<count($urls_completed);$i++,$xn++)
																														{   
																														Ka_AEZ56jwB8MHjF(array(
																														'cmd'=> 'info',
																														'id' => 'percprog',
																														'text'=> number_format($i*100/count($urls_completed),0).'%'
																														));
																														$ZR1vtYkW3IIT6ji = $this->ctboMafhgvqDmuTRdSR();
																														if($ZR1vtYkW3IIT6ji && ($i != $dh6mwOEumX3JD))
																														{
																														ZBWGkqS6VQ71($q64AQ_T07,Z17BHXaZcFYLa6pQZ(array('istart'=>$i,'rinfo'=>$this->e6rLElc7C4)));
																														}
																														if($this->B14o0udck['xs_memsave'])
																														{
																														$cu = i0c9crUM5phHcmd1CrY($urls_completed[$i]);
																														}else
																														$cu = &$urls_completed[$i];
																														$l = $this->NpOTWccEKPO7LjSMseh($cu['link']);
																														$cu['link'] = $l;
																														if($qDot7WxFYvQPR) $PumGiN59i[]=$l;
																														$t = $this->N4yuA2XEdnmwGMXLE4($cu['t']);
																														$d = $this->N4yuA2XEdnmwGMXLE4($cu['d'] ? $cu['d'] : $cu['t'], true);
																														$dLJTsb_ip3FtL0 = '';
																														if($cu['clm'])
																														$dLJTsb_ip3FtL0 = $cu['clm'];
																														else
																														switch($this->B14o0udck['xs_lastmod']){
																														case 1:$dLJTsb_ip3FtL0 = $cu['lm']?$cu['lm']:$ctime;break;
																														case 2:$dLJTsb_ip3FtL0 = $ctime;break;
																														case 3:$dLJTsb_ip3FtL0 = $this->B14o0udck['xs_lastmodtime'];break;
																														}
																														$Pl78ZpRHcI = $c1r0vtAKt4y5_gmCb1e = false;
																														if($cu['p'])
																														$p = $cu['p'];
																														else
																														{
																														$p = $this->B14o0udck['xs_priority'];
																														if($this->B14o0udck['xs_autopriority'])
																														{
																														$p = $p*pow($this->B14o0udck['xs_descpriority']?$this->B14o0udck['xs_descpriority']:0.8,$cu['o']);
																														if($this->urls_prev)
																														{
																														$Pl78ZpRHcI = true;
																														$c1r0vtAKt4y5_gmCb1e = !in_array($cu['link'], $this->urls_prev)||$this->urls_prevnews[$cu['link']];
																														if($c1r0vtAKt4y5_gmCb1e)
																														$p=0.95;
																														}
																														$p = max(0.0001,min($p,1.0));
																														$p = @number_format($p, 4);
																														}
																														}
																														if($dLJTsb_ip3FtL0){
																														$dLJTsb_ip3FtL0 = strtotime($dLJTsb_ip3FtL0);
																														$dLJTsb_ip3FtL0 = gmdate('Y-m-d\TH:i:s+00:00',$dLJTsb_ip3FtL0);
																														}
																														$f = $cu['f']?$cu['f']:$this->B14o0udck['xs_freq'];
																														$D6IQA6CnCMx9RWf = array(
																														'URL'=>$l,
																														'TITLE'=>$t,
																														'DESC'=>($d),
																														'PERIOD'=>$f,
																														'LASTMOD'=>$dLJTsb_ip3FtL0,
																														'ORDER'=>$cu['o'],
																														'PRIORITY'=>$p
																														);
																														if($this->B14o0udck['xs_makemob'])
																														{
																														$this->C5VWcxw36h(array_merge($D6IQA6CnCMx9RWf, array('ismob'=>true)), $eYgPj3ZHK0T12hAy[2], 4);
																														}
																														
																														$this->C5VWcxw36h($D6IQA6CnCMx9RWf, $eYgPj3ZHK0T12hAy[2], 0);
																														
																														
																														if($this->B14o0udck['xs_maketxt'] && $pjWDjZIGXb1f)
																														$this->KsbskAuOsxLPc1sC['fwrite']($pjWDjZIGXb1f, $cu['link']."\n");
																														foreach($sm_proc_list as $duBMhqfH7kGKH)
																														$duBMhqfH7kGKH->gD2gJih5je9Dh($D6IQA6CnCMx9RWf);
																														if($this->B14o0udck['xs_makeror'] && $ee6xJLhs_ZF4V7QG){
																														if($this->B14o0udck['xs_ror_unique']){
																														$t=$D6IQA6CnCMx9RWf['TITLE'];
																														$d=$D6IQA6CnCMx9RWf['DESC'];
																														while($YQ502io_kAuiNyf=$ai[md5('t'.$t)]++){
																														$t=$D6IQA6CnCMx9RWf['TITLE'].' '.$YQ502io_kAuiNyf;
																														}
																														while($YQ502io_kAuiNyf=$ai[md5('d'.$d)]++){
																														$d=$D6IQA6CnCMx9RWf['DESC'].' '.$YQ502io_kAuiNyf;
																														}
																														$D6IQA6CnCMx9RWf['TITLE']=$t;
																														$D6IQA6CnCMx9RWf['DESC']=$d;
																														}
																														fwrite($ee6xJLhs_ZF4V7QG, $this->JXrAUXdkHB6bEow->VGnW7iJnFC33aI7tL0($Qw4OhMRiQXE9Pvp0y22[2],$D6IQA6CnCMx9RWf));
																														}
																														}
																														$this->Gg5AAIeuiYp();
																														if($this->B14o0udck['xs_maketxt'])
																														{
																														$this->KsbskAuOsxLPc1sC['fclose']($pjWDjZIGXb1f);
																														@chmod(RGVnCnecoCvEL7oyPH.$this->GZCFp_txIxdI, 0666);
																														}
																														if($this->B14o0udck['xs_makeror'])
																														{
																														if($ee6xJLhs_ZF4V7QG)
																														fwrite($ee6xJLhs_ZF4V7QG, $Qw4OhMRiQXE9Pvp0y22[3]);
																														fclose($ee6xJLhs_ZF4V7QG);
																														}
																														foreach($sm_proc_list as $duBMhqfH7kGKH)
																														$duBMhqfH7kGKH->IkN8UDC3Sq4();
																														ZBWGkqS6VQ71($q64AQ_T07,Z17BHXaZcFYLa6pQZ(array('done'=>true)));
																														Ka_AEZ56jwB8MHjF(array('cmd'=> 'info','id' => 'percprog',''));
																														}
																														function JiNZdZTQFJ($q2PfaTx_3ig)
																														{
																														for($i=0;file_exists($sf=z_fhGrViQaOeql9.DXwTWcPx8gwRJFL($i,$q2PfaTx_3ig).$this->GZCFp_txIxdI);$i++){
																														unlink($sf);
																														}
																														}
																														function ffpknLH3lruh($q2PfaTx_3ig)
																														{
																														global $qFRPmUDRi;
																														for($i=0;file_exists(z_fhGrViQaOeql9.($sf=DXwTWcPx8gwRJFL($i,$q2PfaTx_3ig).$this->GZCFp_txIxdI));$i++){
																														if(!copy(z_fhGrViQaOeql9.$sf,$this->furl_p.$sf))
																														{
																														if($cn = @fopen($this->furl_p.$sf, 'w')){
																														@fwrite($cn, file_get_contents(z_fhGrViQaOeql9.$sf));
																														@fclose($cn);
																														}else
																														if(file_exists(z_fhGrViQaOeql9.$sf))
																														{
																														$qFRPmUDRi[]=$this->furl_p.$sf;
																														}
																														}
																														
																														@chmod(z_fhGrViQaOeql9.$sf, 0666);
																														}
																														}
																														function gZnBm63TnG1($q2PfaTx_3ig, $oL4Wd5vimhWp8DF0q = 0)
																														{
																														$cn = '';
																														for($i=0;file_exists($sf=z_fhGrViQaOeql9.DXwTWcPx8gwRJFL($i,$q2PfaTx_3ig).$this->GZCFp_txIxdI);$i++)
																														{
																														
																														$cn .= $this->GZCFp_txIxdI?implode('',gzfile($sf)):hoxrmfFginIYPn($sf);
																														if($i>200)break;
																														}
																														preg_match_all('#<loc>(.*?)</loc>'.($oL4Wd5vimhWp8DF0q ? '.*?<news:publication_date>(.*?)</news:publication_date>' : '').'#is',$cn,$um);
																														if($oL4Wd5vimhWp8DF0q)
																														{
																														$al = array();
																														foreach($um[1] as $i=>$l)
																														{
																														if(time()-strtotime($um[2][$i])<=$oL4Wd5vimhWp8DF0q*24*3600)
																														$al[$l] = $um[2][$i];
																														}
																														return $al;
																														}
																														return $um[1];
																														}
																														}
																														$q0PNLQD52dm6SKSyg = new XMLCreator();
																														



































































































