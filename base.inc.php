<?php
/**
 * The include file for non-executing libraries.  
 * Anything included here should not execute any code, only define functions or classes.
 *
 * @package lib
 * @subpackage base
**/

// Cut down on the global includes, use specific includes instead.

require_once(dirname(__FILE__)."/resources.php");

// *** Include all common function includes here.
require_once(LIB_ROOT."lib_input.php");
require_once(LIB_ROOT."lib_db.php");
?>
