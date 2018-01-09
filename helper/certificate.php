<?php
/**
 * Created by PhpStorm.
 * User: sachin
 * Date: 1/7/2018
 * Time: 5:22 PM
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
$file=$_SERVER['DOCUMENT_ROOT'].'/openssl.cnf';
if(isset($_REQUEST['submit'])){


    $cid=$mysqli->real_escape_string($_REQUEST['id']);

    $query="SELECT * FROM `customers` WHERE `id`='$cid' LIMIT 1";

    $result=$mysqli->query($query);

    if($result){

        while($row=$result->fetch_assoc()){

            $email=$row['email'];
            $customer_name=$row['first_name']." ".$row['last_name'];
            $password=$row['password'];
        }
    }

    $dn = array(
        "countryName" => "US",
        "stateOrProvinceName" => "CA",
        "commonName" => "$customer_name",
        "emailAddress" => "$email",
        "localityName" => "San Francisco",
        "organizationName" => "Cloudflare",
        "organizationalUnitName" => "DEV",
    );

// Generate a new private (and public) key pair
    $privkey = openssl_pkey_new(array(
        "private_key_bits" => 2048,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
         "config"=>$file

    ));


    openssl_pkey_export($privkey, $pkeyout,$password,array("config"=>$file));
// Generate a certificate signing request
    $csr = openssl_csr_new($dn, $privkey,array("config"=>$file));

// Generate a self-signed cert, valid for 365 days
    $x509 = openssl_csr_sign($csr, null, $privkey, $days=365, array('digest_alg' => 'sha256',"config"=>$file));


    openssl_csr_export($csr, $csrout) ;
    openssl_x509_export($x509, $certout);

    $date= date('Y-m-d H:i:s');

    $insert="INSERT INTO customer_certificate(customer_id,private_key,body,created_at)VALUES($cid,'$pkeyout','$certout','$date')";
    $mysqli->query($insert);
    $id=$mysqli->insert_id;

    echo json_encode(array('id'=>$id,'created_at'=>$date,'active'=>1));
    exit();
}


