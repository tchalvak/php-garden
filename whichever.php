<?php
/**
 * Return first non-null argument.
**/
function whichever() {
    $arg_list = func_get_args();
    foreach($arg_list as $l_arg){
        if(!is_null($l_arg)){
            return $l_arg;
        }
    }
    return null;
}

?>
