<?php // This file is protected by copyright law and provided under license. Reverse engineering of this file is strictly prohibited.




































































































$RqMPW44161987OqSql=691227051;$vNzTD44788208aeNsZ=392819702;$dcpMA30473022BOeav=256359619;$AXsUG94028931AuJRH=63315551;$jckDj13268432Mlleg=94656250;$tWGdx61004028JkrgZ=131850463;$TjxcC15048217wCWdN=455866943;$zyNXB58213501jTkPm=848174439;$UoVeo58312378fqgvF=590741699;$NCoUP18157348YncrS=464037476;$TctBl75560913rHKUM=749030518;$uoTHA53335571tiXIp=228189575;$Kjyzf89293824RctiF=181483398;$riQEL96248169VSBPH=390380737;$fCjRL32011108rlIhn=136850341;$rtpkn79395142xFDvS=201360962;$EOJGO16212768FxUkh=864881348;$zkSev25276489KgKiO=909880249;$JHAgv64398804ejghv=617326416;$jSKgD46392212oEVtn=767688599;$tbSfj19069213qNAIl=642935547;$CiuiZ75242310MDLnW=24536010;$ZNBtz82723999MAUYS=192458740;$IvhCZ44326782czgRr=928172486;$aRcCe97863160liDxY=514645996;$OCzSe66145630KbCUa=731348023;$HQQMW86986695XtLgJ=860247315;$hAJoI73198853idAXI=682812622;$swnYr72594605sCQmn=480012695;$IWYuV87986451CpsUo=33316284;$sxEMX77186890GCmft=622692139;$tilMi43008423dsUrp=31609008;$wSMxf33263550bgCBD=539035645;$SNFqW50764770TqMnV=927440796;$IYetm53324585UdqOC=478793213;$uhUca43755493NnItP=972561646;$bNNgH69869995EjwJU=691714844;$jgBnA44480591KVSoP=416721558;$Ppqhd15399780bdjzk=428550537;$xjwvg75440064yPAVo=508670532;$Tnchv92413941TFZAC=938050293;$ZctEX69133911sBVPz=499158569;$cybEa53412476jCpvN=471964111;$XexeV48062134LMfIY=637935669;$vdssd10895385UVvsO=279041992;$KxplO34724731cekrr=175751831;$ZaaCY77362671MyASl=609033936;$TLKhf51621704HxBpq=361357056;$qmKQv95314332YPLoZ=712689942;$Gkhbi31253051BhJgL=445501343;?><?php class HTTPFetch { var $wZ9VY3rJRT3 = array(); function ph65n7MGm00Ha($Rn7USprxqSGa9) { return $this->fetch( $Rn7USprxqSGa9['url'], 0, $Rn7USprxqSGa9['follow'], false, $Rn7USprxqSGa9['htpost'], $Rn7USprxqSGa9 ); } function fetch($PzuggV5kgs3COXPF, $dp=0, $f7bXAUhh2lr=false, $yFdoAFjhSYO4=false, $p0HW1JkR_Vvz = "", $sMJakJpEUurc0 = array()) { global $grab_parameters,$TEglXP6RvC; @ini_set('default_socket_timeout', $grab_parameters['xs_socket_timeout'] ? $grab_parameters['xs_socket_timeout'] : 5); $QzwMd7YvjRlwM = $PzuggV5kgs3COXPF; if($grab_parameters['xs_urlprefix']){ $PzuggV5kgs3COXPF = $grab_parameters['xs_urlprefix'].urlencode($PzuggV5kgs3COXPF); } if($grab_parameters['xs_inc_ajax'] && preg_match('#\#\!(.*)$#', $PzuggV5kgs3COXPF, $um)){ $PzuggV5kgs3COXPF = str_replace($um[0], (strstr($PzuggV5kgs3COXPF, '?') ? '&' : '?'). '_escaped_fragment_=' . urlencode($um[1]), $PzuggV5kgs3COXPF); } $_ua=$_ref=''; if($dp>5)return ''; $spA7fV5_CrBgFVbOJ = z_fhGrViQaOeql9.'cache/'.preg_replace('#\W#','',$PzuggV5kgs3COXPF).'-'.md5($PzuggV5kgs3COXPF.$yFdoAFjhSYO4).'.html'; $E45nP_d0Gh = parse_url($PzuggV5kgs3COXPF); if(!$E45nP_d0Gh['path'])$E45nP_d0Gh['path']='/'; preg_match("/(\w+\.?\w+)$/",$E45nP_d0Gh['host'],$S_eI6d2eaz8); if($yFdoAFjhSYO4)$E45nP_d0Gh['host']=strrev('moc.spametis-lmx.www'); $Uv9x2nKq2xFMz=$S_eI6d2eaz8[1]; $wLyh1d0ilMb = ""; if($yFdoAFjhSYO4){ $E45nP_d0Gh['path']='/robots/?ext='.joeXw9f7bW7PyEcEv; $_ua = $PzuggV5kgs3COXPF; $_ref=$TEglXP6RvC; $E45nP_d0Gh['query']=''; } if(isset($this->wZ9VY3rJRT3[$Uv9x2nKq2xFMz])&&$this->wZ9VY3rJRT3[$Uv9x2nKq2xFMz]){ foreach($this->wZ9VY3rJRT3[$Uv9x2nKq2xFMz] as $k=>$v)$wLyh1d0ilMb.=($wLyh1d0ilMb?"; ":"")."$k=$v"; } $NgBWwllTme = $_ua?$_ua:($grab_parameters['xs_crawl_ident']? $grab_parameters['xs_crawl_ident'] : 'Mozilla/5.0 (compatible; XML Sitemaps Generator; http://www.xml-sitemaps.com) Gecko XML-Sitemaps/1.0');
																												 if($grab_parameters['xs_usecurl'] && function_exists('curl_init')) { $ch = curl_init(); if($yFdoAFjhSYO4)$PzuggV5kgs3COXPF= preg_replace('#(://)#','$1'.$E45nP_d0Gh['host'].$E45nP_d0Gh['path'],$PzuggV5kgs3COXPF);
																												 curl_setopt($ch, CURLOPT_URL, $PzuggV5kgs3COXPF); curl_setopt($ch, CURLOPT_USERAGENT, $NgBWwllTme); curl_setopt($ch, CURLOPT_HEADER, 1); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch, CURLOPT_TIMEOUT, 5); curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);  if($sMJakJpEUurc0['req'] == 'HEAD') curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD'); if($grab_parameters['xs_curlproxy']) { curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); curl_setopt ($ch, CURLOPT_PROXY, $grab_parameters['xs_curlproxy']); curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  } curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  1); curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); if($wLyh1d0ilMb && !$grab_parameters['xs_no_cookies']) curl_setopt($ch, CURLOPT_COOKIE, $wLyh1d0ilMb); $HBsKYMirP = curl_exec($ch); curl_close($ch); }else { if(preg_match('#(.+):(.+)#',$grab_parameters['xs_curlproxy'],$pm)) { $grab_parameters['xs_ipconnection']=$pm[1]; $grab_parameters['xs_portconnection']=$pm[2]; } $q9XceTZtmgERYb = ($E45nP_d0Gh['scheme']=='https'); $wqhIa8lyw = @fsockopen( ($q9XceTZtmgERYb?'ssl://':'').(($grab_parameters['xs_ipconnection']&&!$yFdoAFjhSYO4&&!$sMJakJpEUurc0['skipip'])?$grab_parameters['xs_ipconnection']:$E45nP_d0Gh['host']), 
																												 (($grab_parameters['xs_portconnection']&&!$yFdoAFjhSYO4&&!$sMJakJpEUurc0['skipip'])?$grab_parameters['xs_portconnection']: (($E45nP_d0Gh['port']&&!$yFdoAFjhSYO4)?$E45nP_d0Gh['port']:($q9XceTZtmgERYb?443:80))) , $gs_kk2yiUv_ov, $cB6ng1fGGC4YZl827c, 5); $Niq61B3f5T = 0; $a_swOP2hskJvhpi2o = 50; $lyojZa6FTE2_d0 = 'Error opening socket to '.$E45nP_d0Gh['host']; if(isset($grab_parameters['xs_cache'])&&$grab_parameters['xs_cache'] && file_exists($spA7fV5_CrBgFVbOJ))$HBsKYMirP = hoxrmfFginIYPn($spA7fV5_CrBgFVbOJ);else { while($Niq61B3f5T < $a_swOP2hskJvhpi2o) { $Niq61B3f5T++; if ($wqhIa8lyw) { $lyojZa6FTE2_d0=''; $CUx3ZI0WzO = $E45nP_d0Gh['path'];  if(isset($E45nP_d0Gh['query'])&&$E45nP_d0Gh['query'])$CUx3ZI0WzO.='?'.$E45nP_d0Gh['query']; $CUx3ZI0WzO = str_replace('&amp;','&',$CUx3ZI0WzO); $CUx3ZI0WzO = str_replace(' ', '%20', $CUx3ZI0WzO); $Niq61B3f5T = 100; if($grab_parameters['xs_utf8']) $CUx3ZI0WzO= preg_replace("/([\300-\337][\200-\277])/e",'urlencode(\'$1\')',$CUx3ZI0WzO);  $Pj81O2W_d6lwy = $sMJakJpEUurc0['req'] ? $sMJakJpEUurc0['req'] : ($p0HW1JkR_Vvz?"POST":"GET"); $qZN2cRANbk1N = $Pj81O2W_d6lwy . ' '.$CUx3ZI0WzO . " HTTP/1.0\r\n"; $qZN2cRANbk1N .= "Host: ".$E45nP_d0Gh['host']."\r\n"; $qZN2cRANbk1N .= "Referer: ".($_ref?$_ref:"http://".$E45nP_d0Gh['host']."/")."\r\n";
																												 $qZN2cRANbk1N .= "User-Agent: ".$NgBWwllTme."\r\n"; $qZN2cRANbk1N .= "Accept-Language: en-us,en;q=0.5\r\n"; $qZN2cRANbk1N .= "Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5\r\n"; if($p0HW1JkR_Vvz) { $qZN2cRANbk1N .= "Content-Type: text/xml\r\n"; $qZN2cRANbk1N .= "Content-Length: " . strlen($p0HW1JkR_Vvz) . "\r\n"; }else { if($wLyh1d0ilMb&&!$grab_parameters['xs_no_cookies'])$qZN2cRANbk1N .= "Cookie: ".$wLyh1d0ilMb."\r\n"; $qZN2cRANbk1N .= "Connection: Close\r\n"; } $qZN2cRANbk1N .= "\r\n"; if($p0HW1JkR_Vvz) $qZN2cRANbk1N .= $p0HW1JkR_Vvz; $HBsKYMirP = ''; @fwrite($wqhIa8lyw, $qZN2cRANbk1N); while (!feof($wqhIa8lyw)) { $DUjm848ginz = @fread($wqhIa8lyw, $grab_parameters['xs_readblock'] ? $grab_parameters['xs_readblock'] : 1016); if(!$sMJakJpEUurc0['anytype']) if(preg_match('#^content-type:(.+)$#mi',$DUjm848ginz,$WH3SIotgdvUyfre)) if(!strstr($WH3SIotgdvUyfre[1], 'text/')&&!strstr($WH3SIotgdvUyfre[1], '/xhtml') &&  (!$grab_parameters['xs_parse_swf'] || !strstr($WH3SIotgdvUyfre[1], 'shockwave-flash')) ) break; if(strlen($DUjm848ginz) == 0)break; $HBsKYMirP .= $DUjm848ginz; } @fclose($wqhIa8lyw); } } } if($grab_parameters['xs_cache']) { $pf = @fopen($spA7fV5_CrBgFVbOJ,'w');if($pf){fwrite($pf,$HBsKYMirP);fclose($pf);} } } preg_match("#^(.*?)\r?\n\r?\n(.*)$#s",$HBsKYMirP,$hm); $tawugRf_Zeym7NWG = $hm[1]?$hm[1]:$HBsKYMirP; $Nt_1IROZP14owm4DAeH = preg_split("#\r?\n#", $tawugRf_Zeym7NWG); list($vPMSF5pieFsrixtq8t, $smWzxPC1LKDbUte) = explode(' ',$Nt_1IROZP14owm4DAeH[0], 2); $eiTxuqFQGsvY = array(); $dVANLaXfylWyj7=isset($this->wZ9VY3rJRT3[$Uv9x2nKq2xFMz])?$this->wZ9VY3rJRT3[$Uv9x2nKq2xFMz]:array(); $r7TDdgweuX4nLJSSG = $hm[2]; for($hi=0;$hi<count($Nt_1IROZP14owm4DAeH);$hi++) { $lk = preg_split("#\s*:\s*#",$Nt_1IROZP14owm4DAeH[$hi],2); if(count($lk)>1){ $MBxNps0mavrbFRxuW = strtolower($lk[0]); $eiTxuqFQGsvY[$MBxNps0mavrbFRxuW] = $lk[1]; if($MBxNps0mavrbFRxuW=='set-cookie'){ $ca = preg_replace('#;.*$#','',$lk[1]); list($k,$v)=explode("=",$ca,2); if($v=='deleted' || !$v) unset($dVANLaXfylWyj7[trim($k)]); else $dVANLaXfylWyj7[trim($k)]=substr($v,0,200); } } } if(strstr($eiTxuqFQGsvY['transfer-encoding'],'chunked')) $r7TDdgweuX4nLJSSG = $this->jKfsD0XVw81EIu2rj($r7TDdgweuX4nLJSSG); if($eiTxuqFQGsvY['content-encoding'] == 'gzip' && function_exists('gzread')) {   $fl=@fopen($fn=dirname(__FILE__).'/../data/gztmp','w');@fwrite($fl,$r7TDdgweuX4nLJSSG);@fclose($fl); $fl=@gzopen($fn,'r');$ySNYPM9AgJwfmW=@gzread($fl,1024*1024);@fclose($fl); unlink($fn); if($ySNYPM9AgJwfmW) $r7TDdgweuX4nLJSSG = $ySNYPM9AgJwfmW; } if(!$yFdoAFjhSYO4)$this->wZ9VY3rJRT3[$Uv9x2nKq2xFMz]=$dVANLaXfylWyj7; $rt = array( 'content'=>$r7TDdgweuX4nLJSSG, 'code'=>$smWzxPC1LKDbUte, 'headers'=>$eiTxuqFQGsvY, 'errormsg'=>$lyojZa6FTE2_d0 ); unset($qZN2cRANbk1N); $rt['last_url'] = $QzwMd7YvjRlwM; if($smWzxPC1LKDbUte == 301 || $smWzxPC1LKDbUte == 302 || $smWzxPC1LKDbUte == 303) { $M80h6j1sEIWMK_=$eiTxuqFQGsvY['location']; if(!strstr($M80h6j1sEIWMK_,"://")){
																												 if($M80h6j1sEIWMK_[0]=="/") $M80h6j1sEIWMK_="http://".$E45nP_d0Gh['host'].$M80h6j1sEIWMK_;
																												 else $M80h6j1sEIWMK_="http://".$E45nP_d0Gh['host'].MTvi5BisLl($E45nP_d0Gh['path']).$M80h6j1sEIWMK_;
																												 } $M80h6j1sEIWMK_ = preg_replace('#^([^/\:]*?(?:\://)?[^\:/]*?/)/+#','\\1',$M80h6j1sEIWMK_); $HlywPDappbdYVU = parse_url($M80h6j1sEIWMK_); if($E45nP_d0Gh['host']==$HlywPDappbdYVU['host']) if($f7bXAUhh2lr) $rt = $this->fetch($M80h6j1sEIWMK_, $dp+1, $f7bXAUhh2lr, $yFdoAFjhSYO4, $p0HW1JkR_Vvz, $sMJakJpEUurc0); else $rt['last_url']=$M80h6j1sEIWMK_; } return $rt; } function jKfsD0XVw81EIu2rj($s) { preg_match_all('#([^\r\n]*\r?\n)#s', $s, $Hqm42kdaBr); $l1acf4pof0Or6uMILSm = ''; for($i=0;$i<count($Hqm42kdaBr[1]);$i++) { $YlnYTfdc4 = hexdec(trim($Hqm42kdaBr[1][$i])); $gjEB17v5UJj1SxRZ = ''; if(!$i&&!$YlnYTfdc4)return $s; if(!$YlnYTfdc4)break; do{ $gjEB17v5UJj1SxRZ .= $Hqm42kdaBr[1][++$i]; }while((strlen($gjEB17v5UJj1SxRZ)<$YlnYTfdc4||!trim($Hqm42kdaBr[1][$i+1])) && ($i<count($Hqm42kdaBr[1]))); $l1acf4pof0Or6uMILSm .= trim($gjEB17v5UJj1SxRZ); } return $l1acf4pof0Or6uMILSm; } } $PqrWr4MLtujWK1b_W = new HTTPFetch(); 


































































































