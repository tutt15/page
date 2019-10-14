<?php

function strFindImg($str)
{
	$lastPos = 0;
	$positions = array();

	preg_match_all("|src=\"(.*)\"|U",
    $str,
    $out, PREG_PATTERN_ORDER);

	return $out;
}