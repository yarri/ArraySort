<?php
class TcArraySort extends TcBase {

	function test(){
		$ar = [
			"7" => "Apple",
			"10" => "Orange",
			"11" => "Banana",
			"222" => "Melon",
			"33" => "Apple", // another apple
		];

		$ar2 = array_sort($ar);
		$this->assertEquals([
			"Apple",
			"Apple",
			"Banana",
			"Melon",
			"Orange"
		],$ar2);
	}
}
