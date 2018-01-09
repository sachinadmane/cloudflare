<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 1/8/2018
 * Time: 8:15 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');

if(isset($_REQUEST['submit'])){


    $firstname=$mysqli->real_escape_string($_REQUEST['firstname']);

    $lastname=$mysqli->real_escape_string($_REQUEST['lastname']);

    $email=$mysqli->real_escape_string($_REQUEST['email']);

    $password=$mysqli->real_escape_string($_REQUEST['password']);

    $length = 12;
    $encrypted_id = substr(str_shuffle(md5(time())),0,$length);

    $salt= substr(str_shuffle(md5(time())),0,7);

    $hashpassword = md5($salt . $password) . ':' . $salt;

    $query="INSERT INTO customers(first_name,last_name,email,encrypted_id,password)VALUES('$firstname','$lastname','$email','$encrypted_id','$hashpassword')";

    $mysqli->query($query);

    $id=$mysqli->insert_id;

    echo json_encode(array("id"=>$id));

    exit();

}