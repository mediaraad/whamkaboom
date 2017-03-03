<?php
// prevent direct access
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
if(!$isAjax) {
	$user_error = 'Access denied - not an AJAX request...';
	trigger_error($user_error, E_USER_ERROR);
	}


// get what user typed in autocomplete input
$term = trim($_GET['term']);
 
$a_json = array();
$a_json_row = array();
 
//$a_json_invalid = array(array("id" => "#", "value" => $term, "label" => "Only letters and digits are permitted..."));
//$json_invalid = json_encode($a_json_invalid);
 
// replace multiple spaces with one
$term = preg_replace('/\s+/', ' ', $term);
 
// SECURITY HOLE ***************************************************************
// allow space, any unicode letter and digit, underscore and dash
//if(preg_match("/[^\040\pL\pN_-]/u", $term)) {
//	print $json_invalid;
//	exit;
//	}
// *****************************************************************************
 
// database connection
$conn = new mysqli("localhost", "root", "buhbuh", "strip_db");
 
if($conn->connect_error) {
	echo 'Database connection failed...' . 'Error: ' . $conn->connect_errno . ' ' . $conn->connect_error;
	exit;
	} 
else $conn->set_charset('utf8');
 

/** 
 * Create SQL
 */

$sql = 'SELECT stripheld_id, stripheld_held FROM stripheld_tbl WHERE stripheld_held is not null ';
$sql .= ' AND stripheld_held LIKE ' . "'" . $conn->real_escape_string($term) . "%'";
$sql .=' group by stripheld_held';
//$sql .=' order by stripheld_held';
 
$rs = $conn->query($sql);
if($rs === false) {
	$user_error = 'Wrong SQL: ' . $sql . 'Error: ' . $conn->errno . ' ' . $conn->error;
	trigger_error($user_error, E_USER_ERROR);
	}

while($row = $rs->fetch_assoc()) {
    $a_json_row["id"] = $row['stripheld_id'];
    $a_json_row["value"] = $row['stripheld_held'];
    $a_json_row["label"] = $row['stripheld_held'];
    array_push($a_json, $a_json_row);
	}

$json = json_encode($a_json);
echo $json;
?>