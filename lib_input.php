<?php
/*
 * Deals with getting and filtering user input (just from request).
 *
 * @package input
 */

// Input function that by default LEAVES INPUT COMPLETELY UNFILTERED
// To not filter some input, you have to explicitly pass in null for the third parameter,
// e.g. in('some_url_parameter', null, null)
function in($var_name, $default_val=null, $filter_function=null){
    $result = isset($_REQUEST[$var_name])? $_REQUEST[$var_name] : $default_val;
    // Check that the filter function sent in exists.
    if($filter_function && function_exists($filter_function)){
        $result = $filter_function($result);
    }
    return $result;
}


?>
