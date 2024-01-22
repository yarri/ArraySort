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
			"Orange",
		],$ar2);

		$ar2 = array_sort($ar,null,SORT_LOCALE_STRING,["reverse" => true]);
		$this->assertEquals([
			"Orange",
			"Melon",
			"Banana",
			"Apple",
			"Apple",
		],$ar2);

		$ar2 = array_sort($ar,null,SORT_LOCALE_STRING,["preserve_keys" => true]);
		$this->assertEquals([
			"Apple",
			"Apple",
			"Banana",
			"Melon",
			"Orange",
		],array_values($ar2));
		$this->assertEquals([
			7,
			33,
			11,
			222,
			10,
		],array_keys($ar2));

		$ar2 = array_sort($ar,null,SORT_LOCALE_STRING,["preserve_keys" => true, "reverse" => true]);
		$this->assertEquals([
			"Orange",
			"Melon",
			"Banana",
			"Apple",
			"Apple",
		],array_values($ar2));
		$this->assertEquals([
			10,
			222,
			11,
			33,
			7,
		],array_keys($ar2));

		// sort_keys

		$ar3 = array_sort($ar,null,SORT_LOCALE_STRING,["sort_keys" => true]);
		$this->assertEquals([
			"Orange",
			"Banana",
			"Melon",
			"Apple",
			"Apple",
		],array_values($ar3));
		$this->assertEquals([
			10,
			11,
			222,
			33,
			7,
		],array_keys($ar3));

		$ar3 = array_sort($ar,null,SORT_LOCALE_STRING,["sort_keys" => true, "reverse" => true]);
		$this->assertEquals([
			"Apple",
			"Apple",
			"Melon",
			"Banana",
			"Orange",
		],array_values($ar3));
		$this->assertEquals([
			7,
			33,
			222,
			11,
			10,
		],array_keys($ar3));

		$ar3 = array_sort($ar,null,SORT_NUMERIC,["sort_keys" => true]);
		$this->assertEquals([
			"Apple",
			"Orange",
			"Banana",
			"Apple",
			"Melon",
		],array_values($ar3));
		$this->assertEquals([
			7,
			10,
			11,
			33,
			222,
		],array_keys($ar3));
	}
}
