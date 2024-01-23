ArraySort
=========

The definitive function for sorting arrays in PHP.

Usage
-----

  $fruits = ["d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple"];

  array_sort($fruits); // ["apple", "banana", "lemon", "orange"]
  array_sort($fruits,["reverse" => true]); // ["orange", "lemon", "banana", "apple"]

  array_sort($fruits,["preserve_keys" => true]); // ["c" => "apple", "b" => "banana", "d" => "lemon", "a" => "orange"]
  array_sort($fruits,["preserve_keys" => true, "reverse" => true]); // ["a" => "orange", "d" => "lemon", "b" => "banana", "c" => "apple"]

  array_sort($fruits,["sort_keys" => true]); // ["a" => "orange", "b" => "banana", "c" => "apple", "d" => "lemon"]
  array_sort($fruits,["sort_keys" => true, "reverse" => true]); // ["d" => "lemon", "c" => "apple", "b" => "banana", "a" => "orange"]

  // numeric sorting

  $numbers = ["d" => 200, "a" => 100, "b" => 20, "c" => 10];

  // not yet :)
  array_sort($numbers); // [10, 100, 20, 200];

  array_sort($numbers,SORT_NUMERIC); // [10, 20, 100, 200]
  array_sort($numbers,SORT_NUMERIC,["reverse" => true]); // [200, 100, 20, 10]

  array_sort($numbers,SORT_NUMERIC,["preserve_keys" => true]); // ["c" => 10, "b" => 20, "a" => 100, "d" => 200]

Installation
------------

Just use the Composer:

    composer require yarri/array-sort

License
-------

ArraySort is free software distributed [under the terms of the MIT license](http://www.opensource.org/licenses/mit-license)

[//]: # ( vim: set ts=2 et: )
