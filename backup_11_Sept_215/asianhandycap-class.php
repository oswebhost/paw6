<?php




/*
$or = new asianhandycap();
$or->asian_rt(0,0.25,3,0 , 1.08 ,1.85) ;

echo  $or->hcap . " / " . $or->acap . " ----------- Act RT: " . $or->h_s . " - " . $or->a_s . "<br/>";
echo "H-Odd: " . $or->hodd . " -----------  A-Odd: " . $or->aodd . "<br>";
echo $or->vchar . " - Unit:" . $or->unit . " - correct: " . $or->correct . "<br/><br/><br/><br/>";

$or = new asianhandycap();
$or->asian_rt(0,0.25,2,0 , 2.08 ,1.85) ;

echo  $or->hcap . " / " . $or->acap . " ----------- Act RT: " . $or->h_s . " - " . $or->a_s . "<br/>";
echo "H-Odd: " . $or->hodd . " -----------  A-Odd: " . $or->aodd . "<br>";
echo $or->vchar . " - Unit:" . $or->unit . " - correct: " . $or->correct . "<br/><br/><br/><br/>";

$or = new asianhandycap();
$or->asian_rt(0.25,0,2,2 , 2.08 ,1.85) ;

echo  $or->hcap . " / " . $or->acap . " ----------- Act RT: " . $or->h_s . " - " . $or->a_s . "<br/>";
echo "H-Odd: " . $or->hodd . " -----------  A-Odd: " . $or->aodd . "<br>";
echo $or->vchar . " - Unit:" . $or->unit . " - correct: " . $or->correct . "<br/><br/><br/><br/>";
*/

class asianhandycap{

	var $unit   = 0;
	var $correct= 0;
	
	var $char1  = "";
	var $char2  = "";
	
	var $vchar = "";
	
	var $bookRt = "";
	var $actRt = "";

	function asian_rt($hcap, $acap, $h_s, $a_s, $hodd, $aodd){

		$this->handicap = $hcap+$acap ;// sum the handicap
		$this->hcap = $hcap;
		$this->acap = $acap;
		$this->h_s  = $h_s;
		$this->a_s  = $a_s;
		$this->hodd = $hodd;
		$this->aodd = $aodd;

		switch ($this->handicap){
			case 0.25:
			case 0.75:
			case 1.25:
			case 1.75:
			case 2.25:
			case 2.75:

			$full  = (int) $this->handicap;
			$dec   = $this->handicap - $full;
			
			if ($dec == 0.25){
				$split_1 = 0.00;
				$split_2 = 0.50;
			
			}elseif($dec == 0.75){
				$split_1 = 0.50;
				$split_2 = 1.00;
			}

			$this->bookRt = $this->bookie_char($this->hodd, $this->aodd);

			if ($this->hcap>0){ 
				$bet_1_hgoal = $this->h_s + ($full+$split_1) ;
				$bet_1_agoal = $this->a_s ;
				
				$bet_2_hgoal = $this->h_s + ($full+$split_2) ;
				$bet_2_agoal = $this->a_s ;

				$this->actRt_1 = $this->rt_char($bet_1_hgoal, $bet_1_agoal);
				$this->actRt_2 = $this->rt_char($bet_2_hgoal, $bet_2_agoal);

				if ($this->bookRt == $this->actRt_1){	
					$char1 = "W";
					$unit1  = 0.50;
					$correct1 = 0.50;
				}else{
					if($bet_1_hgoal==$bet_1_agoal){
						$char1 = "NB";
						$unit1  = 0.00;
						$correct1 = 0.00;

					}else{
						$char1 = "L";
						$unit1  = 0.50;
						$correct1 = 0.00;
					}
				}

				if ($this->bookRt == $this->actRt_2){	
					$char2 = "W";
					$unit2  = 0.50;
					$correct2 = 0.50;
				}else{
					if($bet_2_hgoal==$bet_2_agoal){
						$char2 = "NB";
						$unit2  = 0.00;
						$correct2 = 0.00;
					}else{
						$char2 = "L";
						$unit2  = 0.50;
						$correct2 = 0.00;
					}
				}

				$this->vchar = "$char1/$char2";
				$this->unit  = $unit1 + $unit2;
				$this->correct = $correct1 + $correct2 ;
				
				if ($this->h_s=="P"){
					$this->vchar = "-";
					$this->unit  = 0.00;
					$this->correct = 0.00;
				}
				
				if ($this->hodd == $this->aodd){
					$this->vchar = "-";
					$this->unit  = 0.00;
					$this->correct = 0.00;
				}

			}else{

				$bet_1_hgoal = $this->h_s   ;
				$bet_1_agoal = $this->a_s + ($full+$split_1);
				

				$bet_2_hgoal = $this->h_s  ;
				$bet_2_agoal = $this->a_s + ($full+$split_2);


				$this->actRt_1 = $this->rt_char($bet_1_hgoal, $bet_1_agoal);
				$this->actRt_2 = $this->rt_char($bet_2_hgoal, $bet_2_agoal);

				if ($this->bookRt == $this->actRt_1){	
					$char1 = "W";
					$unit1  = 0.50;
					$correct1 = 0.50;
				}else{
					if($bet_1_hgoal==$bet_1_agoal){
						$char1 = "NB";
						$unit1  = 0.00;
						$correct1 = 0.00;

					}else{
						$char1 = "L";
						$unit1  = 0.50;
						$correct1 = 0.00;
					}
				}

				if ($this->bookRt == $this->actRt_2){	
					$char2 = "W";
					$unit2  = 0.50;
					$correct2 = 0.50;
				}else{
					if($bet_2_hgoal==$bet_2_agoal){
						$char2 = "NB";
						$unit2  = 0.00;
						$correct2 = 0.00;
					}else{
						$char2 = "L";
						$unit2  = 0.50;
						$correct2 = 0.00;
					}
				}

				$this->vchar = "$char1/$char2";
				$this->unit  = $unit1 + $unit2;
				$this->correct = $correct1 + $correct2 ;
				
				if ($this->h_s=="P"){
					$this->vchar = "-";
					$this->unit  = 0.00;
					$this->correct = 0.00;
				}

				if ($this->hodd == $this->aodd){
					$this->vchar = "-";
					$this->unit  = 0.00;
					$this->correct = 0.00;
				}

			}

			break;

            

			default:

				$hcap_hgoal = $this->h_s + $this->hcap;
				$hcap_agoal = $this->a_s + $this->acap;

				$this->bookRt = $this->bookie_char($this->hodd, $this->aodd);
				$this->actRt  = $this->rt_char($hcap_hgoal, $hcap_agoal);

				if ($this->bookRt == $this->actRt){	
					$this->vchar = "W";
					$this->unit  = 1.00;
					$this->correct = 1.00;
				}else{
					if($hcap_hgoal == $hcap_agoal){
						$this->vchar = "NB";
						$this->unit  = 0;
						$this->correct = 0.00;
					}else{
						$this->vchar = "L";
						$this->unit  = 1.0;
						$this->correct = 0.00;

					}

				}
				
				if ($this->h_s=="P"){
					$this->vchar = "-";
					$this->unit  = 0.00;
					$this->correct = 0.00;
				}

				if ($this->hodd == $this->aodd){
					$this->vchar = "-";
					$this->unit  = 0.00;
					$this->correct = 0.00;
				}
				break;
		}

	}

	function rt_char($hs, $as){
			$this->rt = "";
			if ($hs>$as){
				$this->rt = "H";
			}elseif($as>$hs){
				$this->rt = "A";
			}else{
				$this->rt = "D";
			}	
			return $this->rt;
	}

	function bookie_char($hs, $as){
			$this->rt = "";
			if ($hs<$as){
				$this->rt = "H";
			}elseif($as<$hs){
				$this->rt = "A";
			}else{
				$this->rt = "D";
			}	
			return $this->rt;
	}
	

}


?>