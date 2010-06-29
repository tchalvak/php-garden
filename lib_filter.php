<?php
/*
 * Filtering functions.
 *
 * @package input
 */


// Casts to an integer anything that can be cast that way non-destructively, otherwise null.
function sanitize_to_int($dirty){
	if($dirty == (int) $dirty){ // Cast anything that can be non-destructively cast.
		$res = (int) $dirty;
	} else {
		$res = null;
	}
	return $res;
}

// Strip everything except alphanumeric, underscore, and dash
function sanitize_to_word($dirty){
	return preg_replace("[^A-Za-z0-9_\-]", "", (string) $dirty);	
}

// Strip everything except words, digits, spaces, _, -, ., @, :, and slash for urls /
function sanitize_to_text($dirty){
    // Allows words, digits, spaces, _, -, ., @, :, and slash for urls /
	return preg_replace("/[^\w\d\s_\-\.\@\:\/]/", "", (string) $dirty);
}

function sanitize_to_email($dirty){
	return filter_var($dirty, FILTER_SANITIZE_EMAIL);
}



// Restrict an option to certain possibilities, e.g. for an orderby string, the possibilities could be an array of column names.
function restrict_to($original, $possibilities=array(), $default=null){
	foreach ($possibilities as $possibility){
		if ($original == $possibility){
			return $original;
		}
	}
	return $default;  // If the original doesn't match, just return the default.
}

?>
