<?
/**
 * Handles the operations regarding a database record.
 */
include_once 'dbrecordmodel.php';

class userModel extends dbRecordModel {
	function __construct() {
		parent::__construct();
	 	$this->table = 'user';
	 	$this->columns = array('userid','username','password');
	 	$this->primaryKey = 'userid';
	}
}
?>
