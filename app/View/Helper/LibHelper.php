<?php
class LibHelper extends AppHelper {
	function randomNumber($option=10){
		$int = rand(0,51);
		$a_z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$rand_letter = $a_z[$int];
		for($i=1;$i<$option;$i++){
			$int1 = rand(0,51);
			$rand_letter.= $a_z[$int1];
		}
		return $rand_letter;
	}
	public function formatPrice($number){
		$number = intval($number);
		return $number = number_format($number, 0, '.', ',') . ' VNĐ';
	}
	public function formatPriceNot($number){
		$number = intval($number);
		return $number = number_format($number, 0, '.', ',');
	}
}
