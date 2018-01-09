<?php
/**
 Looks up a certificate in the database and toggles between active and inactive values.
 * This file is called from the UI through an Ajax request
 */
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
if (isset($_REQUEST['submit'])) {
    $cert_id = $mysqli->real_escape_string($_REQUEST['id']);

    $query = "SELECT `active` FROM customer_certificate WHERE id='$cert_id'";
    $result = $mysqli->query($query);
    $active = null;
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $active = $row['active'];
        }
        if ($active > 0) {
            $update = "UPDATE `customer_certificate` SET active='0' WHERE id='$cert_id'";
        } else {
            $update = "UPDATE `customer_certificate` SET active='1' WHERE id='$cert_id'";
        }

        $mysqli->query($update);
    }


}