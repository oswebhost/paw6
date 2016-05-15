<?php

// 

$or = new asianhandicap();
$or->ahcap_outcome() ;

echo "H-odd: $or->hodd <br/>";



class asianhandicap{

	var $total_unit = 0;
	var $void_unit  = 0;
	var $corret_unit = 0;
	
	var $part1_char = 0;
	var $part2_char = 0;
	var $final_char = 0;
	

	function ahcap_outcome($ht_asl, $at_asl, $ht_act, $at_act, $ht_hcap, $at_hcap, $ht_odd, $at_odd ){

		$this->$ht_asl = $ht_asl ;
		$this->$at_asl = $at_asl ;
		
		$this->$h_s  = $ht_act;
		$this->$a_s  = $at_act;
		
		$this->$hcap = $ht_hcap;
		$this->$acap = $at_hcap;
		$this->handicap = $ht_hcap+$at_hcap ;// sum the handicap
		
		$this->$hodd = $ht_odd;
		$this->$aodd = $at_odd;
		
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
				
				

			
				break;
		
			default: 
		}

		
			

	}

}

?>