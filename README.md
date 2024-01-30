ArraySort
=========

[![Build Status](https://app.travis-ci.com/yarri/ArraySort.svg?branch=master)](https://app.travis-ci.com/yarri/ArraySort)

The definitive function for sorting arrays in PHP.

Function signatures
-------------------

    array_sort(array $array): array
    array_sort(array $array, array $options = []): array
    array_sort(array $array, int $flags = SORT_LOCALE_STRING): array
    array_sort(array $array, int $flags = SORT_LOCALE_STRING, array $options = []): array
    array_sort(array $array, int $flags = SORT_LOCALE_STRING, callable $callback = null, array $options = []): array
    array_sort(array $array, callback $callback = null, array $options = []): array

#### Parameters

**array**

The input array.

**flags**

The parameter flags may be used to modify the sorting behavior using these values:
  
* SORT_REGULAR - compare items normally; the details are described in the comparison operators section
* SORT_NUMERIC - compare items numerically
* SORT_STRING - compare items as strings
* SORT_LOCALE_STRING - compare items as strings, based on the current locale. It uses the locale, which can be changed using setlocale()
* SORT_NATURAL - compare items as strings using "natural ordering" like natsort()
* SORT_FLAG_CASE - can be combined (bitwise OR) with SORT_STRING or SORT_NATURAL to sort strings case-insensitively

**callback**

The parameter callback is a function to convert an array item to its string or numeric form. If it is set to NULL the default function is used:

    $callback = function($item){ return (string)$item; };

**options**

The default options are:

    Array(
      "sort_keys" => false,
      "reverse" => false,
      "preserve_keys" => false,
    )

#### Return value

The function array_sort returns the sorted array.

Usage
-----

    $fruits = ["d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple"];

    array_sort($fruits); // ["apple", "banana", "lemon", "orange"]
    array_sort($fruits,["reverse" => true]); // ["orange", "lemon", "banana", "apple"]

    array_sort($fruits,["preserve_keys" => true]); // ["c" => "apple", "b" => "banana", "d" => "lemon", "a" => "orange"]
    array_sort($fruits,["preserve_keys" => true, "reverse" => true]); // ["a" => "orange", "d" => "lemon", "b" => "banana", "c" => "apple"]

    // === SORTING KEYS ===

    array_sort($fruits,["sort_keys" => true]); // ["a" => "orange", "b" => "banana", "c" => "apple", "d" => "lemon"]
    array_sort($fruits,["sort_keys" => true, "reverse" => true]); // ["d" => "lemon", "c" => "apple", "b" => "banana", "a" => "orange"]

    // === NUMERIC SORTING ===

    $numbers = ["d" => 200, "a" => 100, "b" => 20, "c" => 10];

    // not yet :)
    array_sort($numbers); // [10, 100, 20, 200];

    array_sort($numbers,SORT_NUMERIC); // [10, 20, 100, 200]
    array_sort($numbers,SORT_NUMERIC,["reverse" => true]); // [200, 100, 20, 10]

    array_sort($numbers,SORT_NUMERIC,["preserve_keys" => true]); // ["c" => 10, "b" => 20, "a" => 100, "d" => 200]

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
    array_sort($books, function($book){ return $book["author"]; });
    // [
    //   [
    //     "author" => "King, Stephen",
    //     "title" => "The X-Files",
    //   ],
    //   [
    //     "author" => "Tolstoy, Leo",
    //     "title" => "War and Peace",
    //   ],
    //   [
    //     "author" => "Toole, John Kennedy",
    //     "title" => "A Confederacy of Dunces",
    //   ],
    //   [
    //     "author" => "Verne, Jules",
    //     "title" => "Around the World in Eighty Days",
    //   ],
    // ]

    // sorting by the title without article
    array_sort($books, function($book){ return preg_replace("/^(a|the) /i","",$book["title"]); });
    // [
    //   [
    //     "author" => "Verne, Jules",
    //     "title" => "Around the World in Eighty Days",
    //   ],
    //   [
    //     "author" => "Toole, John Kennedy",
    //     "title" => "A Confederacy of Dunces",
    //   ],
    //   [
    //     "author" => "Tolstoy, Leo",
    //     "title" => "War and Peace",
    //   ],
    //   [
    //     "author" => "King, Stephen",
    //     "title" => "The X-Files",
    //   ],
    // ]


Installation
------------

Just use the Composer:

    composer require yarri/array-sort

License
-------

ArraySort is free software distributed [under the terms of the MIT license](http://www.opensource.org/licenses/mit-license)

[//]: # ( vim: set ts=2 et: )
