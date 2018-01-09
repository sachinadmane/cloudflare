<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');

if(strtolower($_SERVER['REQUEST_METHOD'])=='delete'){

    $id=$mysqli->real_escape_string($_REQUEST['id']);

    $response=array();

    if($id){
        $query="DELETE FROM customers WHERE id='$id'";
        $mysqli->query($query);
       $mysqli->affected_rows>0?$response['status']=true:$response['status']=false;
    }

    echo json_encode($response);
    exit();

}


$query="SELECT c.*,group_concat(concat(cc.id,'_',cc.`active`, '_', cc.created_at ) )as certs FROM `customers` c LEFT JOIN customer_certificate cc on c.id=cc.customer_id GROUP BY c.id";

$result=$mysqli->query($query);

$response=array();

while($row=$result->fetch_assoc()) {
    $response[] = $row;

}

echo json_encode($response);