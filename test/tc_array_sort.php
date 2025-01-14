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

		$ar2 = array_sort($ar,SORT_LOCALE_STRING,null,["reverse" => true]);
		$this->assertEquals([
			"Orange",
			"Melon",
			"Banana",
			"Apple",
			"Apple",
		],$ar2);

		$ar2 = array_sort($ar,SORT_LOCALE_STRING,null,["preserve_keys" => true]);
		$this->assertEquals([
			7 => "Apple",
			33 => "Apple",
			11 => "Banana",
			222 => "Melon",
			10 => "Orange",
		],$ar2);

		$ar2 = array_sort($ar,SORT_LOCALE_STRING,null,["preserve_keys" => true, "reverse" => true]);
		$this->assertArrayEquals([
			10 => "Orange",
			222 => "Melon",
			11 => "Banana",
			33 => "Apple",
			7 => "Apple",
		],$ar2);

		// sort_keys

		$ar3 = array_sort($ar,SORT_LOCALE_STRING,null,["sort_keys" => true]);
		$this->assertArrayEquals([
			10 => "Orange",
			11 => "Banana",
			222 => "Melon",
			33 => "Apple",
			7 => "Apple",
		],$ar3);

		$ar3 = array_sort($ar,SORT_LOCALE_STRING,null,["sort_keys" => true, "reverse" => true]);
		$this->assertArrayEquals([
			7 => "Apple",
			33 => "Apple",
			222 => "Melon",
			11 => "Banana",
			10 => "Orange",
		],$ar3);

		$ar3 = array_sort($ar,null,SORT_NUMERIC,["sort_keys" => true]);
		$this->assertArrayEquals([
			7 => "Apple",
			10 => "Orange",
			11 => "Banana",
			33 => "Apple",
			222 => "Melon",
		],$ar3);
	}

	function test_usage(){
		$fruits = ["d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple"];

		$sorted = array_sort($fruits);
		$this->assertArrayEquals(["apple","banana","lemon","orange"],$sorted);

		$sorted = array_sort($fruits,["reverse" => true]);
		$this->assertArrayEquals(["orange","lemon","banana","apple"],$sorted);

		$sorted = array_sort($fruits,["preserve_keys" => true]);
		$this->assertArrayEquals(["c" => "apple", "b" => "banana", "d" => "lemon", "a" => "orange"],$sorted);

		$sorted = array_sort($fruits,["preserve_keys" => true, "reverse" => true]);
		$this->assertArrayEquals(["a" => "orange", "d" => "lemon", "b" => "banana", "c" => "apple"],$sorted);

		$sorted = array_sort($fruits,["sort_keys" => true]);
		$this->assertArrayEquals(["a" => "orange", "b" => "banana", "c" => "apple", "d" => "lemon"],$sorted);

		$sorted = array_sort($fruits,["sort_keys" => true, "reverse" => true]);
		$this->assertArrayEquals(["d" => "lemon", "c" => "apple", "b" => "banana", "a" => "orange"],$sorted);

		// === NUMERIC SORTING ===

		$numbers = ["d" => 200, "a" => 100, "b" => 20, "c" => 10];

		$sorted = array_sort($numbers);
		$this->assertArrayEquals($sorted,[10, 100, 20, 200]);

		$sorted = array_sort($numbers,SORT_NUMERIC);
		$this->assertArrayEquals($sorted,[10, 20, 100, 200]);

		$sorted = array_sort($numbers,SORT_NUMERIC,["reverse" => true]);
		$this->assertArrayEquals($sorted,[200, 100, 20, 10]);

		$sorted = array_sort($numbers,SORT_NUMERIC,["preserve_keys" => true]);
		$this->assertArrayEquals($sorted,["c" => 10, "b" => 20, "a" => 100, "d" => 200]);

		// === SORTING OF STRUCTURES ===

		$books = [
			[
				"author" => "Verne, Jules",
				"title" => "Around the World in Eighty Days",
			],
			[
				"author" => "Tolstoy, Leo",
				"title" => "War and Peace",
			],
			[
				"author" => "King, Stephen",
				"title" => "The X-Files",
			],
			[
				"author" => "Toole, John Kennedy",
				"title" => "A Confederacy of Dunces",
			],
		];

		// sorting by the author
		$sorted = array_sort($books, function($book){ return $book["author"]; });
		$this->assertArrayEquals([
			[
				"author" => "King, Stephen",
				"title" => "The X-Files",
			],
			[
				"author" => "Tolstoy, Leo",
				"title" => "War and Peace",
			],
			[
				"author" => "Toole, John Kennedy",
				"title" => "A Confederacy of Dunces",
			],
			[
				"author" => "Verne, Jules",
				"title" => "Around the World in Eighty Days",
			],
		],$sorted);

		// sorting by the title without article
		$sorted = array_sort($books, function($book){ return preg_replace("/^(an?|the) /i","",$book["title"]); });
		$this->assertArrayEquals([
			[
				"author" => "Verne, Jules",
				"title" => "Around the World in Eighty Days",
			],
			[
				"author" => "Toole, John Kennedy",
				"title" => "A Confederacy of Dunces",
			],
			[
				"author" => "Tolstoy, Leo",
				"title" => "War and Peace",
			],
			[
				"author" => "King, Stephen",
				"title" => "The X-Files",
			],
		],$sorted);
	}
}
