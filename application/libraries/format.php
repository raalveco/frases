<?php
	class Format{
		public static function uncamelize($input) {
			preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
			$ret = $matches[0];
			foreach ($ret as &$match) {
		    	$match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
			}
		  	return implode('_', $ret);
		}
		
		public static function camelize($value, $lcfirst = true){
		  	$value = preg_replace("/([_-\s]?([a-z0-9]+))/e", "ucwords('\\2')", $value);
		  	return ($lcfirst ? strtolower($value[0]) : strtoupper($value[0])) + substr($value, 1);
		}
	}
?>