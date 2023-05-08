<?php 
	function array_strtonum($input) {
		array_walk_recursive($input, function(&$v) {
			if (is_numeric($v)) $v = strpos($v, '.') !== false ? floatval($v) : intval($v);
		});
		return $input;
	}

	function nonnull($x) {
	   return isset($x) && !empty($x);
	}
?>
