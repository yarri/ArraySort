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
		"reverse" => false,
		"preserve_keys" => false,
	];

	$in = array_map($callable,$ar);

	if($options["reverse"]){
		arsort($in,$flags);
	}else{
		asort($in,$flags);
	}

	$out = [];
	foreach(array_keys($in) as $k){
		$out[$k] = $ar[$k];
	}

	if(!$options["preserve_keys"]){
		$out = array_values($out);
	}

	return $out;
}
