<?php
/**
 *
 * $articles = Article::FindAll();
 * // Note that the class Article has the magic __toString() method which returns the title of the given article.
 *
 * // Sorting articles by title
 * $articles = array_sort($articles);
 *
 * // Sorting articles by title
 * $articles = array_sort($articles,["reverse" => true]);
 *
 * // Sorting articles by title
 * $articles = array_sort($articles);
 *
 */
function array_sort($ar,$flags = SORT_LOCALE_STRING,$callback = null,$options = []){
	if(!is_null($callback) && !is_callable($callback)){
		if(is_array($callback)){
			$options = $callback;
			$callback = null;
		}elseif(is_numeric($callback)){
			$flags = $callback;
			$callback = null;
		}
	}

	if(!is_numeric($flags)){
		if(is_callable($flags)){
			$callback = $flags;
			$flags = SORT_LOCALE_STRING;
		}elseif(is_array($flags)){
			$options = $flags;
			$flags = SORT_LOCALE_STRING;
		}
	}

	if(is_null($callback)){
		$callback = function($item){ return (string)$item; };
	}

	$options += [
		"sort_keys" => false,
	];

	$options += [
		"reverse" => false,
		"preserve_keys" => $options["sort_keys"], // default false
	];

	$keys = array_keys($ar);
	if($options["sort_keys"]){
		$in = $keys;
	}else{
		$in = array_values($ar);
	}

	$in = array_map($callback,$in);

	asort($in,$flags);

	if($options["reverse"]){
		$in = array_reverse($in,true);
	}

	$out = [];
	foreach(array_keys($in) as $k){
		$key = $keys[$k];
		$out[$key] = $ar[$key];
	}

	if(!$options["preserve_keys"]){
		$out = array_values($out);
	}

	return $out;
}
