<?php
 
/*
 * Following code will get single inventory details
 * A inventory is identified by inventory ut_tag (ut_tag)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
$con = $db->connect();
 
// check for post data
if (isset($_GET["ut_tag"])) {
    $ut_tag = $_GET['ut_tag'];
 
    // get a inventory from inventory table
    $result = mysqli_query($con, "SELECT * FROM inventory WHERE ut_tag = $ut_tag");
 
    if (!empty($result)) {
        // check for empty result
        if (mysqli_num_rows($result) > 0) {
 
            // success
            $response["success"] = 1;
            $response["message"] = "Inventory found";
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no inventory found
            $response["success"] = 0;
            $response["message"] = "No inventory found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no inventory found
        $response["success"] = 0;
        $response["message"] = "No inventory found";
 
        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>