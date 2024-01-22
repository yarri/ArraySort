<?php
/**
 *
 * $articles = Article::FindAll();
 * $articles = array_sort($articles,function($article){ return $article->getTitle(); });
 */
function array_sort($ar,$callable = null,$flags = SORT_LOCALE_STRING,$options = []){
	if(is_null($callable)){
		$callable = function($item){ return (string)$item; };
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

	$in = array_map($callable,$in);

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
