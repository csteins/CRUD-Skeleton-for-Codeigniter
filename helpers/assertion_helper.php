<?php
/**
 * Provides assertion functions for databases.
 */

/**
 * Check if an assertion for a database table is true
 *
 * @param string $table Name of the database table of filter values or an SQL string
 * @param mixed[] $data Array structure of the database record of check for
 * @param int $num Number of expected rows
 * @param mixed[] $ignore Array of database table attributes to ignore
 * @param string $operator The comparision operator for the assertion

 * @return bool Returns if the assertion is valid or not.
 */
function assert_sql($table, $data, $num,$ignore=array(),$operator="==") {
	// Ingnore the irrelevant table fields
	for($i=0;$i<count($ignore);$i++) {
		unset($data[$ignore[$i]]);
	}
	//Query the database
	$ci=& get_instance();
	$ci->load->database();
	$query = $ci->db->get_where($table, $data);

	//Check if the returned number of rows match the expected
	switch ($operator) {
		case "==":
			if ($query->num_rows() == $num) {
				return true;
			}
			break;
		case "<=":
			if ($query->num_rows() <= $num) {
				return true;
			}
			break;
		case ">=":
			if ($query->num_rows() >= $num) {
				return true;
			}
			break;
	}

	$error_message = "Assertion violated\n";
	$error_message .= "Table:$table\n";
	foreach($data as $key=>$value) {
		$error_message .=  $key . ":" . $value ."\n";
	}
	$error_message .=  "Ignorierte Felder:" . implode(",",$ignore) . "\n";
	$error_message .=  "Operator:$operator\n";
	$error_message .=  "Expected result:$num\n";
	$error_message .=  "Actual result:" . $query->num_rows()  ."\n";
	log_message('error', $error_message);

	return false;
}

/**
 * Check if an assertion for a database table is true with the operator set to "=="
 *
 * @param string $table Name of the database table of filter values or an SQL string
 * @param mixed[] $data Array structure of the database record of check for
 * @param int $num Number of expected rows
 * @param mixed[] $ignore Array of database table attributes to ignore

 * @return bool Returns if the assertion is valid or not.
 */
function assert_sql_equals($table, $data, $num,$ignore=array()) {
	return assert_sql($table, $data, $num,$ignore,"==");
}

/**
 * Check if an assertion for a database table is true with the operator set to ">"
 *
 * @param string $table Name of the database table of filter values or an SQL string
 * @param mixed[] $data Array structure of the database record of check for
 * @param int $num Number of expected rows
 * @param mixed[] $ignore Array of database table attributes to ignore

 * @return bool Returns if the assertion is valid or not.
 */
function assert_sql_greater($table, $data, $num,$ignore=array()) {
	return assert_sql($table, $data, $num,$ignore,">");
}
/**
 * Check if an assertion for a database table is true with the operator set to "<"
 *
 * @param string $table Name of the database table of filter values or an SQL string
 * @param mixed[] $data Array structure of the database record of check for
 * @param int $num Number of expected rows
 * @param mixed[] $ignore Array of database table attributes to ignore

 * @return bool Returns if the assertion is valid or not.
 */

function assert_sql_smaller($table, $data, $num,$ignore=array()) {
	return assert_sql($table, $data, $num,$ignore,"<");
}
?>