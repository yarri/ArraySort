<?php
class TcIssue extends TcBase {

	function test(){
		$ar = [
			"(kocka)",
			"!(kocka)",
			"(kocka)",
		];
		$this->assertArrayEquals([
			"!(kocka)",
			"(kocka)",
			"(kocka)",
		],array_sort($ar));

		$ar = [
			"('kocka' | 'kun') 0" => "_repl6661cd3c42bac_1_",
			"(!'kocka' & !'kun') 1" => "_repl6661cd3c42bac_2_",
		];
		$this->assertArrayEquals([
			"(!'kocka' & !'kun') 1" => "_repl6661cd3c42bac_2_",
			"('kocka' | 'kun') 0" => "_repl6661cd3c42bac_1_",
		],array_sort($ar,["sort_keys" => true]));
	}
}
