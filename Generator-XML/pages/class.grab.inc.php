<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$vCjna49147034LmUHW=116576446;$UZGrp75305481tRUfQ=831315094;$FeOrr52069397Uwhqq=389008819;$KUXXd38501282ZHawr=194501373;$LjwvP48663635Zpoel=154136505;$nrttn51618957ipnlb=673757965;$aJYGb61429749LlTia=660709503;$uvUXX47158508yyheV=520834869;$eFIaY22867736zsGEK=160477813;$CMJRA47619934eHVDJ=984482087;$qOcvc45477600iSqQW=901191437;$yNPaT75503235lvHGi=316449615;$mRuhu61759338jBmgr=135600372;$BUKQs63308411FdMoz=764487458;$HGerM94212952CVQtR=111454620;$Llyfa33535461yKAkL=580345612;$eEvuj75338440vedlg=79504180;$TNrVC98684388xSUka=13774078;$YuWOi27635803wQuXb=289499054;$ZoALj11255188ZNExT=313522857;$PHTBB63605042NYlzd=991189240;$FeJST63747864SsZMO=730341950;$WLAjX25746154mRDCo=436324737;$IANRl98662415mlSgS=514981354;$cpTHh26559143AIlJk=872655548;$USGps48498840yFLms=916191071;$RnwGj88544007frUiK=551931671;$qhcCh25757141BxKZc=185721100;$jDvWi54200745tufsB=722903107;$waiql52937317jkuLs=571321442;$Pnegp36029358brQYu=636319855;$NzlKc62539368jElla=324742096;$iPuhI56529846IymoW=541931915;$wTAdi77063294lUiUL=694733063;$XLCHK48202209VQmgz=689489289;$QlsqO29009094zPhjU=932044342;$oHONK33546448RWHpB=329741974;$IWCrp30876770wMHgx=287425934;$liYlA35062561GvRon=711439972;$OHDHM15166320zGCqj=9627838;$grwOx75250550Dvubk=86333282;$Spffs94377747PdNIv=348400055;$YFoYT86610413BDKgc=702171906;$xeUNv21011047lApnl=554492584;$nThfO91642151vDYCs=810705841;$YReqR87566224pUGJD=877655426;$yPEMX22845764mPMYl=661685089;$KeFOB46543274ZXwPQ=568638580;$HddCW82721253zOoYg=504859650;$MPupZ10442199WXoEE=876192047;?><?php class SiteCrawler { function moLbvHVqFXK8OJ(&$a, $i64_RzaxP7PMd7s, $mB38DEhdYf, $ka0IRxjBCkwNLQf, $sAg5YsdwOc) { global $grab_parameters; $MWesmarOm = parse_url($sAg5YsdwOc); if($MWesmarOm['scheme'] && substr($a, 0, 2) == '//') 
																										 $a = $MWesmarOm['scheme'].':'.$a; $a = str_replace(':80/', '/', $a); if($a[0]=='?')$a = preg_replace('#^([^\?]*?)([^/\?]*?)(\?.*)?$#','$2',$i64_RzaxP7PMd7s).$a; if($grab_parameters['xs_inc_ajax'] && ($a[0] == '#')){ $a = preg_replace('#\#.*$#', '', $i64_RzaxP7PMd7s).$a; } if(preg_match('#^https?(:|&\#58;)#is',$a)); else if($a&&$a[0]=='/')$a = $mB38DEhdYf.$a; else $a = $ka0IRxjBCkwNLQf.$a; $a=str_replace('/./','/',$a); if(substr($a,-2) == '..')$a.='/'; if(strstr($a,'../')){ preg_match('#(.*?:.*?//.*?)(/.*)$#',$a,$aa); 
																										 do{ $ap = $aa[2]; $aa[2] = preg_replace('#/?[^/]*/\.\.#','',$ap,1); }while($aa[2]!=$ap); $a = $aa[1].$aa[2]; } $a = preg_replace('#/\./#','/',$a); $a = str_replace('&#38;','&',$a); $a = str_replace('&amp;','&',$a); $a = preg_replace('#\#'.($grab_parameters['xs_inc_ajax']?'[^\!]':'').'.*$#','',$a); $a = preg_replace('#^([^\?]*[^/\:]/)/+#','\\1',$a); $a = preg_replace('#[\r\n]+#s','',$a); $CZRJ7mEGdpy0R = (strtolower(substr($a,0,strlen($sAg5YsdwOc)) ) != strtolower($sAg5YsdwOc)); if($_GET['ddbg2'])echo "($a)<br>\n";//exit; 
																										 return $CZRJ7mEGdpy0R; } function BDURPicA56HxjrUUp($B14o0udck,&$urls_completed) { global $grab_parameters,$PqrWr4MLtujWK1b_W; error_reporting(E_ALL&~E_NOTICE); @set_time_limit($grab_parameters['xs_exec_time']); if($B14o0udck['bgexec']) { ignore_user_abort(true); } register_shutdown_function('AfTRVXncZI6Bitp'); if(function_exists('ini_set')) { @ini_set("zlib.output_compression", 0); @ini_set("output_buffering", 0); } $mKNc3ZuibHw8 = explode(" ",microtime()); $bZ3jbCz403O1HU = $mKNc3ZuibHw8[0]+$mKNc3ZuibHw8[1]; $starttime = time(); $HT7yKXImq = $nettime = 0; $inOnsdwxENV3KRYY = $B14o0udck['initurl']; $d9a1XR4MDwhKF3F = $B14o0udck['maxpg']>0 ? $B14o0udck['maxpg'] : 1E10; $euDeOOfWG = $B14o0udck['maxdepth'] ? $B14o0udck['maxdepth'] : -1; $Wv2SmnmzlB = $B14o0udck['progress_callback']; $gk7xyukmlMb = preg_replace("#\s*[\r\n]+\s*#",'|', (strstr($s=trim($grab_parameters['xs_excl_urls']),'*')?$s:preg_quote($s,'#'))); $hSaCvxHsKMVb0F = preg_replace("#\s*[\r\n]+\s*#",'|', (strstr($s=trim($grab_parameters['xs_incl_urls']),'*')?$s:preg_quote($s,'#'))); $mWaGjhtsk5qfq6cQTZJ = $mO8dP_vKE = array(); $LzzEy5A_btN = preg_split('#[\r\n]+#', $grab_parameters['xs_ind_attr']); $YQuOYEF3pgh7zsh = '#200'.($grab_parameters['xs_allow_httpcode']?'|'.$grab_parameters['xs_allow_httpcode']:'').'#'; if($grab_parameters['xs_memsave']) { if(!file_exists(e6p6oz8D73L8)) mkdir(e6p6oz8D73L8, 0777); else if($B14o0udck['resume']=='') fbWEyZNrRSnYdpJt(e6p6oz8D73L8, '.txt'); } foreach($LzzEy5A_btN as $ia) if($ia) { $is = explode(',', $ia); if($is[0][0]=='$') $UFH0cYalshj8ilZw = substr($is[0], 1); else $UFH0cYalshj8ilZw = str_replace('\\$','$',preg_quote($is[0],'#')); $mO8dP_vKE[] = $UFH0cYalshj8ilZw; $mWaGjhtsk5qfq6cQTZJ[str_replace('$','',$is[0])]=array('lm'=>$is[1], 'f'=>$is[2], 'p'=>$is[3]); } if($mO8dP_vKE) $awjs5cXHLQKLCojjfKj = implode('|',$mO8dP_vKE); $Ve5h8i9QJ3ta = parse_url($inOnsdwxENV3KRYY); if(!$Ve5h8i9QJ3ta['path']){$inOnsdwxENV3KRYY.='/';$Ve5h8i9QJ3ta = parse_url($inOnsdwxENV3KRYY);} $NrUnGhCWocSUEo = $PqrWr4MLtujWK1b_W->fetch($inOnsdwxENV3KRYY,0,true);// the first request is to skip session id 
																										 $gTrlEaHME = !preg_match($YQuOYEF3pgh7zsh,$NrUnGhCWocSUEo['code']); if($gTrlEaHME) { $gTrlEaHME = ''; foreach($NrUnGhCWocSUEo['headers'] as $k=>$v) $gTrlEaHME .= $k.': '.$v.'<br />'; return array( 'errmsg'=>'<b>There was an error while retrieving the URL specified:</b> '.$inOnsdwxENV3KRYY.''. ($NrUnGhCWocSUEo['errormsg']?'<br><b>Error message:</b> '.$NrUnGhCWocSUEo['errormsg']:''). '<br><b>HTTP headers follow:</b><br>'.$gTrlEaHME. '<br><b>HTTP output:</b><br>'.$NrUnGhCWocSUEo['content'] , ); } $inOnsdwxENV3KRYY = $NrUnGhCWocSUEo['last_url']; $urls_completed = array(); $urls_ext = array(); $urls_404 = array(); $mB38DEhdYf = $Ve5h8i9QJ3ta['scheme'].'://'.$Ve5h8i9QJ3ta['host'].((!$Ve5h8i9QJ3ta['port'] || ($Ve5h8i9QJ3ta['port']=='80'))?'':(':'.$Ve5h8i9QJ3ta['port'])); 
																										 $pn = $tsize = $retrno = 0; $sAg5YsdwOc = preg_replace('#^([^/\:]*?(?:\://)?[^\:/]*?/)/+#','\\1',$mB38DEhdYf.'/'.MTvi5BisLl($Ve5h8i9QJ3ta['path'])); $aJAUx_d6Kz = preg_replace('#^.+://[^/]+#', '', $sAg5YsdwOc); 
																										 $wbHEDNyTv6j = $PqrWr4MLtujWK1b_W->fetch($inOnsdwxENV3KRYY,0,true,true); $u3Aj3kpP8f7NX = str_replace($sAg5YsdwOc,'',$inOnsdwxENV3KRYY); $urls_list_full = array($u3Aj3kpP8f7NX); if(!$u3Aj3kpP8f7NX)$u3Aj3kpP8f7NX='/'; $urls_list = array($u3Aj3kpP8f7NX); $urls_list2 = $urls_list_skipped = array(); $WKLxFNU9Afmx3X = array(); $links_level = 0; $KRr98TLai1Fm69wjk = $ref_links = $ref_links2 = array(); $LgLI0zBLaiF = 0; $X586Srhrb7zbBwwaEu = $d9a1XR4MDwhKF3F; if(!$grab_parameters['xs_progupdate'])$grab_parameters['xs_progupdate'] = 20; if(isset($grab_parameters['xs_robotstxt']) && $grab_parameters['xs_robotstxt']) { $ygddcsZcedjzZC = $PqrWr4MLtujWK1b_W->fetch($mB38DEhdYf.'/robots.txt'); if($mB38DEhdYf.'/' != $sAg5YsdwOc) { $V15cq9dPNt8iS8 = "\n".$PqrWr4MLtujWK1b_W->fetch($sAg5YsdwOc.'robots.txt'); $ygddcsZcedjzZC['content']  .= "\n".$V15cq9dPNt8iS8['content']; } $ra=preg_split('#user-agent:\s*#im',$ygddcsZcedjzZC['content']); $lnnGg7ZbD9_Q4X6=array(); for($i=1;$i<count($ra);$i++){ preg_match('#^(\S+)(.*)$#s',$ra[$i],$UVtSAwQYOsEzzCeKfY); if($UVtSAwQYOsEzzCeKfY[1]=='*'||strstr($UVtSAwQYOsEzzCeKfY[1],'google')){ preg_match_all('#^disallow:[^\r\n\S](\S*)#im',$UVtSAwQYOsEzzCeKfY[2],$rm); for($pi=0;$pi<count($rm[1]);$pi++) if($rm[1][$pi]) $lnnGg7ZbD9_Q4X6[] =  str_replace('\\$','$', str_replace('\\*','.*', preg_quote($rm[1][$pi],'#') )); } } for($i=0;$i<count($lnnGg7ZbD9_Q4X6);$i+=200) $XQa0UewN3f[]=implode('|', array_slice($lnnGg7ZbD9_Q4X6, $i,200)); }else $XQa0UewN3f = array(); if($grab_parameters['xs_inc_ajax']) $grab_parameters['xs_proto_skip'] = str_replace( '\#', '\#[^\!]', $grab_parameters['xs_proto_skip']); $SgSv9EHvXQ8D = $grab_parameters['xs_exc_skip']!='\\.()'; $G2z7RcI6R969uBUdPAI = $grab_parameters['xs_inc_skip']!='\\.()'; $grab_parameters['xs_inc_skip'] .= '$'; $grab_parameters['xs_exc_skip'] .= '$'; if($grab_parameters['xs_debug']) $_GET['ddbg']=1; $tqAifGeogXJRviudvJ1 = 0; $url_ind = 0; $cnu = 1; $pf = fopen(z_fhGrViQaOeql9.bjmS1HQhkPEjp1QMl,'w');fclose($pf); if($B14o0udck['resume']!=''){ $T_IVB6tYAThxWS = @J288sfitpupJnEcw3(hoxrmfFginIYPn(z_fhGrViQaOeql9.PMVKiWGsLbTpXo0qagQ)); if($T_IVB6tYAThxWS) { echo 'Resuming the last session (last updated: '.date('Y-m-d H:i:s',$T_IVB6tYAThxWS['time']).')'."\n"; extract($T_IVB6tYAThxWS); $bZ3jbCz403O1HU-=$ctime; $tqAifGeogXJRviudvJ1 = $ctime; unset($T_IVB6tYAThxWS); } } sleep(1); @unlink(z_fhGrViQaOeql9.bjmS1HQhkPEjp1QMl); if($urls_list) do { $i64_RzaxP7PMd7s = $urls_list[$url_ind++]; unset($urls_list[$url_ind-1]);   $TNm6SblxP = GHJEfA2QYqwa($i64_RzaxP7PMd7s); $EYyBXYy9WWbLGYL5iQ = false; $NrUnGhCWocSUEo = array(); $cn = ''; if(isset($WKLxFNU9Afmx3X[$i64_RzaxP7PMd7s])) $i64_RzaxP7PMd7s=$WKLxFNU9Afmx3X[$i64_RzaxP7PMd7s]; $f = $SgSv9EHvXQ8D && preg_match('#'.$grab_parameters['xs_exc_skip'].'#i',$i64_RzaxP7PMd7s); if($gk7xyukmlMb&&!$f)$f=$f||preg_match('#('.$gk7xyukmlMb.')#',$i64_RzaxP7PMd7s); if($XQa0UewN3f&&!$f) foreach($XQa0UewN3f as $bm) { $f = $f||preg_match('#^('.$bm.')#',$aJAUx_d6Kz.$i64_RzaxP7PMd7s); } $f2 = false; if(!$f) { $f2 = $G2z7RcI6R969uBUdPAI && preg_match('#'.$grab_parameters['xs_inc_skip'].'#i',$i64_RzaxP7PMd7s); if($hSaCvxHsKMVb0F&&!$f2) $f2 = $f2||(preg_match('#('.$hSaCvxHsKMVb0F.')#',$i64_RzaxP7PMd7s)); if($grab_parameters['xs_parse_only'] && !$f2 && $i64_RzaxP7PMd7s!='/') { $f2 = $f2 || !preg_match('#'.str_replace(' ', '|', preg_quote($grab_parameters['xs_parse_only'],'#')).'#',$i64_RzaxP7PMd7s); } } do{ if(!$f && !$f2)// && ($X586Srhrb7zbBwwaEu*1.2>(count($urls_list)+count($urls_completed)-$url_ind))) 
																										 { if($euDeOOfWG<=0 || $links_level<$euDeOOfWG) { $WtUMZDMaR6ayGRcIX = preg_replace('#^([^/\:]*?(?:\://)?[^\:/]*?/)/+#','\\1',$sAg5YsdwOc.$i64_RzaxP7PMd7s); if($_GET['ddbg'])echo "<h4> { $WtUMZDMaR6ayGRcIX } </h4>";flush(); $cDdos7BIlJ=0; $GjJcq8T1P9=array_sum(explode(' ', microtime())); do { $NrUnGhCWocSUEo = $PqrWr4MLtujWK1b_W->fetch($WtUMZDMaR6ayGRcIX, 0, 1); if($NrUnGhCWocSUEo['code']==403) { $cDdos7BIlJ++; sleep($grab_parameters['xs_delay_ms']?$grab_parameters['xs_delay_ms']:1); } else $cDdos7BIlJ=5; }while($cDdos7BIlJ<3); $nettime+=array_sum(explode(' ', microtime()))-$GjJcq8T1P9; if($_GET['ddbg']){echo "<hr> [[[ ".$NrUnGhCWocSUEo['code']." ]]] ";print_r($NrUnGhCWocSUEo['headers']);flush();} $rxvoXLx7w1k = is_array($NrUnGhCWocSUEo['headers']) ? strtolower($NrUnGhCWocSUEo['headers']['content-type']) : ''; if($rxvoXLx7w1k && !strstr($rxvoXLx7w1k,'text/html') && !strstr($rxvoXLx7w1k,'/xhtml') && (!$grab_parameters['xs_parse_swf'] || !strstr($rxvoXLx7w1k, 'shockwave-flash')) ) continue; $CHHojaW_931nk6i5Tlw = array(); if($NrUnGhCWocSUEo['code']==404){ $urls_404[]=array($i64_RzaxP7PMd7s,$ref_links2[$i64_RzaxP7PMd7s]); } if($YQuOYEF3pgh7zsh && !preg_match($YQuOYEF3pgh7zsh,$NrUnGhCWocSUEo['code'])) continue; $cn = $NrUnGhCWocSUEo['content']; $tsize+=strlen($cn); $retrno++; if($Il2qN32A6EeND = preg_replace('#<!--(\[if IE\]>|.*?-->)#is', '',$cn)) $cn = $Il2qN32A6EeND; if($grab_parameters['xs_canonical']) if(($WtUMZDMaR6ayGRcIX == $NrUnGhCWocSUEo['last_url']) && preg_match('#<link[^>]*rel="canonical"[^>]href="([^>]*?)"#', $cn, $hPqMY1ez6oMQQl)) $NrUnGhCWocSUEo['last_url'] = $hPqMY1ez6oMQQl[1]; $yiI3GJqLr5Z = preg_replace('#^.*?'.preg_quote($sAg5YsdwOc,'#').'#','',$NrUnGhCWocSUEo['last_url']); if(($WtUMZDMaR6ayGRcIX != $NrUnGhCWocSUEo['last_url']) && ($WtUMZDMaR6ayGRcIX != $NrUnGhCWocSUEo['last_url'].'/')) { $WKLxFNU9Afmx3X[$i64_RzaxP7PMd7s]=$NrUnGhCWocSUEo['last_url']; $io=$i64_RzaxP7PMd7s; $urls_list2[] = $yiI3GJqLr5Z; if(count($ref_links[$yiI3GJqLr5Z])<max(1,intval($grab_parameters['xs_maxref']))) $ref_links[$yiI3GJqLr5Z][] = $i64_RzaxP7PMd7s; continue; } preg_match('#<base[^>]*?href=[\'"](.*?)[\'"]#is',$cn,$bm); if(isset($bm[1])&&$bm[1]) $ka0IRxjBCkwNLQf = MTvi5BisLl($bm[1].(preg_match('#//.*/#',$bm[1])?'-':'/-')); 
																										 else $ka0IRxjBCkwNLQf = MTvi5BisLl($sAg5YsdwOc.$i64_RzaxP7PMd7s); if(strstr($rxvoXLx7w1k, 'shockwave-flash')) { include_once KH6aKAnNWiCYJWvf.'class.pfile.inc.php'; $am = new SWFParser(); $am->HZpRje35mVkO0jMR($cn); $vNqieogz40S1ja = $am->zyhF94FNJ(); }else { $tHSKS4COUobk6O = $grab_parameters['xs_utf8_enc'] ? 'isu':'is'; preg_match_all('#<(?:a|area|go)\s(?:[^>]*?\s)?href\s*=\s*(?:"([^"]*)|\'([^\']*)|([^\s\">]+)).*?>#'.$tHSKS4COUobk6O, $cn, $am);
																										
																										preg_match_all('#<i?frame\s(?:[^>]*?\s)?src\s*=\s*["\']?(.*?)("|>|\'[>\s])#'.$tHSKS4COUobk6O, $cn, $AQEJpzp83PVPuONNJ);
																										
																										preg_match_all('#<meta\s[^>]*http-equiv\s*=\s*"?refresh[^>]*URL\s*=\s*["\']?(.*?)("|>|\'[>\s])#'.$tHSKS4COUobk6O, $cn, $IcPgk0YCJ);
																										
																										if($grab_parameters['xs_parse_swf'])
																										
																										preg_match_all('#<object[^>]*application/x-shockwave-flash[^>]*data\s*=\s*["\']([^"\'>]+).*?>#'.$tHSKS4COUobk6O, $cn, $vNqieogz40S1ja);
																										
																										else $vNqieogz40S1ja = array(array(),array());
																										
																										
																										$CHHojaW_931nk6i5Tlw = array();
																										
																										for($i=0;$i<count($am[1]);$i++)
																										
																										{
																										
																										if( !preg_match('#rel=["\']nofollow#i', $am[0][$i]) ) 
																										
																										$CHHojaW_931nk6i5Tlw[] = $am[1][$i];
																										
																										}
																										
																										$CHHojaW_931nk6i5Tlw = @array_merge(
																										
																										$CHHojaW_931nk6i5Tlw,
																										
																										
																										$am[2],$am[3],  
																										
																										$AQEJpzp83PVPuONNJ[1],$IcPgk0YCJ[1],
																										
																										$vNqieogz40S1ja[1]);
																										
																										}
																										
																										$CHHojaW_931nk6i5Tlw = array_unique($CHHojaW_931nk6i5Tlw);
																										
																										
																										
																										$nn = $nt = 0;
																										
																										reset($CHHojaW_931nk6i5Tlw);
																										
																										if(preg_match('#<meta name="robots" content="[^"]*?nofollow#is',$cn))
																										
																										$CHHojaW_931nk6i5Tlw = array();
																										
																										foreach($CHHojaW_931nk6i5Tlw as $i=>$ll)
																										
																										if($ll)
																										
																										{                    
																										
																										$a = $sa = trim($ll);
																										
																										
																										if($grab_parameters['xs_proto_skip'] && 
																										
																										(preg_match('#^'.$grab_parameters['xs_proto_skip'].'#i',$a)||
																										
																										($SgSv9EHvXQ8D && preg_match('#'.$grab_parameters['xs_exc_skip'].'#i',$a))||
																										
																										preg_match('#^'.$grab_parameters['xs_proto_skip'].'#i',function_exists('html_entity_decode')?html_entity_decode($a):$a)
																										
																										))
																										
																										continue;
																										
																										if($grab_parameters['xs_exclude_check'])
																										
																										{
																										
																										$_f=$_f2=false;
																										
																										$_f=$gk7xyukmlMb&&preg_match('#('.$gk7xyukmlMb.')#',$a);
																										
																										if($XQa0UewN3f&&!$_f)
																										
																										foreach($XQa0UewN3f as $bm)
																										
																										$_f = $_f||preg_match('#^('.$bm.')#',$aJAUx_d6Kz.$i64_RzaxP7PMd7s);
																										
																										if($_f)continue;
																										
																										}
																										
																										$CZRJ7mEGdpy0R = $this->moLbvHVqFXK8OJ($a, $i64_RzaxP7PMd7s, $mB38DEhdYf, $ka0IRxjBCkwNLQf, $sAg5YsdwOc);
																										
																										$yiI3GJqLr5Z = substr($a,strlen($sAg5YsdwOc));
																										
																										$yiI3GJqLr5Z = str_replace(' ', '%20', $yiI3GJqLr5Z);
																										
																										if($grab_parameters['xs_cleanurls'])
																										
																										$yiI3GJqLr5Z = @preg_replace($grab_parameters['xs_cleanurls'],'',$yiI3GJqLr5Z);
																										
																										if($grab_parameters['xs_cleanpar'])
																										
																										{
																										
																										$yiI3GJqLr5Z = @preg_replace('#[\\?\\&]('.$grab_parameters['xs_cleanpar'].')=[a-z0-9\-\_]+$#i','',$yiI3GJqLr5Z);
																										
																										$yiI3GJqLr5Z = @preg_replace('#([\\?\\&])('.$grab_parameters['xs_cleanpar'].')=[a-z0-9\-\_]+&#i','$1',$yiI3GJqLr5Z);
																										
																										}
																										
																										if($CZRJ7mEGdpy0R)
																										
																										{
																										
																										if($grab_parameters['xs_extlinks'] && !$urls_ext[$a])
																										
																										$urls_ext[$a] = $WtUMZDMaR6ayGRcIX;
																										
																										continue;
																										
																										}
																										
																										if($_GET['ddbg3'])echo "<u>[$a]</u><br>\n";//exit;
																										
																										$urls_list2[] = $yiI3GJqLr5Z;
																										
																										if($grab_parameters['xs_maxref'] && count($ref_links[$yiI3GJqLr5Z])<$grab_parameters['xs_maxref'])
																										
																										$ref_links[$yiI3GJqLr5Z][] = $i64_RzaxP7PMd7s;
																										
																										$nt++;
																										
																										}
																										
																										unset($CHHojaW_931nk6i5Tlw);
																										
																										}
																										
																										}                                        
																										
																										
																										
																										if($grab_parameters['xs_incl_only'] && !$f)
																										
																										$f = $f || !preg_match('#'.str_replace(' ', '|', preg_quote($grab_parameters['xs_incl_only'],'#')).'#',$sAg5YsdwOc.$i64_RzaxP7PMd7s);
																										
																										if(!$f) $f = $f||preg_match('#<meta name="robots" content="[^"]*?noindex#is',$cn);
																										
																										if(!$f)
																										
																										{
																										
																										$YQ502io_kAuiNyf = array(
																										
																										
																										'link'=>preg_replace('#//+$#','/', preg_replace('#^([^/\:\?]/)/+#','\\1',$sAg5YsdwOc.$i64_RzaxP7PMd7s))
																										
																										);
																										
																										if($grab_parameters['xs_makehtml'])
																										
																										{
																										
																										preg_match('#<title>(.*?)</title>#is', $NrUnGhCWocSUEo['content'], $p3RMgGPJdKj);
																										
																										$YQ502io_kAuiNyf['t'] = strip_tags($p3RMgGPJdKj[1]);
																										
																										}
																										
																										if($grab_parameters['xs_metadesc'])
																										
																										{
																										
																										preg_match('#<meta\s[^>]*(?:http-equiv|name)\s*=\s*"?description[^>]*content\s*=\s*["]?([^>\"]*)#is', $cn, $x3MLsIREpgasGm);
																										
																										if($x3MLsIREpgasGm[1])
																										
																										$YQ502io_kAuiNyf['d'] = $x3MLsIREpgasGm[1];
																										
																										}
																										
																										if($grab_parameters['xs_makeror']||$grab_parameters['xs_autopriority'])
																										
																										$YQ502io_kAuiNyf['o'] = max(0,$links_level);
																										
																										if(preg_match('#('.$awjs5cXHLQKLCojjfKj.')#',$sAg5YsdwOc.$i64_RzaxP7PMd7s,$GYOAxf_ifFR12047x4j))
																										
																										{
																										
																										$YQ502io_kAuiNyf['clm'] = $mWaGjhtsk5qfq6cQTZJ[$GYOAxf_ifFR12047x4j[1]]['lm'];
																										
																										$YQ502io_kAuiNyf['f'] = $mWaGjhtsk5qfq6cQTZJ[$GYOAxf_ifFR12047x4j[1]]['f'];
																										
																										$YQ502io_kAuiNyf['p'] = $mWaGjhtsk5qfq6cQTZJ[$GYOAxf_ifFR12047x4j[1]]['p'];
																										
																										}
																										
																										
																										
																										
																										
																										if($grab_parameters['xs_lastmod_notparsed'] && $f2)
																										
																										{
																										
																										$NrUnGhCWocSUEo = $PqrWr4MLtujWK1b_W->fetch($WtUMZDMaR6ayGRcIX, 0, 1, false, "", array('req'=>'HEAD'));
																										
																										
																										}
																										
																										if(!$YQ502io_kAuiNyf['lm'] && isset($NrUnGhCWocSUEo['headers']['last-modified']))
																										
																										$YQ502io_kAuiNyf['lm']=$NrUnGhCWocSUEo['headers']['last-modified'];
																										
																										if($_GET['ddbg'])echo "((include ".$YQ502io_kAuiNyf['link']."))<br />";flush();
																										
																										$EYyBXYy9WWbLGYL5iQ = true;
																										
																										if($grab_parameters['xs_memsave'])
																										
																										{
																										
																										dxY5KOhQceAuFRoi($TNm6SblxP, $YQ502io_kAuiNyf);
																										
																										$urls_completed[] = $TNm6SblxP;
																										
																										}else
																										
																										$urls_completed[] = $YQ502io_kAuiNyf;
																										
																										$X586Srhrb7zbBwwaEu = $d9a1XR4MDwhKF3F - count($urls_completed);
																										
																										}
																										
																										}while(false);// zerowhile
																										
																										if($url_ind>=$cnu)
																										
																										{
																										
																										unset($urls_list);
																										
																										$url_ind = 0;
																										
																										$urls_list = array_values(array_unique(array_diff($urls_list2,$urls_list_full)));
																										
																										$urls_list_full = array_merge($urls_list_full,$urls_list);
																										
																										$cnu = count($urls_list);
																										
																										unset($ref_links2);
																										
																										$ref_links2 = $ref_links;
																										
																										unset($ref_links); unset($urls_list2);
																										
																										$ref_links = array();
																										
																										$urls_list2 = array();
																										
																										$links_level++;
																										
																										}
																										
																										if(!$EYyBXYy9WWbLGYL5iQ)//&& $grab_parameters['xs_chlog'])
																										
																										$urls_list_skipped[]=$i64_RzaxP7PMd7s;
																										
																										$pn++;
																										
																										$mKNc3ZuibHw8=explode(" ",microtime());
																										
																										$ctime = $mKNc3ZuibHw8[0]+$mKNc3ZuibHw8[1] - $bZ3jbCz403O1HU;
																										
																										$pl=min($cnu-$url_ind,$X586Srhrb7zbBwwaEu);
																										
																										if( ($cnu==$url_ind || $pl==0||$pn==1 || ($pn%$grab_parameters['xs_progupdate'])==0)
																										
																										|| count($urls_completed)>=$d9a1XR4MDwhKF3F)
																										
																										{
																										
																										if(strstr($wbHEDNyTv6j['content'],'header'))break;
																										
																										$mu = function_exists('memory_get_usage') ? memory_get_usage() : '-';
																										
																										$HT7yKXImq = max($HT7yKXImq, $mu);
																										
																										if(intval($mu))
																										
																										$mu = number_format($mu/1024,1).' Kb';
																										
																										if($_GET['ddbg'])echo "(memory: $mu)<br>\n";//exit;
																										
																										$urls_list2 = array_values(array_unique($urls_list2));
																										
																										$ZdD16fdro7T29 = array(
																										
																										$ctime, // running time
																										
																										str_replace($inOnsdwxENV3KRYY, '', $i64_RzaxP7PMd7s),  // current URL
																										
																										$pl,                    // urls left
																										
																										$pn,                    // processed urls
																										
																										$tsize,                 // bandwidth usage
																										
																										$links_level,           // depth level
																										
																										$mu,                    // memory usage
																										
																										count($urls_completed), // added in sitemap
																										
																										count($urls_list2),     // in the queue
																										
																										);
																										
																										if($B14o0udck['bgexec'])
																										
																										ZBWGkqS6VQ71(A4sNJQoe6O47I_YC4,Z17BHXaZcFYLa6pQZ($ZdD16fdro7T29));
																										
																										if($Wv2SmnmzlB && !$f)
																										
																										$Wv2SmnmzlB($ZdD16fdro7T29);
																										
																										
																										}else
																										
																										{
																										
																										$Wv2SmnmzlB(array('cmd'=>'ping', 'bg' => $B14o0udck['bgexec']));
																										
																										}
																										
																										if($grab_parameters['xs_savestate_time']>0 &&
																										
																										( 
																										
																										($ctime-$tqAifGeogXJRviudvJ1>$grab_parameters['xs_savestate_time'])
																										
																										|| ($url_ind>=$cnu)
																										
																										)
																										
																										)
																										
																										{
																										
																										$tqAifGeogXJRviudvJ1 = $ctime;
																										
																										if($_GET['ddbg'])echo "(saving dump)<br />\n";flush();
																										
																										$T_IVB6tYAThxWS = compact('url_ind',
																										
																										'urls_list','urls_list2','cnu',
																										
																										'ref_links','ref_links2',
																										
																										'urls_list_full','urls_completed',
																										
																										'urls_404',
																										
																										'nt','tsize','pn','links_level','ctime', 'urls_ext',
																										
																										'starttime', 'retrno', 'nettime', 'urls_list_skipped',
																										
																										'imlist'
																										
																										);
																										
																										$T_IVB6tYAThxWS['time']=time();
																										
																										$Xfcs5RdKZjSaEqvTYT=Z17BHXaZcFYLa6pQZ($T_IVB6tYAThxWS);
																										
																										ZBWGkqS6VQ71(PMVKiWGsLbTpXo0qagQ,$Xfcs5RdKZjSaEqvTYT);
																										
																										unset($T_IVB6tYAThxWS);
																										
																										unset($Xfcs5RdKZjSaEqvTYT);
																										
																										}
																										
																										if($grab_parameters['xs_delay_req'] && $grab_parameters['xs_delay_ms'] &&
																										
																										(($pn%$grab_parameters['xs_delay_req'])==0))
																										
																										{
																										
																										sleep($grab_parameters['xs_delay_ms']);
																										
																										}
																										
																										if($aCerQRayOa7vjcFtDKJ=file_exists($IVvqfIlb3rHfBU9=z_fhGrViQaOeql9.bjmS1HQhkPEjp1QMl)){
																										
																										if(@unlink($IVvqfIlb3rHfBU9))
																										
																										break;
																										
																										else
																										
																										$aCerQRayOa7vjcFtDKJ=0;
																										
																										}
																										
																										}while(
																										
																										count($urls_completed)<$d9a1XR4MDwhKF3F
																										
																										&&
																										
																										$url_ind<$cnu
																										
																										);
																										
																										if($_GET['ddbgexit'])exit;
																										
																										return array(
																										
																										'u404'=>$urls_404,
																										
																										'starttime'=>$starttime,
																										
																										'topmu' => $HT7yKXImq,
																										
																										'ctime'=>$ctime,
																										
																										'tsize'=>$tsize,
																										
																										'retrno' => $retrno,
																										
																										'nettime' => $nettime,
																										
																										'errmsg'=>'',
																										
																										'initurl'=>$inOnsdwxENV3KRYY,
																										
																										'initdir'=>$sAg5YsdwOc,
																										
																										'ucount'=>count($urls_completed),
																										
																										'crcount'=>$pn,
																										
																										'time'=>time(),
																										
																										'params'=>$B14o0udck,
																										
																										'interrupt'=>$aCerQRayOa7vjcFtDKJ,
																										
																										'urls_ext'=>$urls_ext,
																										
																										'urls_list_skipped' => $urls_list_skipped,
																										
																										'max_reached' => count($urls_completed)>=$d9a1XR4MDwhKF3F
																										
																										);
																										
																										}
																										
																										}
																										
																										$kYhgTL6xjtaMnUKyj = new SiteCrawler();
																										
																										function AfTRVXncZI6Bitp(){
																										
																										@unlink(z_fhGrViQaOeql9.A4sNJQoe6O47I_YC4);
																										
																										}
																										
																										



































































































