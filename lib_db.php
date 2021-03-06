<?php


/*
 * Database abstractions, note that these functions return an iterable db resultset or an array
 *
 * @package db
 */

/**
 * Run bound queries on the database.
 *
 * Use: query('select all from players limit :count', array('count'=>10));
 * Or: query('select all from players limit :count', array('count'=>array(10, PDO::PARAM_INT)));
 *
 * Note that it returns foreachable resultset object unless an array is specifically requested.
**/
function query($sql, $bindings=array(), $return_resultset=false){
    static $pdo;
    if(!$pdo){
    	try {
    		// *** SINGLE TIME CONNECTION TO THE DATABASE ***
    		$pdo = new PDO(CONNECTION_STRING, DBUSER, DBPASS);
    		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	} catch (Exception $e) {   // *** We catch this error to keep the exception from throwing back essential connection data.
    		throw new Exception('The Database connection failed.');
    	}
    }
	$statement = $pdo->prepare($sql);
	foreach($bindings as $binding => $value){
		if(is_array($value)){
		    // Cast the bindings when something to cast to was sent in.
			$statement->bindParam($binding, $value[0], $value[1]);
		} else {
			$statement->bindValue($binding, $value);
		}
	}
	$statement->execute();

	if($return_resultset){
		return $statement;  // Returns a foreachable resultset
	}
	
	// Otherwise returns an associative array.
	return $statement->fetchAll(PDO::FETCH_ASSOC); 
}

// Wrapper to explicitly & simply get a resultset.
function query_resultset($sql_query, $bindings=array()){
	return query($sql_query, $bindings, $resultset=true);
}

// Run to just get the first row, for 1 row queries.
function query_row($sql, $bindings=array()){
    $resultset = query_resultset($sql, $bindings);
	return $resultset->fetch(PDO::FETCH_ASSOC);
}

// Get only the first result item.
function query_item($sql, $bindings=array()){
	$row = query_row($sql, $bindings);
	return is_array($row)? reset($row) : null;
}

?>
