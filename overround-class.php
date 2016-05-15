<?php

/* Weighted Over Rounds rev05.xls

$or = new overround();
$or->find_or(1.90, 3.30, 3.75, 54.28,23.23,22.49) ;

echo "H-odd: $or->hodd <br/>";
echo "D-odd: $or->dodd <br/>";
echo "A-odd: $or->aodd <br/><br/>";
echo "H-Pb: $or->hpb <br/>";
echo "D-Pb: $or->dpb <br/>";
echo "A-Pb: $or->apb <br/><br/>";

echo "M-OR: $or->match_or <br/>";
echo "H-OR: $or->home_or <br/>";
echo "D-OR: $or->draw_or <br/>";
echo "A-OR: $or->away_or <br/><br/>";

echo "HFlag: " . $or->home_value . "<br/>";
echo "AFlag: " . $or->away_value . "<br/>";

*/

class overround{

	var $match_or= 0;
	var $home_or = 0;
	var $draw_or = 0;
	var $away_or = 0;

	var $hodd = 0;
	var $dodd = 0;
	var $aodd = 0;

	var $hpb = 0;
	var $dpb = 0;
	var $apb = 0;

	var $home_value = 0;
	var $away_value = 0;

	var $odd_sum = 0;
	var $bookie_home = 0;
	var $bookie_away = 0;
	var $bookie_draw = 0;

	function find_or($h_odd, $d_odd, $a_odd, $hprob, $dprob, $aprob){

		$this->home_value = 0;
		$this->away_value = 0;

		$this->hodd = ($h_odd<1 ? 1 : $h_odd);
		$this->dodd = ($d_odd<1 ? 1 : $d_odd);
		$this->aodd = ($a_odd<1 ? 1 : $a_odd);

		$this->hpb = $hprob;
		$this->dpb = $dprob;
		$this->apb = $aprob;

		$this->odd_sum = num20(((1/$this->hodd)*100) +  ((1/$this->dodd)*100) + ((1/$this->aodd)*100)) ;

		$this->bookie_home = num20(((1/$this->hodd)*100)/ $this->odd_sum  * 100) ;
		$this->bookie_away = num20(((1/$this->aodd)*100)/ $this->odd_sum  * 100) ;
		$this->bookie_draw = num20(((1/$this->dodd)*100)/ $this->odd_sum  * 100) ;

		$this->match_or = num20( ( (1/$this->hodd) + (1/$this->dodd) + (1/$this->aodd) - 1 ) * 100) ;   

		$this->home_or = num20((($this->bookie_home - $this->hpb)/$this->bookie_home) * 100);
		$this->draw_or = num20((($this->bookie_draw - $this->dpb)/$this->bookie_draw) * 100);
		$this->away_or = num20((($this->bookie_away - $this->apb)/$this->bookie_away) * 100);
		
		if ( ($this->hpb > 50.00) and ($this->home_or < 5.00) ){
			$this->home_value = 1;
			$this->away_value = 0;
		}

		if ( ($this->apb > 50.00) and ($this->away_or < 5.00) ){
			$this->away_value = 1;
			$this->home_value = 0;
		}

		

	}

}

?>