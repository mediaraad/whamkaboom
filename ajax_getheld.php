<?php
// prevent direct access
/*$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
if(!$isAjax) {
	$user_error = 'Access denied - not an AJAX request...';
	trigger_error($user_error, E_USER_ERROR);
	}*/


$held = $_POST['deVar'];
$held = str_replace("'","&#39;",$held);
 
$a_json = array();
$a_json_row = array();
 
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

$sql = 'SELECT stripheld_id, stripheld_held,stripheld_titelalbum FROM stripheld_tbl WHERE stripheld_held is not null ';
$sql .= ' AND stripheld_held = ' . "'" . $conn->real_escape_string($held) . "'";

$rs = $conn->query($sql);
if($rs === false) {
	$user_error = 'Wrong SQL: ' . $sql . 'Error: ' . $conn->errno . ' ' . $conn->error;
	trigger_error($user_error, E_USER_ERROR);
	}

while($row = $rs->fetch_assoc()) {
    $a_json_row["id"] = $row['stripheld_id'];
    $a_json_row["held"] = $row['stripheld_held'];
    $a_json_row["titel"] = $row['stripheld_titelalbum'];
    array_push($a_json, $a_json_row);
	}

$json = json_encode($a_json);
echo $json;
?>